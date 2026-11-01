# 📚 Diccionario de Datos - Mi Tienda

Este documento describe la estructura de la base de datos del sistema E-commerce "Mi Tienda".

## 1. Tabla: `users` (Usuarios)

| Campo | Tipo de Dato | Nulo | Clave | Descripción |
| :--- | :--- | :--- | :--- | :--- |
| `id` | BIGINT UNSIGNED | No | PK | Identificador único del usuario |
| `name` | VARCHAR(255) | No | | Nombre completo |
| `email` | VARCHAR(255) | No | UK | Correo electrónico (único) |
| `phone` | VARCHAR(255) | Sí | | Número de teléfono |
| `role` | ENUM('cliente', 'admin') | No | | Rol en el sistema |
| `password` | VARCHAR(255) | No | | Contraseña encriptada |

## 2. Tabla: `categories` (Categorías)

| Campo | Tipo de Dato | Nulo | Clave | Descripción |
| :--- | :--- | :--- | :--- | :--- |
| `id` | BIGINT UNSIGNED | No | PK | Identificador único |
| `name` | VARCHAR(255) | No | | Nombre de la categoría |
| `slug` | VARCHAR(255) | No | UK | URL amigable |

## 3. Tabla: `products` (Productos)

| Campo | Tipo de Dato | Nulo | Clave | Descripción |
| :--- | :--- | :--- | :--- | :--- |
| `id` | BIGINT UNSIGNED | No | PK | Identificador único |
| `category_id` | BIGINT UNSIGNED | No | FK | ID de la categoría |
| `name` | VARCHAR(150) | No | | Nombre del producto |
| `price` | DECIMAL(10,2) | No | | Precio de venta |
| `stock` | INT | No | | Cantidad en inventario |