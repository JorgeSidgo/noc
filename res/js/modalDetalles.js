Vue.component('modal-detalles', {

    props: {
        detalles: {
            type: Array,
            required: false
        }
    },


    template: `<div class="ui longer fullscreen first coupled modal" id="modalDetalles">
                    <div class="header">
                        Documentos del Paquete
                    </div>

                    <div class="scrolling content">
                    <form action="" class="ui form" id="frmDetalles">
                        <table v-if="detalles" class="ui selectable very compact single line table">
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
                            <tr v-for="detalle in detalles" :codigo-detalle="detalle.codigoDetalleEnvio">
                                <td>{{detalle.descTipoTramite}}</td>
                                <td>{{detalle.nombreCliente}}</td>
                                <td>{{detalle.descArea}}</td>
                                <td>{{detalle.descTipoDocumento}}</td>
                                <td>{{detalle.numDoc}}</td>
                                <td>{{detalle.monto}}</td>
                                <td>
                                    {{detalle.descStatus}}
                                </td>
                                <td>
                                    {{detalle.observacion}}
                                </td>
                                <td>
                                    <button @click="$parent.modalCambiar" type="button" class="ui mini circular primary icon button btnCambios">
                                        <i class="edit icon"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                        </table>
                        </form>
                    </div>
                    <div class="actions">
                        <button @click="$parent.cerrarModal" class="ui deny button">
                            Cancelar
                        </button>
                        <button id="btnDetalles" class="ui right black button">
                            Aceptar
                        </button>
                    </div>
                </div>`

});