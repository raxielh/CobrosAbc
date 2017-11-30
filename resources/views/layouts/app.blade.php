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
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.cyan-light_blue.min.css">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
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
    </style>
  </head>
  <body>
    <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
      <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title">nombre del cobro</span>
          <div class="mdl-layout-spacer"></div>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
            <label class="mdl-button mdl-js-button mdl-button--icon" for="search">
              <i class="material-icons">search</i>
            </label>
            <div class="mdl-textfield__expandable-holder">
              <input class="mdl-textfield__input" type="text" id="search">
              <label class="mdl-textfield__label" for="search">Buscar...</label>
            </div>
          </div>
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
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">home</i>Inicio</a>
        </nav>
      </div>
      <main class="mdl-layout__content mdl-color--grey-100">
          <div class="mdl-grid">
              <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
                  @yield('content')
              </div>
          </div>
      </main>        
    </div>
    
    <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>

  </body>
</html>
