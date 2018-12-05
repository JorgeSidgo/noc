<div id="app">

    <modal-detalles :detalles="detalles"></modal-detalles>

    <div class="ui small second coupled modal" id="modalCambios">

        <div class="header">
            Cambiar Estado
        </div>
        <div class="content">

            <div style="margin-bottom: 0em !important; width: 100% !important;" class="ui tiny fluid horizontal divided list">

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
                        <option value="2">Revisado</option>
                        <option value="3">Completo</option>
                        <option value="4">En finanzas</option>
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
<script src="./res/js/modalDetalles.js"></script>

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
                idDetalle: 0,
                idStatus: 2,
                observacion: ''
            }
        },
        methods: {
            cargarDetalles(id) {

                this.idEnvio = parseInt(id);

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

            cerrarModal() {
                this.detalles = [];
            },

            modalCambiar(idDetalle, tramite, cliente, area, tipoDoc, estado, obs) {

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

            correoPaquete(idUsuario, idEnvio) {
                $('body').dimmer('show');
                
                // alert('envio: ' + idEnvio + ' user: ' +idUsuario);

                $.ajax({
                    type: 'POST',
                    url: '?1=EnvioController&2=revisionPaquete',
                    data: {
                        idUsuario: idUsuario,
                        idEnvio: idEnvio
                    },
                    success: function(r) {

                        if(r==1) {
                            swal({
                                title: null,
                                text: 'El correo fué enviado',
                                type: 'success',
                                showConfirmButton: false,
                                timer: 1000
                            });
                                            $('body').dimmer('hide');
                        } else {
                            swal({
                                title: null,
                                text: 'Error al enviar el correo',
                                type: 'error',
                                showConfirmButton: false,
                                timer: 1000
                            });
                            $('body').dimmer('hide');
                        }
                        app.reloadTabla();
                    }
                }); 

            }

            
        },
        computed: {

        }
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
            app.correoPaquete($(this).attr('codigo-usuario'), $(this).attr('codigo-envio'));
        });
    });
</script>