<div id="app">

    <modal-detalles :detalles="detalles"></modal-detalles>

    <div class="ui tiny second coupled modal" id="modalCambios">

        <div class="header">
            Cambiar Estado
        </div>
        <div class="content">
            <form action="" class="ui equal width form" id="frmAutorizar">
                    <div class="field">
                        <label for="">Estado:</label>
                        <select class="ui dropdown" name="idEstado" id="idEstado">
                            <option value="2">Revisado</option>
                            <option value="3">Completo</option>
                            <option value="4">En finanzas</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="">Observación:</label>
                        <input type="text" id="obs" name="obs">
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
                            <th>Acciones</th>
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
            detalles: []
        },
        methods: {
            cargarDetalles(id) {

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

            cerrarModal() {
                this.detalles = [];
            },

            modalCambiar() {
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
                this.cerrarCambios();
            }
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
    });
</script>