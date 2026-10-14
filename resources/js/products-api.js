/**
 * PRODUCTS-API.JS - Consumo de la API RESTful de productos
 * - Listar productos
 * - Crear producto
 * - Editar producto
 * - Eliminar producto
 */

document.addEventListener('DOMContentLoaded', () => {
    // Verificar que estamos en la página de productos
    const productsTable = document.getElementById('products-table');
    if (!productsTable) return;

    const API_URL = '/api/productos';
    const loadingElement = document.getElementById('products-loading');
    const errorElement = document.getElementById('products-error');
    const tableBody = document.getElementById('products-tbody');

    /* ============================================
       ESTADO DE CARGA (LOADING)
       ============================================ */
    function showLoading() {
        if (loadingElement) loadingElement.style.display = 'block';
        if (errorElement) errorElement.style.display = 'none';
        if (tableBody) tableBody.innerHTML = '';
    }

    function hideLoading() {
        if (loadingElement) loadingElement.style.display = 'none';
    }

    /* ============================================
       ESTADO DE ERROR
       ============================================ */
    function showError(message) {
        if (errorElement) {
            errorElement.style.display = 'block';
            errorElement.innerHTML = `
                <section class="alert alert--danger">
                    <span class="alert__icon">⚠</span>
                    <section class="alert__content">
                        <p class="alert__title">Error al cargar productos</p>
                        <p class="alert__message">${message}</p>
                    </section>
                </section>
            `;
        }
        hideLoading();
    }

    /* ============================================
       CARGAR PRODUCTOS DESDE LA API
       ============================================ */
    async function loadProducts() {
        showLoading();

        try {
            const response = await fetch(API_URL, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
            });

            if (!response.ok) {
                throw new Error(`Error ${response.status}: ${response.statusText}`);
            }

            const data = await response.json();
            renderProducts(data.data.data);

        } catch (error) {
            console.error('Error:', error);
            showError(error.message);
        }
    }

    /* ============================================
       RENDERIZAR PRODUCTOS EN LA TABLA
       ============================================ */
    function renderProducts(products) {
        if (!tableBody) return;

        tableBody.innerHTML = '';

        if (products.length === 0) {
            tableBody.innerHTML = `
                <tr>
                    <td colspan="6" style="text-align: center;">No hay productos disponibles.</td>
                </tr>
            `;
            hideLoading();
            return;
        }

        products.forEach((product) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>
                    <div class="product-cell">
                        <div class="product-cell__image">IMG</div>
                        <div class="product-cell__info">
                            <strong>${product.name}</strong>
                            <small>${product.sku || 'Sin SKU'}</small>
                        </div>
                    </div>
                </td>
                <td>${product.category ? product.category.name : 'Sin categoría'}</td>
                <td><strong>$${parseFloat(product.price).toFixed(2)}</strong></td>
                <td>${product.stock}</td>
                <td>
                    <span class="badge ${product.active ? 'badge--success' : 'badge--danger'}">
                        ${product.active ? 'Activo' : 'Inactivo'}
                    </span>
                </td>
                <td>
                    <div class="admin-table__actions">
                        <button class="admin-table__action admin-table__action--edit" 
                                onclick="editProduct(${product.id})" title="Editar">
                            ✏️
                        </button>
                        <button class="admin-table__action admin-table__action--delete" 
                                onclick="deleteProduct(${product.id})" title="Eliminar">
                            🗑️
                        </button>
                    </div>
                </td>
            `;
            tableBody.appendChild(row);
        });

        hideLoading();
    }

    /* ============================================
       EXPONER FUNCIONES GLOBALES
       ============================================ */
    window.editProduct = function (id) {
        // Redirigir a la página de edición
        window.location.href = `/admin/productos/${id}/editar`;
    };

    window.deleteProduct = async function (id) {
        if (!confirm('¿Estás seguro de eliminar este producto?')) return;

        try {
            const response = await fetch(`${API_URL}/${id}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
            });

            if (!response.ok) {
                throw new Error(`Error ${response.status}: ${response.statusText}`);
            }

            // Recargar la lista
            loadProducts();

            // Mostrar toast de éxito
            if (window.Toast) {
                window.Toast.success('Producto eliminado', 'El producto se eliminó correctamente');
            }

        } catch (error) {
            console.error('Error:', error);
            if (window.Toast) {
                window.Toast.danger('Error', error.message);
            }
        }
    };

    /* ============================================
       INICIALIZAR
       ============================================ */
    loadProducts();
});