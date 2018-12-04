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
                            <th class="two wide">Trámite</th>
                            <th class="three wide">Cliente</th>
                            <th class="two wide">Área</th>
                            <th class="two wide">Tipo Doc</th>
                            <th class="one wide">N° Doc</th>
                            <th class="one wide">Monto</th>
                            <th class="two wide">Status</th>
                            <th class="three wide">Observaciones</th>
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
                                <td v-if="detalle.descStatus == 'Pendiente'" style="background-color: #F6AD43;">
                                    {{detalle.descStatus}}
                                </td>
                                <td v-else-if="detalle.descStatus == 'Revisado'" style="background-color: #F67943;">
                                    {{detalle.descStatus}}
                                </td>
                                <td v-else-if="detalle.descStatus == 'Completo'" style="background-color: lightgreen;">
                                    {{detalle.descStatus}}
                                </td>
                                <td v-else-if="detalle.descStatus == 'Regresado a Finanzas'" style="background-color: lightblue;">
                                    {{detalle.descStatus}}
                                </td>
                                <td>
                                    {{detalle.observacion}}
                                </td>
                                <!-- <button @click="$parent.modalCambiar(detalle.codigoDetalleEnvio, detalle.descTipoTramite, detalle.nombreCliente, detalle.descArea, detalle.descTipoDocumento, detalle.descStatus, detalle.observacion)" type="button" class="ui mini circular green icon button btnCambios">
                                    <i class="sync icon"></i>
                                </button> -->
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
        <div class="actions">
            <button @click="$parent.cerrarModal" class="ui deny black button">
                Cerrar
            </button>
        </div>
    </div>`
    
    });