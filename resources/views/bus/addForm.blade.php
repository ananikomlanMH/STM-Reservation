@php
    $form = (new \App\Helpers\FormHelper\Form());
    $FormElement = $form->getInput("text", null, "numero", "Numero", null, null, "noEmpty", 200);
    $FormElement .= $form->getInput("number", null, "nbreSiege", "Siege", null, null, "noEmpty", 10);
    $url = route('bus.add');
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
            <p>Bus:</p>
            <i class='fi-rr-cross close__modal'></i>
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
