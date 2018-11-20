<style>
    body {
        overflow: hidden;
    }
</style>
<!-- kiondaquepex -->

<body class="body-login">
    <div id="fondo-dot"></div>
    <div id="app">
        <div class="contenedor" style="margin-top:0; height: 100vh; background: none !important; display: flex;
        align-items: center;
        justify-content: center;">
            <div class="cuadro" style="min-width: 350px">
                <div class="cuadro-ins">
                    <img src="./res/img/deloitteNigga.svg" alt="" id="logo-login">
                </div>
                <form id="frmNewPass" action="" method="POST" class="ui form">
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="user icon"></i>
                            <input @keyup.enter="login" value="" @keyup="setTrue" type="text" class="reqLogin" name="user" id="user"
                                placeholder="Usuario Deloitte">
                        </div>
                    </div>
                    <div style="text-align: right;" class="field">
                        <div class="ui right labeled left icon input">
                            <i class="envelope icon"></i>
                            <input type="text" class="reqLogin" name="correo" id="correo" placeholder="Correo Electrónico"
                                @keyup.enter="login" @keyup="setTrue">
                                
                        </div>
                        
                    </div>
                    <a id="label-error" style="display: none; margin: 0; text-align:center;" class="ui red fluid large label" v-if="isError">Datos
                        Incorrectos</a>
                    <button style="margin-top: 15px;" class="ui green-deloitte fluid button" name="btnEnviar" value="noloc" @click="login" id="btnEnviar"
                        type="button" @submit.prevent="">Enviar datos</button>
                        

                </form>
                <div style="text-align:center; margin-top:15px;" class="field">
                    <a href="?1=UsuarioController&2=loginview" class="ui bottom attached label">Volver a inicio</a>
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
            $('#btnEnviar').click(function() {

                if(validarVacios('frmNewPass', '#btnEnviar') == 0) {

                    $('#frmNewPass').addClass('loading');

                    var datos = {};

                    $('#frmNewPass').find(":input").each(function () {
                        gatos[this.name] = $(this).val();
                    });

                    gatos = JSON.stringify(gatos);

                    console.log(gatos);

                } else {
                    $('#label-error').html('Complete todos los campos');
                    $('#label-error').css('display', 'inline-block');
                }

            });
        });
    </script>

</body>