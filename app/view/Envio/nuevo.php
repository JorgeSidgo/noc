<script src="./res/plugins/v-money.js"></script>

<style>
    .contenedor {
        width: 92vw;
    }
</style>
<?php
 $_SESSION['rol']=0;
if($_SESSION["descRol"]=="Administrador") {?>
<script>
    $(function() {
    overflowRestore();
});


 $(document).ready(function(){

    
    $('#modalEleccion').modal('setting', 'autofocus', false).modal('setting', 'closable', false).modal('show');

    });

    $(function() {
            var option = '';
            var usuarios = '<?php echo $usuariosCMB?>';

            $.each(JSON.parse(usuarios), function() {
                option = `<option value="${this.codigoUsuario}">${this.nombre} ${this.apellido}</option>`;

                $('#usuario').append(option);
            });
        });


      $(function ()
      {

        var select = document.getElementById('usuario');
        select.addEventListener('change',
            function(){
            var selectedOption = this.options[select.selectedIndex];
            var nombre=selectedOption.text;
            $("#nombreActual").html(nombre);
            });

      });  
</script>
<?php }?>

<script>
    var fecha;
    $(function() {
        fecha = new Date();
        fecha = fecha.getDate() + '/' + (fecha.getMonth() + 1) + '/' + fecha.getFullYear();

        $('#fecha-header').html('Fecha: ' + fecha);
    });
</script>
<div class="ui tiny modal" id="modalEleccion">

<div class="header">
<i class="paper plane icon"></i>Envío Deloitte<font color="#85BC22" size="20px">.</font>
</div>
<div class="content">
         <form class="ui form" id="frmEnvio">
    <div class="field">
            <label for="">A nombre de: </label>

            <!--select de usuario-->
            <select name="usuario" id="usuario" class="ui search dropdown">
            </select></div>
            </form>
    </div>
<div class="actions">
    <button class="ui blue right button" id="btnSeleccionarUsuario">
        Seleccionar Usuario
    </button>
</div>
</div>
<div id="app">
    <div class="ui grid">
        <div class="row">
            <div class="titulo">
                <i class="paper plane icon"></i>
                Envíos Deloitte<font color="#85BC22" size="20px">.</font>
                <?php
                if($_SESSION["descRol"]=="Administrador") {?>
                <center>A nombre de: <font color="#85BC22"><span id="nombreActual"></span></font></center>

                <?php }?>
                <span style="float:right;">
                    <small>
                        <small id="fecha-header">Fecha</small>
                    </small>

                    <button @click.once="guardarEnvio" class="ui green-deloitte mini circular icon button"><i class="check icon"></i></button>
                    <button @click="agregarDetalle" class="ui primary mini circular icon button"><i class="plus icon"></i></button>
                </span>
            </div>
        </div>

        <div class="row ">
            <div class="sixteen wide column">
                <form action="" class="ui form" id="frmEnvios">
                    <table class="ui green fixed very compact table">
                        <thead class="super-compact">
                            <tr>
                                <th class="two wide">Trámite</th>
                                <th class="three wide">Cliente</th>
                                <th class="two wide">Área</th>
                                <th class="two wide">Tipo Doc</th>
                                <th class="one wide">N° Doc</th>
                                <th class="two wide">Monto</th>
                                <th class="three wide">Observaciones</th>
                                <th class="one wide"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(envio, index) in envios">
                                <td>
                                    <div class="ui mini input">
                                        <select class="requerido" v-model="envio.tramite">
                                            <option value="1">Entrega</option>
                                            <option value="2">Cobro</option>
                                            <option value="3">Transferencia</option>
                                            <option value="4">Depósito</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="ui mini input">
                                        <select v-model="envio.cliente" id="clientes" name="clientes">
                                            <option v-for="option in clientesOps" :value="option.codigoCliente">{{option.nombreCliente}}</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="ui mini input">
                                        <select v-model="envio.area" id="area" name="area">
                                            <option v-for="option in areaOps" :value="option.codigoArea">{{option.descArea}}</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="ui mini input">
                                        <select v-model="envio.tipoDocumento" id="documentos" name="documentos">
                                            <option v-for="option in tipoDocumentoOps" :value="option.codigoTipoDocumento">{{option.descTipoDocumento}}</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="ui mini input">
                                        <input class="requerido" v-model="envio.numDocumento" type="text">
                                    </div>
                                </td>
                                <td>
                                    <div class="ui mini input">
                                        <!-- <input class="requerido" mask="dinero" v-model="envio.monto" type="text"> -->
                                        <money v-model="envio.monto" v-bind="money" class="requerido"></money>
                                    </div>
                                </td>
                                <td>
                                    <div class="ui mini input">
                                        <input class="requerido" v-model="envio.observaciones" type="text">
                                    </div>
                                </td>
                                <td>
                                    <button type="button" @click="eliminarDetalle(index)" class="ui negative mini circular icon button"><i
                                            class="times icon"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    var app = new Vue({
        el: '#app',
        data: {
            envios: [{
                tramite: '1',
                cliente: '1',
                area: '1',
                tipoDocumento: '1',
                numDocumento: '',
                monto: '',
                observaciones: ''
            }],
            clientesOps: <?php echo $clientes?>,

            areaOps: <?php echo $areas?>,

            tipoDocumentoOps: <?php echo $documentos?>,

            money: {
                decimal: '.',
                thousands: ',',
                prefix: '$ ',
                suffix: '',
                precision: 2,
                masked: true
            }

        },
        methods: {
            guardarEnvio() {

                if (this.envios.length) {

                    $('#frmEnvios').addClass('loading');
                    $.ajax({
                        type: 'POST',
                        data: {
                            detalles: JSON.stringify(this.envios)
                        },
                        url: '?1=EnvioController&2=registrarEnvio',
                        success: function (r) {
                            $('#frmEnvios').removeClass('loading');
                            if (r == 1) {
                                swal({
                                    title: 'Completado',
                                    type: 'success'
                                }).then((result) => {
                                    if (result.value) {
                                        app.envios = [{
                                            tramite: '1',
                                            cliente: '1',
                                            area: '1',
                                            tipoDocumento: '1',
                                            numDocumento: '',
                                            monto: '',
                                            observaciones: ''
                                        }]
                                    }
                                });
                            }
                        }
                    });
                }

            },
            agregarDetalle() {
                this.envios.push({
                    tramite: '1',
                    cliente: '1',
                    area: '1',
                    tipoDocumento: '1',
                    numDocumento: '',
                    monto: '',
                    observaciones: ''
                });
            },
            eliminarDetalle(index) {
                this.envios.splice(index, 1);
            }
        },
        mounted() {
            $('.ui.dropdown').dropdown();
            $('.ui.dropdown.selection').css('max-width', '100%');
            $('.ui.dropdown.selection').css('min-width', '100%');
            $('.ui.dropdown.selection').css('width', '100%');
            $('input[mask="dinero"]').mask('$0');
        },
        updated() {
            $('.ui.dropdown').dropdown();
            $('.ui.dropdown.selection').css('max-width', '100%');
            $('.ui.dropdown.selection').css('min-width', '100%');
            $('.ui.dropdown.selection').css('width', '100%');
            $('input[mask="dinero"]').mask('$0');
        }
    });
</script>

<script>
        $("#btnSeleccionarUsuario").click(function(){

            var datos=$("#usuario").val();
            var rol=1
            $.ajax({
                    type: 'POST',
                    url: '?1=EnvioController&2=setCodigo',
                    data:{datos,rol},
                    success: function(r) {
                        
                        $('#modalEleccion').modal('hide');;
                        
                    }
                    });           
        });
</script>