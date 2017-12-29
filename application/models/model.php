<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class model extends CI_Model{


    function meta(){
        $result = $this->db->query("dba.FGran_Flujo_Recepcion_Proceso 4700,11,-1,'2017-11-01 00:00:00','2018-01-01',-1,-1,-1,-1,-1,709,N'*',-1,-1,0,0,2017");
        $data=  $result->result_array();

        $procesado = 0;
        $ingresado = 0;

        for ($i=0; $i < count($data); $i++) {
          $procesado = $procesado + $data[$i]['procesado'] ;
          $ingresado = $ingresado + $data[$i]['ingresado'] ;

        }
        $porcentajeMeta =($procesado * 100)/ 1800000 ;
        $porcentajeVaciadoMeta = ($ingresado * 100 ) / 1800000;
        return array("procesado"=>number_format($procesado,0,".",","),"ingresado"=>number_format($ingresado,0,".",","),"porcentajeMeta"=>$porcentajeMeta,"porcentajeVaciado"=>$porcentajeVaciadoMeta);

    }

    function totalElegidos(){
        $result = $this->db->query("dba.FGran_InformeProcesoKilos_New 4700,-1,4,-1,-1,-1,-1,-1,-1,'2017-11-01 00:00:00','2018-01-01 23:59:00',0,0,1,-1,N'*',0,709,-1,-1,0,-1,1,1,0,1,-1,-1,default,2017");
        $data=  $result->result_array();
        $totalElegido = 0 ;
        for ($i=0; $i < count($data); $i++) {
         if (trim($data[$i]['cate_nombre'])=="Elegido-C") {
            $totalElegido = $totalElegido + (float)$data[$i]['det4_totkil'];
         }
        }

        return $totalElegido;

    }


    function kilosEmbalados(){
      $result = $this->db->query("dba.FGran_InformeProcesoKilos_New 4700,-1,4,-1,-1,-1,-1,-1,-1,'2017-11-01 00:00:00','2018-01-01 23:59:00',0,0,1,-1,N'*',0,709,-1,-1,0,-1,1,1,0,1,-1,-1,default,2017");
      $data=  $result->result_array();
      $ordenAgrupada = array();
      $totalElegido=0;

      for ($i=0; $i < count($data); $i++) {
        if (trim($data[$i]['cate_nombre'])=="Elegido-C") {
            $totalElegido = $totalElegido + (float)$data[$i]['det4_totkil'];
        }


        $encontrado=false;
        if(count($ordenAgrupada)==0){
          array_push($ordenAgrupada,array("orden"=>$data[$i]['orpr_numero'],"embalado"=>$data[$i]['cla3_kembex'],"cal7"=>$data[$i]['det4_ccal07']));


        }else {

          for ($j=0; $j < count($ordenAgrupada); $j++) {
            if ($data[$i]['orpr_numero']==$ordenAgrupada[$j]['orden']) {
              $ordenAgrupada[$j]['embalado'] = (float)$ordenAgrupada[$j]['embalado'] + (float)$data[$i]['cla3_kembex'];
              $ordenAgrupada[$j]['cal7'] = (float)$ordenAgrupada[$j]['cal7'] + (float)$data[$i]['det4_ccal07'];

              $encontrado= true;
            }
          }

          if(!$encontrado){
              array_push($ordenAgrupada,array("orden"=>$data[$i]['orpr_numero'],"embalado"=>$data[$i]['cla3_kembex'],"cal7"=>$data[$i]['det4_ccal07']));

          }


        }

      }


      // array_push($ordenAgrupada,array("sumaElegidos"=>$totalElegido));

      return array("embalados"=>$ordenAgrupada,"sumaElegidos"=>$totalElegido);

    }

    function KilosEstimadosCerrados(){
        $result = $this->db->query("dba.FGran_Informe_ProductorOrden N'4700',N'4',N'1',N'99999999',N'-1','2017-11-01 00:00:00','2018-01-01 00:00:00',N'3',N'-1',-1,2017");
        $data=  $result->result_array();
        $estimados = array();
        $sumaTotalKilos = 0 ;
        $sumaTotalKilosPorcentaje = 0 ;

        for ($i=0; $i < count($data); $i++) {
            $orden =$data[$i]['orpr_numero'] ;
            $kilos =$data[$i]['Kilos'] ;
            $poremb = $data[$i]['fgcc_poremb'];
            $fecha = $data[$i]['orpr_fecpro'];

            $kilosPorcentaje = $kilos * $poremb / 100 ;

            $sumaTotalKilos=$sumaTotalKilos + $kilos ;
            $encontrado = false ;
            if (count($estimados) == 0 ) {
                $porc_estimado =($kilosPorcentaje / $kilos)*100 ;
                array_push($estimados,array("orden"=>$orden , "kilosPorcentaje"=>$kilosPorcentaje,"kilosTotales"=>$kilos,"kilosEstimados" =>$porc_estimado,"fecha"=>$fecha));

                $sumaTotalKilosPorcentaje=$sumaTotalKilosPorcentaje + $kilosPorcentaje ;
            }else {

                for($j = 0 ; $j < count($estimados) ;$j++){

                    if ($estimados[$j]['orden'] == $orden) {
                        $orden =$data[$i]['orpr_numero'] ;
                        $kilos =$data[$i]['Kilos'] ;
                        $poremb =  $data[$i]['fgcc_poremb'];
                        $kilosPorcentaje = $kilos * $poremb / 100 ;



                        $estimados[$j]['kilosPorcentaje'] = (float)$estimados[$j]['kilosPorcentaje'] + (float)$kilosPorcentaje ;
                        $estimados[$j]['kilosTotales'] = (float)$estimados[$j]['kilosTotales'] + (float)$kilos ;
                        $estimados[$j]['kilosEstimados'] = ($estimados[$j]['kilosPorcentaje'] / $estimados[$j]['kilosTotales'])*100 ;

                        $sumaTotalKilosPorcentaje=$sumaTotalKilosPorcentaje +   $kilosPorcentaje ;
                        $encontrado = true;
                    }

                 }

                 if (!$encontrado) {
                    $porc_estimado =($kilosPorcentaje / $kilos) * 100 ;
                    array_push($estimados,array("orden"=>$orden , "kilosPorcentaje"=>$kilosPorcentaje,"kilosTotales"=>$kilos,"kilosEstimados" =>$porc_estimado,"fecha"=>$fecha));

                    $sumaTotalKilosPorcentaje=$sumaTotalKilosPorcentaje + $kilosPorcentaje ;
                 }


            }




          }
          asort($estimados);
          $conjunto = array("dataCompleta"=>$estimados , "totalKilos" => $sumaTotalKilos,"totalKilosEstimados"=>$sumaTotalKilosPorcentaje);
          return $conjunto;


    }



    

    function  unionEmbaldosCerrados($kilosEmbalados,$kilosCerrados){
      // echo json_encode($kilosEmbalados);
      $sumaKgEstimados = 0 ;
      $embalajeReal = 0;
      for ($i=0; $i < count($kilosEmbalados['embalados']); $i++) {


        for ($j=0; $j < count($kilosCerrados['dataCompleta']); $j++) {
            if($kilosCerrados['dataCompleta'][$j]['orden']==$kilosEmbalados['embalados'][$i]['orden']){

              // $embalajeReal += $kilosEmbalados['embalados'][$i]['embalado'] - $kilosEmbalados['embalados'][$i]['cal7'];
              $embalajeReal += $kilosEmbalados['embalados'][$i]['embalado'];
              $sumaKgEstimados +=  $kilosCerrados['dataCompleta'][$j]['kilosPorcentaje'];
              $kilosEmbalados['embalados'][$i]['kilosPorcentaje']=$kilosCerrados['dataCompleta'][$j]['kilosPorcentaje'];
              $kilosEmbalados['embalados'][$i]['kilosTotales']=$kilosCerrados['dataCompleta'][$j]['kilosTotales'];
              $kilosEmbalados['embalados'][$i]['kilosEstimados']=$kilosCerrados['dataCompleta'][$j]['kilosEstimados'];
              $kilosEmbalados['embalados'][$i]['fecha']=$kilosCerrados['dataCompleta'][$j]['fecha'];


            }
        }
        # code...
      }
      $kilosEmbalados['totalKilos'] = $kilosCerrados['totalKilos'];
      $kilosEmbalados['totalKilosEstimados'] = $kilosCerrados['totalKilosEstimados'];
      $kilosEmbalados['sumaKgEstimados'] = $sumaKgEstimados;
      $kilosEmbalados['porcentajeEstimadoTotal'] = ($kilosEmbalados['sumaKgEstimados']* 100) / $kilosEmbalados['totalKilos'] ;
      $kilosEmbalados['porcentajeRealTotal'] = ($embalajeReal* 100) / $kilosEmbalados['totalKilos'] ;
      // echo json_encode($kilosEmbalados);
      return $kilosEmbalados;

    }

    function KilosEstimadosAbiertos(){
        $result = $this->db->query("dba.FGran_Informe_ProductorOrden N'4700',N'4',N'1',N'99999999',N'-1','2017-11-01 00:00:00','2018-01-01 00:00:00',N'1',N'-1',-1,2017");
        $data=  $result->result_array();
        $estimados = array();
        $sumaTotalKilos = 0 ;
        $sumaTotalKilosPorcentaje = 0 ;

        for ($i=0; $i < count($data); $i++) {
            $orden =$data[$i]['orpr_numero'] ;
            $kilos =$data[$i]['Kilos'] ;
            $poremb = $data[$i]['fgcc_poremb'];
            $kilosPorcentaje = $kilos * $poremb / 100 ;
            $fecha = $data[$i]['orpr_fecpro'];
            $sumaTotalKilos=$sumaTotalKilos + $kilos ;
            $encontrado = false ;
            if (count($estimados) == 0 ) {
                $porc_estimado =($kilosPorcentaje / $kilos)*100 ;
                array_push($estimados,array("orden"=>$orden , "kilosPorcentaje"=>$kilosPorcentaje,"kilosTotales"=>$kilos,"kilosEstimados" =>$porc_estimado,"fecha"=>$fecha));

                $sumaTotalKilosPorcentaje=$sumaTotalKilosPorcentaje + $kilosPorcentaje ;
            }else {

                for($j = 0 ; $j < count($estimados) ;$j++){

                    if ($estimados[$j]['orden'] == $orden) {
                        $orden =$data[$i]['orpr_numero'] ;
                        $kilos =$data[$i]['Kilos'] ;
                        $poremb =  $data[$i]['fgcc_poremb'];
                        $kilosPorcentaje = $kilos * $poremb / 100 ;



                        $estimados[$j]['kilosPorcentaje'] = (float)$estimados[$j]['kilosPorcentaje'] + (float)$kilosPorcentaje ;
                        $estimados[$j]['kilosTotales'] = (float)$estimados[$j]['kilosTotales'] + (float)$kilos ;
                        $estimados[$j]['kilosEstimados'] = ($estimados[$j]['kilosPorcentaje'] / $estimados[$j]['kilosTotales'])*100 ;

                        $sumaTotalKilosPorcentaje=$sumaTotalKilosPorcentaje +  $kilosPorcentaje ;
                        $encontrado = true;
                    }

                 }

                 if (!$encontrado) {
                    $porc_estimado =($kilosPorcentaje / $kilos) * 100 ;
                    array_push($estimados,array("orden"=>$orden , "kilosPorcentaje"=>$kilosPorcentaje,"kilosTotales"=>$kilos,"kilosEstimados" =>$porc_estimado,"fecha"=>$fecha));

                    $sumaTotalKilosPorcentaje=$sumaTotalKilosPorcentaje + $kilosPorcentaje;
                 }


            }




          }
          asort($estimados);
          $conjunto = array("dataCompleta"=>$estimados , "totalKilos" => $sumaTotalKilos,"totalKilosEstimados"=>$sumaTotalKilosPorcentaje);
          return $conjunto;

    }

    function CajasPorVariedad(){

          $result = $this->db->query("dba.FGran_InformeProcesoKilos_New 4700,-1,4,-1,-1,-1,-1,-1,-1,'2017-11-01 00:00:00','2018-01-01 23:59:00',0,0,1,-1,N'*',0,709,-1,-1,0,-1,1,1,0,1,-1,-1,default,2017");
          $data=  $result->result_array();
          $CajasPorVariedad = array();
          for ($i=0; $i < count($data); $i++) {
            $encontrado = false;
              if(count($CajasPorVariedad)==0){
                array_push($CajasPorVariedad,array("variedad"=>trim($data[$i]['vari_nombre']),"cantidad_cajas"=>(int)$data[$i]['det4_totcaj']));
              }else {

                for($j = 0 ; $j < count($CajasPorVariedad); $j++ ){
                      if($CajasPorVariedad[$j]['variedad']==trim($data[$i]['vari_nombre'])){
                        $cajasAcumuladas = (int)$CajasPorVariedad[$j]['cantidad_cajas'] + (int)$data[$i]['det4_totcaj'] ;
                        $CajasPorVariedad[$j]['cantidad_cajas'] = $cajasAcumuladas;



                        $encontrado=true;
                      }
                }

                if(!$encontrado){
                    array_push($CajasPorVariedad,array("variedad"=>trim($data[$i]['vari_nombre']),"cantidad_cajas"=>(int)$data[$i]['det4_totcaj']));
                }




              }


          }

          return $CajasPorVariedad;


    }


}

 ?>
