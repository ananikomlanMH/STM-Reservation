@extends('layout')

@section('title', 'Forfaits')

@section('content')
<section class="home-section">
    <div class="link"><a href="#">Forfaits</a>
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
                               value="@if(!empty($_GET['q'])){{ htmlspecialchars($_GET['q'] ?? '') }}@endif" placeholder="Rechercher...">
                        <i class="icon-search fi-rr-search"></i>
                        @if(!empty($_GET))
                        <button class="filter"><a href="{{ route('forfait.index') }}">Effacer les
                                filtres <i class="fi-rr-broom"></i></a></button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
        <div class="right-content d-flex gap-1">
            <div class="filter-drop dropdownList">
                <div class="default_option">@if(!empty($_GET['show'])) {{ (int)$_GET['show'] }}/Pages @else Affichage @endif</div>
                <ul class="">
                    @for($i = 10 ; $i <= 100 ; $i += 10)
                    <li><a href="?{{ \App\Helpers\URLHelper\URLHelper::withParam($_GET, "show", $i) }}">{{ $i }}/Pages</a></li>
                    @endfor
                </ul>
            </div>
            <button class="btn-primary JS_Call_Url_Get_Form" data-url="{{ route('forfait.addForm', ['token' => $params['token']]) }}">Nouveau forfait<i class="fi-rr-plus"></i></button>
        </div>
    </div>

    <div class="table-list table-bordered table-striped ">
        <table>
            <thead>
            <tr>
                <th class="w-80">{!! $params['tables']->th('_id') !!}</th>
                <th>{!! $params['tables']->th('villeDepart') !!}</th>
                <th>{!! $params['tables']->th('villeDestination') !!}</th>
                <th>{!! $params['tables']->th('montant') !!}</th>
                <th>{!! $params['tables']->th('typeVoyage') !!}</th>
                <th class="w-80"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($forfaits as $forfait)
            <tr>
                <td class="img">
                    <div>
                        <img src="/vendors/images/logo.png " alt="profile">
                    </div>
                </td>
                <td>{{$forfait->villeDepart}}</td>
                <td>{{$forfait->villeDestination}}</td>
                <td>{{ \App\Helpers\NumberHelper\NumberHelper::CurrencyFormat($forfait->montant) }}</td>
                <td>{{$forfait->typeVoyage}}</td>
                <td class="table_drop_action">
                    <i class='icon fi-rr-menu-dots-vertical'></i>
                    <div class="dropdown">
                        <ul>
                            <li><a data-url="{{ route('forfait.editForm', ['token' => $params['token'], 'id' =>$forfait->id]) }}" class="JS_Call_Url_Get_Form"><i class="fi-rr-edit" ></i>Editer</a></li>
                            <li>
                                <form action="{{ route('forfait.delete') }}" method="post" class="deleteForm"
                                      data-content="cette donnée">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $forfait->id }}">
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
            @if(count($forfaits) === 0)
            <tr>
                <td colspan="6" style="text-align: center"> Aucun enregistrement trouvé</td>
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
