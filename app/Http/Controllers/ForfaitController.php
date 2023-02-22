<?php

namespace App\Http\Controllers;

use App\Helpers\TableHelper\TableHelper;
use App\Models\Forfait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ForfaitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $token = csrf_token();
        $active_link = 'forfaits';

        // Define Table
        $tables = new TableHelper(['_id', 'villeDepart', 'villeDestination', 'montant', 'typeVoyage'], $_GET);
        $tables->setSortable("_id" , "#");
        $tables->setSortable("villeDepart" , "Ville Depart");
        $tables->setSortable("villeDestination" , "Ville Destination");
        $tables->setSortable("montant" , "Montant");
        $tables->setSortable("typeVoyage" , "Type Voyage");

        // get Data
        $forfaits = Forfait::query()->orderBy($tables->getSort(), $tables->getDir());
        if (request('q')){
            $forfaits->where("villeDepart", "LIKE", '%'.request('q').'%');
        }
        $limit = (int)request('show') ?: 8;
        $page = (int)request('p') ?: 1;
        $offset = $limit * ($page - 1);
        $nbr_pages = ceil(count($forfaits->get())/$limit);
        $allData = $forfaits->skip($offset)->take($limit)->get();

        // get search list
        $searchListData = Forfait::all();
        $searchListDataJSON = [];
        foreach ($searchListData as $item){
            $searchListDataJSON[] = $item->villeDepart . " - " . $item->villeDestination;
        }
        $searchListDataJSON = json_encode($searchListDataJSON);

        // get count data
        $total_data = count($searchListData);
        $current_total_data = $nbr_pages > 1 ? ($limit*($page-1)) + count($allData) :  count($allData);
        $rowStart = (request()->input('p', 1) - 1) * $limit;

        return view('forfaits.index', ['forfaits'=>$allData,'params'=> compact('active_link', 'token', 'tables', 'searchListDataJSON', 'page', 'nbr_pages', 'total_data', 'current_total_data', 'rowStart')]);
    }

    public function addForm($token)
    {
        if ($token !== csrf_token()){
            abort(404);
        }
        return view('forfaits.addForm');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
        $query = Forfait::create($data);

        if($query==null) {
            return response()->json([
                'type' => 'error',
                'message' => 'Echec d\'ajout!',
                'redirection' => route('forfait.index')
            ]);
        }
        return response()->json([
            'type' => 'success',
            'message' => 'Ajout réussi!',
            'redirection' => route('forfait.index')
        ]);
    }

    public function editForm($token,$id)
    {
        if ($token !== csrf_token()){
            abort(404);
        }
        return view('forfaits.editForm', ['forfait'=>Forfait::find($id)]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
        $find = Forfait::find($data['id']);

        unset($data['id']);
        $query = $find->update($data);

        if($query==null) {
            return response()->json([
                'type' => 'error',
                'message' => 'Echec d\'e la modification!',
                'redirection' => route('forfait.index')
            ]);
        }
        return response()->json([
            'type' => 'success',
            'message' => 'Modification réussi!',
            'redirection' => route('forfait.index')
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
        $query = Forfait::find($data['id'])->delete();

        if($query==null) {
            return response()->json([
                'type' => 'error',
                'message' => 'Echec de suppression!',
                'redirection' => route('forfait.index')
            ]);
        }
        return response()->json([
            'type' => 'success',
            'message' => 'Suppression réussie!',
            'redirection' => route('forfait.index')
        ]);
    }
}
