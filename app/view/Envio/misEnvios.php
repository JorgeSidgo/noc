<div id="app">

    <modal-detalles :detalles="detalles"></modal-detalles>

    <div class="ui tiny second coupled modal" id="modalCambios">

        <div class="header">
            Actualizar Documento
        </div>
        <div class="content">
            <form v-on:submit.prevent action="" class="ui equal width form" id="frmAutorizar">
                <div class="field">
                    <label for="">Observación:</label>
                    <input v-model="cambiarDetalle.observacion" type="text" id="obs" name="obs">
                </div>
                <input type="hidden" id="idAutorizar" name="idAutorizar">
            </form>
        </div>

        <div class="actions">
            <button type="button" @click="cerrarCambios" class="ui black button">
                Cancelar
            </button>
            <button type="button" @click="cambiarEstado" id="btnCambiar" class="ui right green button">
                Actualizar
            </button>
        </div>
    </div>

    <div class="ui grid">
        <div class="row">
            <div class="titulo">
                <i class="envelope icon"></i>
                Mis Envíos<font color="#85BC22" size="20px">.</font>
            </div>
        </div>

        <div v-if="pendientes.length" class="row">
            <h3 style="width: 100%;" class="ui dividing header">
                Documentos Pendientes
            </h3>
        </div>

        <div v-if="pendientes.length" class="row">
            <div class="sixteen wide column">
                <table id="" class="ui selectable very compact celled table" style="width:100%; margin:auto;">
                    <thead>
                        <tr>
                            <th>Trámite</th>
                            <th>Cliente</th>
                            <th>Área</th>
                            <th>Tipo de Documento</th>
                            <th>N° Documento</th>
                            <th>Monto</th>
                            <th>Status</th>
                            <th>Observación</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="pendiente in pendientes">
                            <td>{{pendiente.descTipoTramite}}</td>
                            <td>{{pendiente.nombreCliente}}</td>
                            <td>{{pendiente.descArea}}</td>
                            <td>{{pendiente.descTipoDocumento}}</td>
                            <td>{{pendiente.numDoc}}</td>
                            <td>{{pendiente.monto}}</td>

                            <td v-if="pendiente.descStatus == 'Pendiente'" style="background-color: #F6AD43;">
                                {{pendiente.descStatus}}
                            </td>
                            <td v-else-if="pendiente.descStatus == 'Incompleto'" style="background-color: #F67943;">
                                {{pendiente.descStatus}}
                            </td>
                            <td v-else-if="pendiente.descStatus == 'Recibido'" style="background-color:lightblue;">
                                {{pendiente.descStatus}}
                            </td>
                            <td v-else-if="pendiente.descStatus == 'Completo'" style="background-color: lightgreen;">
                                {{pendiente.descStatus}}
                            </td>
                            <td v-else-if="pendiente.descStatus == 'Regresado a Finanzas'" style="background-color: rgba(149, 165, 166, 0.3);">
                                {{pendiente.descStatus}}
                            </td>

                            <td>{{pendiente.observacion}}</td>
                            <td>
                                <button @click="modalCambiar(pendiente.codigoDetalleEnvio, pendiente.codigoEnvio)" type="button" class="ui mini circular green icon button btnCambios">
                                    <i class="sync icon"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>








        <div class="row">
            <h3 style="width: 100%;" class="ui dividing header">
                Envios Realizados
            </h3>
        </div>

        <div class="row">
            <div class="sixteen wide column">
                <table id="dtPaquetes" class="ui selectable very compact celled table" style="width:100%; margin:auto;">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Documentos</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="./res/tablas/tablaMisEnvios.js"></script>
<script src="./res/js/modalMisDetalles.js"></script>

<script>
    var app = new Vue({
        el: '#app',
        data: {
            detalles: [],

            idEnvio: 0,

            datosDetalle: {
                tramite: '',
                cliente: '',
                area: '',
                tipoDoc: ''
            },

            cambiarDetalle: {
                idEnvio: 0,
                idDetalle: 0,
                idStatus: 1,
                observacion: ''
            },

            pendientes: []
        },
        methods: {
            cargarDetalles(id) {

                this.idEnvio = parseInt(id);

                $('#frmDetalles').addClass('loading');
                $.ajax({
                    type: 'POST',
                    url: '?1=EnvioController&2=getDetallesEnvioH',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        app.detalles = JSON.parse(data);
                        $('#frmDetalles').removeClass('loading');
                    }
                });
            },

            cargarPendientes() {
                $.ajax({
                    type: 'POST',
                    url: '?1=EnvioController&2=misDetallesPendientes',
                    success: function (data) {
                        app.pendientes = JSON.parse(data);
                    }
                });
            },

            reloadTabla() {
                tablaPaquetes.ajax.reload();
            },

            cerrarModal() {
                this.detalles = [];
            },

            modalCambiar(idDetalle, codigoEnvio) {

                this.cambiarDetalle.idEnvio = parseInt(codigoEnvio);
                this.cambiarDetalle.idDetalle = parseInt(idDetalle);

                $('#modalCambios').modal('setting', 'autofocus', false).modal('setting', 'closable', false)
                    .modal('show');
                $('#modalDetalles').modal('hide');
            },

            cerrarCambios() {
                $('#modalCambios').modal('hide');
            },

            cambiarEstado() {

                var detalle = JSON.stringify(this.cambiarDetalle);

                $.ajax({
                    type: 'POST',
                    url: '?1=EnvioController&2=actualizarDetalle',
                    data: {
                        detalle: detalle
                    },
                    success: function (r) {

                        console.log(r);
                        if (r == 1) {
                            swal({
                                title: null,
                                text: 'Los cambios fueron guardados',
                                type: 'success',
                                showConfirmButton: false,
                                timer: 1000
                            });
                            app.cambiarDetalle.observacion = '';
                            app.cargarDetalles(app.idEnvio);
                            app.cerrarCambios();
                            app.cargarPendientes();
                            app.reloadTabla();
                        }

                    }
                });

            }
        },
        mounted() {
            this.cargarPendientes();
        }
    });
</script>


<script>
    $(function () {
        $('.sixteen.wide.column').children().children().css('margin', '0');
    });
</script>

<script>
    $(function () {
        $(document).on("click", ".btnVer", function () {
            $('#modalDetalles').modal('setting', 'autofocus', false).modal('setting', 'closable', false)
                .modal('show');
            app.cargarDetalles($(this).attr('id'));
        });
    });
</script>
