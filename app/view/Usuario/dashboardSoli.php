
<div class="row tiles" style="display: flex !important; align-items: baseline; justify-content: space-between">

    <a href="?1=EnvioController&2=nuevoEnvio"  style="width: 49%;" class="ui green inverted segment">
        <h3>Nuevo Envío</h3>
        <div class="ui divider"></div>
        <i class="paper plane icon"></i>
    </a>

    <a href="?1=EnvioController&2=misEnvios" style="width: 49%;"  class="ui orange inverted segment">
        <h3>Mis Envíos</h3>
        <div class="ui divider"></div>
        <i class="envelope icon"></i>
    </a>


</div>
<style>
.btnGraficos{
  border-radius: 4px 4px 4px 4px;
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
 $id=$_SESSION['codigoUsuario'];
 $con = new mysqli("localhost","root","","deloitte_mensajeria");
$sql="call clientes_Usuario(".$id.")";
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
          title: 'Mis clientes que reciben mayor cantidad de envíos'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
      
    </script>

<?php
 require_once './vendor/autoload.php';
 $con = new mysqli("localhost","root","","deloitte_mensajeria");

$sql="call tiposTramiteUsuario(".$id.")";

$res=$con->query($sql);

$Cantidad=mysqli_num_rows($res);

$tramite=null;
$i=1;

if ($Cantidad==1) {
  while ($fila=$res->fetch_assoc()) {
   $tramite[$i]=$fila['Tramite'];
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
          ['Tramite', 'Cantidad'],
           <?php
          while ($fila=$res->fetch_assoc()) {
          echo "['".$fila["descTipoTramite"]."',".$fila["Tramite"]."],";          
          }
          ?>
        ]);

        var options = {
          title: 'Tipos de trámite que he realizado con mayor frecuencia',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
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