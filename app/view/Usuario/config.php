

<script>
    $(document).ready(function() {
        // $('#nomUser').val(<?php echo "'".$_SESSION['nomUsuario']."'"; ?>);
        // $('#nom').val(<?php echo "'".$_SESSION['nombre']."'"; ?>);
        // $('#ape').val(<?php echo "'".$_SESSION['apellido']."'"; ?>);

    });
</script>

<!-- <input type="hidden" id="idUser" name="idUser" value=<?php echo '"'.$_SESSION['idUsuario'].'"'; ?> -->

<!-- modal de registro -->
<div class="ui tiny modal" id="modalCambiarNomUser">

    <div class="header">
        Cambiar nombre de usuario
    </div>
    <div class="content">
        <form class="ui form" id="frmCambiarNomUser">
            <div class="field">
                <label for="">Nombre de Usuario:</label>
                <input class="reqRegistrar" type="text" name="nomUser" id="nomUser">
                <div class="ui red pointing label" style="display: none;">
                </div>
            </div>
        </form>
    </div>
    <div class="actions">
        <div class="ui black deny button" id="btnCancelarRegistrar">
            Cancelar
        </div>
        <div class="ui blue right button" id="btnGuardarNomUser">
            Guardar Cambios
        </div>
    </div>
</div>


<!-- modal de registro -->
<div class="ui tiny modal" id="modalCambiarNom">

    <div class="header">
        Cambiar Nombre y Apellido
    </div>
    <div class="content">
        <form class="ui form" id="frmCambiarNom">
            <div class="two fields">
                <div class="field">
                    <label for="">Nombres:</label>
                    <input class="reqRegistrar" type="text" name="nom" id="nom">
                    <div class="ui red pointing label" style="display: none;">
                    </div>
                </div>
                <div class="field">
                    <label for="">Apellidos:</label>
                    <input class="reqRegistrar" type="text" name="ape" id="ape">
                    <div class="ui red pointing label" style="display: none;">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="actions">
        <div class="ui black deny button" id="btnCancelarRegistrar">
            Cancelar
        </div>
        <div class="ui blue right button" id="btnGuardarNom">
            Guardar Cambios
        </div>
    </div>
</div>

<!-- modal de registro -->
<div class="ui tiny modal" id="modalCambiarContra">

    <div class="header">
        Cambiar Contraseña
    </div>
    <div class="content">
        <form class="ui form" id="frmCambiarContra">
            <div class="field">
                <label for="">Contraseña Actual:</label>
                <input class="reqRegistrar" type="text" name="antPass" id="antPass">
                <div class="ui red pointing label" style="display: none;">
                </div>
            </div>
            <div class="field">
                <label for="">Nueva Contraseña:</label>
                <input class="reqRegistrar" type="text" name="nuPass" id="nuPass">
                <div class="ui red pointing label" style="display: none;">
                </div>
            </div>
        </form>
    </div>
    <div class="actions">
        <div class="ui black deny button" id="btnCancelarRegistrar">
            Cancelar
        </div>
        <div class="ui blue right button" id="btnGuardarContra">
            Guardar Cambios
        </div>
    </div>
</div>

<!-- modal de registro -->
<div class="ui tiny modal" id="modalEliminarCuenta">

    <div class="header">
        Eliminar Cuenta
    </div>
    <div class="content">
        <form class="ui form" id="frmEliminarCuenta">
            <div class="field">
                <label for="">Ingrese su <code style="padding: 0px 3px; background: rgba(255, 0, 0, .1); color: rgba(255, 0, 0, 0.8); border-radius: 2px;">contraseña</code> para confirmar:</label>
                <input class="reqRegistrar" type="text" name="antPass" id="antPass">
                <div class="ui red pointing label" style="display: none;">
                </div>
            </div>
        </form>
    </div>
    <div class="actions">
        <div class="ui black deny button" id="btnCancelarEliminar">
            Cancelar
        </div>
        <div class="ui red right button" id="btnConfEliminarCuenta">
            Eliminar Cuenta
        </div>
    </div>
</div>


<div class="pusher">
    <div class="contenedor">
        <div class="ui grid">
            <div class="row">
                <div class="sixteen wide column">
                    <div class="barra-titulo">
                        <p class="texto-barra-titulo">
                            Configuración
                        </p>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="eight wide column">
                    <h3 class="ui header">Nombre de Usuario</h3>
                    <?php echo '<p class="user-info">'.$_SESSION['nomUsuario'].'</p>' ?>
                    <div class="ui divider"></div>
                    <h3 class="ui header">Nombre Completo</h3>
                    <?php echo '<p class="user-info">'.$_SESSION['nombre'].' '.$_SESSION['apellido'].'</p>' ?>
                    <div class="ui divider"></div>
                    <h3 class="ui header">Permisos de la cuenta</h3>
                    <?php echo '<p class="user-info">'.$_SESSION['descRol'].'</p>' ?>
                </div>

                 <div class="four wide column right floated">
                    <div class="ui list">
                        <div class="item">
                            <button class="ui right floated fluid button" id="btnCambiarNomUser" type="button">Cambiar Nombre de Usuario</button>
                        </div>
                        <div class="item">
                            <button class="ui right floated fluid button" id="btnCambiarNom" type="button">Cambiar Nombre y Apellido</button>
                        </div>
                        <div class="item">
                            <button class="ui right floated fluid button" id="btnCambiarContra" type="button">Cambiar Contraseña</button>
                        </div>
                        <div class="item">
                            <button class="ui right floated fluid red button" id="btnEliminarCuenta" type="button">Eliminar Cuenta</button>
                        </div>
                    </div>
                </div>

            </div>

            <!-- <div class="row">
                <div class="ten wide column">
                    <form id="frmConf" class="ui form">
                        <div class="two fields">
                            <div class="field">
                                <label>Nombres:</label>
                                <input name="first-name" type="text">
                            </div>
                            <div class="field">
                                <label>Apellidos:</label>
                                <input name="last-name" type="text">
                            </div>
                        </div>
                      <button class="ui positive button" type="button">Guardar Cambios</button>
                    </form>
                </div>
            </div> -->
        </div>
    </div>
</div>