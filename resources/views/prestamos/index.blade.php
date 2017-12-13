@extends('layouts.app')

@section('content')
<h3 style="margin: 6px;color: #676767;font-weight: 200;">Prestamos</h3>
<form action="{{ route('prestamo.store')}}" method="post" id="save_barrio">
  {!! csrf_field() !!}
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
      <label for="input_text" class="mdl-textfield__label">Interes</label>
      <select name="interes" required class="ui search dropdown interes" id="buscar_1">
          <option value="" selected="selected">Interes</option>
          @foreach ($data['interes'] as $key => $value)
            <option value="{{ $value['numero'] }}">{{ $value['numero'] }}</option>
          @endforeach
      </select><a href="{{ route('interes.index') }}"><i class="material-icons">add_circle</i></a>
    </div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
        <label for="input_text" class="mdl-textfield__label">Monto</label>
       <input type="hidden" id="monto" name="monto" required="" />
        <input type="text" class="mdl-textfield__input" id="mascara_monto" name="" required="" />
    </div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
        <label for="input_text" class="mdl-textfield__label">Fecha</label>
        <input type="date" class="mdl-textfield__input" id="input_text" name="fecha" required="" value="{{date('Y-m-d') }}" />
    </div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
        <label for="input_text" class="mdl-textfield__label">Tiempo</label>
        <input type="number" class="mdl-textfield__input" id="tiempo" name="tiempo" required="" />
    </div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
        <label for="input_text" class="mdl-textfield__label">Referencia</label>
        <input type="text" class="mdl-textfield__input" id="referencia" name="referencia" />
    </div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
      <select name="cliente" required class="ui search dropdown" id="buscar_2">
          <option value="" selected="selected">Cliente</option>
          @foreach ($data['datos'] as $key => $value)
            <option value="{{ $value['id'] }} ">{{ $value['identificacion'] }} | {{ $value['nombre'] }}</option>
          @endforeach
      </select><a href="{{ route('clientes.index') }}"><i class="material-icons">add_circle</i></a>
    </div>
    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored "><i class="material-icons">save</i>Guardar</button>
    <h5 style="margin: 5px;color: #676767;font-weight: 300;">Cuota: <span id="cuo"></span></h5>
    <h5 style="margin: 5px;color: #676767;font-weight: 300;">Valor Prestamo: <span id="vp"></span></h5>
    <hr>
    <table id="tbl_barrio" class="table display responsive no-wrap" style="width:100% !important">
      <thead>
          <tr>
            <th>id</th>
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
</form>
<script type="text/javascript">
$(function() {
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
          $(".load").hide();
          $("#monto").val('');
          $("#mascara_monto").val('');
          $("#referencia").val('');
          $("#tiempo").val('');
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
    $("#cuo" ).text("");
    $("#vp" ).text("");
  var table=$('#tbl_barrio').DataTable( {
      "destroy": true,
      "processing": true,
      ajax: '{{ route('prestamo_get')}}',
      columns: [
      {data: 'ide'},
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
          {data: 'action2', name: 'action2', orderable: false, searchable: false},
      ],
      columnDefs: [
          { width: 1, targets: 9 },
          { width: 1, targets: 10 }
      ]
  });
  table
      .column( 0 ).visible( false )
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
    i=parseInt(i);
    t=parseInt(t);
    m=parseInt(m.val());
    var f1=(m*(i/100))+m;
    var f2=((m*(i/100))+m)/t;
    console.log(f1);
    $("#cuo" ).text(f2);
    $("#vp" ).text(f1);
  });

  $( "#tiempo" ).keyup(function() {
    var i=$(".interes option:selected" ).text();
    var t=$("#tiempo" ).val();
    var m=$("#monto").val(QuitarMoneda($( "#mascara_monto" ).val()));
    i=parseInt(i);
    t=parseInt(t);
    m=parseInt(m.val());
    var f1=(m*(i/100))+m;
    var f2=((m*(i/100))+m)/t;
    console.log(f1);
    $("#cuo" ).text(f2);
    $("#vp" ).text(f1);
  });

  $( ".interes" ).change(function() {
    var i=$(".interes option:selected" ).text();
    var t=$("#tiempo" ).val();
    var m=$("#monto").val(QuitarMoneda($( "#mascara_monto" ).val()));
    i=parseInt(i);
    t=parseInt(t);
    m=parseInt(m.val());
    var f1=(m*(i/100))+m;
    var f2=((m*(i/100))+m)/t;
    console.log(f1);
    $("#cuo" ).text(f2);
    $("#vp" ).text(f1);
  });

</script>
@endsection
