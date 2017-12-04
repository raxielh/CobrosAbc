@extends('layouts.app')

@section('content')
<h3 style="margin: 6px;color: #676767;font-weight: 200;"><a href="{{ route('prestamo.index')}}"><i class="material-icons" style="color: #263238;">arrow_back</i></a> Ordenar prestamos</h3>

  <table id="tbl_barrio" class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp" style="width:100% !important">
    <thead>
      <tr>
        <th>Cliente</th>
        <th>Identificacion</th>
        <th>Monto</th>
        <th>Interes</th>
        <th>Valor Prestamo</th>
        <th>Tiempo</th>
        <th>Cuota</th>
        <th>Fecha</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($data['datos'] as $key => $value)
      <tr style="cursor: pointer;">
        <th><i class="material-icons" style="color: #263238;">menu</i></th>
        <th>{{ $value->nombre }}</th>
        <th>{{ $value->identificacion }}</th>
        <th>{{ $value->monto }}</th>
        <th>{{ $value->interes }}</th>
        <th>{{ $value->valor_prestamo }}</th>
        <th>{{ $value->tiempo }}</th>
        <th>{{ $value->cuota }}</th>
        <th>{{ $value->fecha }}</th>
      </tr>
      @endforeach
    </tbody> 
  </table>

@endsection
