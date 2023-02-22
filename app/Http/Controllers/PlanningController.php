<?php

namespace App\Http\Controllers;

use App\Models\Agence;
use App\Models\Agent;
use App\Models\Bus;
use App\Models\Forfait;
use App\Models\Reservation;
use App\Models\Voyageur;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class PlanningController extends Controller
{
    //

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $params['active_link'] = 'planning';

        $bus = Bus::all();

        $data = [];

        foreach ($bus as $item){
            $data[$item->numero] = [];
        }
        foreach (Reservation::all() as $item){
            $data[$item->bus][] = $item;
        }

        return view('planning.index',
            compact(
                'params',
                'bus',
                'data',
            )
        );
    }
}
