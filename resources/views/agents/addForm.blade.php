@php
    $form = (new \App\Helpers\FormHelper\Form());

    $agence = [];
    foreach ($agences as $item){
        $agence[] = [
            'id' => $item->agence . ' - '. $item->region,
            'libelle' => $item->agence . ' - '. $item->region,
        ];
    }

    $FormElement = $form->getInput("hidden", null, "matricule", "Matricule", null, "M".date("YmdH"), "noEmpty", 200);
    $FormElement .= $form->getInput("text", null, "nom", "Nom", null, null, "noEmpty", 200);
    $FormElement .= $form->getInput("text", null, "prenom", "Prénom", null, null, "noEmpty", 200);
    $FormElement2 = $form->getInput("text", null, "tel", "Téléphone", null, null, "noEmpty", 200);
    $FormElement2 .= $form->getSelectInput("custom-select", "agence", "Agence", null, "noEmpty", $agence);
    $url = route('agent.add');
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
            <p>Agent:</p>
            <i class='fi-rr-cross close__modal'></i>
        </div>
        <div class="modal__body">
            <form action="{{$url}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="d-flex gap-2">
                    {!! $FormElement !!}
                </div>
                {!! $FormElement2 !!}
                {!! $form->getFile("image", "Photo", null, "", "accept='image/png, image/jpeg, image/jpg'" ) !!}
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
