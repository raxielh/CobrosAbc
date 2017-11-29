<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <!-- Styles 
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">-->
    <style>
    .mdl-layout {
      align-items: center;
      justify-content: center;
    }
    .mdl-layout__content {
        padding: 24px;
        flex: none;
    }
    .error-block{
        font-weight: 300;
        color: #c30000;
    }
    </style>
</head>
<body>
    <div class="mdl-layout mdl-js-layout mdl-color--grey-100">
        <main class="mdl-layout__content">
            <div class="mdl-card mdl-shadow--6dp">
                <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
                    <h2 class="mdl-card__title-text">{{ config('app.name') }}</h2>
                </div>
                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                    <div class="mdl-card__supporting-text">
                        <div class="mdl-textfield mdl-js-textfield">
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="col-md-6">
                                    <!--<input id="email" type="email" class="mdl-textfield__input" name="email" value="{{ old('email') }}" required autofocus>-->
                                    <input id="email" type="email" class="mdl-textfield__input" name="email" value="1@2.co" required autofocus>
                                    <label for="email" class="mdl-textfield__label">Correo</label>
                                    @if ($errors->has('email'))
                                        <span class="error-block">
                                            {{ $errors->first('email') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="mdl-textfield mdl-js-textfield">
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <div class="col-md-6">
                                    <input id="password" type="password" class="mdl-textfield__input" name="password" required value="123456">
                                    <label for="password" class="mdl-textfield__label">Contraseña</label>
                                    @if ($errors->has('password'))
                                        <span class="error-block">
                                            {{ $errors->first('password') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mdl-card__supporting-text">
                        <label class="mdl-checkbox mdl-js-checkbox" for = "checkbox3">
                            <input type="checkbox" name="remember" id="checkbox3" class="mdl-checkbox__input"  {{ old('remember') ? 'checked' : '' }}>
                            <span class = "mdl-checkbox__label">Recordar</span>
                        </label>
                    </div> 
                    <div class="mdl-card__actions">
                        <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">Entrar</button>
                    </div>
                    <div class="mdl-card__actions">
                        <a class="mdl-button mdl-js-button mdl-button--accent" href="{{ route('password.request') }}">Olvidaste tu contraseña?</a>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>

