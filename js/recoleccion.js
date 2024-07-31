document.addEventListener("DOMContentLoaded", iniciarEscucha);

/*
if (
  /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
    navigator.userAgent
  )
) {
  //si es un dispositivo movil el input buscar articulo solo podrá ser utilizado por el escaner del colector.
  //esto es para que no aparezca el teclado de android y ocupe espacio en pantalla
  document.getElementById("buscarArticulo").readOnly = true;
} else {
  document.getElementById("buscarArticulo").readOnly = false;
}*/

let tabla = document.querySelector(".table");
let total = document.getElementById("total");
let ultimoIngresado = document.getElementById("ultCodigo");
let trash = document.querySelectorAll(".fa-trash-can");

let success = new Audio("sound/Confirm Button - Sound Effect (HD).ogg");
let cancel = new Audio("sound/Stop Sound Effect.ogg");

let inputSearch = document.getElementById("buscarArticulo");

let iconProcesar = document.querySelector(".fa-square-check");
let iconCancel = document.querySelector(".fa-circle-xmark");

function iniciarEscucha() {
  inputSearch.addEventListener("search", () => {
    console.log("estas buscando");
  });
  inputSearch.addEventListener("keypress", buscarCodigo);
  iconProcesar.addEventListener("click", confirmar);
  iconCancel.addEventListener("click", cancelar);
}

function buscarCodigo(e) {
  let articulo = e.target.value;
  conexion = new XMLHttpRequest();
  conexion.onreadystatechange = () => {
    if (conexion.readyState == 4 && conexion.status == 200) {
      if (!conexion.responseText.includes("error")) {
        resultado = conexion.responseText;
        console.log(resultado);
        agregarFila(articulo, resultado); //agrego elemento a la fila
      } else {
        Swal.fire("Código inexistente", "", "error");
        cancel.play();
      }
      inputSearch.value = "";
    }
  };
  conexion.open("GET", "controller/articulos.php?codigo=" + articulo, false);
  conexion.send();
}

function agregarFila(articulo, descripcion) {
  total.innerHTML = parseInt(total.innerHTML) + 1;
  //buscar articulo, si está , se suma, caso contrario se agrega a la tabla
  codigo = articulo.split("  ").join("");
  //codigos que tienen 2 espacios no genera id correctamente.
  if (!buscarCodigoEnTabla(codigo)) {
    let rows = $("tbody");
    /*  codigo=articulo.split("  ").join("");  */
    rows.append(`
    <tr>
        <td>${articulo}</td>
        <td id=${codigo}>${descripcion}</td>
        <td>1</td>
        <td><i class="fa-solid fa-trash-can"></i></td>
    </tr>
`);
  } else {
    let cod = document.getElementById(`${codigo}`);
    cod.parentElement.children[2].innerHTML =
      parseInt(cod.parentElement.children[2].innerHTML) + 1; //sumo en 1 cantidad
  }
  ultimoIngresado.innerHTML = codigo;
  trash = document.querySelectorAll(".fa-trash-can");
}

function buscarCodigoEnTabla(articulo) {
  let codigo = document.getElementById(`${articulo}`);
  let resultado;
  if (codigo != null) {
    resultado = true;
  } else {
    resultado = false;
  }

  return resultado;
}

//funciones check y cancel
function confirmar() {
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: "btn btn-success ml-2",
      cancelButton: "btn btn-danger",
    },
    buttonsStyling: false,
  });
  swalWithBootstrapButtons
    .fire({
      title: "Confirmar?",
      text: "Ya no se podran agregar articulos!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Guardar",
      cancelButtonText: "Cancelar",
      reverseButtons: true,
    })
    .then((result) => {
      if (result.isConfirmed) {
        /*  if (guardarConteo()) {
          swalWithBootstrapButtons.fire(
            "Cambios guardados",
            "Un nuevo conteo a sido guardado",
            "success"
          );
          success.play();
        } else  */ /* {
          swalWithBootstrapButtons.fire(
            "Cancelled",
            "Your imaginary file is safe :)",
            "error"
          ); */

        /*  cancel.play(); */
        /*  } */
        guardarConteo();
      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === Swal.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire("Cancelado", "", "error");

        /* cancel.play(); */
      }
    });
}

///GUARDAR TABLA EN OBJETO PARA GUARDAR INFO

function guardarConteo() {
  let conteoArticulos = [];
  let usuario = document.getElementById("usuario").value;
  let ubicacion = document.getElementById("ubicacion").value;
  let table = document.querySelector(".table");
  let rows = table.rows;
  let c = 1;
  while (c < rows.length) {
    let codigo = rows[c].children[0].innerHTML;
    let cantidad = rows[c].children[2].innerHTML;
    conteoArticulos.push({
      codigo: `${codigo}`,
      cantidad: `${cantidad}`,
      usuario: `${usuario}`,
      ubicacion: `${ubicacion}`,
    });
    c++;
  }

  if (conteoArticulos.length > 0) {
    guardarInformacion(conteoArticulos);
  } else {
    Swal.fire({
      icon: "info",
      title: "Campos vacios",
      text: "Deben comenzar el conteo",
    });
  }

  /*  return false; */ //me tiene que retornar true o false si se ejecutó la query en el back
}

function guardarInformacion(conteoArticulos) {
  conexion = new XMLHttpRequest();
  conexion.onreadystatechange = procesar;
  let codigos = JSON.stringify(conteoArticulos);
  conexion.open("GET", "./controller/procesar.php?codigos=" + codigos, false);
  conexion.send();
}

function procesar() {
  if (conexion.readyState == 4 && conexion.status == 200) {
    if (conexion.responseText.includes("Error")) {
      Swal.fire(
        {
          icon: "error",
          title: "Error de carga",
          text: "No se modificó ningún pedido! " + conexion.responseText,
        },
        cancel.play()
      );
    } else {
      Swal.fire(
        {
          icon: "success",
          title: "Datos agregados exitosamente!",
          text: "" + conexion.responseText,
          showConfirmButton: true,
        },
        success.play()
      ).then(function () {
        /* location.reload(); */
        window.location.href = "index.php";
      });
    }
  }
}

function cancelar() {
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: "btn btn-success ml-2",
      cancelButton: "btn btn-danger",
    },
    buttonsStyling: false,
  });
  swalWithBootstrapButtons
    .fire({
      title: "Desea salir?",
      text: "Se perdera la información de los artículos escaneados",
      icon: "question",
      showCancelButton: true,
      confirmButtonText: "Aceptar",
      cancelButtonText: "Cancelar",
      reverseButtons: true,
    })
    .then((result) => {
      if (result.isConfirmed) {
        window.location.href = "index.php";
      }
    });
}

const observer = new MutationObserver((mutationList) => {
  mutationList.forEach((mutation) => {
    if (mutation.addedNodes.length) {
      /*  console.log("Añadido", mutation.addedNodes[0]); */
      trash = document.querySelectorAll(".fa-trash-can");
      trash.forEach((ele) => {
        ele.addEventListener("click", () => {
          const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: "btn btn-success ml-2",
              cancelButton: "btn btn-danger",
            },
            buttonsStyling: false,
          });
          swalWithBootstrapButtons
            .fire({
              title: "Desea borrar articulo?",
              text: "",
              icon: "question",
              showCancelButton: true,
              confirmButtonText: "Confirmar",
              cancelButtonText: "Cancelar",
              reverseButtons: true,
            })
            .then((result) => {
              if (result.isConfirmed) {
                total.innerHTML=parseInt(total.innerHTML)-(ele.parentElement.parentElement.children[2].innerHTML);
                ele.parentElement.parentElement.remove();
              }
            });
          /*  console.log("helloww:"+ele.parentElement.parentElement.remove()); */
        });
      });
    }
  });
});

const table = document.querySelector("table.tr");
const observerOptions = {
  attributes: true,
  childList: true,
  subtree: true,
};

observer.observe(tabla, observerOptions);
