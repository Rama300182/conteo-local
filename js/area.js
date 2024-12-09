document.addEventListener('DOMContentLoaded', function() {
  let area = document.getElementById("caja");
  let btnEnviar = document.getElementById("enviar");
  let numsucElement = document.getElementById("numsuc");
  let cancel = new Audio("sound/error-170796.ogg");

  // Verifica que el elemento numsuc existe
  if (!numsucElement) {
      console.error('El elemento numsuc no se encontró');
      return; // Este return es válido porque está dentro de una función
  }

  let numsuc = parseInt(numsucElement.value, 10);

  // Verifica que numsuc sea un número válido
  if (isNaN(numsuc)) {
      console.error('El valor de numsuc no es un número válido');
      return; // Este return es válido porque está dentro de una función
  }

  area.focus();
  btnEnviar.addEventListener("click", buscarArea);
  area.addEventListener("search", buscarArea);
  area.addEventListener("keypress", function(e) {
      if (e.key === "Enter") {
          buscarArea(e);
      }
  });

  function buscarArea(e) {
      e.preventDefault();
      let ubicacion = area.value;
      let idEnc = document.querySelector("#idEnc").textContent
      fetch(`controller/ubicacion.php?area=${encodeURIComponent(ubicacion)}&idEnc=${idEnc}`)
          .then(response => response.json())
          .then(data => {
           
              if (data.status === 'error') {
                  Swal.fire({
                      icon: "error",
                      title: "Error",
                      text: data.mensaje
                  });
                  cancel.play();
              } else {
                window.location.href = `recoleccion.php?area=${encodeURIComponent(ubicacion)}&idEnc=${idEnc}`;
                 
              }
          })
          .catch(error => {
              console.error('Error:', error);
              Swal.fire({
                  icon: "error",
                  title: "Error",
                  text: "Hubo un problema al buscar la ubicación: " + error.message
              });
          });
  }

});