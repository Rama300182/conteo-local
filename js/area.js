let area = document.getElementById("caja");
area.focus();
let formulario = document.getElementById("formulario");
let btnEnviar = document.getElementById("enviar");
let cancel = new Audio("sound/Stop Sound Effect.ogg");
let conexion;
let ubicacion;
/* formulario.addEventListener("submit", buscarArea); */
btnEnviar.addEventListener("click", buscarArea);
area.addEventListener("search", buscarArea);
area.addEventListener("keypress", buscarArea);
/* area.addEventListener("keypress", buscarArea); */


function buscarArea(e) {
  ubicacion = area.value;
  conexion = new XMLHttpRequest();
  conexion.onreadystatechange = procesar;
  conexion.open("GET", "controller/ubicacion.php?area=" + ubicacion, true);
  conexion.send();
}

function procesar(e) {
  if (
    conexion.readyState == 4 &&
    conexion.status == 200 &&
    conexion.readyState != 3
  ) {
    if (conexion.responseText.includes("Error")) {
      Swal.fire(
        {
          icon: "error",
          title: "Error",
          text: "Area no encontrada " + conexion.responseText,
        },
        cancel.play(),
        e.preventDefault()
      );
    } else {
      buscarAreaInventarioFinal(e, ubicacion);
    }
  }
}

function buscarAreaInventarioFinal(e, ubicacion) {
  conexion = new XMLHttpRequest();
  conexion.onreadystatechange = BuscarUbicacion;
  conexion.open("GET", "controller/ubicacion.php?ubicacion=" + ubicacion, true);
  conexion.send();
}

function BuscarUbicacion(e) {
  console.log(conexion.responseText);
  if (
    conexion.readyState == 4 &&
    conexion.status == 200 &&
    conexion.readyState != 3
  ) {
    if (conexion.responseText.includes("Error")) {
      Swal.fire(
        {
          icon: "error",
          title: "Error",
          text:
            "Ya se realizó el inventario en esta area" +
            conexion.responseText,
        },
        cancel.play(),
        e.preventDefault()
      );
    } else {
      window.location.href = "recoleccion.php?area=" + ubicacion;
    }
  }
}
