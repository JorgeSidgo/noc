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
                <form action="" method="POST" class="ui form">

                    
                    <div class="two fields">
                        <div class="field">
                            <label for="">Nombre:</label>
                                <input @keyup.enter="login" @keyup="setTrue" type="text" class="reqLogin" name="user" id="user">
                        </div>
                        <div class="field">
                            <label for="">Apellido:</label>
                                <input type="text" class="reqLogin" name="pass" id="pass" 
                                    @keyup.enter="login" @keyup="setTrue">

                        </div>
                    </div>
                    <div class="field">
                            <label for="">Nombre de Usuario:</label>
                                <input @keyup.enter="login" @keyup="setTrue" type="text" class="reqLogin" name="user" id="user">
                        </div>
                    <div class="field">
                            <label for="">E-mail:</label>
                                <input type="text" class="reqLogin" name="pass" id="pass"
                                    @keyup.enter="login" @keyup="setTrue">

                        </div>
                    <div class="two fields">
                        <div class="field">
                            <label for="">Contraseña:</label>
                                <input type="password" class="reqLogin" name="pass" id="pass"
                                    @keyup.enter="login" @keyup="setTrue">

                        </div>
                        <div class="field">
                            <label for="">Confirmar Contraseña:</label>
                                <input type="password" class="reqLogin" name="pass" id="pass"
                                    @keyup.enter="login" @keyup="setTrue">

                        </div>
                    </div>
                    
                    <div class="ui negative message" v-if="isError">
                        <p>
                            Datos Incorrectos
                        </p>
                    </div>
                    <button style="margin-top: 15px;" :class="loading" @click="login" id="btnLogin" type="button"
                        @submit.prevent="" >Registrarse</button>
                    
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
        var app = new Vue({
            el: "#app",
            data: {
                isError: false,
                loading:['ui','fluid','green-deloitte','button']
            },
            methods: {
                setTrue() {
                    this.isError = false;
                },
                login() {
                    this.loading.push('loading');
                    var user = document.getElementById("user").value.trim();
                    var pass = document.getElementById("pass").value.trim();

                    /* $('#btnLogin').addClass("loading"); */

                    fetch("../controladorUsuario?op=login&nom="+ user + "&pass=" + pass)
                        .then(response => {
                            if (response.ok) {
                                return response.json();
                            } else {
                                throw "Error al recibir datos";
                                this.isError = true;
                                
                            }
                        })
                        .then(val => {

                            if (val == 1) {
                                location.href = 'dashboard.jsp';
                                
                            } else {
                                this.loading.pop();
                                this.isError = true;
                            }
                            
                        }).catch(res => {
                            this.loading.pop();
                            this.isError = true;
                            console.log(res);
                        
                        });
                }
            }
        });
    </script>
</body>