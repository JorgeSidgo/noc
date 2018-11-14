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
            <div class="cuadro" style="min-width: 350px">
                <div class="cuadro-ins">
                    <img src="./res/img/deloitteNigga.svg" alt="" id="logo-login">
                </div>
                <form action="" method="POST" class="ui form">
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="user icon"></i>
                            <input @keyup.enter="login" @keyup="setTrue" type="text" class="reqLogin" name="user" id="user" placeholder="Usuario">
                        </div>
                    </div>
                    <div style="text-align: right;" class="field">
                        <div class="ui left icon input">
                            <i class="lock icon"></i>
                            <input type="password" class="reqLogin" name="pass" id="pass" placeholder="Contraseña"
                                @keyup.enter="login" @keyup="setTrue">
                        </div>
                        <a href=""><small>Olvidé mi contraseña</small></a>
                    </div>
                    
                    <div class="ui negative message" v-if="isError">
                        <p>
                            Datos Incorrectos
                        </p>
                    </div>
                    <button style="margin-top: 15px;" :class="loading" @click="login" id="btnLogin" type="button"
                        @submit.prevent="" >Ingresar</button>
                    
                </form>
                <div style="text-align:center; margin-top:15px;" class="field">
                        <a href="?1=Sistema&2=registroForm" class="ui bottom attached label">¿Aún no tiene cuenta? Regístrese</a>
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