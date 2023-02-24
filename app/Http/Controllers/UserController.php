<?php

namespace App\Http\Controllers;

use App\Helpers\TableHelper\TableHelper;
use App\Models\Agent;
use App\Models\Bus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $is_connected = Auth::check();
        if ($is_connected){
            return redirect("/");
        }
        return view('login.index');
    }

    public function viewUser()
    {
        $token = csrf_token();
        $active_link = 'settings';

        // Define Table
        $tables = new TableHelper(['_id', 'name', 'email'], $_GET);
        $tables->setSortable("_id" , "#");
        $tables->setSortable("name" , "Nom");
        $tables->setSortable("email" , "Email");

        // get Data
        $users = User::query()->orderBy($tables->getSort(), $tables->getDir());
        if (request('q')){
            $users->where("name", "LIKE", '%'.request('q').'%');
        }
        $limit = (int)request('show') ?: 8;
        $page = (int)request('p') ?: 1;
        $offset = $limit * ($page - 1);
        $nbr_pages = ceil(count($users->get())/$limit);
        $allData = $users->skip($offset)->take($limit)->get();

        // get search list
        $searchListData = User::all();
        $searchListDataJSON = [];
        foreach ($searchListData as $item){
            $searchListDataJSON[] = $item->name;
        }
        $searchListDataJSON = json_encode($searchListDataJSON);

        // get count data
        $total_data = count($searchListData);
        $current_total_data = $nbr_pages > 1 ? ($limit*($page-1)) + count($allData) :  count($allData);
        $rowStart = (request()->input('p', 1) - 1) * $limit;

        return view('settings.index', ['users'=>$allData,'params'=> compact('active_link', 'token', 'tables', 'searchListDataJSON', 'page', 'nbr_pages', 'total_data', 'current_total_data', 'rowStart')]);
    }

    public function login(Request $request)
    {
        $data = $request->all();
        $remember = !empty($data['remember']);

        $auth = Auth::attempt(['email' => $data['email'], 'password' => $data['password']], $remember);

        if ($auth){
            $request->session()->regenerate();

            return response()->json([
                'type' => 'success',
                'message' => 'Bienvenue sur STM Transport.',
                'redirection' => route('home.index')
            ]);
        }
        return response()->json([
            'type' => 'error',
            'message' => 'Veuillez verifier votre nom ou mot de passe.',
            'redirection' => route('login')
        ]);
    }

    public function logout(Request $request): \Illuminate\Http\JsonResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json([
            'type' => 'error',
            'message' => 'Déconnexion avec succès',
            'redirection' => route('login')
        ]);
    }

    public function addForm($token)
    {
        if ($token !== csrf_token()){
            abort(404);
        }
        return view('settings.addForm', ['agents' => Agent::all()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $query = User::create($data);

        if($query==null) {
            return response()->json([
                'type' => 'error',
                'message' => 'Echec d\'ajout!',
                'redirection' => route('users.index')
            ]);
        }
        return response()->json([
            'type' => 'success',
            'message' => 'Ajout réussi!',
            'redirection' => route('users.index')
        ]);
    }

    public function editForm($token,$id)
    {
        if ($token !== csrf_token()){
            abort(404);
        }
        return view('settings.editForm', ['user'=>User::find($id), 'agents' => Agent::all()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $find = User::find($data['id']);

        unset($data['id']);
        $query = $find->update($data);

        if($query==null) {
            return response()->json([
                'type' => 'error',
                'message' => 'Echec d\'e la modification!',
                'redirection' => route('users.index')
            ]);
        }
        return response()->json([
            'type' => 'success',
            'message' => 'Modification réussi!',
            'redirection' => route('users.index')
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
        $query = User::find($data['id'])->delete();

        if($query==null) {
            return response()->json([
                'type' => 'error',
                'message' => 'Echec de suppression!',
                'redirection' => route('users.index')
            ]);
        }
        return response()->json([
            'type' => 'success',
            'message' => 'Suppression réussie!',
            'redirection' => route('users.index')
        ]);
    }
}
