@php
    $form = (new \App\Helpers\FormHelper\Form());
    $FormElement = $form->getInput("hidden", null, "id", "id", null, $bus->id, "noEmpty", 200);
    $FormElement .= $form->getInput("text", null, "numero", "Numero", null, $bus->numero, "noEmpty", 200);
    $FormElement .= $form->getInput("number", null, "nbreSiege", "Siege", null, $bus->nbreSiege, "noEmpty", 10);
    $url = route('bus.edit');
@endphp

<div class="modal__box">
    <div class="modal__container w-5x">
        <div class="form-loader">
            <div class="lds-ellipsis">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <div class="modal__header">
            <p>Bus: <span>{{ $bus->numero }}</span></p>
            @include('includes.toggleSwitch')
        </div>
        <div class="modal__body">
            <form action="{{$url}}" method="POST">
                @csrf
                {!! $FormElement !!}
            </form>
        </div>
        <br>
        @include('includes.requiredField')
        <div class="modal__footer">
            <input type="reset" class="close__modal" value="Annuler">
            <input type="submit" class="modalForm__submit" name="add" value="Enregistrer">
        </div>
    </div>
</div>
