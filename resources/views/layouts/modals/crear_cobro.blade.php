<dialog id="dialog" class="mdl-dialog">
  <h3 class="mdl-dialog__title">MDL Dialog</h3>
  <div class="mdl-dialog__content">
    <p>
      This is an example of the Material Design Lite dialog component.
      Please use responsibly.
    </p>
  </div>
  <div class="mdl-dialog__actions">
    <button type="button" class="mdl-button">Close</button>
    <button type="button" class="mdl-button" disabled>Disabled action</button>
  </div>
</dialog>

<script>
  (function() {
    'use strict';
    var dialogButton = document.querySelector('.dialog-button');
    var dialog = document.querySelector('#dialog');
    if (! dialog.showModal) {
      dialogPolyfill.registerDialog(dialog);
    }
    dialogButton.addEventListener('click', function() {
       dialog.showModal();
    });
    dialog.querySelector('button:not([disabled])')
    .addEventListener('click', function() {
      dialog.close();
    });
  }());
</script>