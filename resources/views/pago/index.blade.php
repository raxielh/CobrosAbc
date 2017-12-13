@extends('layouts.app')

@section('content')
<style media="screen">
  .mdl-button--fab{
    color: #fff;
    background: rgb(68, 220, 80);
  }
</style>
<h3 style="margin: 6px;color: #676767;font-weight: 200;">Pago Prestamo @if (currentUser() == 1)<a href="{{ url('prestamo_ordenar') }}" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect"><i class="material-icons">vertical_align_center</i>Ordenar</a>@endif</h3>

  <table id="tbl_barrio" style="width:100% !important">
    <thead style="background: #37474f;">
      <tr>
        <th></th>
        <th  style="color:#fff">Orden</th>
        <th  style="color:#fff">Cliente</th>
        <th  style="color:#fff">Identificacion</th>
        <th  style="color:#fff">Monto</th>
        <th  style="color:#fff">Interes</th>
        <th  style="color:#fff">Valor Prestamo</th>
        <th  style="color:#fff">Tiempo</th>
        <th  style="color:#fff">Cuota</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($data['datos'] as $key => $value)
      <tr>
        <th>
          <a class="mdl-button mdl-js-button mdl-button--fab" href="{{ url('pago') }}/{{ $value->ide }}">
            <i class="material-icons">account_balance_wallet</i>
          </a>
        </th>
        <th>{{ $value->orden }}</th>
        <th>{{ $value->nombre }}</th>
        <th>{{ $value->identificacion }}</th>
        <th>{{ $value->mascara_monto }}</th>
        <th>{{ $value->interes }}</th>
        <th>{{ $value->valor_prestamo }}</th>
        <th>{{ $value->tiempo }}</th>
        <th>{{ $value->cuota }}</th>
      </tr>
      @endforeach
    </tbody>
  </table>
<script type="text/javascript">
$(function() {
  $("#pago").addClass("active");
  cargar();
});

function cargar(){
  var table=$('#tbl_barrio').DataTable( {
      "responsive": true,
  });
  table
      .column( 1 ).visible( false )
      .order( 'asc' )
      .draw();
}

</script>
@endsection
