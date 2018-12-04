

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
    <i class="user icon"></i> Mi usuario Deloitte<font color="#85BC22" size="20px">.</font>
    </div>
    <div class="content">
        <form class="ui form" id="frmCambiarNomUser">
            <div class="field">
                <label for="">Nombre de Usuario:</label>
                <input class="reqRegistrar" type="text" name="nomUser" id="nomUser" value=<?php echo '"'.$_SESSION['nomUsuario'].'"'; ?>>
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
    <i class="street view icon"></i> Datos Personales
    </div>
    <div class="content">
        <form class="ui form" id="frmCambiarNom">
            <div class="two fields">
                <div class="field">
                    <label for="">Nombres:</label>
                    <input class="reqRegistrar" type="text" name="nom" id="nom" value=<?php echo '"'.$_SESSION['nombre'].'"'; ?>>
                    <div class="ui red pointing label" style="display: none;">
                    </div>
                </div>
                <div class="field">
                    <label for="">Apellidos:</label>
                    <input class="reqRegistrar" type="text" name="ape" id="ape" value=<?php echo '"'.$_SESSION['apellido'].'"'; ?>>
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
    <i class="cogs icon"></i> Cambiar Contraseña
    </div>
    <div class="content">
        <form class="ui form" id="frmCambiarContra">
            
                <label for="">Contraseña Actual:</label>
                <div class="two fields">
                <input type="password" name="antPass" id="antPass" class="requerido">
                <div id="show-contra" class="ui basic label show-contra"><i style="margin: 0;" id="icon-contra" class="eye slash icon"></i></div>
                <div class="ui red pointing label" style="display: none;">
                </div>
            </div>
                <label for="">Nueva Contraseña:</label>
                <div class="two fields">
                <input  type="password" name="nuPass" id="nuPass" class="requerido">
                <div id="show-contra" class="ui basic label show-contra"><i style="margin: 0;" id="icon-contra" class="eye slash icon"></i></div>
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
       <i class="trash icon"></i> Eliminar cuenta Deloitte<font color="#85BC22" size="20px">.</font>
    </div>
    <div class="content">
        <form class="ui form" id="frmEliminarCuenta">
            
                <label for="">Ingrese su <code style="padding: 0px 3px; background: rgba(255, 0, 0, .1); color: rgba(255, 0, 0, 0.8); border-radius: 2px;">contraseña</code> para confirmar:</label>
                <div class="two fields">
                <input class="requerido" type="password" name="antPass" id="antPass">
                <div id="show-contra" class="ui basic label show-contra"><i style="margin: 0;" id="icon-contra" class="eye slash icon"></i></div>
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
                        <h1><i class="user icon"></i>
                Mi cuenta Deloitte<font color="#85BC22" size="20px">.</font></h1><hr>
                        </p>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="eight wide column">
                    <h3 class="ui header"><font color=""><i class="user outline icon"></font></i>Usuario Deloitte<font color="#85BC22" size="20px">.</font></h3>
                    <h4><?php echo '<p class="user-info">'.$_SESSION['nomUsuario'].'</p>' ?></h4>
                    <div class="ui divider"></div>
                    <h3 class="ui header">  <i class="street view  icon"></i>Nombre Completo.</h3>
                    <h4><?php echo '<p class="user-info">'.$_SESSION['nombre'].' '.$_SESSION['apellido'].'</p>' ?></h4>
                    <div class="ui divider"></div>
                    <h3 class="ui header">  <i class="cog icon"></i>Permisos de la cuenta.</h3>
                    <h4><?php echo '<p class="user-info">'.$_SESSION['descRol'].'</p>' ?></h4>
                </div>

                 <div class="four wide column right floated">
                <center><h3><i class="cogs icon"></i> Opciones de configuración.</h3></center>
                    <div class="ui list">
                        <div class="item">
                            <button class="ui right floated fluid green-deloitte  button" id="btnCambiarNomUser" type="button"><i class="user icon"></i>Mi usuario Deloitte</button>
                        </div>
                        <div class="item">
                            <button class="ui right floated fluid green-deloitte  button" id="btnCambiarNom" type="button"><i class="street view icon"></i>Datos Personales</button>
                        </div>
                        <div class="item">
                            <button class="ui right floated fluid green-deloitte button" id="btnCambiarContra" type="button"><i class="lock icon"></i>Modificar contraseña</button>
                        </div>
                        <div class="item">
                            <button class="ui right floated fluid red button" id="btnEliminarCuenta" type="button"><i class="trash icon"></i>Eliminar mi cuenta</button>
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
<script>
 $(document).on("click", "#btnCambiarNom", function () {
            $('#modalCambiarNom').modal('setting', 'autofocus', false).modal('setting', 'closable', false).modal('show');
        });
        $(document).on("click", "#btnCambiarNomUser", function () {
            $('#modalCambiarNomUser').modal('setting', 'autofocus', false).modal('setting', 'closable', false).modal('show');
        });
        $(document).on("click", "#btnCambiarContra", function () {
            $('#modalCambiarContra').modal('setting', 'autofocus', false).modal('setting', 'closable', false).modal('show');
        });
        $(document).on("click", "#btnEliminarCuenta", function () {
            $('#modalEliminarCuenta').modal('setting', 'autofocus', false).modal('setting', 'closable', false).modal('show');
        });
</script>
 <script>
        $(function () {
            $('.show-contra').mousedown(function () {
                $(this).children().attr('class', 'eye icon');
                $(this).siblings('input.requerido').attr('type', 'text');
            });


            $('.show-contra').mouseup(function () {
                $(this).children().attr('class', 'eye slash icon');
                $(this).siblings('input.requerido').attr('type', 'password');
            });

        });
    </script>