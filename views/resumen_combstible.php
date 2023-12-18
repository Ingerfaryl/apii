<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div style="width: 70%; margin:auto;">
        <canvas id="lienzo"></canvas>
    </div>
<!-- CND chart -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const contexto = document.querySelector("#lienzo")
    const grafico = new Chart(contexto,{
        type:'pie',
        data:{
            labels: [],
            datasets:[{
                label:"Tipo combustible",
                data:[]
            }]
        }
    });
    (function(){
        fetch(`../controllers/vehiculo.controller.php?tarea=getTipoCombustible`)
        .then(respuesta => respuesta.json())
        .then(datos =>{
            
            grafico.data.labels = datos.map(registro => registro.tipocombustible)
            grafico.data.datasets[0].data = datos.map(registros => registros.total)
            grafico.update()
        })
        .catch(e=>{
            console.error(e)
        })
    })();
</Script>
</body>
</html>