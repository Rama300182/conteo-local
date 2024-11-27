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
      const response = await fetch(`controller/articulos.php?codigo=${articulo}`);
      const data = await response.json();
      
      if (data.error) {
        throw new Error(data.error);
      }
      
      console.log(data);
      agregarFila(data.cod_articu, data.descripcio);
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
        guardarInformacion(conteoArticulos)
 
      }
    } 
  })

}

async function guardarInformacion(conteoArticulos) {
  const codigos = JSON.stringify(conteoArticulos);
  const numsuc = document.getElementById("numsuc").value;
  
  try {
    const response = await fetch(`./controller/procesar.php?codigos=${codigos}&numsuc=${numsuc}`);
    const data = await response.text();
    
    if (data.toLowerCase().includes("error")) {
      throw new Error(data);
    }
    
    await Swal.fire({
      icon: "success",
      title: "Datos agregados exitosamente!",
      text: data,
      showConfirmButton: false,
      timer: 1500
    });
    
    // Si tienes un sonido de éxito, asegúrate de que esté definido
    if (typeof success !== 'undefined' && success instanceof Audio) {
      success.play();
    }
    
    // Redirigir después de un breve retraso para asegurar que el usuario vea el mensaje
    setTimeout(() => {
      window.location.href = "index.php";
    }, 1500);
  } catch (error) {
    console.error("Error al guardar información:", error);
    await Swal.fire({
      icon: "error",
      title: "Error de carga",
      text: "Hubo un problema al procesar la solicitud: " + error.message,
    });
    
    // Si tienes un sonido de error, asegúrate de que esté definido
    if (typeof cancel !== 'undefined' && cancel instanceof Audio) {
      cancel.play();
    }
  }
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
