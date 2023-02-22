@php
    $form = (new \App\Helpers\FormHelper\Form());

    $region = [
        [
            'id' => 'Niamey',
            'libelle' => 'Niamey',
        ],
        [
            'id' => 'Dosso',
            'libelle' => 'Dosso',
        ],
        [
            'id' => 'Tillabéri',
            'libelle' => 'Tillabéri',
        ],
        [
            'id' => 'Tahoua',
            'libelle' => 'Tahoua',
        ],
        [
            'id' => 'Diffa',
            'libelle' => 'Diffa',
        ],
        [
            'id' => 'Agadez',
            'libelle' => 'Agadez',
        ],
        [
            'id' => 'Maradi',
            'libelle' => 'Maradi',
        ],
        [
            'id' => 'Zinder',
            'libelle' => 'Zinder',
        ]
    ];

    $FormElement = $form->getInput("hidden", null, "id", "id", null, $agence->id, "noEmpty", 200);
    $FormElement .= $form->getInput("text", null, "agence", "Agence", null, $agence->agence, "noEmpty", 200);
    $FormElement .= $form->getInput("text", null, "localite", "Localité", null, $agence->localite, "noEmpty", 200);
    $FormElement .= $form->getSelectInput("custom-select", "region", "Region", $agence->region, "noEmpty", $region);
    $url = route('agence.edit');
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
            <p>Agence: <span>{{ $agence->agence }}</span></p>
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
