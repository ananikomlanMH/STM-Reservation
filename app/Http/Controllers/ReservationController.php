<?php

namespace App\Http\Controllers;

use App\Helpers\TableHelper\TableHelper;
use App\Models\Bus;
use App\Models\Forfait;
use App\Models\Reservation;
use App\Models\Voyageur;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use MongoDB;
use PDF;


class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $token = csrf_token();
        $active_link = 'reservations';

        // Define Table
        $tables = new TableHelper(['_id', 'datedepart', 'heureDepart', 'numBillet', 'valise', 'sac', 'colis', 'gyz', 'siege', 'etatVoyage', 'alleRetour', 'bus', 'agent', 'voyageur', 'montant', 'trajet'], $_GET);
        $tables->setSortable("_id" , "#");
        $tables->setSortable("datedepart" , "Date");
        $tables->setSortable("heureDepart" , "Heure");
        $tables->setSortable("numBillet" , "Billet");
        $tables->setSortable("valise" , "Valise");
        $tables->setSortable("sac" , "Sac");
        $tables->setSortable("colis" , "Colis");
        $tables->setSortable("gyz" , "GYZ");
        $tables->setSortable("siege" , "Siege");
        $tables->setSortable("etatVoyage" , "Etat");
        $tables->setSortable("alleRetour" , "Type");
        $tables->setSortable("bus" , "Bus");
        $tables->setSortable("agent" , "Agent");
        $tables->setSortable("voyageur" , "Voyageur");
        $tables->setSortable("trajet" , "Trajet");
        $tables->setSortable("montant" , "Montant");

        // get Data
        $reservations = Reservation::query()->orderBy($tables->getSort(), $tables->getDir());
        if (request('q')){
            $reservations->where("voyageur", "LIKE", '%'.request('q').'%');
        }
        $limit = (int)request('show') ?: 8;
        $page = (int)request('p') ?: 1;
        $offset = $limit * ($page - 1);
        $nbr_pages = ceil(count($reservations->get())/$limit);
        $allData = $reservations->skip($offset)->take($limit)->get();

        // get search list
        $searchListData = Reservation::all();
        $searchListDataJSON = [];
        foreach ($searchListData as $item){
            $searchListDataJSON[] = $item->voyageur;
        }
        $searchListDataJSON = json_encode($searchListDataJSON);

        // get count data
        $total_data = count($searchListData);
        $current_total_data = $nbr_pages > 1 ? ($limit*($page-1)) + count($allData) :  count($allData);
        $rowStart = (request()->input('p', 1) - 1) * $limit;

        return view('reservations.index', ['reservations'=>$allData,'params'=> compact('active_link', 'token', 'tables', 'searchListDataJSON', 'page', 'nbr_pages', 'total_data', 'current_total_data', 'rowStart')]);
    }

    public function addForm($token)
    {
        if ($token !== csrf_token()){
            abort(404);
        }
        return view('reservations.addForm', ['voyageurs' => Voyageur::all(), 'forfaits' => Forfait::all(), "buss" => Bus::all()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
        $montant = explode(' (', $data['montant']);
        $date = new \DateTime("@".strtotime($data['datedepart']));
        $date = $date->getTimestamp();
        $data['datedepart'] = new MongoDB\BSON\UTCDateTime($date*1000);
        $data['agent'] = "Anani Komlan";
        $data['trajet'] = $montant[0];
        $data['montant'] = (int)str_replace(" ", '', explode(" FCFA)", $montant[1])[0]);
        $query = Reservation::create($data);

        if($query==null) {
            return response()->json([
                'type' => 'error',
                'message' => 'Echec d\'ajout!',
                'redirection' => route('reservation.index')
            ]);
        }
        return response()->json([
            'type' => 'success',
            'message' => 'Ajout réussi!',
            'redirection' => route('reservation.index')
        ]);
    }

    public function print($token,$id)
    {
        if ($token !== csrf_token()){
            abort(404);
        }
        $reservation = Reservation::find($id);

        $pdf = PDF::loadView('reservations.print',
            ['params'=> compact('reservation', 'token')],
            [],
            [
                'default_font' => 'poppins',
                'author' => 'STM TRANSPORT',
                'format' => 'A4',
                'margin_left' => 5,
                'margin_right' => 5,
                'margin_top' => 10,
                'margin_bottom' => 10,
                'margin_header' => 0,
                'margin_footer' => 0,
                'custom_font_dir'  => base_path('public/vendors/font'), // don't forget the trailing slash!
                'custom_font_data' => [
                    'poppins' => [ // must be lowercase and snake_case
                        'R' => 'Poppins-Regular.ttf',
                        'B' => 'Poppins-Bold.ttf',
                        'I' => 'Poppins-Italic.ttf',
                    ]
                    // ...add as many as you want.
                ]
            ]);

        return $pdf->stream('BILLET RESERVATION N°'. $reservation->numBillet .'.pdf');
    }

    public function editForm($token,$id)
    {
        if ($token !== csrf_token()){
            abort(404);
        }
        return view('reservations.editForm', ['reservation'=>Reservation::find($id), 'voyageurs' => Voyageur::all(), 'forfaits' => Forfait::all(), "buss" => Bus::all()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
        $montant = explode(' (', $data['montant']);
        $date = new \DateTime("@".strtotime($data['datedepart']));
        $date = $date->getTimestamp();
        $data['datedepart'] = new MongoDB\BSON\UTCDateTime($date*1000);
        $data['agent'] = "Anani Komlan";
        $data['trajet'] = $montant[0];
        $data['montant'] = (int)str_replace(" ", '', explode(" FCFA)", $montant[1])[0]);

        $find = Reservation::find($data['id']);
        unset($data['id']);
        $query = $find->update($data);

        if($query==null) {
            return response()->json([
                'type' => 'error',
                'message' => 'Echec d\'e la modification!',
                'redirection' => route('reservation.index')
            ]);
        }
        return response()->json([
            'type' => 'success',
            'message' => 'Modification réussi!',
            'redirection' => route('reservation.index')
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
        $query = Reservation::find($data['id'])->delete();

        if($query==null) {
            return response()->json([
                'type' => 'error',
                'message' => 'Echec de suppression!',
                'redirection' => route('reservation.index')
            ]);
        }
        return response()->json([
            'type' => 'success',
            'message' => 'Suppression réussie!',
            'redirection' => route('reservation.index')
        ]);
    }
}
