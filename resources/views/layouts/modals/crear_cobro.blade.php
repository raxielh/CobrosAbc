<dialog id="dialog_crear_cobro" class="mdl-dialog">
<form action="" method="post" id="save_cobro" >
  {!! csrf_field() !!}
  <input type="hidden" id="accion" value="1">
  <h3 class="mdl-dialog__title" id="title">Crear Cobro</h3>
  <div class="mdl-dialog__content">
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input" type="text"  name="nombre" required="">
        <label class="mdl-textfield__label" for="nombre">Nombre del cobro...</label>
      </div>
      <div class="mdl-textfield mdl-js-textfield">
        <textarea class="mdl-textfield__input" type="text" rows= "3"  name="localidad" required="" placeholder="Localidad..."></textarea>
        <label class="mdl-textfield__label" for="localidad">Localidad...</label>
      </div>
      <div class="mdl-textfield mdl-js-textfield">
        <input class="mdl-textfield__input" type="color"  name="color" required="" placeholder="Elije un color..." value="#46B6AC">
        <label class="mdl-textfield__label" for="color">Elije un color...</label>
      </div>
  </div>
  <div class="mdl-dialog__actions">
    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" id="save">Guardar</button>
    <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent cerrar">Cerrar</button>
  </div>
 </form>
</dialog>
