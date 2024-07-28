

 function guardarUsuario(){
    var nombre = document.getElementById('nombre').value;
    var user = document.getElementById('user').value;
    var pass = document.getElementById('pass').value;
    var rol = document.getElementById('rol').value;

    if(nombre != '' && user != '' && pass != '' && rol != ''){
        Swal.fire({
            icon: 'info',
            title: 'Desea crear el usuario?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Guardar',
            denyButtonText: `No guardar`,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                let env = 1;
                let url = (env == 1) ? 'altaUser.php' : 'test.php';
                $.ajax({
                    url: 'controller/'+url,
                    method: 'POST',
                    data: {
                        nombre: nombre,
                        user: user,
                        pass: pass,
                        rol: rol,
                    },
                });
                Swal.fire('Usuario creado correctamente!', '', 'success')
                    .then(function () {
                    window.location = "menu.php";
                });
            } else if (result.isDenied) {
                Swal.fire('El usuario no fue creado', '', 'info')
                .then(function () {
                    window.location = "menu.php";
                });
            }
            })
            } else {
        Swal.fire({
            icon: 'info',
            title: 'Atención',
            text: 'Debe llenar todos los campos!',
            })
    }
}

document.addEventListener('DOMContentLoaded',iniciar);

//Valida los input//
function validarTextoEntrada(input, patron) {
    var texto = input.value

    var letras = texto.split("")

    for (var x in letras) {
        var letra = letras[x]

        if (!(new RegExp(patron, "i")).test(letra)) {
            letras[x] = ""
        }
    }

    input.value = letras.join("")
}

//Restringe al ingreso de texto solamente//
var txtSoloLetras = document.getElementsByClassName("soloText")
txtSoloLetras.addEventListener("input", function (event) {
    validarTextoEntrada(this, "[a-z ]")
})

function iniciar()
{
    var txtCurp=document.querySelectorAll('.mayusc');

    txtCurp.forEach(ele=>ele.addEventListener('input', function (event) {
        this.value = this.value.toUpperCase();
    }));
}

    //Eliminar Usuario por User//

    function eliminarUsuario(){
        // var user = ""
        document.querySelectorAll(".click").forEach(el => {
        el.addEventListener("click", e => {
            var user = e.target.getAttribute('value');
            // console.log("Se ha clickeado el nombre "+user);
            Swal.fire({
            title: "Desea eliminar el usuario?",
            text: "El usuario será eliminado de manera permanente!",
            icon: "info",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Cancelar",
            confirmButtonText: "Aceptar",
            }).then((result) => {
            if (result.isConfirmed) {
                let env = 1;
                let url = env == 1 ? "eliminarUser.php" : "test.php";
                $.ajax({
                url: "controller/" + url,
                method: "POST",
                data: {
                    user: user,
                },
                success: function (data) {
                    Swal.fire({
                    icon: "success",
                    title: "Usuario eliminado correctamente!",
                    text: "Usuario: " + data,
                    showConfirmButton: true,
                    }).then(function () {
                    window.location = "userList.php";
                            });
                        },
                    });
                }
            });
        },true);
    });
}

/*
 */