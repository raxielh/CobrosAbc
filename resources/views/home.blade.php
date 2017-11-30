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
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
    crossorigin="anonymous"></script>
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
	.demo-card-square.mdl-card {
	    width: 320px;
		height: 320px;
	}
	.demo-card-square > .mdl-card__title {
	    color: #fff;
		background:
		url('{{ asset('img/icono.png') }}') bottom right 15% no-repeat #46B6AC;
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

				<div class="mdl-grid">

				    <div class="mdl-cell mdl-cell--2-col-phone mdl-cell--4-col-tablet mdl-cell--2-col-desktop">
				        <div class="mdl-layout__tab-panel is-active" id="overview">
							<div class="demo-card-square mdl-card mdl-shadow--2dp">
							  <div class="mdl-card__title mdl-card--expand">
							    <h2 class="mdl-card__title-text">Nombre del cobro</h2>
							  </div>
							  <div class="mdl-card__actions mdl-card--border">
							    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="{{ route('dashboard', [1])}}">
							      Entrar
							    </a>
							  </div>
							</div>
				        </div> 
				    </div>

				</div>

				<button class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored botonF1 btn_crear_cobro">
				  <i class="material-icons">add</i>
				</button>
		      
		      </main>
		    </div>
	    </div>
	  </main>
	</div>
	@include('layouts.modals.crear_cobro')
    <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>
  </body>
</html>
