@php
    header("Turbolinks-Location: /login");
    $form = (new \App\Helpers\FormHelper\Form());
@endphp
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>STM - Connexion</title>
    <link rel="shortcut icon" href="/vendors/images/logo.png" type="image/x-icon">

    <link rel="stylesheet" href="/vendors/css/app.css">

    <!--    Icons -->
    <link rel="stylesheet" href="/vendors/css/uicons/css/uicons-regular-rounded.css">
    <link rel="stylesheet" href="/vendors/css/font-awesome/css/all.min.css">

    <!--    JS Files -->

    <script defer src="/vendors/js/turbolinks.js" data-turbolinks-eval="false"></script>
    <script defer src="/vendors/js/app.js" data-turbolinks-eval="false"></script>
</head>
<body>
<div class="login_container">
    <div class="login">
        <form action="" id="login__form" method="post">
            @csrf
            <h1>Connexion</h1>
            <hr>
            <p style="font-weight: 600;"><span style="color:var(--primary-color);">STM</span> TRANSPORT VOYAGEUR</p>
            {!! $form->getInput("email", null, "email", "Email", null, null , "noEmpty", 200) !!}
            {!! $form->getInput("password", null, "password", "Password", null, null , "noEmpty", 200) !!}

            <div class="checkbox tiny rounded-22">
                <div class="checkbox-container">
                    <input id="checkbox-default" name="remember" type="checkbox" />
                    <div class="checkbox-checkmark"></div>
                </div>
                <label for="checkbox-default">Rester connecter</label>
            </div>
            <button>Se connecter</button>

            <p class="or">
                ----- ou continuer avec -----
            </p>
            <div class="icons">
                <i class="fab fa-google"></i>
                <i class="fab fa-github"></i>
                <i class="fab fa-facebook"></i>
            </div>
{{--            <div class="not-member">--}}
{{--                Not a member? <a href="#">Register Now</a>--}}
{{--            </div>--}}
        </form>
    </div>
    <div class="pic">
        <img src="/vendors/images/bus_group.jpg">
    </div>
</div>
</body>
</html>
