@php
    $form = (new \App\Helpers\FormHelper\Form());

    $agence = [];
    foreach ($agences as $item){
        $agence[] = [
            'id' => $item->agence . ' - '. $item->region,
            'libelle' => $item->agence . ' - '. $item->region,
        ];
    }

    $FormElement = $form->getInput("hidden", null, "id", "id", null, $agent->id, "noEmpty", 200);
    $FormElement .= $form->getInput("text", null, "nom", "Nom", null, $agent->nom, "noEmpty", 200);
    $FormElement .= $form->getInput("text", null, "prenom", "Prénom", null, $agent->prenom, "noEmpty", 200);
    $FormElement2 = $form->getInput("text", null, "tel", "Téléphone", null, $agent->tel, "noEmpty", 200);
    $FormElement2 .= $form->getSelectInput("custom-select", "agence", "Agence", $agent->agence, "noEmpty", $agence);
    $url = route('agent.edit');
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
            <p>Agent: <span>{{ $agent->nom }} {{ $agent->prenom }}</span></p>
            @include('includes.toggleSwitch')
        </div>
        <div class="modal__body">
            <form action="{{$url}}" method="POST">
                @csrf
                <div class="d-flex gap-2">
                    {!! $FormElement !!}
                </div>
                {!! $FormElement2 !!}
                {!! $form->getFile("image", "Photo", $agent->image, "", "accept='image/png, image/jpeg, image/jpg'" ) !!}
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
