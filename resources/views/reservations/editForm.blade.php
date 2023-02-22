@php
    $form = (new \App\Helpers\FormHelper\Form());


    $etatVoyage = [
        [
            'id' => 'En cours',
            'libelle' => 'En cours',
        ],
        [
            'id' => 'Effectué',
            'libelle' => 'Effectué',
        ],
        [
            'id' => 'Annulé',
            'libelle' => 'Annulé',
        ],
    ];

    $allerVoyage = [
        [
            'id' => 'Aller Simple',
            'libelle' => 'Aller Simple',
        ],
        [
            'id' => 'Aller-Retour',
            'libelle' => 'Aller-Retour',
        ]
    ];

    $typeVoyage = [
        [
            'id' => 'National',
            'libelle' => 'National',
        ],
        [
            'id' => 'International',
            'libelle' => 'International',
        ]
    ];

    $voyageur = [];
    foreach ($voyageurs as $item){
        $voyageur[] = [
            'id' => $item->nom . " ". $item->prenom,
            'libelle' => $item->nom . " ". $item->prenom . " (". $item->tel .")"
        ];
    }

    $forfait = [];
    foreach ($forfaits as $item){
        $forfait[] = [
            'id' => $item->villeDepart . " - ". $item->villeDestination . " (". \App\Helpers\NumberHelper\NumberHelper::CurrencyFormat($item->montant) .")",
            'libelle' => $item->villeDepart . " - ". $item->villeDestination . " (". \App\Helpers\NumberHelper\NumberHelper::CurrencyFormat($item->montant) .")",
        ];
    }

    $bus = [];
    foreach ($buss as $item){
        $bus[] = [
            'id' => $item->numero,
            'libelle' => $item->numero
            ];
    }

    $FormElement = $form->getInput("hidden", null, "id", "id", null, $reservation->id, "noEmpty", 200);
    $FormElement .= $form->getInput("hidden", null, "agent", "agent", null, $reservation->agent, "", 200);
    $FormElement .= $form->getInput("hidden", null, "trajet", "trajet", null, $reservation->trajet, "", 200);
    $url = route('reservation.edit');
@endphp

<div class="modal__box">
    <div class="modal__container w-9x">
        <div class="form-loader">
            <div class="lds-ellipsis">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <div class="modal__header">
            <p>Reservation: <span>{{ $reservation->numBillet }}</span></p>
            @include('includes.toggleSwitch')
        </div>
        <div class="modal__body">
            <form action="{{$url}}" method="POST">
                @csrf
                <div class="d-flex" style="gap: 15px;">
                    {!! $form->getInput("date", "date-picker", "datedepart", "Date", null, date('Y-m-d', $reservation->datedepart->toDateTime()->getTimestamp()), "noEmpty", 200) !!}
                    {!! $form->getInput("time", "time-picker", "heureDepart", "Heure", null, $reservation->heureDepart, "noEmpty", 200) !!}
                    {!! $form->getInput("text", null, "numBillet", "Billet", null, $reservation->numBillet, "noEmpty", 200, "disabled, forceDisabled=true") !!}
                </div>
                <div class="d-flex" style="gap: 15px;">
                    {!! $form->getInput("number", null, "valise", "Valise", null, $reservation->valise, "", 200, "min=0") !!}
                    {!! $form->getInput("number", null, "sac", "Sac", null, $reservation->sac, "", 200, "min=0") !!}
                    {!! $form->getInput("number", null, "colis", "Colis", null, $reservation->colis, "", 200, "min=0") !!}
                    {!! $form->getInput("number", null, "gyz", "GYZ", null, $reservation->gyz, "", 200, "min=0") !!}
                </div>
                <div class="d-flex" style="gap: 15px;">
                    {!! $form->getInput("number", null, "siege", "Siege", null, $reservation->siege, "noEmpty", 200, "min=0") !!}
                    {!! $form->getSelectInput("custom-select", "etatVoyage", "Etat voyage", $reservation->etatVoyage, "noEmpty", $etatVoyage) !!}
                    {!! $form->getSelectInput("custom-select", "alleRetour", "Aller retour", $reservation->alleRetour, "noEmpty", $allerVoyage) !!}
                </div>
                <div class="d-flex" style="gap: 15px;">
                    <div class="w-500">
                        {!! $form->getSelectInput("custom-select", "bus", "Bus", $reservation->bus, "noEmpty", $bus) !!}
                    </div>
                    {!! $form->getSelectInput("custom-select", "voyageur", "Voyageur", $reservation->voyageur, "noEmpty", $voyageur, "disabled, forceDisabled=true") !!}
                    {!! $form->getSelectInput("custom-select", "typeVoyage", "Type voyage", $reservation->typeVoyage, "noEmpty", $typeVoyage) !!}
                </div>
                {!! $form->getSelectInput("custom-select", "montant", "Montant", $reservation->trajet. " (". \App\Helpers\NumberHelper\NumberHelper::CurrencyFormat($reservation->montant) .")", "noEmpty", $forfait) !!}
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
