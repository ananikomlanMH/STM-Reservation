<?php

namespace App\Http\Controllers;

use App\Helpers\TableHelper\TableHelper;
use App\Models\Agence;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AgenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $token = csrf_token();
        $active_link = 'agences';

        // Define Table
        $tables = new TableHelper(['_id', 'agence', 'localite', 'region'], $_GET);
        $tables->setSortable("_id" , "#");
        $tables->setSortable("agence" , "Agence");
        $tables->setSortable("localite" , "Localité");
        $tables->setSortable("region" , "Region");

        // get Data
        $agences = Agence::query()->orderBy($tables->getSort(), $tables->getDir());
        if (request('q')){
            $agences->where("agence", "LIKE", '%'.request('q').'%');
        }
        $limit = (int)request('show') ?: 8;
        $page = (int)request('p') ?: 1;
        $offset = $limit * ($page - 1);
        $nbr_pages = ceil(count($agences->get())/$limit);
        $allData = $agences->skip($offset)->take($limit)->get();

        // get search list
        $searchListData = Agence::all();
        $searchListDataJSON = [];
        foreach ($searchListData as $item){
            $searchListDataJSON[] = $item->agence;
        }
        $searchListDataJSON = json_encode($searchListDataJSON);

        // get count data
        $total_data = count($searchListData);
        $current_total_data = $nbr_pages > 1 ? ($limit*($page-1)) + count($allData) :  count($allData);
        $rowStart = (request()->input('p', 1) - 1) * $limit;

        return view('agences.index', ['agences'=>$allData,'params'=> compact('active_link', 'token', 'tables', 'searchListDataJSON', 'page', 'nbr_pages', 'total_data', 'current_total_data', 'rowStart')]);
    }

    public function addForm($token)
    {
        if ($token !== csrf_token()){
            abort(404);
        }
        return view('agences.addForm');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
        $query = Agence::create($data);

        if($query==null) {
            return response()->json([
                'type' => 'error',
                'message' => 'Echec d\'ajout!',
                'redirection' => route('agence.index')
            ]);
        }
        return response()->json([
            'type' => 'success',
            'message' => 'Ajout réussi!',
            'redirection' => route('agence.index')
        ]);
    }

    public function editForm($token,$id)
    {
        if ($token !== csrf_token()){
            abort(404);
        }
        return view('agences.editForm', ['agence'=>Agence::find($id)]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
        $find = Agence::find($data['id']);
        unset($data['id']);
        $query = $find->update($data);

        if($query==null) {
            return response()->json([
                'type' => 'error',
                'message' => 'Echec d\'e la modification!',
                'redirection' => route('agence.index')
            ]);
        }
        return response()->json([
            'type' => 'success',
            'message' => 'Modification réussi!',
            'redirection' => route('agence.index')
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
        $query = Agence::find($data['id'])->delete();

        if($query==null) {
            return response()->json([
                'type' => 'error',
                'message' => 'Echec de suppression!',
                'redirection' => route('agence.index')
            ]);
        }
        return response()->json([
            'type' => 'success',
            'message' => 'Suppression réussie!',
            'redirection' => route('agence.index')
        ]);
    }
}
