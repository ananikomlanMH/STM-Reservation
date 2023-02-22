<?php

namespace App\Http\Controllers;

use App\Helpers\TableHelper\TableHelper;
use App\Models\Voyageur;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class VoyageurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $token = csrf_token();
        $active_link = 'voyageurs';

        // Define Table
        $tables = new TableHelper(['_id', 'nom', 'prenom', 'tel', 'adresse'], $_GET);
        $tables->setSortable("_id" , "#");
        $tables->setSortable("nom" , "Nom");
        $tables->setSortable("prenom" , "Prénom");
        $tables->setSortable("tel" , "Téléphone");
        $tables->setSortable("adresse" , "Adresse");

        // get Data
        $voyageurs = Voyageur::query()->orderBy($tables->getSort(), $tables->getDir());
        if (request('q')){
            $full_search = explode(" ", request('q'));
            $search_1  = $full_search[0];
            $search_2 = $full_search[1] ?? $search_1;

            $voyageurs->orWhere(function($query) use ($search_2, $search_1) {
                $query->where("nom", "LIKE", '%'.$search_1.'%');
                $query->orWhere("prenom", "LIKE", '%'.$search_2.'%');
            });
        }
        $limit = (int)request('show') ?: 8;
        $page = (int)request('p') ?: 1;
        $offset = $limit * ($page - 1);
        $nbr_pages = ceil(count($voyageurs->get())/$limit);
        $allData = $voyageurs->skip($offset)->take($limit)->get();

        // get search list
        $searchListData = Voyageur::all();
        $searchListDataJSON = [];
        foreach ($searchListData as $item){
            $searchListDataJSON[] = $item->nom . " " .$item->prenom;
        }
        $searchListDataJSON = json_encode($searchListDataJSON);

        // get count data
        $total_data = count($searchListData);
        $current_total_data = $nbr_pages > 1 ? ($limit*($page-1)) + count($allData) :  count($allData);
        $rowStart = (request()->input('p', 1) - 1) * $limit;

        return view('voyageurs.index', ['voyageurs'=>$allData,'params'=> compact('active_link', 'token', 'tables', 'searchListDataJSON', 'page', 'nbr_pages', 'total_data', 'current_total_data', 'rowStart')]);
    }

    public function addForm($token)
    {
        if ($token !== csrf_token()){
            abort(404);
        }
        return view('voyageurs.addForm');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();

        $query = Voyageur::create($data);

        if($query==null) {
            return response()->json([
                'type' => 'error',
                'message' => 'Echec d\'ajout!',
                'redirection' => route('voyageur.index')
            ]);
        }
        return response()->json([
            'type' => 'success',
            'message' => 'Ajout réussi!',
            'redirection' => route('voyageur.index')
        ]);
    }

    public function editForm($token,$id)
    {
        if ($token !== csrf_token()){
            abort(404);
        }
        return view('voyageurs.editForm', ['voyageur'=>Voyageur::find($id)]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
        $find = Voyageur::find($data['id']);

        unset($data['id']);
        $query = $find->update($data);

        if($query==null) {
            return response()->json([
                'type' => 'error',
                'message' => 'Echec d\'e la modification!',
                'redirection' => route('voyageur.index')
            ]);
        }
        return response()->json([
            'type' => 'success',
            'message' => 'Modification réussi!',
            'redirection' => route('voyageur.index')
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
        $query = Voyageur::find($data['id'])->delete();

        if($query==null) {
            return response()->json([
                'type' => 'error',
                'message' => 'Echec de suppression!',
                'redirection' => route('voyageur.index')
            ]);
        }
        return response()->json([
            'type' => 'success',
            'message' => 'Suppression réussie!',
            'redirection' => route('voyageur.index')
        ]);
    }
}
