@extends('layouts.app')

@section('content')
<h3 style="margin: 6px;color: #676767;font-weight: 200;">Capital</h3>
<form action="{{ route('capital.store')}}" method="post" id="save_barrio">
  {!! csrf_field() !!}
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
        <label for="input_text" class="mdl-textfield__label">Monto</label>
        <input type="hidden" id="monto" name="monto" required="" />
        <input type="text" class="mdl-textfield__input" id="mascara_monto" name="" required="" />
    </div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <label for="input_email" class="mdl-textfield__label">Referencia</label>
        <input type="text" class="mdl-textfield__input" id="input_email" name="referencia"/>
    </div>
    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored "><i class="material-icons">save</i>Guardar</button>
    <hr>
    <table id="tbl_barrio" class="table display responsive no-wrap" style="width:100% !important">
      <thead>
          <tr>
              <th>Monto</th>
              <th>Referencia</th>
              <th>Fecha de Ingreso</th>              
              <th></th><th></th>
          </tr>
      </thead>
    </table>
</form>
<script type="text/javascript">
$(function() {
  $("#capital").addClass("active");
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
      ajax: '{{ route('capital_get')}}',
      columns: [
          {data: 'mascara_monto'},
          {data: 'referencia'},
          {data: 'created_at'},
          {data: 'action', name: 'action', orderable: false, searchable: false},
          {data: 'action2', name: 'action2', orderable: false, searchable: false},
      ],
      columnDefs: [
          { width: 110, targets: 3 },
          { width: 110, targets: 4 }
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
              url: "{{ url('capital') }}/"+id,
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
