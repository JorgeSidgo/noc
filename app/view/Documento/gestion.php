<div id="app">

    <modal-registrar id_form="frmRegistrar" id="modalRegistrar" url="?1=DocumentoController&2=registrar" titulo="Registrar Documento"
        :campos="campos_registro" tamanio="tiny"></modal-registrar>

    <modal-editar id_form="frmEditar" id="modalEditar" url="?1=DocumentoController&2=editar" titulo="Editar Documento"
        :campos="campos_editar" tamanio="tiny"></modal-editar>

    <modal-eliminar id_form="frmEliminar" id="modalEliminar" url="?1=DocumentoController&2=eliminar" titulo="Eliminar Documento"
        sub_titulo="¿Está seguro de querer eliminar este Documento?" :campos="campos_eliminar" tamanio="tiny"></modal-eliminar>

    <div class="ui grid">
        <div class="row">
            <div class="titulo">
                Documentos
            </div>
        </div>
        <div class="row title-bar">
            <div class="sixteen wide column">
                <button class="ui right floated positive labeled icon button" @click="modalRegistrar" id="btnModalRegistro">
                    <i class="plus icon"></i>
                    Agregar
                </button>
            </div>
        </div>
        <div class="row title-bar">
            <div class="sixteen wide column">
                <div class="ui divider"></div>
            </div>
        </div>
        <div class="row">
            <div class="sixteen wide column">
                <table id="dtDocumentos" class="ui selectable very compact celled table" style="width:100%; margin:auto;">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Tipo de Documento</th>
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

<script src="./res/tablas/tablaDocumentos.js"></script>
<script src="./res/js/modalRegistrar.js"></script>
<script src="./res/js/modalEditar.js"></script>
<script src="./res/js/modalEliminar.js"></script>

<script>
var app = new Vue({
        el: "#app",
        data: {
            campos_registro: [{
                    label: 'Tipo de Documento:',
                    name: 'nombre',
                    type: 'text'
                }
            ],
            campos_editar: [
                {
                    label: 'Tipo de Documento:',
                    name: 'nombre',
                    type: 'text'
                }],
            campos_eliminar: [{
                name: 'idEliminar',
                type: 'hidden'
            }]
        },
        methods: {
            refrescarTabla() {
                tablaDocumentos.ajax.reload();
            },
            modalRegistrar() {
                $('#modalRegistrar').modal('setting', 'autofocus', false).modal('setting', 'closable', false).modal(
                    'show');
            },
            cargarDatos() {
                var id = $("#idDetalle").val();

                fetch("?1=DocumentoController&2=cargarDatosDocumento&id=" + id)
                    .then(response => {
                        return response.json();
                    })
                    .then(dat => {

                        $('#frmEditar input[name="nombre"]').val(dat.nombre);
                        $('#frmEditar input[name="apellido"]').val(dat.apellido);
                        $('#frmEditar input[name="user"]').val(dat.nomDocumento);
                        $('#frmEditar input[name="correo"]').val(dat.email);
                        $('#frmEditar select[name="rol"]').dropdown('set selected', dat.codigoRol);
                    })
                    .catch(err => {
                        console.log(err);
                    });
            }
        }
    });
</script>

<script>
        $(document).on("click", ".btnEliminar", function () {
            $('#modalEliminar').modal('setting', 'closable', false).modal('show');
            $('#idEliminar').val($(this).attr("id"));
        });
        $(document).on("click", ".btnEditar", function () {
            $('#modalEditar').modal('setting', 'autofocus', false).modal('setting', 'closable', false).modal('show');
            $('#idDetalle').val($(this).attr("id"));
            app.cargarDatos();
        });

        $(document).on("click", ".btnAutorizar", function () {
            $('#modalAutorizar').modal('setting', 'autofocus', false).modal('setting', 'closable', false).modal('show');
            $('#idAutorizar').val($(this).attr("id"));
        });
</script>

     