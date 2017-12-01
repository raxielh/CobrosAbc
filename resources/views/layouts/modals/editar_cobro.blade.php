<dialog id="dialog_update_cobro" class="mdl-dialog">
<form action="" method="post" id="update_cobro" >
  {!! csrf_field() !!}
  <input name="_method" type="hidden" value="PUT">
  <h3 class="mdl-dialog__title" id="title">Editar Cobro</h3>
  <div class="mdl-dialog__content">
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input" type="text" id="nombre" name="nombre" required="">
        <label class="mdl-textfield__label" for="nombre">Nombre del cobro...</label>
      </div>
      <div class="mdl-textfield mdl-js-textfield">
        <textarea class="mdl-textfield__input" type="text" rows= "3" id="localidad" name="localidad" required="" placeholder="Localidad..."></textarea>
        <label class="mdl-textfield__label" for="localidad">Localidad...</label>
      </div>
      <div class="mdl-textfield mdl-js-textfield">
        <input class="mdl-textfield__input" type="color" id="color" name="color" required="" placeholder="Elije un color..." value="#46B6AC">
        <label class="mdl-textfield__label" for="color">Elije un color...</label>
      </div>
  </div>
  <input name="id" type="hidden" value="" id="_id">
  <div class="mdl-dialog__actions">
    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" id="update">Actualizar</button>
    <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent cerrar2">Cerrar</button>
  </div>
 </form>
</dialog>
