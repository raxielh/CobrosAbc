@extends('layouts.app')

@section('content')
<style media="screen">
  .mdl-button--fab{
    color: #fff;
    background: rgb(68, 220, 80);
  }
</style>
<h3 style="margin: 6px;color: #676767;font-weight: 200;">Configurar Fuera de Linea</h3>
<h4 style="margin: 6px;color: #676767;font-weight: 200;">Pasos para configuar fuera de linea</h4>
<span class="mdl-chip mdl-chip--deletable">
    <span class="mdl-chip__text">1. Genera un clave unica para tu cobro</span>
    <button type="button" class="mdl-chip__action"><i class="material-icons">forward</i></button>
</span>
<span class="mdl-chip mdl-chip--deletable">
    <span class="mdl-chip__text">2. Descarga la App para Android</span>
    <button type="button" class="mdl-chip__action"><i class="material-icons">play_for_work</i></button>
</span>
<span class="mdl-chip mdl-chip--deletable">
    <span class="mdl-chip__text">3. Ingresa tu clave unica en la App</span>
    <button type="button" class="mdl-chip__action"><i class="material-icons">perm_device_information</i></button>
</span>
<div style="padding-top: 2em;padding-bottom: 3em">


    @if(count($data['datos'])==0)
    <form action="{{ url('offline')}}" method="post" id="save_barrio">
      {!! csrf_field() !!}
      <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
        <i class="material-icons">vpn_key</i> Generar clave unica
      </button>
    </form>
    @else
    <h1 style="margin: 6px;color: #676767;font-weight: 200;">Tu key es:  {{ ($data['datos'][0]->key) }}</h1>
    <form action="{{ url('offline')}}/{{ ($data['datos'][0]->id) }}" method="post" id="save_barrio">
      {!! csrf_field() !!}
      <input type="hidden" name="_method" value="PUT">
      <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" style="background: rgb(202, 0, 0);">
        <i class="material-icons">vpn_key</i> Volver a Generar clave unica
      </button>
    </form>
    @endif

</div>
<script type="text/javascript">
  $(function() {
    $("#offline").addClass("active");
  });
</script>
@endsection
