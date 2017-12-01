<script>
  $(function() {

    cargar_cobros();

    dialog = document.querySelector('#dialog_crear_cobro');
    dialog2 = document.querySelector('#dialog_update_cobro');

    $('.btn_crear_cobro').click(function(event)
    {
      dialog.showModal();
    });

    $('.cerrar').click(function(event)
    {
      dialog.close();
    });

    $('.cerrar2').click(function(event)
    {
      dialog2.close();
    });

    $("#save_cobro").submit(function(e) {
      $(".load").show();
      $("#save").hide();
      var form = $(e.target);
      var datos = $("#save_cobro").serialize();
      $.ajax(
        {
          type: "POST",
          url: "{{ route('cobro.store') }}",//form.attr("action"),
          data:datos,
          success: function (data)
          {
            $(".load").hide();
            $("#save").show();
            dialog.close();
            mensaje(data);
            cargar_cobros();
            $("#save_cobro")[0].reset();
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

  function cargar_cobros(){
    $(".load").show();
    $.getJSON( "{{ route('cobro.index') }}", function( data ) {
       if(data.length==0){
         var html = '<h2 style="font-weight: 200;">No tienes prestamos creados :(<h2>';
       }else{
           var html = '';
           $.each(data, function(i, record) {
               var estado = record.estado;
               if(estado==1){color='bolita_verde';btn='<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="{{ url("/dashboard")}}/'+record.id+'"> <span> <div class="'+color+'"></div></span> Entrar</a>'}else{color='bolita_roja';btn='<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="#"> <span> <div class="'+color+'"></div></span> Entrar</a>'}
               html += '<div class="mdl-cell mdl-cell--2-col-phone mdl-cell--4-col-tablet mdl-cell--4-col-desktop">'+
                         '<div class="mdl-layout__tab-panel is-active" id="overview">'+
                           '<div class="demo-card-square mdl-card mdl-shadow--2dp">'+
                              '<div class="mdl-card__title mdl-card--expand" style="background: url({{ asset("img/icono.png") }}) no-repeat '+record.color+';background-position: 101% 17%;">'+
                             	    '<h2 class="mdl-card__title-text">'+record.nombre+'</h2>'+
                             	'</div>'+
                              '<div class="mdl-card__actions mdl-card--border">'+
                              '<button class="mdl-button mdl-js-buttont" style="color:'+record.color+';min-width:0px;"><i class="material-icons" onclick="borrar('+record.id+')" >delete_forever</i></button>'+
                              '<button class="mdl-button mdl-js-buttont" style="color:'+record.color+';min-width:0px;"><i class="material-icons" onclick="editar('+record.id+')" >mode_edit</i></button>'+
                              btn+
                             	'</div>'+
                            '</div>'+
                         	'</div>'+
                        '</div>';
           });
         }
       $('#cobros').html(html);
       $(".load").hide();
    });
  }

  function borrar(id){
    $(".load").show();
    $.confirm({
        title: 'Confirmar!',
        content: 'Estas seguro de borrar este Cobro!',
        buttons: {
            Cancelar: function () {
              $(".load").hide();
            },
            Borrar: function () {
              $.ajax({
                method: "POST",
                url: "{{ url('cobro') }}/"+id,
                data: { _token: "{{ csrf_token() }}",_method: "DELETE" }
              }).done(function( data ) {
                $(".load").hide();
                mensaje(data);
                cargar_cobros();
              });
            }
        }
    });
  }

  function editar(id){
    $(".load").show();
    $.getJSON( "{{ url('cobro') }}/"+id, function( data ) {
      $('#nombre').val(data.nombre);
      $('#localidad').val(data.localidad);
      $('#color').val(data.color);
      $('#_id').val(data.id);
      $(".load").hide();
    });
    dialog2.showModal();
  }

  $("#update_cobro").submit(function(e) {
    $(".load").show();
    $("#update").hide();
    var id=$('#_id').val();
    var form = $(e.target);
    var datos = $("#update_cobro").serialize();
    $.ajax(
      {
        type: "POST",
        url: "{{ url('cobro') }}/"+id,//form.attr("action"),
        data:datos,
        success: function (data)
        {
          $(".load").hide();
          $("#update").show();
          dialog2.close();
          mensaje(data);
          cargar_cobros();
        },
        error: function(jqXHR, text, error)
        {
          mensaje(data);
        }
      }
    );
    return false;
  });
</script>
