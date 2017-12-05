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
    <link rel="stylesheet" type="text/css" href="{{ asset('css/semantic.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.cyan-light_blue.min.css">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-2.2.4.js"></script>

    <link href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="//cdn.datatables.net/responsive/1.0.0/css/dataTables.responsive.css" rel="stylesheet">
    <script src="http://getbootstrap.com/assets/js/vendor/popper.min.js"></script>
    <script src=".http://getbootstrap.com/dist/js/bootstrap.min.js"></script>
    <script src=" {{ asset('js/jquery.dataTables.js') }}"></script>
    <script src="//cdn.datatables.net/responsive/2.2.0/js/dataTables.responsive.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>


    <script src="{{ asset('js/semantic.js') }}"></script>

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
      td{
        text-align: center;
      }
      .jconfirm .jconfirm-holder {
          max-height: 80%;
          padding: 5px 0;
          max-width: 500px;
          margin: 0px auto;
      }
      .demo-drawer-header{
        height: auto;
      }
      .demo-navigation .mdl-navigation__link .material-icons{
        margin-right: 10px;
        color:#fff !important;
      }
      .demo-layout .demo-navigation .mdl-navigation__link {
          color: #fff;
          font-weight: 300;
          font-size: 20px;
      }
      .mdl-dialog {
  border: none;
  box-shadow: 0 9px 46px 8px rgba(0, 0, 0, 0.14), 0 11px 15px -7px rgba(0, 0, 0, 0.12), 0 24px 38px 3px rgba(0, 0, 0, 0.2);
  width: 280px; }
  .mdl-dialog__title {
    padding: 24px 24px 0;
    margin: 0;
    font-size: 2.5rem; }
  .mdl-dialog__actions {
    padding: 8px 8px 8px 24px;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-flex-direction: row-reverse;
        -ms-flex-direction: row-reverse;
            flex-direction: row-reverse;
    -webkit-flex-wrap: wrap;
        -ms-flex-wrap: wrap;
            flex-wrap: wrap; }
    .mdl-dialog__actions > * {
      margin-right: 8px;
      height: 36px; }
      .mdl-dialog__actions > *:first-child {
        margin-right: 0; }
    .mdl-dialog__actions--full-width {
      padding: 0 0 8px 0; }
      .mdl-dialog__actions--full-width > * {
        height: 48px;
        -webkit-flex: 0 0 100%;
            -ms-flex: 0 0 100%;
                flex: 0 0 100%;
        padding-right: 16px;
        margin-right: 0;
        text-align: right; }
  .mdl-dialog__content {
    padding: 20px 24px 24px 24px;
    color: rgba(0,0,0, 0.54); }
    .btn-red{
      color: rgb(255, 255, 255) !important;
    background-color: rgb(255, 64, 64)!important;
    }
    .btn-blue{
      color: rgb(255, 255, 255)!important;
    background-color: rgb(64, 99, 255)!important
    }
    .btn-green{
      color: rgb(255, 255, 255)!important;
    background-color: rgb(24, 197, 0)!important;
    }
.mdl-button--raised.mdl-button--colored{
  color: #fff !important;
}
.active{
      background: #26acac;
}
    @media (max-width: 500px) {
      #con{
        padding:0em !important;
        width: 100% !important;
      }
  		#use,#con_search{
  		  display: none;
  		}
      .mdl-layout__drawer-button{
        width: 31px;
      }
      .mdl-layout__header-row {
          padding: 0 16px 0 40px;
      }
  	}
    </style>
  </head>
  <body>
    <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
      <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title" style="color:{{$data['nombre_cobro']['color']}}">{{$data["nombre_cobro"]["nombre"]}}</span>
          <div class="mdl-layout-spacer"></div>
          <a href="#">
            <div class="mdl-spinner mdl-js-spinner is-active load"></div>
          </a>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable" id="con_search">
            <label class="mdl-button mdl-js-button mdl-button--icon" for="search">
              <i class="material-icons">search</i>
            </label>
            <div class="mdl-textfield__expandable-holder" >
              <input class="mdl-textfield__input" type="text" id="search">
              <label class="mdl-textfield__label" for="search">Buscar...</label>
            </div>
          </div>
          <button class="mdl-button mdl-js-button mdl-js-ripple-effect" id="hdrbtn">
            <span id="use">{{ Auth::user()->name }}</span> <i class="material-icons">more_vert</i>
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
        </div>
      </header>
      <div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
        <header class="demo-drawer-header">
          <div class="demo-avatar-dropdown" style="font-size: 30px;font-weight: 100;">
            <a href="{{ route('home')}}"><i class="material-icons" style="color: #fff;">arrow_back</i></a><span>{{ config('app.name') }}</span>
            <div class="mdl-layout-spacer"></div>
          </div>
        </header>
        <nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">
          <a class="mdl-navigation__link" id="home" href="{{ route('dashboard',[$data['cobro']]) }}">
            <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">home</i>Inicio
          </a>
          <a class="mdl-navigation__link" id="interes" href="{{ route('interes.index') }}">
            <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">forward_10</i>Interes
          </a>
          <a class="mdl-navigation__link" id="capital" href="{{ route('capital.index') }}">
            <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">euro_symbol</i>Capital
          </a>
          <a class="mdl-navigation__link" id="barrio" href="{{ route('barrio.index') }}">
            <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">directions</i>Barrios
          </a>
          <a class="mdl-navigation__link" id="clientes" href="{{ route('clientes.index') }}">
            <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">face</i>Clientes
          </a>
          <a class="mdl-navigation__link" id="prestamos" href="{{ route('prestamo.index') }}">
            <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">account_balance</i>Prestamos
          </a>
          <a class="mdl-navigation__link" id="pago" href="{{ route('pago.index') }}">
            <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">add_shopping_cart</i>Pago
          </a>
        </nav>
      </div>
      <main class="mdl-layout__content mdl-color--grey-100">
          <div class="mdl-grid">
              <div style="background:#fff;width:100%;padding:1em" id="con">
                @yield('content')
              </div>
          </div>
      </main>
    </div>
    <div id="demo-toast-example" class="mdl-js-snackbar mdl-snackbar">
      <div class="mdl-snackbar__text"></div>
      <button class="mdl-snackbar__action" type="button"></button>
    </div>
    <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('#buscar_1').dropdown();
        $('#buscar_2').dropdown();
      });
    </script>
  </body>
</html>
