# Programaci-nIA
# F1 Project

**Proyecto web de Fórmula 1** que permite consultar noticias, resultados, comprar merchandising y entradas para Grandes Premios.

## Instalación

1. Clonar o descargar el repositorio.
2. Instalar XAMPP o LAMP/WAMP.
3. Crear la base de datos `f1_project` e importar el archivo SQL proporcionado.
4. Configurar `config/database.php` con tus credenciales MySQL.
5. Colocar las imágenes en `assets/img/` según las rutas indicadas.
6. Acceder desde el navegador a `http://localhost/proyecto-f1/index.php`.

## Estructura

- `/pages`: Páginas públicas.
- `/includes`: Cabeceras, pie y navegación.
- `/assets`: CSS, JS y imágenes.
- `/api`: Funciones para carrito y compras.
- `/config`: Conexión a la base de datos.

## Funcionalidades

- Noticias F1
- Resultados de carreras
- Tienda de merchandising
- Compra de entradas
- Panel administrativo CRUD completo

## Notas

- Los productos y entradas se pueden añadir desde la base de datos añadiendo una imagen en respecto a su ID.
- Los modals y botones tienen validaciones básicas.
- Compatible con PHP 8 y MySQL.

