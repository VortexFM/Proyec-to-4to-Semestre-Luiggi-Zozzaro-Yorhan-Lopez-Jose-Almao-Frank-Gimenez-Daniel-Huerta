document.addEventListener('DOMContentLoaded', () => {
    // Verificar que estamos en la página de productos
    const productsTable = document.getElementById('products-table');
    if (!productsTable) return;

    const API_URL = '/api/productos';
    const loadingElement = document.getElementById('products-loading');
    const errorElement = document.getElementById('products-error');
    const tableBody = document.getElementById('products-tbody');

    const modalProduct = document.getElementById('modal-product');
    const productForm = document.getElementById('product-form');
    const productSubmit = document.getElementById('product-submit');
    const modalTitle = document.getElementById('modal-product-title');

    /* ============================================
       CARGAR CATEGORÍAS EN LOS SELECTS
       ============================================ */
    async function loadCategoriesSelects() {
        try {
            const res = await fetch('/api/categorias', {
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
            });
            const json = await res.json();
            
            const categorias = json.data.data || json.data;

            const selectFilter = document.getElementById('filter-category');
            const selectModal = document.getElementById('product-category');

            if (selectFilter) {
                selectFilter.innerHTML = '<option value="">Todas las categorías</option>';
                categorias.forEach(cat => {
                    selectFilter.innerHTML += `<option value="${cat.id}">${cat.name}</option>`;
                });
            }

            if (selectModal) {
                selectModal.innerHTML = '<option value="">Seleccione una categoría</option>';
                categorias.forEach(cat => {
                    selectModal.innerHTML += `<option value="${cat.id}">${cat.name}</option>`;
                });
            }
        } catch (error) {
            console.error("Error al cargar categorías:", error);
        }
    }

    loadCategoriesSelects();

    /* ============================================
       CARGAR PRODUCTOS
       ============================================ */
    async function loadProducts() {
        if (loadingElement) loadingElement.style.display = 'block';
        if (errorElement) errorElement.style.display = 'none';
        if (tableBody) tableBody.innerHTML = '';

        const search = document.getElementById('filter-search')?.value || '';
        const category = document.getElementById('filter-category')?.value || '';
        const status = document.getElementById('filter-status')?.value || '';

        const params = new URLSearchParams();
        if (search) params.append('search', search);
        if (category) params.append('category_id', category);
        if (status !== '') params.append('active', status);

        try {
            const response = await fetch(`${API_URL}?${params.toString()}`, {
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
            });

            if (!response.ok) throw new Error(`Error ${response.status}`);

            const data = await response.json();
            renderProducts(data.data.data);

        } catch (error) {
            console.error('Error:', error);
            if (errorElement) {
                errorElement.style.display = 'block';
                errorElement.innerHTML = `<p style="color:red">Error: ${error.message}</p>`;
            }
        } finally {
            if (loadingElement) loadingElement.style.display = 'none';
        }
    }

    function renderProducts(products) {
        if (!tableBody) return;
        tableBody.innerHTML = '';

        if (products.length === 0) {
            tableBody.innerHTML = `<tr><td colspan="6" style="text-align: center;">No hay productos disponibles.</td></tr>`;
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
                <td><span class="badge ${product.active ? 'badge--success' : 'badge--danger'}">${product.active ? 'Activo' : 'Inactivo'}</span></td>
                <td>
                    <div class="admin-table__actions">
                        <button class="admin-table__action admin-table__action--edit" onclick="editProduct(${product.id})" title="Editar">✏️</button>
                        <button class="admin-table__action admin-table__action--delete" onclick="deleteProduct(${product.id})" title="Eliminar">🗑️</button>
                    </div>
                </td>
            `;
            tableBody.appendChild(row);
        });
    }

    /* ============================================
       EVENTOS DEL MODAL
       ============================================ */
    const btnNewProduct = document.getElementById('btn-new-product');
    if (btnNewProduct) {
        btnNewProduct.addEventListener('click', (event) => {
            event.preventDefault();
            openProductModal();
        });
    }

    function openProductModal(product = null) {
        if (!modalProduct) return;
        productForm.reset();

        if (product) {
            modalTitle.textContent = 'Editar Producto';
            document.getElementById('product-name').value = product.name;
            document.getElementById('product-category').value = product.category_id;
            document.getElementById('product-description').value = product.description;
            document.getElementById('product-price').value = product.price;
            document.getElementById('product-sale-price').value = product.sale_price || '';
            document.getElementById('product-stock').value = product.stock;
            document.getElementById('product-sku').value = product.sku || '';
            document.getElementById('product-featured').checked = product.featured;
            document.getElementById('product-active').checked = product.active;
            productForm.dataset.productId = product.id;
        } else {
            modalTitle.textContent = 'Nuevo Producto';
            delete productForm.dataset.productId;
        }

        modalProduct.classList.add('is-open');
        modalProduct.setAttribute('aria-hidden', 'false');
    }

    function closeProductModal() {
        if (!modalProduct) return;
        modalProduct.classList.remove('is-open');
        modalProduct.setAttribute('aria-hidden', 'true');
    }

    document.querySelectorAll('[data-modal-close]').forEach((btn) => {
        btn.addEventListener('click', closeProductModal);
    });

    if (modalProduct) {
        modalProduct.addEventListener('click', (event) => {
            if (event.target === modalProduct) closeProductModal();
        });
    }

    /* ============================================
       GUARDAR Y EDITAR
       ============================================ */
    if (productForm) {
        productForm.addEventListener('submit', async (event) => {
            event.preventDefault();
            const productId = productForm.dataset.productId;
            const isEdit = !!productId;

            productSubmit.disabled = true;
            productSubmit.textContent = 'Guardando...';

            const formData = new FormData(productForm);
            const data = {
                category_id: parseInt(formData.get('category_id')),
                name: formData.get('name'),
                description: formData.get('description'),
                price: parseFloat(formData.get('price')),
                sale_price: formData.get('sale_price') ? parseFloat(formData.get('sale_price')) : null,
                stock: parseInt(formData.get('stock')),
                sku: formData.get('sku') || null,
                featured: formData.get('featured') === 'on',
                active: formData.get('active') === 'on',
            };

            try {
                const url = isEdit ? `${API_URL}/${productId}` : API_URL;
                const method = isEdit ? 'PUT' : 'POST';

                const response = await fetch(url, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: JSON.stringify(data),
                });

                const result = await response.json();
                if (!response.ok) throw new Error(result.message || 'Error al guardar');

                closeProductModal();
                loadProducts();
                if (window.Toast) window.Toast.success(isEdit ? 'Producto actualizado' : 'Producto creado', result.message);

            } catch (error) {
                console.error('Error:', error);
                if (window.Toast) window.Toast.danger('Error', error.message);
            } finally {
                productSubmit.disabled = false;
                productSubmit.textContent = 'Guardar Producto';
            }
        });
    }

    window.editProduct = async function (id) {
        try {
            const response = await fetch(`${API_URL}/${id}`, { headers: { 'Accept': 'application/json' } });
            if (!response.ok) throw new Error(`Error ${response.status}`);
            const data = await response.json();
            openProductModal(data.data);
        } catch (error) {
            console.error('Error:', error);
            if (window.Toast) window.Toast.danger('Error', 'No se pudo cargar el producto');
        }
    };

    window.deleteProduct = async function (id) {
        if (!confirm('¿Estás seguro de eliminar este producto?')) return;
        try {
            const response = await fetch(`${API_URL}/${id}`, {
                method: 'DELETE',
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
            });
            if (!response.ok) throw new Error(`Error ${response.status}`);
            loadProducts();
            if (window.Toast) window.Toast.success('Producto eliminado', 'El producto se eliminó correctamente');
        } catch (error) {
            console.error('Error:', error);
            if (window.Toast) window.Toast.danger('Error', error.message);
        }
    };

    const btnApplyFilters = document.getElementById('btn-apply-filters');
    if (btnApplyFilters) {
        btnApplyFilters.addEventListener('click', () => loadProducts());
    }

    loadProducts();
});