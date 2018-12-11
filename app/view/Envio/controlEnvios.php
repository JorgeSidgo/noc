<div id="app">

        <div id="cargando" class="ui dimmer">
                <div class="ui big loader"></div>
        </div>

    <modal-detalles :detalles="detalles"></modal-detalles>

    <div class="ui tiny modal" id="modalConfirmar">

        <div class="header">
            Confirmar Correo
        </div>
        <div class="content">
            <h4>¿Desea enviar el correo con la revisión de este paquete?</h4>
        </div>
        <div class="actions">
            <button class="ui black deny button">
                Cancelar
            </button>
            <button class="ui right teal button" id="btnConfirmar" @click="correoPaquete">
                Aceptar
            </button>
        </div>
    </div>


    <div class="ui small second coupled modal" id="modalCambios">

        <div class="header">
            Cambiar Estado
        </div>
        <div class="content">

            <div style="margin-bottom: 0em !important; width: 100% !important;" class="ui tiny fluid horizontal divided list">

                <div class="item">
                    <i class="tag icon"></i>
                    <div class="content">
                        {{datosDetalle.correlativo}}
                    </div>
                </div>
                <div class="item">
                    <i class="exchange icon"></i>
                    <div class="content">
                        {{datosDetalle.tramite}}
                    </div>
                </div>
                <div class="item">
                    <i class="building icon"></i>
                    <div class="content">
                        {{datosDetalle.cliente}}
                    </div>
                </div>
                <div class="item">
                    <i class="industry icon"></i>
                    <div class="content">
                        {{datosDetalle.area}}
                    </div>
                </div>
                <div class="item">
                    <i class="copy icon"></i>
                    <div class="content">
                        {{datosDetalle.tipoDoc}}
                    </div>
                </div>

            </div>
            <div class="ui divider"></div>
            <form action="" class="ui equal width form" id="frmAutorizar">
                <div class="field">
                    <label for="">Estado:</label>
                    <select v-model="cambiarDetalle.idStatus" class="ui dropdown" name="idEstado" id="idEstado">
                        <option value="1">Pendiente</option>
                        <option value="2">Incompleto</option>
                        <option value="3">Recibido</option>
                        <option value="4">Completo</option>
                        <option value="5">Regresado a finanzas</option>
                    </select>
                </div>
                <div class="field">
                    <label for="">Observación:</label>
                    <input v-model="cambiarDetalle.observacion" type="text" id="obs" name="obs">
                </div>
                <input type="hidden" id="idAutorizar" name="idAutorizar">
            </form>
        </div>

        <div class="actions">
            <button @click="cerrarCambios" class="ui black button">
                Cancelar
            </button>
            <button @click="cambiarEstado" id="btnCambiar" class="ui right primary button">
                Cambiar Estado
            </button>
        </div>
    </div>

    <div class="ui grid">
        <div class="row">
            <div class="titulo">
                <i class="box icon"></i>
                Control de Envíos<font color="#85BC22" size="20px">.</font>
            </div>
        </div>
        <br><br><br>


        <div class="row">
            <div class="sixteen wide column">
                <table id="dtPaquetes" class="ui selectable very compact celled table" style="width:100%; margin:auto;">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Correlativo</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Usuario</th>
                            <th>Nombre</th>
                            <th>Documentos</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

        <div v-if="paquetesManana > 0" class="row">
            <h3 style="width: 100%;" class="ui dividing header">
                Paquetes agendados para mañana
            </h3>
        </div>

        <div v-if="paquetesManana > 0" class="row">
            <div class="sixteen wide column">
                <table id="dtManana" class="ui selectable very compact celled table" style="width:100%; margin:auto;">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Correlativo</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Usuario</th>
                            <th>Nombre</th>
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
<script src="./res/tablas/tablaPaquetes.js"></script>
<script src="./res/tablas/tablaManana.js"></script>
<script src="./res/js/modalDetalles.js"></script>

<script>
    var app = new Vue({
        el: '#app',
        data: {
            detalles: [],

            idEnvio: 0,

            paquetesManana: <?php echo $numPaquetesManana?>,

            datosDetalle: {
                correlativo: '',
                tramite: '',
                cliente: '',
                area: '',
                tipoDoc: ''
            },

            datosCorreo: {
                idEnvio: 0,
                idUsuario: 0
            },

            cambiarDetalle: {
                idEnvio: 0,
                idDetalle: 0,
                idStatus: 2,
                observacion: ''
            }
        },
        methods: {
            cargarDetalles(id) {

                this.idEnvio = parseInt(id);
                this.cambiarDetalle.idEnvio = parseInt(id);

                $('#frmDetalles').addClass('loading');
                $.ajax({
                    type: 'POST',
                    url: '?1=EnvioController&2=getDetallesEnvio',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        app.detalles = JSON.parse(data);
                        $('#frmDetalles').removeClass('loading');
                    }
                });
            },

            reloadTabla() {
                tablaPaquetes.ajax.reload();
            },

            reloadTabla2() {
                tablaManana.ajax.reload();
            },
            cerrarModal() {
                this.detalles = [];
            },

            modalCambiar(idDetalle, correlativo, tramite, cliente, area, tipoDoc, estado, obs) {

                // this.cambiarDetalle.idEnvio = idEnvio;

                this.datosDetalle.correlativo = correlativo;
                this.datosDetalle.tramite = tramite;
                this.datosDetalle.cliente = cliente;
                this.datosDetalle.area = area;
                this.datosDetalle.tipoDoc = tipoDoc;
                this.cambiarDetalle.observacion = obs;

                this.cambiarDetalle.idDetalle = parseInt(idDetalle);

                $("#idEstado option:contains(" + estado + ")").attr('selected', 'selected');


                $('#modalCambios').modal('setting', 'autofocus', false).modal('setting', 'closable', false)
                    .modal('show');
                $('#modalDetalles').modal('hide');
            },

            cerrarCambios() {
                $('#modalDetalles').modal('setting', 'autofocus', false).modal('setting', 'closable', false)
                    .modal('show');
                $('#modalCambios').modal('hide');
            },

            numeroPaquetesManana() {

                $.ajax({
                    type: 'POST',
                    url: '?1=EnvioController&2=numeroPaquetesManana',
                    success: function(r) {
                        app.paquetesManana = parseInt(r);
                    }
                });

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

                            app.cargarDetalles(app.idEnvio);
                            app.cerrarCambios();
                            app.reloadTabla();
                        }

                    }
                });

            },

            modalConfirmar(idUsuario, idEnvio) {

                this.datosCorreo.idUsuario = parseInt(idUsuario);
                this.datosCorreo.idEnvio = parseInt(idEnvio);

                $('#modalConfirmar').modal('show');
            },

            correoPaquete() {
                $('#modalConfirmar').modal('hide');
                $('#cargando').addClass('active');

                $.ajax({
                    type: 'POST',
                    url: '?1=EnvioController&2=revisionPaquete',
                    data: {
                        idUsuario: app.datosCorreo.idUsuario,
                        idEnvio: app.datosCorreo.idEnvio
                    },
                    success: function (r) {

                        if (r == 1) {
                            swal({
                                title: null,
                                text: 'El correo fué enviado',
                                type: 'success',
                                showConfirmButton: false,
                                timer: 1000
                            });
                        } else {
                            swal({
                                title: null,
                                text: 'Error al enviar el correo',
                                type: 'error',
                                showConfirmButton: false,
                                timer: 1000
                            });
                        }
                        app.reloadTabla();

                        $('#cargando').removeClass('active');
                    }
                });

            }


        },
        
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
        $(document).on("click", ".btnCorreo", function () {
            app.modalConfirmar($(this).attr('codigo-usuario'), $(this).attr('codigo-envio'));
        });
    });
</script>
