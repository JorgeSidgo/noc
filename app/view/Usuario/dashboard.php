<script>
    /* $(function() {
    $('.contenedor').css('width', '100vw');
    $('.contenedor').css('padding', '10px 0px');
}); */
</script>


<div id="dashboard-grid" class="ui grid">

    <div class="row" id="dashboard-card">
        <h3 class="ui header">
            <?php echo $_SESSION["nombre"].' '.$_SESSION["apellido"]?>
            <div class="sub header">
                <?php echo $_SESSION["email"]?>
            </div>
        </h3>
    </div>

    <div class="row">
        <a href="?1=EnvioController&2=nuevoEnvio" style="width: 22%;" class="ui labeled icon green huge button">
            <i class="paper plane icon"></i>
            Nuevo Envio
        </a>
        <a href="?1=EnvioController&2=nuevoEnvio" style="width: 22%;" class="ui labeled icon green huge button">
            <i class="paper plane icon"></i>
            Nuevo Envio
        </a>
        <a href="?1=EnvioController&2=nuevoEnvio" style="width: 22%;" class="ui labeled icon green huge button">
            <i class="paper plane icon"></i>
            Nuevo Envio
        </a>
        <a href="?1=EnvioController&2=nuevoEnvio" style="width: 22%;" class="ui labeled icon green huge button">
            <i class="paper plane icon"></i>
            Nuevo Envio
        </a>
    </div>

</div>