const URL = "api/productos/";

let products = [];

document.getElementById("id").addEventListener('click', getById());  //button

async function getAll() {
    try { //por si te confundis de enpoint
        let response = await fetch(URL); //obtengo todas com fetch, por defecto GET
        if (!response.ok) {
            throw new Error('Recurso no existe');
        }
        products = await response.json(); //cambia formato json
        console.log(products);
    } catch(e) {
        console.log(e);
    }
}


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

        // inserto la tarea nueva
        tasks.push(nProducts);
        form.reset();
    } catch(e) {
        console.log(e);
    }
} 

async function deleteProduct(e) {
    e.preventDefault();
    try {
        let id = e.target.dataset.products;
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

async function getById(){
    try { 
        let id = e.target.dataset.products;
        let response = await fetch(URL + id);
        if (!response.ok) {
            throw new Error('Recurso no existe');
        }
        products = await response.json(); //cambia formato json
        console.log(products);
    } catch(e) {
        console.log(e);
    }
}
