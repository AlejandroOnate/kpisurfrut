<!DOCTYPE html>

<?php
$suma=0;
for($i=0 ; $i < count($kilosPorOrdenAbiertas['dataCompleta']);$i++){

$suma = $suma + (float)$kilosPorOrdenAbiertas['dataCompleta'][$i]['kilosTotales'];


}





?>




<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.1.0/material.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.material.min.css">
    <link rel="stylesheet" href="css/index.css">

    <title></title>

  </head>
  <body>
    <nav class="navTitulo">
      <div class="nav-wrapper">
        <a href="#!" class="brand-logo center">KPI Surfrut</a>
        <!-- <ul class="left hide-on-med-and-down">
          <li><a href="sass.html">Sass</a></li>
          <li><a href="badges.html">Components</a></li>
          <li class="active"><a href="collapsible.html">JavaScript</a></li>
        </ul> -->
      </div>
    </nav>

    <div class="row">

      <div class="col m12 s12">
        <div class="card">
          <div class="card-content">
            <div class="card-title">
              Porcentaje meta cumplida (Kilos Vaciados)
            </div>

            <div class="progress">
               <div class="determinate" style="width: <?=$meta['porcentajeMeta']?>%"></div>
           </div>

           <h3 class="porcentajeMeta"><?=number_format($meta['porcentajeMeta'],1)?> %</h3>

          </div>
        </div>
      </div>

    </div>


  <div class="row">

    <!-- <div class="col m3 s6">
      <div class="card">

        <div class="card-content">
          <div class="card-title">
             Kilos vaciados hasta la fecha.
            <hr>
          </div>
          <div class="row">

            <div class="col m3 s12 box valign-wrapper">
              <i class="material-icons center-align">move_to_inbox</i>
            </div>

            <div class="col m9  s12 valign-wrapper boxResult">
              <h3 class="titleResult"><?=$meta['ingresado']?></h3>
            </div>

          </div>
        </div>

      </div>
    </div> -->




    <div class="col m6 s6">
      <div class="card">

        <div class="card-content">
          <div class="card-title">
             Kilos Vaciados.
            <hr>
          </div>
          <div class="row">

            <div class="col m3  s12 box valign-wrapper">
              <i class="material-icons">move_to_inbox</i>
            </div>

            <div class="col m9  s12 valign-wrapper boxResult">
              <h3 class="titleResult"><?=$meta['procesado']?></h3>
            </div>

          </div>
        </div>

      </div>
    </div>

    <div class="col m6 s6">
      <div class="card">

        <div class="card-content">
          <div class="card-title">
             Kilos elegido.
            <hr>
          </div>
          <div class="row">

            <div class="col m3  s12 box valign-wrapper">
              <i class="material-icons">move_to_inbox</i>
            </div>

            <div class="col m9  s12 valign-wrapper boxResult">
              <h3 class="titleResult"><?=number_format($totalElegidos,0,"",",")?></h3>
            </div>

          </div>
        </div>

      </div>
    </div>


  </div>
    <h3 class="center-align">Tabla de kilos por lote </h3>
    <hr>


    <h5 class="">Ordenes Cerradas </h5>
    <hr>
    <div class="row">

    <div class="col m3 s6">

      <div class="card">

        <div class="card-content">
          <div class="card-title">
             Suma Total Kilos
            <hr>
          </div>
          <div class="row">

            <div class="col m3 s12 box valign-wrapper">
              <i class="material-icons center-align">move_to_inbox</i>
            </div>

            <div class="col m9 s12 valign-wrapper boxResult">
              <p class="titleResult"><?=number_format($kilosPorOrdenCerradas['totalKilos'],1,".","")?> Kg</p>
            </div>

          </div>
        </div>

      </div>
    </div>

    <div class="col m3 s6">

      <div class="card">

        <div class="card-content">
          <div class="card-title">
             Suma Total Kilos Según %
            <hr>
          </div>
          <div class="row">

            <div class="col m3 s12 box valign-wrapper">
              <i class="material-icons center-align">move_to_inbox</i>
            </div>

            <div class="col m9 s12 valign-wrapper boxResult">
              <p class="titleResult"><?=number_format($kilosPorOrdenCerradas['totalKilosEstimados'],1,".","")?> Kg</p>
            </div>

          </div>
        </div>

      </div>
    </div>

    <div class="col m3 s6">

      <div class="card">

        <div class="card-content">
          <div class="card-title">
             Kg Elegidos
            <hr>
          </div>
          <div class="row">

            <div class="col m3 s12 box valign-wrapper">
              <i class="material-icons center-align">move_to_inbox</i>
            </div>

            <div class="col m9 s12 valign-wrapper boxResult">
              <p class="titleResult"><?=number_format($kilosPorOrdenCerradas['sumaElegidos'],1,".","")?> Kg</p>
            </div>

          </div>
        </div>

      </div>
    </div>

    <div class="col m3 s6">

      <div class="card">

        <div class="card-content">
          <div class="card-title">
             Porcentaje Estimado Total
            <hr>
          </div>
          <div class="row">

            <div class="col m3 s12 box valign-wrapper">
              <i class="material-icons center-align">move_to_inbox</i>
            </div>

            <div class="col m9 s12 valign-wrapper boxResult">
              <p class="titleResult"><?=number_format($kilosPorOrdenCerradas['porcentajeEstimadoTotal'],1,".","")?>%</p>
            </div>

          </div>
        </div>

      </div>
    </div>

    <div class="col m3 s6">

      <div class="card">

        <div class="card-content">
          <div class="card-title">
             Porcentaje Embalaje Real
            <hr>
          </div>
          <div class="row">

            <div class="col m3 s12 box valign-wrapper">
              <i class="material-icons center-align">move_to_inbox</i>
            </div>

            <div class="col m9 s12 valign-wrapper boxResult">
              <p class="titleResult"><?=number_format($kilosPorOrdenCerradas['porcentajeRealTotal'],1,".","")?>%</p>
            </div>

          </div>
        </div>

      </div>
    </div>


    </div>

    <div class="row">

    <table id="kilosPorOrden" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Orden</th>
            <th>Suma de Kilos </th>
            <th>Kg estimados de embalado</th>
            <th>embalados</th>
            <th>porcentaje real embalado</th>

            <th>porcentaje kg estimados</th>

        </tr>
    </thead>
    <tfoot>
        <tr>
          <th>Fecha</th>
          <th>Orden</th>
          <th>Suma de Kilos </th>
          <th>Kg estimados de embalado</th>
          <th>embalados</th>
          <th>porcentaje real embalado</th>

          <th>porcentaje kg estimados</th>
        </tr>
    </tfoot>
    <tbody class="kilosOrdenes">

    <?php for($i=0 ; $i < count($kilosPorOrdenCerradas['embalados']);$i++): ?>
          <tr>
              <td><?=$kilosPorOrdenCerradas['embalados'][$i]['fecha']?></td>
              <td><?=$kilosPorOrdenCerradas['embalados'][$i]['orden']?></td>
              <td><?=$kilosPorOrdenCerradas['embalados'][$i]['kilosTotales']?></td>
              <td><?=$kilosPorOrdenCerradas['embalados'][$i]['kilosPorcentaje']?></td>
              <td><?=$kilosPorOrdenCerradas['embalados'][$i]['embalado']?></td>
              <td><?=number_format((($kilosPorOrdenCerradas['embalados'][$i]['embalado']) *100) / $kilosPorOrdenCerradas['embalados'][$i]['kilosTotales'],1)?></td>

              <td><?=number_format($kilosPorOrdenCerradas['embalados'][$i]['kilosEstimados'],1)?></td>

          </tr>
      <?php endfor; ?>

    </tbody>

</table>

    </div>

<hr>
    <h5 class="">Ordenes Abiertas </h5>
    <hr>
    <div class="row">

    <div class="col m6 s6">

      <div class="card">

        <div class="card-content">
          <div class="card-title">
             Suma Total Kilos
            <hr>
          </div>
          <div class="row">

            <div class="col m3 s12 box valign-wrapper">
              <i class="material-icons center-align">move_to_inbox</i>
            </div>

            <div class="col m9 s12 valign-wrapper boxResult">
              <p class="titleResult"><?=number_format($kilosPorOrdenAbiertas['totalKilos'],1,".","")?> Kg</p>
            </div>

          </div>
        </div>

      </div>
    </div>

    <div class="col m6 s6">

      <div class="card">

        <div class="card-content">
          <div class="card-title">
             Suma Total Kilos Según %
            <hr>
          </div>
          <div class="row">

            <div class="col m3 s12 box valign-wrapper">
              <i class="material-icons center-align">move_to_inbox</i>
            </div>

            <div class="col m9 s12 valign-wrapper boxResult">
              <p class="titleResult"><?=number_format($kilosPorOrdenAbiertas['totalKilosEstimados'],1,".","")?> Kg</p>
            </div>

          </div>
        </div>

      </div>
    </div>


    </div>
    <div class="row">

    <table id="kilosPorOrdenAbiertas" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Orden</th>
            <th>Suma de Kilos </th>
            <th>Suma de Kg segun %</th>
            <th>porcentaje</th>

        </tr>
    </thead>
    <tfoot>
        <tr>
          <th>Fecha</th>
          <th>Orden</th>
          <th>Suma de Kilos </th>
          <th>Suma de Kg segun %</th>
          <th>porcentaje</th>
        </tr>
    </tfoot>
    <tbody class="kilosOrdenes">

    <?php for($i=0 ; $i < count($kilosPorOrdenAbiertas['dataCompleta']);$i++): ?>
          <tr>
              <td><?=$kilosPorOrdenAbiertas['dataCompleta'][$i]['fecha']?></td>
              <td><?=$kilosPorOrdenAbiertas['dataCompleta'][$i]['orden']?></td>
              <td><?=$kilosPorOrdenAbiertas['dataCompleta'][$i]['kilosTotales']?></td>
              <td><?=$kilosPorOrdenAbiertas['dataCompleta'][$i]['kilosPorcentaje']?></td>
              <td><?=$kilosPorOrdenAbiertas['dataCompleta'][$i]['kilosEstimados']?></td>

          </tr>
      <?php endfor; ?>

    </tbody>

</table>

    </div>
<hr>
    <h5 class="">Cajas Por Variedad </h5>
    <hr>
    <div class="row CajasPorVariedad">

    <div class="col m3 s3">

      <div class="card">

        <div class="card-content">
          <div class="card-title">
            Royal
            <hr>
          </div>
          <div class="row">

            <div class="col m3 s12 box valign-wrapper">
              <i class="material-icons center-align">move_to_inbox</i>
            </div>

            <div class="col m9 s12 valign-wrapper boxResult">
              <p class=""></p>
            </div>

          </div>
        </div>

      </div>
    </div>




    </div>


<div id="columnchart_values" style="width: 900px; height: 300px;"></div>
    <script>
      let base_url = '<?=base_url()?>'
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/dataTables.material.min.js"></script>

    <script src="js/index.js"></script>

  </body>
</html>
