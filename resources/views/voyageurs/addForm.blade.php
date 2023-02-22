@php
    $form = (new \App\Helpers\FormHelper\Form());

    $FormElement = $form->getInput("text", null, "nom", "Nom", null, null, "noEmpty", 200);
    $FormElement .= $form->getInput("text", null, "prenom", "Prénom", null, null, "noEmpty", 200);
    $FormElement .= $form->getInput("text", null, "tel", "Téléphone", null, null, "noEmpty", 200);
    $FormElement .= $form->getInput("text", null, "adresse", "Adresse", null, null, "", 200);
    $url = route('voyageur.add');
@endphp

<div class="modal__box">
    <div class="modal__container w-7x">
        <div class="form-loader">
            <div class="lds-ellipsis">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <div class="modal__header">
            <p>Voyageur:</p>
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
