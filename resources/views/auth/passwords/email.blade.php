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
.mdl-textfield {
    position: relative;
    font-size: 16px;
    display: inline-block;
    box-sizing: border-box;
    width: 100%;
    max-width: 100%;
    margin: 0px;
    padding: 22px 0;
}
    </style>
</head>
<body>
    <div class="mdl-layout mdl-js-layout mdl-color--grey-100">
        <main class="mdl-layout__content">
            <div class="mdl-card mdl-shadow--6dp">
                <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
                    <h2 class="mdl-card__title-text"><a class="mdl-navigation__link" href="{{ route('login')}}">
            <i class="mdl-color-text--blue-grey-400 material-icons" style="color: #fff !important" role="presentation">arrow_back</i> 
          </a>{{ config('app.name') }}</h2>
                </div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="email"  name="email"  required>
                                <label class="mdl-textfield__label" for="sample3">Correo...</label>
  

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group" style="margin: 10px">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                                    Restablecer Contraseña
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>