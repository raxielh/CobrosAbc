@extends('layouts.app')

@section('content')
<h3 style="margin: 6px;color: #676767;font-weight: 200;"><a href="{{ route('prestamo.index')}}"><i class="material-icons" style="color: #263238;">arrow_back</i></a> Editar Prestamo</h3>

<form action="{{ url('prestamo')}}/{{($data['datos'][0]->id)}}" method="post" id="save_barrio">
  {!! csrf_field() !!}
   <input type="hidden" name="_method" value="PUT">
   <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
      <label for="input_text" class="mdl-textfield__label">Interes</label>
      <select name="interes" required class="ui search dropdown interes" id="buscar_1">
          @foreach ($data['interes'] as $key => $value)
            <option value="{{ $value['numero'] }} "@if ($value['numero'] == $data['datos'][0]->interes)
                selected="selected"@endif>{{ $value['numero'] }}</option>
          @endforeach
      </select><a href="{{ route('interes.index') }}"><i class="material-icons">add_circle</i></a>
    </div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
        <label for="input_text" class="mdl-textfield__label">Monto</label>
        <input type="hidden" id="monto" name="monto" required value="{{ $data['datos'][0]->monto }}" />
        <input type="text" class="mdl-textfield__input" id="mascara_monto" name="" required="" value="{{ $data['datos'][0]->mascara_monto }}" />
    </div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
        <label for="input_text" class="mdl-textfield__label">Fecha</label>
        <input type="date" class="mdl-textfield__input" id="input_text" name="fecha" required="" value="{{ $data['datos'][0]->fecha }}" />
    </div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
        <label for="input_text" class="mdl-textfield__label">Tiempo</label>
        <input type="number" class="mdl-textfield__input" id="tiempo" name="tiempo" required="" value="{{ $data['datos'][0]->tiempo }}" />
    </div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
        <label for="input_text" class="mdl-textfield__label">Referencia</label>
        <input type="text" class="mdl-textfield__input" id="input_text" name="referencia" value="{{ $data['datos'][0]->referencia }}" />
    </div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
      <select name="cliente" required class="ui search dropdown" id="buscar_2">
          <option value="" selected="selected">Cliente</option>
          @foreach ($data['cliente'] as $key => $value)
            <option value="{{ $value['id'] }} " @if ($value['id'] == $data['datos'][0]->cliente_id)
                selected="selected"@endif>{{ $value['identificacion'] }} | {{ $value['nombre'] }}</option>
          @endforeach
      </select><a href="{{ route('clientes.index') }}"><i class="material-icons">add_circle</i></a>
    </div>


    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored "><i class="material-icons">save</i> Guardar</button>

    <hr>
</form>
    <table id="tbl_barrio" class="table display responsive no-wrap" style="width:100% !important">
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
              <th>Referencia</th>
              <th></th><th></th>
          </tr>
      </thead>
    </table>

<script type="text/javascript">
$(function() {
    $("#ts" ).hide();
  $("#prestamos").addClass("active");
  cargar();
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
          $("#save_barrio").slideUp();
          $(".load").hide();
          $("#save_barrio")[0].reset();
          cargar();
          mensaje(data);
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
      ajax: '{{ route('prestamo_get')}}',
      columns: [
          {data: 'nombre'},
          {data: 'identificacion'},
          {data: 'mascara_monto'},
          {data: 'interes'},
          {data: 'valor_prestamo'},
          {data: 'tiempo'},
          {data: 'cuota'},
          {data: 'fecha'},
          {data: 'referencia'},
          {data: 'action', name: 'action', orderable: false, searchable: false},
      ],
      columnDefs: [
          { width: 1, targets: 9 },
      ]
  });
  table
      .column( '0:visible' )
      .order( 'asc' )
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
              url: "{{ url('prestamo') }}/"+id,
              data: { _token: "{{ csrf_token() }}",_method: "DELETE" }
            }).done(function( data ) {
              $(".load").hide();
              mensaje(data);
              cargar();
            });
          },
          Cancelar: function () {
            $(".load").hide();
          },
      }
  });
}

  $( "#mascara_monto" ).keyup(function() {
    var i=$(".interes option:selected" ).text();
    var t=$("#tiempo" ).val();
    var m=$("#monto").val(QuitarMoneda($( "#mascara_monto" ).val()));
  });

</script>
@endsection
