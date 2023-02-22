@php
    $form = (new \App\Helpers\FormHelper\Form());

    $type = [
        [
            'id' => 'Aller Simple',
            'libelle' => 'Aller Simple',
        ],
        [
            'id' => 'Aller-Retour',
            'libelle' => 'Aller-Retour',
        ]
    ];

    $FormElement = $form->getInput("hidden", null, "id", "id", null, $forfait->id, "noEmpty", 200);
    $FormElement .= $form->getInput("text", null, "villeDepart", "Ville depart", null, $forfait->villeDepart, "noEmpty", 200);
    $FormElement .= $form->getInput("text", null, "villeDestination", "Ville destination", null, $forfait->villeDestination, "noEmpty", 200);
    $FormElement2 = $form->getInput("number", null, "montant", "Montant", null, $forfait->montant, "noEmpty", 200);
    $FormElement2 .= $form->getSelectInput("custom-select", "typeVoyage", "Type Voyage", $forfait->typeVoyage, "noEmpty", $type);
    $url = route('forfait.edit');
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
            <p>Forfait: <span>{{ $forfait->villeDepart }}-{{ $forfait->villeDestination }}</span></p>
            @include('includes.toggleSwitch')
        </div>
        <div class="modal__body">
            <form action="{{$url}}" method="POST">
                @csrf
                <div class="d-flex gap-2">
                    {!! $FormElement !!}
                </div>
                {!! $FormElement2 !!}
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
