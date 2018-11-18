<style>
    body {
        overflow: hidden;
    }
</style>

<body class="body-login">
    <div id="fondo-dot"></div>
    <div id="app">
        <div class="contenedor" style="margin-top:0; height: 100vh; background: none !important; display: flex;
        align-items: center;
        justify-content: center;">
            <div class="cuadro" style="min-width: 525px">
                <div class="cuadro-ins" style="margin-top: -12%;">
                    <img src="./res/img/deloitteNigga.svg" alt="" id="logo-login">
                </div>
                <form id="frmLogin" method="POST" class="ui form">


                    <div class="two fields">
                        <div class="field">
                            <label for="">Nombre:</label>
                            <input type="text" class="requerido" name="nombre" id="nombre">
                        </div>
                        <div class="field">
                            <label for="">Apellido:</label>
                            <input type="text" class="requerido" name="apellido" id="apellido">

                        </div>
                    </div>
                    <div class="field">
                        <label for="">Nombre de Usuario:</label>
                        <input type="text" class="requerido" name="user" id="user">
                    </div>
                    <div class="field">
                        <label for="">E-mail:</label>
                        <input type="text" class="requerido" name="email" id="email">

                    </div>
                    <div class="field">
                        <label for="">Área:</label>
                        <select name="area" id="area" class="ui dropdown">
                            <option value="1">Abas</option>
                            <option value="2">Tax y Legal</option>
                            <option value="3">RRHH</option>
                            <option value="4">Finanzas</option>
                        </select>

                    </div>
                    <div class="two fields">
                        <div class="field">
                            <label for="">Contraseña:</label>
                            <input type="password" class="requerido" name="pass" id="pass">

                        </div>
                        <div class="field">
                            <label for="">Confirmar Contraseña:</label>
                            <input type="password" class="requerido" name="confPass" id="confPass">

                        </div>
                    </div>

                    <button style="margin-top: 15px;" class="ui green-deloitte fluid button" id="btnLogin" type="button"
                        @submit.prevent="">Registrarse</button>

                </form>
                <div style="text-align:center; margin-top:15px;" class="field">
                    <a href="?" class="ui bottom attached label">¿Ya posee una cuenta? Inicie Sesión</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function () {
            $('#user').focus();
        });
    </script>

    <script>
        $(function() {
            $('#btnLogin').click(function() {

                if(validarVacios('frmLogin', '#btnLogin') == 0)
                {
                    var gatos = {};
                    $('#frmLogin').addClass('loading');

                    $('#frmLogin').find(":input").each(function () {
                        gatos[this.name] = $(this).val();
                    });

                    gatos = JSON.stringify(gatos);

                    console.log(gatos);
                }
                
            });
        });
    </script>

</body>