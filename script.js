let pizzaEditandoId = null; // Variable para almacenar el ID de la pizza que se está editando

// Función para cargar los datos de una pizza en el formulario de edición
function cargarPizzaEnFormulario(pizza) {
    document.getElementById('edit-masa').value = pizza.masa;
    document.getElementById('edit-especialidad').value = pizza.especialidad;
    document.getElementById('edit-precio').value = pizza.precio;
    document.getElementById('edit-cliente').value = pizza.cliente;

    pizzaEditandoId = pizza.id; // Guardar el ID para identificar la pizza que se está editando
}

// Función para manejar el envío del formulario de edición
document.getElementById('pizzaForm2').addEventListener('submit', function (e) {
    e.preventDefault();

    if (!pizzaEditandoId) {
        alert('No hay pizza seleccionada para editar.');
        return;
    }

    const pizzaData = {
        id: pizzaEditandoId,
        masa: document.getElementById('edit-masa').value,
        especialidad: document.getElementById('edit-especialidad').value,
        precio: document.getElementById('edit-precio').value,
        cliente: document.getElementById('edit-cliente').value
    };

    fetch('editar_pizza.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(pizzaData)
    })
        .then(response => response.json())
        .then(data => {
            alert(data.mensaje);
            document.getElementById('pizzaForm2').reset();
            pizzaEditandoId = null; // Reiniciar el estado de edición
            obtenerPizzas(); // Actualizar la tabla
        })
        .catch(error => console.error('Error:', error));
});

// Función para obtener todas las pizzas (actualizada para incluir el enlace de edición)
function obtenerPizzas() {
    fetch('select_pizza.php')
        .then(response => response.json())
        .then(data => {
            const tbody = document.querySelector('table tbody');
            tbody.innerHTML = ''; // Limpiar el contenido previo

            if (data.length === 0) {
                document.getElementById('resultado').innerText = 'No hay pizzas disponibles.';
            } else {
                data.forEach(pizza => {
                    const fila = document.createElement('tr');
                    fila.innerHTML = `
                        <td>${pizza.id}</td>
                        <td>${pizza.masa}</td>
                        <td>${pizza.especialidad}</td>
                        <td>${pizza.precio}</td>
                        <td>${pizza.cliente}</td>
                        <td>
                            <a href="#" onclick='cargarPizzaEnFormulario(${JSON.stringify(pizza)})'>Editar</a> | 
                            <a href="#" onclick="eliminarPizza(${pizza.id})">Eliminar</a>
                        </td>
                    `;
                    tbody.appendChild(fila);
                });
            }
        })
        .catch(error => console.error('Error:', error));
}

// Cargar las pizzas al inicio
document.addEventListener('DOMContentLoaded', obtenerPizzas);
