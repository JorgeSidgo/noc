<script>
/* $(function() {
    $('.contenedor').css('width', '100vw');
    $('.contenedor').css('padding', '10px 0px');
}); */
</script>


<div class="ui grid">

    <div class="row" id="dashboard-card">
        <h3 class="ui header">
            <?php echo $_SESSION["nombre"].' '.$_SESSION["apellido"]?>
            <div class="sub header"><?php echo $_SESSION["email"]?></div>
        </h3>
    </div>

</div>
