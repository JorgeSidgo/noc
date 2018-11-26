<style>
    .contenedor {
        width: 92vw;
    }
</style>

<script>
$(function() {
    overflowRestore();
});
</script>

<script>
    var fecha;
    $(function() {
        fecha = new Date();
        fecha = fecha.getDate() + '/' + (fecha.getMonth() + 1) + '/' + fecha.getFullYear();

        $('#fecha-header').html('Fecha: ' + fecha);
    });
</script>

<div id="app">
    <div class="ui grid">
        <div class="row">
            <div class="titulo">
            <i class="paper plane icon"></i>
                Envíos Deloitte.
                <span style="float:right;">
                    <small>
                        <small id="fecha-header">Fecha</small>
                    </small>

                    <button @click="guardarEnvio" class="ui green mini icon button"><i class="check icon"></i></button>
                    <button @click="agregarDetalle" class="ui green mini icon button"><i class="plus icon"></i></button>
                </span>
            </div>
        </div>

        <div class="row">
            <div class="sixteen wide column">
                <form action="" class="ui form" id="frmEnvios">
                    <table class="ui green fixed very compact table">
                        <thead class="super-compact">
                            <tr>
                                <th class="two wide">Trámite</th>
                                <th class="four wide">Cliente</th>
                                <th class="two wide">Área</th>
                                <th class="two wide">Tipo Doc</th>
                                <th class="one wide">N° Doc</th>
                                <th class="one wide">Monto</th>
                                <th class="three wide">Observaciones</th>
                                <th class="one wide"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(envio, index) in envios">
                                <td>
                                    <div class="ui mini input">
                                    <select class="" v-model="envio.tramite">
                                        <option value="1">Entrega</option>
                                        <option value="2">Remesa</option>
                                        <option value="3">Pago</option>
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
                                    <select  v-model="envio.area" id="area" name="area">
                                        <option v-for="option in areaOps" :value="option.codigoArea">{{option.descArea}}</option>
                                    </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="ui mini input">
                                    <select v-model="envio.tipoDocumento" id="documentos" name="documentos">
                                        <option v-for="option in tipoDocumentoOps" :value="option.codigoTipoDocumento" >{{option.descTipoDocumento}}</option>
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
                                    <input class="requerido" v-model="envio.monto" type="text">
                                    </div>
                                </td>
                                <td>
                                    <div class="ui mini input">
                                    <input class="requerido" v-model="envio.observaciones" type="text">
                                    </div>
                                </td>
                                <td>
                                    <button type="button" @click="eliminarDetalle(index)" class="ui google plus mini circular icon button"><i
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
                tramite: '',
                cliente: '',
                area: '',
                tipoDocumento: '',
                numDocumento: '',
                monto: '$ ',
                observaciones: ''
            }],
            clientesOps: <?php echo $clientes?>,
            
            areaOps: <?php echo $areas?>,

            tipoDocumentoOps: <?php echo $documentos?>

        },
        methods: {
            guardarEnvio() {
                console.log(fecha);
                console.log(JSON.stringify(this.envios));
            },
            agregarDetalle() {
                this.envios.push({
                    tramite: '',
                    cliente: '',
                    area: '',
                    tipoDocumento: '',
                    numDocumento: '',
                    monto: '$ ',
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
        },
        updated() {
            $('.ui.dropdown').dropdown();
            $('.ui.dropdown.selection').css('max-width', '100%');
            $('.ui.dropdown.selection').css('min-width', '100%');
            $('.ui.dropdown.selection').css('width', '100%');
        }
    });
</script>
