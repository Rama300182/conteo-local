<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<button id="botoncito">Boton</button>


<script>


let boton = document.querySelector("#botoncito");

boton.addEventListener("click", ()=>{
    buscarCodigo()
})


function buscarCodigo(e) {

  conexion = new XMLHttpRequest();
  conexion.onreadystatechange = () => {
    if (conexion.readyState == 4 && conexion.status == 200) {
      if (!conexion.responseText.includes("error")) {
        resultado = conexion.responseText;
        console.log(resultado);
        localStorage.setItem('articulos', resultado);

      } else {
        console.log("error", conexion.responseText);
      }
     
    }
  };
  conexion.open("GET", "controller.php", false);
  conexion.send();
}



</script>
</body>
</html>