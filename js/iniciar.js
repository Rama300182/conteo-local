const finalizarConteo = () =>{
    let nroConteo = document.querySelector("#nroConteo").textContent;

    Swal.fire({
        title: "Finalizar Conteo?",
        text: `Desea finalizar el Conteo  Nro:${nroConteo}?`,
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Confirmar",
        cancelButtonText: "Cancelar"
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "controller/finalizar.php",
                method: "POST",
                data: {
                  nroConteo:nroConteo
                },
                success: function (response) {}
            })
        }})

}

const descargarConteo = (nroSuc) => {
    $.ajax({
        url: "controller/descargarConteo.php",
        method: "POST",
        data: {
            nroSuc: nroSuc
        },
        success: function (response) {
          
            const rawData = JSON.parse(response);

          
            const data = rawData.map(item => ({
                ...item, 
                FECHA_SCAN: item.FECHA_SCAN?.date || "N/A" 
            }));

           
            exportToExcel(data, `Conteo_${nroSuc}.xlsx`);
        }
    });
};


const exportToExcel = (data, filename) => {

    const worksheet = XLSX.utils.json_to_sheet(data);
    const workbook = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(workbook, worksheet, "Datos");

    XLSX.writeFile(workbook, filename);
};


const descargarComparativo = (nroSucursal, nroConteo) => {

    if(!nroConteo || nroConteo == '' || nroConteo == undefined ){
        alert('no existe conteo') 
        return 1
    }

    $.ajax({
        url: "controller/descargarComparativo.php",
        method: "POST",
        data: {
            nroSuc: nroSucursal,
            nroConteo: nroConteo
        },
        success: function (response) {
          
            const rawData = JSON.parse(response);

          
            const data = rawData.map(item => ({
                ...item, 
                FECHA_SCAN: item.FECHA_SCAN?.date || "N/A" 
            }));

           
            exportToExcel(data, `Conteo_${nroSucursal}.xlsx`);
        }
    });

}