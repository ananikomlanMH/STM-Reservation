<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Reservation;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use MongoDB;

class PlanningController extends Controller
{
    //

    /**
     * @return Application|Factory|View
     * @throws \Exception
     */
    public function index()
    {
        $params['active_link'] = 'planning';

        $bus = Bus::all();

        $data = [];

        foreach ($bus as $item){
            $data[$item->numero] = [];
        }

        $search_date = request('q', date('Y-m-d'));

        $search_date_depart = strtotime(substr($search_date,0,10)) ?: strtotime(date('Y-m-d'));

        if(strlen($search_date) < 11){
            $search_date_fin = strtotime(substr($search_date,0,10)) ?: strtotime(date('Y-m-d'));
        }else{
            $search_date_fin = strtotime(substr($search_date,-10)) ?: strtotime(date('Y-m-d'));
        }

        $date_start =  new MongoDB\BSON\UTCDateTime((new \DateTime("@".$search_date_depart))->getTimestamp()*1000);
        $date_end =  new MongoDB\BSON\UTCDateTime((new \DateTime("@".$search_date_fin))->getTimestamp()*1000);

        $allReservation = Reservation::whereBetween("datedepart", [$date_start, $date_end])->get();

        foreach ($allReservation as $item){
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
