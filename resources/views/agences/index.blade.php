@extends('layout')

@section('title', 'Agences')

@section('content')
<section class="home-section">
    <div class="link"><a href="#">Agences</a>
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
                        <button class="filter"><a href="{{ route('agence.index') }}">Effacer les
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
            <button class="btn-primary JS_Call_Url_Get_Form" data-url="{{ route('agence.addForm', ['token' => $params['token']]) }}">Nouvelle agence<i class="fi-rr-plus"></i></button>
        </div>
    </div>

    <div class="table-list table-bordered table-striped ">
        <table>
            <thead>
            <tr>
                <th class="w-80">{!! $params['tables']->th('_id') !!}</th>
                <th>{!! $params['tables']->th('agence') !!}</th>
                <th>{!! $params['tables']->th('localite') !!}</th>
                <th>{!! $params['tables']->th('region') !!}</th>
                <th class="w-80"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($agences as $agence)
            <tr>
                <td class="img">
                    <div>
                        <img src="/vendors/images/logo.png " alt="profile">
                    </div>
                </td>
                <td>{{$agence->agence}}</td>
                <td>{{$agence->localite}}</td>
                <td>{{$agence->region}}</td>
                <td class="table_drop_action">
                    <i class='icon fi-rr-menu-dots-vertical'></i>
                    <div class="dropdown">
                        <ul>
                            <li><a data-url="{{ route('agence.editForm', ['token' => $params['token'], 'id' =>$agence->id]) }}" class="JS_Call_Url_Get_Form"><i class="fi-rr-edit" ></i>Editer</a></li>
                            <li>
                                <form action="{{ route('agence.delete') }}" method="post" class="deleteForm"
                                      data-content="cette donn??e">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $agence->id }}">
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
            @if(count($agences) === 0)
            <tr>
                <td colspan="6" style="text-align: center"> Aucun enregistrement trouv??</td>
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
