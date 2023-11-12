const URL = "api/gimnasio/";

let products = [];

async function getAll() {
    try {
        let response = await fetch(URL);
        if (!response.ok) {
            throw new Error('Recurso no existe');
        }
        tasks = await response.json();
    } catch(e) {
        console.log(e);
    }
}

/**
 * Inserta la tarea via API REST
 */
async function insertProduct(e) {
    e.preventDefault();
    
    let data = new FormData(form);
    let product = {
        nombre: data.get('nombre'),
        descripcion: data.get('descripcion'),
        // LOS DEMASSS
    };

    try {
        let response = await fetch(URL, {
            method: "POST",
            headers: { 'Content-Type': 'application/json'},
            body: JSON.stringify(product)
        });
        if (!response.ok) {
            throw new Error('Error del servidor');
        }

        let nProducts = await response.json();

        // inserto la tarea nuevo
        products.push(nProducts);
        form.reset();
    } catch(e) {
        console.log(e);
    }
} 

async function deleteProduct(e) {
    e.preventDefault();
    try {
        let id = e.target.dataset.task;
        let response = await fetch(URL + id, {method: 'DELETE'});
        if (!response.ok) {
            throw new Error('Recurso no existe');
        }

        // eliminar la tarea del arreglo global
        products = products.filter(product => product.id != id);
    } catch(e) {
        console.log(e);
    }
}

