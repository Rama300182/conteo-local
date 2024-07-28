let bton_BorrarInventario = document.querySelector(".btn-borrar");

//Busqueda rapida//

function myFunction() {
  var input, filter, table, tr, td, td2, i, txtValue;
  input = document.getElementById("textbusq");
  filter = input.value.toUpperCase();
  table = document.getElementById("table");
  tr = table.getElementsByTagName("tr");
  //tr = document.getElementById('tr');

  for (i = 0; i < tr.length; i++) {
    visible = false;
    /* Obtenemos todas las celdas de la fila, no sólo la primera */
    td = tr[i].getElementsByTagName("td");

    for (j = 0; j < td.length; j++) {
      if (td[j] && td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
        visible = true;
      }
    }
    if (visible === true) {
      tr[i].style.display = "";
    } else {
      tr[i].style.display = "none";
    }
  }
}

//Sidebar//

$(document).ready(function () {
  if ($(window).width() >= 768) {
    if ($("#bootstrap-sidebar").hasClass("icon-menu")) {
      localStorage.setItem("default-padding", "60px");
      $("#wrapper").css("padding-left", "60px");
      console.log("icon");
    } else if ($("#bootstrap-sidebar").hasClass("text-menu")) {
      localStorage.setItem("default-padding", "150px");
      $("#wrapper").css("padding-left", "150px");
      console.log("text");
    } else if ($("#bootstrap-sidebar").hasClass("big-icon-menu")) {
      localStorage.setItem("default-padding", "100px");
      $("#wrapper").css("padding-left", "100px");
      console.log("big");
    } else {
      $("#wrapper").css("padding-left", "80px");
      localStorage.setItem("default-padding", "80px");
      console.log("ntg");
    }
  }
});

$("#menu-toggle").click(function (e) {
  e.preventDefault();
  let default_padding = localStorage.getItem("default-padding");
  var origin_padding = $("#wrapper").css("padding-left");
  if (origin_padding == "0px") {
    $("#wrapper").css("padding-left", default_padding);
  } else {
    $("#wrapper").css("padding-left", "0px");
  }
  $("#wrapper").toggleClass("toggled");
});

//Eliminar areas//

$(document).ready(function () {
  $(".btn-delete").click(function () {
    var area = "";
    // Obtenemos todos los valores contenidos en los <td> de la fila
    // seleccionada
    $(this)
      .parents("tr")
      .find("#area")
      .each(function () {
        area += $(this).html() + "\n";
      });
    console.log(area);
    Swal.fire({
      title: "Desea eliminar el area?",
      text: "Ya no se podra recuperar la informacion!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "Cancelar",
      confirmButtonText: "Aceptar",
    }).then((result) => {
      if (result.isConfirmed) {
        let env = 1;
        let url = env == 1 ? "eliminarArea.php" : "test.php";
        $.ajax({
          url: "controller/" + url,
          method: "POST",
          data: {
            area: area.replace(/\s+/g, ""),
          },
          success: function (data) {
            Swal.fire({
              icon: "success",
              title: "Area eliminada correctamente!",
              text: "Area: " + data,
              showConfirmButton: true,
            }).then(function () {
              window.location = "inventarioArea.php";
            });
          },
        });
      }
    });
  });
});


//total Areas//

$(document).ready(function () {
  var rows = 0;
  $(".areas").each(function () {
    rows++;
  });
  $("#totalArea").val(new Intl.NumberFormat("de-DE").format(rows));
});

//Total artículos//

$(document).ready(function () {
  sumarTotal();
});
const sumarTotal = () => {
  var data = [];
  $("td.sumTotal").each(function () {
    data.push(parseFloat($(this).text()));
  });
  var suma = data.reduce(function (a, b) {
    return a + b;
  }, 0);
  $("#total").val(new Intl.NumberFormat("de-DE").format(suma));
};

//Total SKU//

$(document).ready(function () {
  var rows = 0;
  $(".articulos").each(function () {
    rows++;
  });
  $("#totaSKU").val(new Intl.NumberFormat("de-DE").format(rows));
});

//Exportar a excel//

$(document).ready(() => {
  $("#btnExport").click(function () {
    $("#tableDetalle").table2excel({
      // exclude CSS class
      exclude: ".noExl",
      name: "Detalle inventario",
      filename: "Detalle inventario", //do not include extension
      fileext: ".xls", // file extension
    });
  });
});


// para que conviva addEvent y ready funcion colocar evento de bton_borrarinventario despues de bton_delete
bton_BorrarInventario.addEventListener("click", borrarInventario);

//Borrar Inventario//

let conexion;
function borrarInventario() {
  conexion = new XMLHttpRequest();
  Swal.fire({
    title: "Desea borrar el inventario?",
    text: "Se borrara de forma permanente!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",
    confirmButtonText: "Aceptar",
  }).then((result) => {
    if (result.isConfirmed) {
      conexion.onreadystatechange = procesar;
      conexion.open("GET", "controller/borrarInventario.php", false);
      conexion.send();
    }
  });
}

function procesar() {
  if (conexion.readyState == 4 && conexion.status == 200) {
    if (conexion.responseText.includes("ERROR")) {
      Swal.fire({
        icon: "error",
        title: "Inventario inexistente!",
        text: "No hay elementos para eliminar ",
      });
    } else {
      Swal.fire({
        icon: "success",
        title: "Datos eliminados correctamente",
        text: "" + conexion.responseText,
        showConfirmButton: true,
      }).then(function () {});
    }
  }
}

$('.navbar-nav>li>a').on('click', function(){
  $('.navbar-collapse').collapse('hide');
});


