@php
    $form = (new \App\Helpers\FormHelper\Form());

    $agent = [];
    foreach ($agents as $item){
        $agent[] = [
            'id' => $item->nom . " ". $item->prenom,
            'libelle' => $item->nom . " ". $item->prenom
        ];
    }

        $FormElement = $form->getInput("hidden", null, "id", "id", null, $user->id, "noEmpty", 200);
    $FormElement .= $form->getSelectInput("custom-select", "name", "Agent", $user->name, "noEmpty", $agent);
    $FormElement .= $form->getInput("email", null, "email", "Email", null, $user->email, "noEmpty", 200);
    $FormElement .= $form->getInput("password", null, "password", "Password", null, null, "noEmpty", 200);

    $url = route('users.edit');
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
            <p>Utilisateur: <span>{{ $user->name }}</span></p>
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
