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

    $FormElement = $form->getInput("text", null, "villeDepart", "Ville depart", null, null, "noEmpty", 200);
    $FormElement .= $form->getInput("text", null, "villeDestination", "Ville destination", null, null, "noEmpty", 200);
    $FormElement2 = $form->getInput("number", null, "montant", "Montant", null, null, "noEmpty", 200);
    $FormElement2 .= $form->getSelectInput("custom-select", "typeVoyage", "Type Voyage", null, "noEmpty", $type);
    $url = route('forfait.add');
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
            <p>Agence:</p>
            <i class='fi-rr-cross close__modal'></i>
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
