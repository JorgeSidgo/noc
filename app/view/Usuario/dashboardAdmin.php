<style>
    body {
        overflow: hidden;
    }
</style>

<script>
$(function() {
    overflowRestore();
});
</script>
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
<div id="app">
<!-- modal para reportes-->
<div class="ui tiny modal" id="modalReportes" style="width:40%;">

    <div class="header">
       <i class="clipboard outline icon"></i> Reportes Deloitte<font color="#85BC22" size="20px">.</font>
    </div><br>
    <div class="content">
        <div class="two fields">
            <h4>
            <label for="">Reporte Diario General: </label>
                   <a href="?1=EnvioController&2=llamaReporte" target="_blank">
                    <button class="ui olive deny button" id="btnCancelar" style="color:black; margin: auto;" id="btnReportes" type="button" >
                            <i class="eye icon"></i>Ver reporte
                        </button></a>
            </h4>
        </div>
    </div>
    <br>
    <div class="ui divider"></div>

    <div class="content">
    <h3>Otros reportes</h3><div class="ui divider"></div>
        <center>
                <h4>
                <button class="ui blue deny button" id="btnAreas">
            Por Áreas
        </button>
        <button class="ui purple right button" id="btnFechas">
            Por Fechas
        </button>
        <button class="ui brown right button" id="btnUsuarios">
            Por Usuario
        </button>

            <br><br>
                     <div id="fechas">
                        <div class="two fields">
                            <h5><label for="" style="width:100%; margin: auto;" id="labFechaInicio"><i class="calendar icon"></i>Fecha inicial:</label>
                            <input type="date" name="fechaIncial" id="fecha">
                            <label for="" style="width:100%;margin: auto;text-align: center;" id="labFechaFinal"><i class="calendar icon"></i>Fecha final:</label>
                            <input type="date" name="fechaFinal" id="fecha2"></h5>
                            <button class="ui green right button" id="btnGenerarReporteFecha">
                                Generar reporte
                            </button>

                        </div>
            </div>
                    <div id="cmbArea">
                        <h4><label for="">Seleccione el área: </label>

                        <!--select de areas-->
                        <select name="area" id="area" class="ui search dropdown" style="margin: auto; width: 60%;">
                        </select>
                        </h4>
                        <button class="ui orange right button" id="btnGenerarReporteArea">
                            Generar reporte
                        </button>
                    </div>
            <div id="cmbUsuario">
                <h4> <label for="">Seleccione el usuario: </label>

                  <!--select de areas-->
                  <select name="usuario" id="usuario" class="ui search dropdown">
                    </select></h4>
                    <button class="ui red right button" id="btnGenerarReporteUsuario">
                        Generar reporte
                    </button>
                        </div>
        </center>
    </div>
    <div class="actions">
        <button class="ui black deny button" id="btnCancelar">
            Cancelar
        </button>
    </div>
</div>
</div>

<script>
$(document).on("click", "#btnReportes", function () {
            $('#modalReportes').modal('setting', 'autofocus', false).modal('setting', 'closable', false).modal('show');
        });
</script>
 <script>
    $(document).ready(function(){
        $('#fechas').hide();
        $('#cmbUsuario').hide();
        $('#cmbArea').hide();

    });

    $(document).on("click", "#btnAreas", function () {
            $('#fechas').hide();
            $('#cmbUsuario').hide();
            $('#cmbArea').show();

        });
        $(document).on("click", "#btnFechas", function () {
            $('#cmbUsuario').hide();
            $('#cmbArea').hide();
            $('#fechas').show();
        });
        $(document).on("click", "#btnUsuarios", function () {
            $('#cmbArea').hide();
            $('#fechas').hide();
            $('#cmbUsuario').show();
        });

        
//llamando al reporte
   $(document).on("click", "#btnGenerarReporteArea", function () {
        var idU = $('#area').val();
   window.open('?1=UsuarioController&2=reporteArea&area='+idU,'_blank');
});

$(document).on("click", "#btnGenerarReporteUsuario", function () {
        var idU = $('#usuario').val();
   window.open('?1=UsuarioController&2=reporteUsuario&usuario='+idU,'_blank');
   return false;
});


$(document).on("click", "#btnGenerarReporteFecha", function () {
        var fecha = $('#fecha').val();
        var fecha2 = $('#fecha2').val();
   window.open('?1=UsuarioController&2=reporteFechas&fecha='+fecha+'&fecha2='+fecha2,'_blank');
   return false;

   
});
</script>



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
    <thead>
        <a class="btnGraficos ui center teal button" style="margin:auto;" href="?1=UsuarioController&2=dashboard">
            <b><i class="chart bar icon"></i>Actualizar gráficos</b>
        </a>

    </thead>
    <tbody>
    <td>
    <br>
    <div id="piechart" style="width: 750px; height: 500px;"></div>
    </td>
    <td><br>
    <div id="donutchart" style="width: 750px; height: 500px;"></div>
    </td>
    </tbody>
    <table>
    </body>
</div>



 <script>
        $(function() {
            var option = '';
            var areas = '<?php echo $areas?>';

            $.each(JSON.parse(areas), function() {
                option = `<option value="${this.codigoArea}">${this.descArea}</option>`;

                $('#area').append(option);
            });
        });


        $(function() {
            var option = '';
            var usuarios = '<?php echo $usuariosCMB?>';

            $.each(JSON.parse(usuarios), function() {
                option = `<option value="${this.codigoUsuario}">${this.nombre} ${this.apellido}</option>`;

                $('#usuario').append(option);
            });
        });

    </script>

   
