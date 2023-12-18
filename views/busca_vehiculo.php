<!doctype html>
<html lang="es">
    <head>
        <title>Buscador de autos</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

        <!-- Bootstrap CSS v5.2.1 -->
        <link 
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
          rel="stylesheet" 
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
          crossorigin="anonymous"/>
    </head>

    <body>
    <div class="container">
      <div class="card mt-2">
        <div class="card-header bg-success">
          <span class="text-light"> Buscador de Placas</span>
        </div>
        <div class="card-body">
          <form id="formdebusqueda" autocomplete="off">
            <p id="cargar"></p>
            <div class="mb-3">
              <label for="placa" class="form-label">Placa: </label>
              <div class=" input-group">
                <input type="text" maxlength="7" id="placa" class="form-control">
                <button class=" btn bg-success" type="button" id="buscar">Buscar</button>
              </div>
              <small id="status"> no hay busquedas activas </small>
            </div>
            <div class="mb-3">
              <label for="marca" class="form-label">Marca: </label>
              <input type="text" id="marca" class="form-control" readonly>
            </div>
            <div class="mb-3">
              <label for="modelo" class="form-label">Modelo:</label>
              <input type="text" id="modelo" class="form-control" readonly>
            </div>
            <div class="mb-3">
              <label for="color" class="form-label">Color:</label>
              <input type="text" id="color" class="form-control" readonly>
            </div>
            <div class="mb-3">
              <label for="tipocombustible" class="form-label">Tipo de Combustible:</label>
              <input type="text" id="tipocombustible" class="form-control" readonly>
            </div>
            <div class="mb-3">
              <label for="peso" class="form-label">Peso:</label>
              <input type="text" id="peso" class="form-control" readonly>
            </div>
            <div class="mb-3">
              <label for="afabricacion" class="form-label">Año de fabricación:</label>
              <input type="text" id="afabricacion" class="form-control" readonly>
            </div>
          </form>
        </div>
      </div>
    </div>
    <script>
      document.addEventListener("DOMContentLoaded",()=>{
        function $(id){return document.querySelector(id)}
        function buscarPlaca(){
          const placa = $("#placa").value
          if(placa != ""){
            const parametros = new FormData()
            parametros.append("tarea", "search")
            parametros.append("placa",placa)
            $("#status").innerHTML = "Buscando, por favor espere..."
            fetch(`../controllers/vehiculo.controller.php`,{
              method: "POST",
              body: parametros
            })

            .then(respuesta => respuesta.json())
            .then(datos=>{
              
              if(!datos){
                $("#status").innerHTML ="No se encontró el registro"
                $("#formBusqueda").reset()
                $("#placa").focus()
              }else{
                $("#status").innerHTML ="Vehiculo encontrado"
                $("#marca").value = datos.marca
                $("#modelo").value = datos.modelo
                $("#color").value = datos.color
                $("#tipocombustible").value = datos.tipocombustible
                $("#peso").value = datos.peso
                $("#afabricacion").value = datos.afabricacion
              }
            })
            .catch(e=>{
              console.error(e)
            })
          }
        }
        $("#placa").addEventListener("keypress",(event)=>{
          if(event.keyCode ==13){
            buscarPlaca()
          }
        });
        $("#buscar").addEventListener("click",buscarPlaca)
      })
    </script>
  </body>
</html>
