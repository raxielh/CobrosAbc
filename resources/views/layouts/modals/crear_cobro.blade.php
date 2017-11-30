<dialog id="dialog_crear_cobro" class="mdl-dialog">
<form action="{{ route('cobro.store') }}" method="post" id="save_cobro" >
  {!! csrf_field() !!}
  <h3 class="mdl-dialog__title">Crear Cobro</h3>
  <div class="mdl-dialog__content">
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input" type="text" id="nombre" name="nombre" required="">
        <label class="mdl-textfield__label" for="nombre">Nombre del cobro...</label>
      </div>
      <div class="mdl-textfield mdl-js-textfield">
        <textarea class="mdl-textfield__input" type="text" rows= "3" id="localidad" name="localidad" required="" placeholder="Localidad..."></textarea>
        <label class="mdl-textfield__label" for="localidad">Localidad...</label>
      </div>
  </div>
  <div class="mdl-dialog__actions">
    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" id="save">Guardar</button>
    <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent cerrar">Cerrar</button>
  </div>
 </form>
</dialog>

<script>
  $(function() {

    var dialog = document.querySelector('#dialog_crear_cobro');

    $('.btn_crear_cobro').click(function(event)
    {
      dialog.showModal();
    });

    $('.cerrar').click(function(event)
    {
      dialog.close();
    });

    $("#save_cobro").submit(function(e) {    
      var form = $(e.target);
      $.ajax(
        {
          type: "POST",
          url: "{{ route('cobro.store') }}",//form.attr("action"),
          data:$("#save_cobro").serialize(),
          success: function (data)
          {  
            console.log(data);
            $("#save_cobro")[0].reset();
          },
          error: function(jqXHR, text, error)
          {
            console.log(data);          
          }
        }
      );
      return false;
    });

  });
</script>