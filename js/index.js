$(document).ready(function(){

  // $.ajax({
  //   url : 'https://content-sheets.googleapis.com/v4/spreadsheets/1XNRxC95ilbBflm1a-Nt56i0uc2mVUEqajZ_UbIX4eYo/values/A19:IN1000',
  //   method:'get',
  //   dataType:'json',
  //   data:{
  //     majorDimension:'ROWS',
  //     access_token:'AIzaSyCc6Y_yXdDHb3gARMkqJeREPt0yX37EV3I',
  //     key:'AIzaSyCc6Y_yXdDHb3gARMkqJeREPt0yX37EV3I'
  //   }
  // }).done(function(respuesta){
  //   console.log(respuesta);
  //
  // })




  $('#kilosPorOrden').DataTable();
  $('#kilosPorOrdenAbiertas').DataTable();



  $.ajax({
    url:base_url+"index.php/kpi/CajasPorVariedad",
		dataType:"json",
		method:"POST"
	}).done(function(respuesta){
    console.log(respuesta)

    let data="";

    for (var i = 0; i < respuesta.length; i++) {

      data = data + `
        <div class="col xl2 m4 s4">

          <div class="card">

            <div class="card-content">
              <div class="card-title">
                ${respuesta[i].variedad}
                <hr>
              </div>
              <div class="row">

                <div class="col m3 s12 box valign-wrapper purple darken-1 ">
                  <i class="material-icons center-align">move_to_inbox</i>
                </div>

                <div class="col m9 s12 valign-wrapper boxResult">
                  <p class="bold">  ${respuesta[i].cantidad_cajas} Cjs</p>
                </div>

              </div>
            </div>

          </div>
        </div>

      `



    }

    $(".CajasPorVariedad").html(data)




  })







});
