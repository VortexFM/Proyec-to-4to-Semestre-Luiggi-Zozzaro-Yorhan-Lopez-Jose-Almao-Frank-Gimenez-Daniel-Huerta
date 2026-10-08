# 🛍️ Mi Tienda - E-commerce para Emprendimientos

![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-4.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Vite](https://img.shields.io/badge/Vite-8.x-646CFF?style=for-the-badge&logo=vite&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.x-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)

Plataforma de comercio electrónico desarrollada con **Laravel 13** y **Tailwind CSS v4**, diseñada para emprendimientos locales que buscan digitalizar su catálogo, gestionar pedidos y vender en línea de forma profesional.

---

## 📋 Tabla de Contenidos

- [Descripción](#-descripción)
- [Características](#-características)
- [Tecnologías](#-tecnologías)
- [Capturas de Pantalla](#-capturas-de-pantalla)
- [Requisitos Previos](#-requisitos-previos)
- [Instalación](#-instalación)
- [Estructura del Proyecto](#-estructura-del-proyecto)
- [Arquitectura CSS](#-arquitectura-css)
- [Funcionalidades](#-funcionalidades)
- [Equipo](#-equipo)
- [Licencia](#-licencia)

---

## 📖 Descripción

**Mi Tienda** es un sistema de comercio electrónico completo pensado para emprendimientos que necesitan una plataforma profesional para vender sus productos en línea.

El proyecto está dividido en tres módulos principales:

1. **Tienda pública (Cliente):** catálogo, carrito, checkout, perfil de usuario.
2. **Panel de administración (Emprendedor):** gestión de productos, pedidos, clientes y reportes.
3. **Frontend responsive:** diseño adaptado a móvil, tablet y desktop.

---

## ✨ Características

### 🛒 Tienda pública (Cliente)
- Página de inicio con hero, categorías, productos destacados y banner promocional.
- Catálogo de productos con filtros por categoría y precio.
- Detalle de producto con galería, reseñas y productos relacionados.
- Carrito de compras con estado vacío animado.
- Checkout con formulario de envío y método de pago.
- Página de confirmación de pedido.
- Login y registro con mostrar/ocultar contraseña.
- Perfil de usuario con historial de pedidos.
- Navegación por categorías.
- Página 404 personalizada.

### 🛠️ Panel de administración (Emprendedor)
- Dashboard con estadísticas (ventas, pedidos, clientes, productos).
- Gestión de productos: crear, editar, eliminar.
- Gestión de pedidos: ver detalle, cambiar estado.
- Gestión de clientes.
- Reportes con gráficos de ventas.

### 📄 Páginas informativas
- Sobre nosotros.
- Preguntas frecuentes (con acordeón).
- Contacto con formulario.
- Términos y condiciones.
- Política de privacidad.
- Política de envíos.
- Política de devoluciones.

---

## 🚀 Tecnologías

### Backend
| Tecnología | Versión | Descripción |
|------------|---------|-------------|
| Laravel | 13.x | Framework de PHP |
| PHP | 8.2+ | Lenguaje de programación |
| MySQL | 8.x | Base de datos relacional |

### Frontend
| Tecnología | Versión | Descripción |
|------------|---------|-------------|
| Tailwind CSS | 4.x | Framework de CSS utilitario |
| Vite | 8.x | Bundler y dev server |
| JavaScript | ES6+ | Interacciones dinámicas |
| Blade | - | Motor de plantillas de Laravel |

### Herramientas
| Herramienta | Descripción |
|-------------|-------------|
| Git | Control de versiones |
| GitHub | Repositorio remoto |
| Composer | Gestor de dependencias PHP |
| npm | Gestor de dependencias Node |
| VS Code | Editor de código |

---

## 📸 Capturas de Pantalla

> *Próximamente se agregarán capturas de pantalla del sistema.*

<!--
### Home
![Home](docs/screenshots/home.png)

### Catálogo
![Catálogo](docs/screenshots/catalogo.png)

### Detalle de producto
![Detalle](docs/screenshots/detalle.png)

### Carrito
![Carrito](docs/screenshots/carrito.png)

### Panel de administración
![Admin](docs/screenshots/admin.png)
-->

---

## 📦 Requisitos Previos

Antes de instalar el proyecto, asegúrate de tener:

- **PHP >= 8.2** ([descargar](https://www.php.net/downloads))
- **Composer** ([descargar](https://getcomposer.org/download/))
- **Node.js >= 18** y **npm** ([descargar](https://nodejs.org/))
- **MySQL >= 8.0** o **MariaDB >= 10.4** ([descargar](https://dev.mysql.com/downloads/))
- **Git** ([descargar](https://git-scm.com/downloads))

---

## 🔧 Instalación

Sigue estos pasos para ejecutar el proyecto en tu máquina local:

### 1. Clonar el repositorio

```bash
git clone https://github.com/VortexFM/Proyec-to-4to-Semestre-Luiggi-Zozzaro-Yorhan-Lopez-Jose-Almao-Frank-Gimenez-Daniel-Huerta.git
cd Proyec-to-4to-Semestre-Luiggi-Zozzaro-Yorhan-Lopez-Jose-Almao-Frank-Gimenez-Daniel-Huerta

### 1. Analisis y calculo de costos de desarrollo de software
1. Introduccion
El presente informe tiene como objetivo calcular el costo real de manufactura del software Mi
Tienda, aplicando la Metodología Oficial de 7 Pasos del Ing. Eduardo Nieves. Se consideranlos costos directos, operativos, mano de obra, inversión en hardware y desgaste, así comolafijación de la Banda Absoluta de Precios.

2. Datos base del proyecto:
DATO VALOR
Total horas reales trabajadas 45.0 h
Sueldo mensual (junior Venezuela) $150 USD/mes
Horas mensuales base 176 h
Gastos fijos mensuales (internet) $30 USD/mes
Inversión hardware (laptop) $200 USD (vida útil 2 años)
Insumos digitales $0

3. Desarrollo de la metodología de 7 pasos:
Paso 1: Insumos Digitales:
* Hosting: $0 (no contratado)
* Dominio: $0 (no contratado)
* SSL: $0 (no contratado)
* C_dir = $0
Paso 2: Costos Operativos Fijos:
Gastos fijos: $30/mes (internet)
Fórmula: ($30 / 176) × 45
C_op = $7.67
Paso 3: Mano de Obra Técnica:
Sueldo: $150/mes
Fórmula: ($150 / 176) × 45
C_labor = $38.35
Paso 4: Inversión Anual en Hardware:
Laptop: $200 / 2 años = $100/año
Fórmula: ($100 / 2112) × 45
C_inv = $4.26
Paso 5: Desgaste & Contingencia (20%):
Subtotal: $0 + $7.67 + $38.35 + $4.26 = $50.28
Fórmula: $50.28 × 0.20
C_desgaste = $10.06
Paso 6: Costo Total Consolidado:
Fórmula: $0 + $7.67 + $38.35 + $4.26 + $10.06
CTC = $60.34 USD

Paso 7: Banda Absoluta de Precios:
Nivel Formula Precio
Piso minimo CTC × 1.30 $78.44
Precio estandar CTC × 1.40 - 1.50 $84.48 - $90.51
Techo Enterprise CTC × 1.60 - 2.00 $96.54 -

4. Matriz de conciliación:
Ticket Descripción Rama GitFlow Horas Reales Costo MOTASK-101 Diseño BD, migraciones
modelos y
seeders
Feature/101-bd- migraciones
9.0 h $7.67
TASK-102 Maquetacion
HTM/CSS de
vistas
Feature/102- maquetacion-ui
11.0 h $9.37
TASK-103 JavaScripts:
menu, validaciones, modales
Geature/103-jsinteracciones
8.5h $7.24
TASK-104 Conexion de
vistas con BD
Feature/104- conexiones-bd
10.0 h $8.52
TASK-105 Documentacion
de repocitorio
de MQ
Feature/105- documentacion
6.5 h $5.54
TOTAL 45.0 h $38.35

5. Concluciones:
* El costo total de manufactura del software es $60.34 USD
* El precio de venta estandar (margen 40-50%) es de $84.48 - $90.51 USD. * El proyecto es rentable para en prendimiento pequeños y medianos
* Se recomienda mantener el precio dentro de la banda absoluta para no perder margen