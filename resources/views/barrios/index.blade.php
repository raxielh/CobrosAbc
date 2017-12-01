@extends('layouts.app')

@section('content')
<form action="{{ route('barrio.store')}}" method="post" id="save_barrio">
  {!! csrf_field() !!}

    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
        <label for="input_text" class="mdl-textfield__label">Nombre</label>
        <input type="text" class="mdl-textfield__input" id="input_text" name="nombre" required="" />
    </div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <label for="input_email" class="mdl-textfield__label">Referencia</label>
        <input type="text" class="mdl-textfield__input" id="input_email" name="Referencia"/>
    </div>
    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored ">Guardar</button>

<table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable">
    <thead>
        <tr>
            <th class="mdl-data-table__cell--non-numeric">Text</th>
            <th>Number</th>
            <th>Number</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="mdl-data-table__cell--non-numeric">Table cell</td>
            <td>255</td>
            <td>190</td>
        </tr>
        <tr>
            <td class="mdl-data-table__cell--non-numeric">Table cell</td>
            <td>50</td>
            <td>125</td>
        </tr>
        <tr>
            <td class="mdl-data-table__cell--non-numeric">Table cell</td>
            <td>13</td>
            <td>196</td>
        </tr>
    </tbody>
</table>
</form>
<script>
  $(function() {

    $("#save_barrio").submit(function(e) {
      $(".load").show();
      $("#save").hide();
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
            $("#save").show();
            dialog.close();
            mensaje(data);
            cargar_cobros();
            $("#save_barrio")[0].reset();
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
</script>
@endsection