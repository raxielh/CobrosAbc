@extends('layouts.app')

@section('content')
<h3 style="margin: 6px;color: #676767;font-weight: 200;"><a href="{{ route('pago.index')}}"><i class="material-icons" style="color: #263238;">arrow_back</i></a> Ordenar prestamos</h3>

  <table id="tbl_barrio" class="mdl-data-table mdl-js-data-table" style="width:100% !important">
    <thead style="background: #37474f;">
      <tr>
        <th></th>
        <th  style="color:#fff">Cliente</th>
        <th  style="color:#fff">Identificacion</th>
        <th  style="color:#fff">Monto</th>
        <th  style="color:#fff">Interes</th>
        <th  style="color:#fff">Valor Prestamo</th>
        <th  style="color:#fff">Tiempo</th>
        <th  style="color:#fff">Cuota</th>
        <th  style="color:#fff">Fecha</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($data['datos'] as $key => $value)
      <tr>
        <th>
          <a href="{{ url('prestamo_ordenar_minus') }}/{{ $value->ide }}"><i class="material-icons" style="color: #263238;">arrow_upward</i></a>
          <a href="{{ url('prestamo_ordenar_plus') }}/{{ $value->ide }}"><i class="material-icons" style="color: #263238;">arrow_downward</i></a>
        </th>
        <th>{{ $value->nombre }}</th>
        <th>{{ $value->identificacion }}</th>
        <th>{{ $value->mascara_monto }}</th>
        <th>{{ $value->interes }}</th>
        <th>{{ $value->valor_prestamo }}</th>
        <th>{{ $value->tiempo }}</th>
        <th>{{ $value->cuota }}</th>
        <th>{{ $value->fecha }}</th>
      </tr>
      @endforeach
    </tbody>
  </table>
<script type="text/javascript">
$(function() {
  $("#pago").addClass("active");
});
</script>
@endsection
