<div id="app">

    <modal-registrar id_form="frmRegistrar" id="modalRegistrar" url="?1=ClienteController&2=registrar" titulo="Registrar Cliente"
        :campos="campos_registro" tamanio='tiny'></modal-registrar>

    <modal-editar id_form="frmEditar" id="modalEditar" url="?1=ClienteController&2=editar" titulo="Editar Cliente"
        :campos="campos_editar" tamanio='tiny'></modal-editar>

    <modal-eliminar id_form="frmEliminar" id="modalEliminar" url="?1=ClienteController&2=eliminar" titulo="Eliminar Cliente"
        sub_titulo="¿Está seguro de querer eliminar este Cliente?" :campos="campos_eliminar" tamanio='tiny'></modal-eliminar>

  
    




    <div class="ui grid">
        <div class="row">
            <div class="titulo">
                Clientes
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
                <table id="dtClientes" class="ui selectable very compact celled table" style="width:100%; margin:auto;">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nombre</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
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

<script src="./res/tablas/tablaClientes.js"></script>
<script src="./res/js/modalRegistrar.js"></script>
<script src="./res/js/modalEditar.js"></script>
<script src="./res/js/modalEliminar.js"></script>

<script>
var app = new Vue({
        el: "#app",
        data: {
            campos_registro: [{
                    label: 'Nombre:',
                    name: 'nombreCliente',
                    type: 'text'
                },
                {
                    label: 'Dirección:',
                    name: 'direccion',
                    type: 'text'
                },
                {
                    label: 'Teléfono',
                    name: 'telefono',
                    mask: 'telefono',
                    type: 'text'
                }
            ],
            campos_editar: [
                {
                    label: 'Nombre:',
                    name: 'nombreCliente',
                    type: 'text'
                },
                {
                    label: 'Dirección:',
                    name: 'direccion',
                    type: 'text'
                },
                {
                    label: 'Teléfono',
                    name: 'telefono',
                    mask: 'telefono',
                    type: 'text'
                },
                {
                    name: 'idDetalle',
                    type: 'hidden'
                }
            ],
            campos_eliminar: [{
                name: 'idEliminar',
                type: 'hidden'
            }]
        },
        methods: {
            refrescarTabla() {
                tablaClientes.ajax.reload();
            },
            modalRegistrar() {
                $('#modalRegistrar').modal('setting', 'autofocus', false).modal('setting', 'closable', false).modal(
                    'show');
            },
            cargarDatos() {
                var id = $("#idDetalle").val();

                fetch("?1=ClienteController&2=cargarDatosCliente&id=" + id)
                    .then(response => {
                        return response.json();
                    })
                    .then(dat => {

                        console.log(dat);

                        $('#frmEditar input[name="nombreCliente"]').val(dat.nombreCliente);
                        $('#frmEditar input[name="direccion"]').val(dat.direccion);
                        $('#frmEditar input[name="telefono"]').val(dat.telefono);
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

</script>
