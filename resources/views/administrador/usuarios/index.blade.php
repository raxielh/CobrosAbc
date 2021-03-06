@extends('layouts.admin')

@section('content')

<h3 style="margin: 6px;color: #676767;font-weight: 200;">Usuarios</h3>
<form action="{{ route('usuarios.store')}}" method="post" id="save_barrio">
  {!! csrf_field() !!}
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
        <label for="input_text" class="mdl-textfield__label">Nombre</label>
        <input type="text" class="mdl-textfield__input" id="input_text" name="name" required="" />
    </div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <label for="input_email" class="mdl-textfield__label">Correo</label>
        <input type="email" class="mdl-textfield__input" id="input_email" name="email" required="" />
    </div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <label for="input_email" class="mdl-textfield__label">Contraseña</label>
        <input type="password" class="mdl-textfield__input" id="input_pass" name="password" required="" />
    </div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
        <label for="input_text" class="mdl-textfield__label">Direccion</label>
        <input type="text" class="mdl-textfield__input" id="input_text" name="direccion" />
    </div>
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
        <label for="input_text" class="mdl-textfield__label">Telefono</label>
        <input type="text" class="mdl-textfield__input" id="input_text" name="telefono" />
    </div>
    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored "><i class="material-icons">save</i>Guardar</button>
    <hr>
    <table id="tbl_barrio" class="table display responsive no-wrap" style="width:100% !important">
      <thead>
          <tr>
              <th>Nombre</th>
              <th>Correo</th>
              <th>Direccion</th>
              <th>Telefono</th>
              <th></th><th></th>
          </tr>
      </thead>
    </table>
</form>
<script type="text/javascript">
$(function() {
  $("#usuarios").addClass("active");
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
      ajax: '{{ route('usuarios_get')}}',
      columns: [
          {data: 'name'},
          {data: 'email'},
          {data: 'direccion'},
          {data: 'telefono'},
          {data: 'action', name: 'action', orderable: false, searchable: false},
          {data: 'action2', name: 'action2', orderable: false, searchable: false},
      ],
      columnDefs: [
          { width: 110, targets: 4 },
          { width: 110, targets: 5 }
      ]
  });
  table
      .column( '0:visible' )
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
              url: "{{ url('usuarios') }}/"+id,
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
