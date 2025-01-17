document.addEventListener("DOMContentLoaded", iniciarEscucha);

// Variables globales
const tabla = document.querySelector(".table");
const total = document.getElementById("total");
const ultimoIngresado = document.getElementById("ultCodigo");
const inputSearch = document.getElementById("buscarArticulo");
const iconProcesar = document.getElementById("iconConfirm");
const iconCancel = document.getElementById("iconCancel");

// Declaración e inicialización de los sonidos
let success, cancel;

// Carga los sonidos solo si el navegador soporta la API de Audio
if (typeof Audio !== 'undefined') {
  success = new Audio("sound/Confirm Button - Sound Effect (HD).ogg");
  cancel = new Audio("sound/Stop Sound Effect.ogg");
}

// Funciones
function iniciarEscucha() {
  inputSearch.addEventListener("keypress", buscarCodigo);
  iconProcesar.addEventListener("click", confirmar);
  iconCancel.addEventListener("click", cancelar);
}


async function buscarCodigo(e) {
  if (e.key === 'Enter' || e.keyCode === 13) {
    const articulo = e.target.value;
    try {

      let data = localStorage.getItem("maestroArticulos");

      data = JSON.parse(data);

      data.forEach(element => {
        if(element.COD_ARTICU == articulo || element.SINONIMO == articulo){
          agregarFila(element.COD_ARTICU, element.DESCRIPCIO);
        }
   
      });

    } catch (error) {
      console.error("Error al procesar la respuesta:", error);
      Swal.fire("Código inexistente", "", "error");
      cancel.play();
    }
    
    inputSearch.value = "";
  }
}

//Agrega fila al escanear//
function agregarFila(articulo, descripcion) {
  total.textContent = parseInt(total.textContent) + 1;
  
  const codigo = articulo.split("  ").join("");
  
  if (!document.getElementById(codigo)) {
    const tbody = document.querySelector("table tbody");
    const newRow = tbody.insertRow(-1);
    newRow.innerHTML = `
      <td class="col-codigo">${articulo}</td>
      <td class="col-descripcion" id="${codigo}">${descripcion}</td>
      <td class="col-cant">1</td>
      <td class="col-accion"><i class="fas fa-trash-alt"></i></td>
    `;
    newRow.querySelector('.fas.fa-trash-alt').addEventListener('click', confirmarBorrado);
  } else {
    const cantidadCell = document.getElementById(codigo).nextElementSibling;
    cantidadCell.textContent = parseInt(cantidadCell.textContent) + 1;
  }
  
  ultimoIngresado.textContent = codigo;
}


function confirmarBorrado(event) {
  Swal.fire({
    title: "¿Desea borrar artículo?",
    icon: "question",
    showCancelButton: true,
    confirmButtonText: "Confirmar",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      const fila = event.target.closest('tr');
      const cantidad = parseInt(fila.cells[2].textContent);
      total.textContent = parseInt(total.textContent) - cantidad;
      fila.remove();
    }
  });
}

function confirmar() {
  Swal.fire({
    title: "¿Confirmar?",
    text: "Ya no se podrán agregar artículos!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Guardar",
    cancelButtonText: "Cancelar",
    reverseButtons: true,
  }).then((result) => {
    if (result.isConfirmed) {
      guardarConteo();
    } else if (result.dismiss === Swal.DismissReason.cancel) {
      Swal.fire("Operación cancelada", "No se realizaron cambios", "info");
    }
  });
}

function guardarConteo() {
  const conteoArticulos = [];
  const usuario = document.getElementById("usuario").value;
  const ubicacion = document.getElementById("ubicacion").value;
  const numsuc = document.getElementById("numsuc").value;
  const rows = document.querySelectorAll("tbody tr");
  
  rows.forEach(row => {
    conteoArticulos.push({
      codigo: row.cells[0].textContent,
      cantidad: row.cells[2].textContent,
      usuario,
      ubicacion,
      numsuc,
      descripcion: row.cells[1].textContent
    });
  });

  if (conteoArticulos.length > 0) {
    guardarDetalle(conteoArticulos);
  } else {
    Swal.fire({
      icon: "info",
      title: "Campos vacíos",
      text: "Deben comenzar el conteo",
    });
  }
}

async function guardarDetalle (conteoArticulos) {

  const codigos = JSON.stringify(conteoArticulos);
  const numSuc = document.getElementById("numsuc").value;
  const area  = document.querySelector("#ubicacion").value;
  const idEnc = document.querySelector("#idEnc").value;
  const usuario = document.querySelector("#usuario").value



  $.ajax({
    url: "controller/guardarDetalle.php",
    method: "POST",
    data: {
      codigos: codigos,
      numSuc: numSuc,
      area: area,
      idEnc: idEnc,
      usuario: usuario
    },
    success: function (response) {
      if(response){
        checkCompletado();
 
      }
    } 
  })

}


function cancelar() {
  console.log("Función cancelar ejecutada"); // Para depuración
  Swal.fire({
    title: "¿Desea salir?",
    icon: "question",
    showCancelButton: true,
    confirmButtonText: "Aceptar",
    cancelButtonText: "Cancelar",
    reverseButtons: true,
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = "index.php";
    }
  });
}

const observer = new MutationObserver((mutations) => {
  mutations.forEach((mutation) => {
    if (mutation.type === 'childList') {
      mutation.addedNodes.forEach((node) => {
        if (node.nodeType === Node.ELEMENT_NODE) {
          const trashIcon = node.querySelector('.fas.fa-trash-alt');
          if (trashIcon) {
            trashIcon.addEventListener('click', confirmarBorrado);
          }
        }
      });
    }
  });
});

observer.observe(tabla, { childList: true, subtree: true });


const checkCompletado = () => {

  const idEnc = document.querySelector("#idEnc").value;


  $.ajax({
    url: "controller/checkCompletado.php",
    method: "POST",
    data: {
      nroConteo: idEnc
    },
    success: function (response) {
      if(response == 1 || response == true){
        window.location.href = `menu.php`;
      }else{
        window.location.href = `index.php?idEnc=${idEnc}`;
      }

    } })

} 



const traerMaestroArticulos = () => {

  const numSuc = document.getElementById("numsuc").value;

  $.ajax({
    url: "controller/traerMaestroArticulos.php",
    method: "POST",
    data: {
      numSuc: numSuc
    },
    success: function (response) {
      localStorage.setItem("maestroArticulos", response)

    } })

}

traerMaestroArticulos();