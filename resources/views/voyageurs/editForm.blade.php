@php
    $form = (new \App\Helpers\FormHelper\Form());

    $FormElement = $form->getInput("hidden", null, "id", "id", null, $voyageur->id, "noEmpty", 200);
    $FormElement .= $form->getInput("text", null, "nom", "Nom", null, $voyageur->nom, "noEmpty", 200);
    $FormElement .= $form->getInput("text", null, "prenom", "Prénom", null, $voyageur->prenom, "noEmpty", 200);
    $FormElement .= $form->getInput("text", null, "tel", "Téléphone", null, $voyageur->tel, "noEmpty", 200);
    $FormElement .= $form->getInput("text", null, "adresse", "Adresse", null, $voyageur->adresse, "", 200);
    $url = route('voyageur.edit');
@endphp

<div class="modal__box">
    <div class="modal__container w-6x">
        <div class="form-loader">
            <div class="lds-ellipsis">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <div class="modal__header">
            <p>Voyageur: <span>{{ $voyageur->nom }} {{ $voyageur->prenom }}</span></p>
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
