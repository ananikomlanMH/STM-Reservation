<?php

namespace App\Http\Controllers;

use App\Models\Agence;
use App\Models\Agent;
use App\Models\Forfait;
use App\Models\Reservation;
use App\Models\Voyageur;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use MongoDB;

class HomeController extends Controller
{
    //

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $params['active_link'] = 'dashboard';

        $count_reservations = Reservation::query()->count();
        $ca_reservations = Reservation::query()->sum("montant");

        $count_agences = Agence::query()->count();
        $count_agents = Agent::query()->count();

        $count_voyageurs = Voyageur::query()->count();
        $count_voyageurs_voyages = Reservation::query()->distinct("voyageur")->get(["voyageur"])->count();

        $count_forfaits = Forfait::query()->count();

        $ca_reservation_by_type = Reservation::raw(function ($collection) {
            return $collection->aggregate([
                [
                    '$group' => [
                        '_id' => '$typeVoyage',
                        'total' => ['$sum' => '$montant']
                    ]
                ]
            ]);
        });

        $ca_reservation_by_year = Reservation::raw(function ($collection) {
            return $collection->aggregate([
                [
                    '$project' => [
                        'montant' => 1,
                        'date' => ['$year' => '$datedepart']
                    ]
                ],
                [
                    '$group' => [
                        '_id' => '$date',
                        'total' => ['$sum' => '$montant']
                    ]
                ],
                [
                    '$sort' => [
                        '_id' => 1
                    ]
                ]
            ]);
        });

        $ca_reservation_by_trajet = Reservation::raw(function ($collection) {
            return $collection->aggregate([
                [
                    '$project' => [
                        'montant' => 1,
                        'trajet' => 1
                    ]
                ],
                [
                    '$group' => [
                        '_id' => '$trajet',
                        'total' => ['$sum' => '$montant']
                    ]
                ],
                [
                    '$sort' => [
                        '_id' => 1
                    ]
                ]
            ]);
        });

        $ca_reservation_by_year = json_encode($ca_reservation_by_year);
        $ca_reservation_by_type = json_encode($ca_reservation_by_type);
        $ca_reservation_by_trajet = json_encode($ca_reservation_by_trajet);


        return view('home.dashboard',
            compact(
                'params',
                'count_reservations',
                'ca_reservations',
                'count_agences',
                'count_agents',
                'count_voyageurs',
                'count_voyageurs_voyages',
                'count_forfaits',
                'ca_reservation_by_type',
                'ca_reservation_by_year',
                'ca_reservation_by_trajet',
            )
        );
    }
}
