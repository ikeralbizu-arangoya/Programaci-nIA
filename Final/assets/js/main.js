// Carrito simple usando localStorage
function agregarCarrito(productId) {
    let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    let encontrado = false;

    carrito = carrito.map(item => {
        if(item.id === productId){
            item.cantidad += 1;
            encontrado = true;
        }
        return item;
    });

    if(!encontrado){
        carrito.push({id: productId, cantidad: 1});
    }

    localStorage.setItem('carrito', JSON.stringify(carrito));
    alert('Producto añadido al carrito');
}

// Para limpiar carrito
function vaciarCarrito() {
    localStorage.removeItem('carrito');
    alert('Carrito vaciado');
}
