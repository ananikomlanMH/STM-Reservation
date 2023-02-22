@extends('layout')

@section('title', 'Dashboard')


@section('content')
    <section class="home-section">
        <div class="link">Dashboard</div>

        <div class="stats-countainer">
            <div class="stat-item">
                <div class="icon">
                    <i class="fi-rr-document"></i>
                </div>
                <div class="text">
                    <p>Reservations ({{ $count_reservations }})</p>
                    <h3><span>{{ \App\Helpers\NumberHelper\NumberHelper::CurrencyFormat2($ca_reservations) }} </span>
                        FCFA</h3>
                </div>
            </div>
            <div class="stat-item">
                <div class="icon">
                    <i class="fi-rr-shop"></i>
                </div>
                <div class="text">
                    <p>Agences ({{ $count_agences }})</p>
                    <h3><span>{{ $count_agents }}  </span>Agents</h3>
                </div>
            </div>
            <div class="stat-item">
                <div class="icon">
                    <i class="fi-rr-graduation-cap"></i>
                </div>
                <div class="text">
                    <p>Voyageurs ({{ $count_voyageurs }})</p>
                    <h3><span>{{ $count_voyageurs_voyages }}  </span>Voyages</h3>
                </div>
            </div>
            <div class="stat-item">
                <div class="icon">
                    <i class="fi-rr-world"></i>
                </div>
                <div class="text">
                    <p>Forfaits ({{ $count_forfaits }})</p>
                    <h3><span>{{ $count_forfaits }}  </span>Destinations</h3>
                </div>
            </div>
        </div>

        <div class="d-flex mt-40">
            <div style="width: 48%;border-right: 1px solid #e2e2e2;" class="js__chart">
                <canvas id="chart__ca_year"></canvas>
            </div>
            <div style="width: 48%;" class="js__chart">
                <canvas id="chart__ca_type"></canvas>
            </div>
        </div>
        <div style="width: 100%;margin-top: 20px;" class="js__chart">
            <canvas id="chart__ca_trajet"></canvas>
        </div>
    </section>
@endsection

@section('script')
    var ca_reservation_by_type = {!! $ca_reservation_by_type !!}
    var ca_reservation_by_year = {!! $ca_reservation_by_year !!}
    var ca_reservation_by_trajet = {!! $ca_reservation_by_trajet !!}
@endsection
