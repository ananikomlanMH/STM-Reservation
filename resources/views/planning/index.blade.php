@extends('layout')

@section('title', 'Planning')


@section('content')
    <section class="home-section">
        <div class="link">Planning</div>

        <div class="customers-favorites">
            <!-- Slider main container -->
            <div class="swiper swiper-initialized swiper-horizontal swiper-pointer-events" style="display: block;">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper" style="cursor: grab; transform: translate3d(0px, 0px, 0px);">

                    @foreach($bus as $key => $item)
                        <div class="swiper-slide planning__item @if($key == 0) active @endif" data-id="{{$key}}">
                            <div class="favorites__item">BUS {{ $item->numero }}</div>
                        </div>
                    @endforeach
                </div>

                <div class="swiper-pagination"></div>
            </div>
        </div>

        <div class="planning-content mt-40">
            @foreach($bus as $key => $item)
                <div class="planning-content-item ctn{{$key}} @if($key == 0) active @endif">
                    <div class="table-list table-bordered table-striped ">
                        <table>
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Heure</th>
                                <th>Bus</th>
                                <th>Billet</th>
                                <th>Siege</th>
                                <th>Agent</th>
                                <th>Voyageur</th>
                                <th>Trajet</th>
                                <th>Montant</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data[$item->numero] as $row)
                                <tr>
                                    <td>{{date('Y-m-d', $row->datedepart->toDateTime()->getTimestamp())}}</td>
                                    <td>{{ $row->heureDepart }}</td>
                                    <td>{{ $row->bus }}</td>
                                    <td>{{ $row->numBillet }}</td>
                                    <td>{{ $row->siege }}</td>
                                    <td>{{ $row->agent }}</td>
                                    <td>{{ $row->voyageur }}</td>
                                    <td>{{ $row->trajet }}</td>
                                    <td>{{ \App\Helpers\NumberHelper\NumberHelper::CurrencyFormat($row->montant) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>

    </section>
@endsection
