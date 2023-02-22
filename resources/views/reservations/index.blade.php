@extends('layout')

@section('title', 'Reservations')

@section('content')
    <section class="home-section">
        <div class="link"><a href="#">Reservations</a>
        </div>

        <div class="filter-form mt-25">
            <div class="wrapper">
                <div class="search_box">
                    <div class="dropdown">
                        <div class="default_option">Trier Par</div>
                        <ul>
                            @foreach($params['tables']->getSortable() as $key => $item)
                                <li>
                                    <a href="?{{ \App\Helpers\URLHelper\URLHelper::withParams($_GET, ['sort' => $key, 'dir' => 'ASC']) }}">{{ $item }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <form action="" method="get">
                        <div class="search_field">
                            <input type="text" autocomplete="off" name="q" class="input" id="autoComplete"
                                   value="@if(!empty($_GET['q'])){{ htmlspecialchars($_GET['q'] ?? '') }}@endif"
                                   placeholder="Rechercher...">
                            <i class="icon-search fi-rr-search"></i>
                            @if(!empty($_GET))
                                <button class="filter"><a href="{{ route('reservation.index') }}">Effacer les
                                        filtres <i class="fi-rr-broom"></i></a></button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
            <div class="right-content d-flex gap-1">
                <div class="filter-drop dropdownList">
                    <div class="default_option">@if(!empty($_GET['show'])) {{ (int)$_GET['show'] }}/Pages @else
                            Affichage @endif</div>
                    <ul class="">
                        @for($i = 10 ; $i <= 100 ; $i += 10)
                            <li><a href="?{{ \App\Helpers\URLHelper\URLHelper::withParam($_GET, "show", $i) }}">{{ $i }}
                                    /Pages</a></li>
                        @endfor
                    </ul>
                </div>
                <button class="btn-primary JS_Call_Url_Get_Form"
                        data-url="{{ route('reservation.addForm', ['token' => $params['token']]) }}">Nouvelle
                    reservation<i class="fi-rr-plus"></i></button>
            </div>
        </div>

        <div class="table-list table-bordered table-striped ">
            <table>
                <thead>
                <tr>
                    <th>{!! $params['tables']->th('datedepart') !!}</th>
                    <th>{!! $params['tables']->th('heureDepart') !!}</th>
                    <th>{!! $params['tables']->th('numBillet') !!}</th>
                    <th>{!! $params['tables']->th('valise') !!}</th>
                    <th>{!! $params['tables']->th('sac') !!}</th>
                    <th>{!! $params['tables']->th('colis') !!}</th>
                    <th>{!! $params['tables']->th('gyz') !!}</th>
                    <th>{!! $params['tables']->th('siege') !!}</th>
                    <th>{!! $params['tables']->th('etatVoyage') !!}</th>
                    <th>{!! $params['tables']->th('alleRetour') !!}</th>
                    <th>{!! $params['tables']->th('bus') !!}</th>
                    <th>{!! $params['tables']->th('agent') !!}</th>
                    <th>{!! $params['tables']->th('voyageur') !!}</th>
                    <th>{!! $params['tables']->th('trajet') !!}</th>
                    <th>{!! $params['tables']->th('montant') !!}</th>
                    <th class="w-80"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($reservations as $reservation)
                    <tr>
                        <td style="font-size: .95em;white-space: nowrap">{{date('Y-m-d', $reservation->datedepart->toDateTime()->getTimestamp())}}</td>
                        <td style="font-size: .95em;">{{$reservation->heureDepart}}</td>
                        <td style="font-size: .95em;">{{$reservation->numBillet}}</td>
                        <td style="font-size: .95em;">{{$reservation->valise ?: 0}}</td>
                        <td style="font-size: .95em;">{{$reservation->sac ?: 0}}</td>
                        <td style="font-size: .95em;">{{$reservation->colis ?: 0}}</td>
                        <td style="font-size: .95em;">{{$reservation->gyz ?: 0}}</td>
                        <td style="font-size: .95em;">{{$reservation->siege}}</td>
                        <td style="font-size: .95em;">{{$reservation->etatVoyage}}</td>
                        <td style="font-size: .95em;">{{$reservation->typeVoyage}}</td>
                        <td style="font-size: .95em;">{{$reservation->bus}}</td>
                        <td style="font-size: .95em;">{{$reservation->agent}}</td>
                        <td style="font-size: .95em;">{{$reservation->voyageur}}</td>
                        <td style="font-size: .95em;">{{$reservation->trajet}}</td>
                        <td style="font-size: .95em;">{{\App\Helpers\NumberHelper\NumberHelper::CurrencyFormat($reservation->montant)}}</td>
                        <td class="table_drop_action">
                            <i class='icon fi-rr-menu-dots-vertical'></i>
                            <div class="dropdown">
                                <ul>
                                    <li>
                                        <a data-url="{{ route('reservation.editForm', ['token' => $params['token'], 'id' =>$reservation->id]) }}"
                                           class="JS_Call_Url_Get_Form"><i class="fi-rr-edit"></i>Editer</a></li>
                                    <li>
                                        <form action="{{ route('reservation.delete') }}" method="post"
                                              class="deleteForm"
                                              data-content="cette donnée">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $reservation->id }}">
                                            <button type="submit" name="delete" class="dropdown__delete__form_button"
                                                    value="delete"><i class="fi-rr-trash"></i>Supprimer
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
                @if(count($reservations) === 0)
                    <tr>
                        <td colspan="17" style="text-align: center"> Aucun enregistrement trouvé</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        <div class="table-nav">
            <div class="pagination">
                {!! (new \App\Helpers\Pagination\PaginationHelper($params['nbr_pages'], $_GET))->getPagination() !!}
            </div>
            <p><span>{{ $params['current_total_data'] }}/{{ $params['total_data'] }}</span> Elements</p>
        </div>
    </section>

    <div id="JS_GenerateForm"></div>
@endsection

@section('script')
    var searchList = {!! $params['searchListDataJSON']  !!}
@endsection
