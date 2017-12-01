<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="App de cobro">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.deep_purple-pink.min.css">
    <link rel="stylesheet" href="https://getmdl.io/templates/text-only/styles.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <style>
    #view-source {
      position: fixed;
      display: block;
      right: 0;
      bottom: 0;
      margin-right: 40px;
      margin-bottom: 40px;
      z-index: 900;
    }
    #editar{
      display: none;
    }
	.demo-card-square.mdl-card {
	    width: 320px;
		height: 210px;
	}
	.demo-card-square > .mdl-card__title {
	  color: #fff;
		background:
		url('{{ asset('img/icono.png') }}') no-repeat #46B6AC;
    background-position: 101% 17%;
	}
	.mdl-demo .mdl-card__actions {
	    margin: 0;
	    padding: 0px !important;
	    color: inherit;
	}
	.mdl-card{
		min-height: 170px;
	}
	.mdl-button{
		color: #fff;
	}
	.botonF1{
	  width:60px;
	  height:60px;
	  border-radius:100%;
	  background:#F44336;
	  right:0;
	  bottom:0;
	  position:absolute;
	  margin-right:16px;
	  margin-bottom:16px;
	  border:none;
	  outline:none;
	  color:#FFF;
	  font-size:36px;
	  box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
	  transition:.3s;
	}
  .bolita_verde{
    background: green;
        display: inline-block;
        width: 10px;
        height: 10px;
        border-radius: 10px;
  }
  .bolita_roja{
    background: red;
        display: inline-block;
        width: 10px;
        height: 10px;
        border-radius: 10px;
  }
  .jconfirm .jconfirm-holder {
      max-height: 80%;
      padding: 5px 0;
      max-width: 500px;
      margin: 0px auto;
  }
	@media (max-width: 400px) {
		.demo-card-square.mdl-card {
		    width: 100%;
			height: 170px;
		}
		.mdl-layout-title{
			display: none;
		}
		.demo-card-square > .mdl-card__title {
		    color: #fff;
		    background: #46B6AC;
        background-position: -700% 269% !important;
		}
    .mdl-button--fab.mdl-button--colored {
        background: rgb(255,64,129);
        color: rgb(255,255,255);
        z-index: 999;
        position: relative;
        margin-left: 17px;
    }
	}
    </style>
  </head>
  <body class="mdl-demo mdl-color--grey-100 mdl-color-text--grey-700 mdl-base">
	<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
	  <header class="mdl-layout__header">
	    <div class="mdl-layout__header-row">
	      <span class="mdl-layout-title">{{ config('app.name') }}</span>
	      <div class="mdl-layout-spacer"></div>
	      <nav class="mdl-navigation">
            <a href="#">
              <div class="mdl-spinner mdl-js-spinner is-active load"></div>
            </a>
	          <button class="mdl-button mdl-js-button mdl-js-ripple-effect" id="hdrbtn">
	            {{ Auth::user()->name }} <i class="material-icons">more_vert</i>
	          </button>
	          <a href="{{ route('logout') }}" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
	            <i class="material-icons">exit_to_app</i>
	          </a>
	          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	            {{ csrf_field() }}
	          </form>
	          <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right" for="hdrbtn">
	            <li class="mdl-menu__item">Editar Perfil</li>
	          </ul>
	      </nav>
	    </div>
	  </header>
	  <main class="mdl-layout__content">
	    <div class="page-content">
		    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
		      <main class="mdl-layout__content">

				<div class="mdl-grid"  id="cobros">



				</div>

				<button class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored botonF1 btn_crear_cobro">
				  <i class="material-icons">add</i>
				</button>

		      </main>
		    </div>
	    </div>
	  </main>
	</div>
  <div id="demo-toast-example" class="mdl-js-snackbar mdl-snackbar">
    <div class="mdl-snackbar__text"></div>
    <button class="mdl-snackbar__action" type="button"></button>
  </div>
	  @include('layouts.modals.crear_cobro')
    @include('layouts.modals.editar_cobro')
    @include('cobros.script')
    <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>
  </body>
</html>
