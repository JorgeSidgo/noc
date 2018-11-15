<div class="ui top fixed menu borderless" id="barra">
    <a class="item" id="btn-menu">
        <i class="material-icons">menu</i>
    </a>
    <!-- <a class="item" style="color:#fff;" href="dashboard.jsp">
        <i class="material-icons">home</i>
    </a> -->
    <a class="item" id="logo-header" style="color:#fff;">
        <img src="./res/img/deloitteNigga.svg" alt="" width="" class="logo" id="">
    </a>

    <div style="margin-right:10px;" id="notif" class="ui floated right dropdown tug floating item">
        <i class="bell icon"></i>
        <!-- <div style="background: #fff; color: #222;" class="ui bottom white circular label">
            1
        </div> -->                       
        <div class="menu">
            <div class="header">
                Notificaciones
                <!-- <div class="ui floated right tiny active inline loader"></div> -->
            </div>

            <div class="divider"></div>
            <div id="notificaciones-header">
                <a href="">
                    <div class="item">
                        <i class="certificate icon"></i>
                        Simon
                    </div>
                </a>
            </div>
        </div>
         <a href="?1=Sistema&2=registroForm" class="ui bottom right attached label">1</a>
    </div>
    

    <div style="margin-right:10px;" id="usuario-header" class="ui dropdown tug floating item">
        <img class="ui avatar image" src="./res/img/userDef.png"> &nbsp;&nbsp; kgarevalo
        <i class="dropdown icon"></i>
        <div class="menu">
            <div class="header">
                Administrador
            </div>
            <div class="divider"></div>
            <a href="../vista/configuracionCuenta.jsp">
                <div class="item" id="#btnConf">
                    <i class="cog icon"></i>
                    Cuenta
                </div>
            </a>
            <a href="../controladorUsuario?op=logout">
                <div style="color:#c0392b;" class="item">
                    <i class="power icon"></i>
                    Cerrar Sesi&oacute;n
                </div>
            </a>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.ui.dropdown')
            .dropdown();
    });
</script>