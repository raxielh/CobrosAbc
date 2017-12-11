@extends('layouts.app')

@section('content')
<style type="text/css">
@if (currentUser() == 1)
  .oculto{
    display: block;
  }
@else
  .oculto{
    display: none;
  }
@endif
</style>
<h3 style="margin: 6px;color: #676767;font-weight: 200;"><a href="{{ route('pago.index')}}"><i class="material-icons" style="color: #263238;">arrow_back</i></a> Pagos Prestamo</h3>
<div class = "mdl-grid">
    <div class = "mdl-cell mdl-cell--9-col mdl-cell--12-col-phone graybox">
        <h4 style="margin: 6px;color: #676767;font-weight: 200;text-align:center">Pagar y historial de pago</h4>
        <form action="{{ url('pago')}}" method="post" id="save_barrio">
          {!! csrf_field() !!}
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
              <label for="input_text" class="mdl-textfield__label">Monto</label>
              @foreach ($data['datos'] as $key => $value)
              <input type="hidden" id="monto" name="monto" required="" value="{{ $value->cuota_m }}" />
              <input type="text" class="mdl-textfield__input" id="mascara_monto" name="" value="{{ $value->cuota_m }}" required="" />
              @endforeach
          </div>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
              <label for="input_text" class="mdl-textfield__label">Referencia</label>
              <input type="text" class="mdl-textfield__input"  name="referencia" value="" />
          </div>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
              <label for="input_text" class="mdl-textfield__label">Fecha</label>
              <input type="date" class="mdl-textfield__input"  name="fecha" value="{{ date('Y-m-d') }}" required="" />
          </div>
          <input type="hidden" name="prestamo" value="{{$data['datos'][0]->ide}}">
          <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
            Pagar
          </button>
        </form>
        <table id="tbl_barrio" class="table display responsive no-wrap" style="width:100% !important">
          <thead>
              <tr>
                  <th>Monto</th>
                  <th>Fecha</th>
                  <th>Refrencia</th>
                  <th>Cobrador</th>
                  <th></th>
              </tr>
          </thead>
        </table>
    </div>
    <div class = "mdl-cell mdl-cell--3-col mdl-cell--12-col-phone graybox">
        <h4 style="margin: 6px;color: #676767;font-weight: 200;text-align:end">Detalle de prestamo</h4>

          <p style="margin:0px 0px 6px;text-align:end;font-size:20px;font-weight: 300;"><strong>Cliente:</strong> {{ $data['datos'][0]->nombre }}</p>
          <p style="margin:0px 0px 6px;text-align:end;font-size:20px;font-weight: 300;"><strong>Identificacion:</strong> {{ $data['datos'][0]->identificacion }}</p>
          <p style="margin:0px 0px 6px;text-align:end;font-size:20px;font-weight: 300;"><strong>Monto:</strong> {{ number_format($data['datos'][0]->monto) }}</p>
          <p style="margin:0px 0px 6px;text-align:end;font-size:20px;font-weight: 300;"><strong>Interes:</strong> {{ $data['datos'][0]->interes }}</p>
          <p style="margin:0px 0px 6px;text-align:end;font-size:20px;font-weight: 300;"><strong>Valor Prestamo:</strong>  {{ $data['datos'][0]->valor_prestamo }}</p>
          <p style="margin:0px 0px 6px;text-align:end;font-size:20px;font-weight: 300;"><strong>Tiempo:</strong> {{ $data['datos'][0]->tiempo }}</p>
          <p style="margin:0px 0px 6px;text-align:end;font-size:20px;font-weight: 300;"><strong>Cuota:</strong> {{ $data['datos'][0]->cuota }}</p>
         <p style="margin:0px 0px 6px;text-align:end;font-size:20px;font-weight: 300;"><strong>Pagado:</strong> {{ number_format($data['pp'][0]->pagado) }}</p>
          <p style="margin:0px 0px 6px;text-align:end;font-size:20px;font-weight: 300;"><strong>Debe:</strong> {{ number_format(($data['datos'][0]->monto)-($data['pp'][0]->pagado)) }}</p>
          <p style="margin:0px 0px 6px;text-align:end;font-size:20px;font-weight: 300;"><strong>Cuotas faltantes:</strong> {{ $data['datos'][0]->tiempo-$data['pp'][0]->restantes  }}</p>
    </div>
 </div>

<script type="text/javascript">
$(function() {
            cargar();
  $("#pago").addClass("active");
  $( "#mascara_monto" ).keyup(function() {
    $("#monto").val(QuitarMoneda($( "#mascara_monto" ).val()));
    $("#mascara_monto").val(Moneda($( "#mascara_monto" ).val()));
  });
  $("#save_barrio").submit(function(e) {
    e.preventDefault();
    $(".load").show();
    var form = $(e.target);
    var datos = $("#save_barrio").serialize();
    $.ajax(
      {
        type: "POST",
        url: form.attr("action"),
        data:datos,
        success: function (data)
        {
          $(".load").hide();
          $("#save_barrio")[0].reset();
          mensaje(data);
          location.reload(true);
        },
        error: function(jqXHR, text, error)
        {
          mensaje(data);
        }
      }
    );
    return false;
  });
});

function cargar(){
  var table=$('#tbl_barrio').DataTable( {
      "destroy": true,
      "processing": true,
      ajax: '{{ url('pago_get')}}/{{$data['datos'][0]->ide}}',
      columns: [
          {data: 'mascara_monto'},
          {data: 'fecha'},
          {data: 'referencia'},
          {data: 'nombre'},
          {data: 'action2', name: 'action2', orderable: false, searchable: false},
      ],
      columnDefs: [
          { width: 110, targets: 4 },
      ]
  });
  table
      .column( '1:visible' )
      .order( 'desc' )
      .draw();
}

function borrar(id){
  $.confirm({
      title: 'Confirmar!',
      content: 'Estas seguro!',
      buttons: {
          Si: function () {
            $(".load").show();
            $.ajax({
              method: "POST",
              url: "{{ url('pago') }}/"+id,
              data: { _token: "{{ csrf_token() }}",_method: "DELETE" }
            }).done(function( data ) {
              $(".load").hide();
              mensaje(data);
              location.reload(true);
            });
          },
          Cancelar: function () {
            $(".load").hide();
          },
      }
  });
}
</script>
@endsection
