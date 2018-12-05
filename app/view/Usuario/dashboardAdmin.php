<div class="row tiles" style="display: flex !important; align-items: baseline; justify-content: space-between">

    <a href="?1=EnvioController&2=nuevoEnvio"  style="width: 24%;" class="ui green inverted segment">
        <h3>Nuevo Envío</h3>
        <div class="ui divider"></div>
        <i class="paper plane icon"></i>
    </a>

    <a href="?1=EnvioController&2=controlEnvios" style="width: 24%;"  class="ui blue inverted segment">
        <h3>Control de Envíos</h3>
        <div class="ui divider"></div>
        <i class="box icon"></i>
    </a>

    <a href="?1=EnvioController&2=misEnvios" style="width: 24%;"  class="ui orange inverted segment">
        <h3>Mis Envíos</h3>
        <div class="ui divider"></div>
        <i class="envelope icon"></i>
    </a>

   <a style="width: 24%;" id="btnReportes"  class="ui teal inverted segment">
        <h3>Reporte Diario</h3>
        <div class="ui divider"></div>
        <i class="save icon"></i>
    </a>
</div>
<!-- modal para reportes-->
<div class="ui tiny modal" id="modalReportes">

    <div class="header">
       <i class="trash icon"></i> Reportes Deloitte<font color="#85BC22" size="20px">.</font>
       <a href="?1=EnvioController&2=llamaReporte" style="width: 14%;" id="btnReportes" target="_blank">
       <i class="save icon"></i>Reporte Diario
    </a>
    </div>
    <div class="content">
        <form class="ui form" id="frmReportes">
            
                <label for="">En base a:</label>
                <div class="two fields">
                <input class="requerido" type="password" name="Pass" id="Pass">
                </div>
            
        </form>
    </div>
    <div class="actions">
        <div class="ui black deny button" id="btnCancelarEliminar">
            Cancelar
        </div>
        <div class="ui red right button" id="btnConfEliminarCuenta">
            Generar reporte
        </div>
    </div>
</div>

<script>
$(document).on("click", "#btnReportes", function () {
            $('#modalReportes').modal('setting', 'autofocus', false).modal('setting', 'closable', false).modal('show');
        });
</script>


<style>
.btnGraficos{
  border-radius: 5px 5px 5px 5px;
  margin: auto;
  width: 15%;
  padding: 10px;
  background-color:#0AF1B9;
  color: black;
  text-align: center;
}
</style>

<a class="btnGraficos" href="?1=UsuarioController&2=dashboard">
<b><i class="chart bar icon"></i>Actualizar gráficos</b>
    </a>


<?php
 require_once './vendor/autoload.php';
 $con = new mysqli("localhost","root","","deloitte_mensajeria");
$sql="call clientesConMasEnvios()";
$res=$con->query($sql);

$Cantidad=mysqli_num_rows($res);

$clientes=null;
$i=1;

if ($Cantidad==1) {
  while ($fila=$res->fetch_assoc()) {
   $clientes[$i]=$fila['Cliente'];
   $i++;
  }
}


?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Cliente', 'Cantidad'],
           <?php
          while ($fila=$res->fetch_assoc()) {
          echo "['".$fila["nombreCliente"]."',".$fila["Cliente"]."],";
         // ['Work',     11],
          
          }
          ?>
        ]);

        var options = {
          title: 'Clientes que reciben mayor cantidad de  envíos'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
      
    </script>


<?php
 require_once './vendor/autoload.php';
 $con = new mysqli("localhost","root","","deloitte_mensajeria");
$sql="call usuariosEnvios()";
$res=$con->query($sql);

$Cantidad=mysqli_num_rows($res);

$usuarios=null;
$i=1;

if ($Cantidad==1) {
  while ($fila=$res->fetch_assoc()) {
   $usuarios[$i]=$fila['Usuario'];
   $i++;
  }
}


?>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Usuario', 'Cantidad'],
           <?php
          while ($fila=$res->fetch_assoc()) {
          echo "['".$fila["nomUsuario"]."',".$fila["Usuario"]."],";          
          }
          ?>
        ]);

        var options = {
          title: 'Usuarios que han enviado mas paquetes',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <table>
    <td>
    <div id="piechart" style="width: 700px; height: 500px;"></div>
    </td>
    <td>
    <div id="donutchart" style="width: 700px; height: 500px;"></div>
    </td>
    <table>
    </body>
</div>