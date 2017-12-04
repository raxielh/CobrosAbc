@extends('layouts.app')

@section('content')
<h3 style="margin: 6px;color: #676767;font-weight: 200;"><a href="{{ route('clientes.index')}}"><i class="material-icons" style="color: #263238;">arrow_back</i></a> Editar Cliente</h3>
<form action="{{ url('clientes')}}/{{($data['datos']['id'])}}" method="post" id="save_barrio">
  {!! csrf_field() !!}
   <input type="hidden" name="_method" value="PUT">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
        <label for="input_text" class="mdl-textfield__label">Nombre</label>
        <input type="text" class="mdl-textfield__input" id="input_text" name="nombre" required="" value="{{($data['datos']['nombre'])}}" />
    </div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
        <label for="input_text" class="mdl-textfield__label">Identificacion</label>
        <input type="text" class="mdl-textfield__input" id="input_text" name="identificacion" required="" value="{{($data['datos']['identificacion'])}}"  />
    </div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
        <label for="input_text" class="mdl-textfield__label">Telefono</label>
        <input type="text" class="mdl-textfield__input" id="input_text" name="telefono" required="" value="{{($data['datos']['telefono'])}} "/>
    </div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
        <label for="input_text" class="mdl-textfield__label">Direccion</label>
        <input type="text" class="mdl-textfield__input" id="input_text" name="direccion" required="" value="{{($data['datos']['direccion'])}}" />
    </div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
        <label for="input_text" class="mdl-textfield__label">Referencia</label>
        <input type="text" class="mdl-textfield__input" id="input_text" name="referencia" value="{{($data['datos']['referencia'])}}"  />
    </div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
      <select name="barrio" required class="ui search dropdown" id="buscar_1">
        @foreach ($data['barrio'] as $key => $value)
            <option value="{{ $value['id'] }}"
            @if ($value['id'] == $data['datos']['barrio_id'])
                selected="selected"
            @endif
            >{{ $value['nombre'] }}</option>
        @endforeach
      </select><a href="{{ route('barrio.index') }}"><i class="material-icons">add_circle</i></a>
    </div>

    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored "><i class="material-icons">save</i> Guardar</button>
    <hr>
</form>
    <table id="tbl_barrio" class="table display responsive no-wrap" style="width:100% !important">
      <thead>
          <tr>
              <th>Nombre</th>
              <th>Identificacion</th>
              <th>Telefono</th>
              <th>Direccion</th>
              <th>Referencia</th>
              <th>Barrio</th>
              <th></th>
          </tr>
      </thead>
    </table>

<script type="text/javascript">
$(function() {
  $("#clientes").addClass("active");
  cargar();

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
      ajax: '{{ route('clientes_get')}}',
      columns: [
          {data: 'nombre'},
          {data: 'identificacion'},
          {data: 'telefono'},
          {data: 'direccion'},
          {data: 'referencia'},
          {data: 'barrio'},
          {data: 'action', name: 'action', orderable: false, searchable: false},
      ],
      columnDefs: [
          { width: 100, targets: 6 },
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
              url: "{{ url('clientes') }}/"+id,
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
</script>
@endsection
