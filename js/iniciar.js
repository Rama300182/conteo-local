
document.addEventListener('DOMContentLoaded', (event) => {
    document.querySelectorAll('#inputRubro option')[0].setAttribute('disabled', 'disabled');
});

document.querySelector('#inputRubro').addEventListener('change', function() {
    this.querySelectorAll('option').forEach(option => {
        if (option.selected && option.value === "") {
            option.selected = false;
        }
    });
});

function iniciarConteo() {
    const selectedOptions = Array.from(document.querySelectorAll('#inputRubro option:checked'));
    const selectedValues = selectedOptions.map(option => option.value);
    
    if (selectedValues.length === 0) {
        alert('Por favor, selecciona al menos un rubro.');
        return;
    }

    console.log('Selected rubros:', selectedValues);

    const formData = new FormData(document.getElementById('conteoForm'));
    formData.append('selectedRubros', JSON.stringify(selectedValues));

    // Envía los datos al backend (ajusta la URL y el método según tus necesidades)
    fetch('tu-endpoint-aqui', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        return response.json();
    })
    .then(data => {
        console.log('Success:', data);
        alert('Conteo iniciado correctamente');
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Hubo un error al iniciar el conteo.');
    });
}