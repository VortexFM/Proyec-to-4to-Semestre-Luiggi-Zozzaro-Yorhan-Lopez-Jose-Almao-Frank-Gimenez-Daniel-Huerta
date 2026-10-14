/**
 * CATEGORIES-API.JS - Consumo de la API RESTful de categorías
 */

document.addEventListener('DOMContentLoaded', () => {
    const categoriesTable = document.getElementById('categories-table');
    if (!categoriesTable) return;

    const API_URL = '/api/categorias';
    const loadingElement = document.getElementById('categories-loading');
    const errorElement = document.getElementById('categories-error');
    const tableBody = document.getElementById('categories-tbody');

    const modalCategory = document.getElementById('modal-category');
    const categoryForm = document.getElementById('category-form');
    const categorySubmit = document.getElementById('category-submit');
    const modalTitle = document.getElementById('modal-category-title');
    const btnNewCategory = document.getElementById('btn-new-category');

    /* ============================================
       ESTADOS DE UI
       ============================================ */
    function showLoading() {
        if (loadingElement) loadingElement.style.display = 'block';
        if (errorElement) errorElement.style.display = 'none';
        if (tableBody) tableBody.innerHTML = '';
    }

    function hideLoading() {
        if (loadingElement) loadingElement.style.display = 'none';
    }

    function showError(message) {
        if (errorElement) {
            errorElement.style.display = 'block';
            errorElement.innerHTML = `
                <div class="alert alert--danger">
                    <span class="alert__icon">⚠</span>
                    <div class="alert__content">
                        <p class="alert__title">Error al cargar categorías</p>
                        <p class="alert__message">${message}</p>
                    </div>
                </div>
            `;
        }
        hideLoading();
    }

    /* ============================================
       CARGAR CATEGORÍAS
       ============================================ */
    async function loadCategories() {
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
            renderCategories(data.data.data);

        } catch (error) {
            console.error('Error:', error);
            showError(error.message);
        }
    }

    /* ============================================
       RENDERIZAR CATEGORÍAS
       ============================================ */
    function renderCategories(categories) {
        if (!tableBody) return;

        tableBody.innerHTML = '';

        if (categories.length === 0) {
            tableBody.innerHTML = `
                <tr>
                    <td colspan="5" style="text-align: center;">No hay categorías disponibles.</td>
                </tr>
            `;
            hideLoading();
            return;
        }

        categories.forEach((category) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>
                    <div class="product-cell">
                        <div class="product-cell__image">${category.icon || '📦'}</div>
                        <div class="product-cell__info">
                            <strong>${category.name}</strong>
                            <small>${category.description || 'Sin descripción'}</small>
                        </div>
                    </div>
                </td>
                <td><code>${category.slug}</code></td>
                <td><span class="badge badge--primary">${category.products_count}</span></td>
                <td>
                    <span class="badge ${category.active ? 'badge--success' : 'badge--danger'}">
                        ${category.active ? 'Activa' : 'Inactiva'}
                    </span>
                </td>
                <td>
                    <div class="admin-table__actions">
                        <button class="admin-table__action admin-table__action--edit"
                                onclick="editCategory(${category.id})" title="Editar">
                            ✏️
                        </button>
                        <button class="admin-table__action admin-table__action--delete"
                                onclick="deleteCategory(${category.id})" title="Eliminar">
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
       MODAL DE CREAR/EDITAR
       ============================================ */
    function openCategoryModal(category = null) {
        if (!modalCategory) return;

        categoryForm.reset();

        if (category) {
            modalTitle.textContent = 'Editar Categoría';
            document.getElementById('category-name').value = category.name;
            document.getElementById('category-icon').value = category.icon || '';
            document.getElementById('category-description').value = category.description || '';
            document.getElementById('category-active').checked = category.active;
            categoryForm.dataset.categoryId = category.id;
        } else {
            modalTitle.textContent = 'Nueva Categoría';
            delete categoryForm.dataset.categoryId;
        }

        modalCategory.classList.add('is-open');
        modalCategory.setAttribute('aria-hidden', 'false');
        document.body.classList.add('modal-open');
    }

    function closeCategoryModal() {
        if (!modalCategory) return;
        modalCategory.classList.remove('is-open');
        modalCategory.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('modal-open');
    }

    // Abrir modal
    if (btnNewCategory) {
        btnNewCategory.addEventListener('click', () => openCategoryModal());
    }

    // Cerrar modal
    document.querySelectorAll('[data-modal-close]').forEach((btn) => {
        btn.addEventListener('click', closeCategoryModal);
    });

    if (modalCategory) {
        modalCategory.addEventListener('click', (event) => {
            if (event.target === modalCategory) closeCategoryModal();
        });
    }

    /* ============================================
       GUARDAR (CREAR/EDITAR)
       ============================================ */
    if (categoryForm) {
        categoryForm.addEventListener('submit', async (event) => {
            event.preventDefault();

            const categoryId = categoryForm.dataset.categoryId;
            const isEdit = !!categoryId;

            categorySubmit.disabled = true;
            categorySubmit.textContent = 'Guardando...';

            const formData = new FormData(categoryForm);
            const data = {
                name: formData.get('name'),
                icon: formData.get('icon') || null,
                description: formData.get('description') || null,
                active: formData.get('active') === 'on',
            };

            try {
                const url = isEdit ? `${API_URL}/${categoryId}` : API_URL;
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

                if (!response.ok) {
                    throw new Error(result.message || 'Error al guardar la categoría');
                }

                closeCategoryModal();
                loadCategories();

                if (window.Toast) {
                    window.Toast.success(
                        isEdit ? 'Categoría actualizada' : 'Categoría creada',
                        result.message
                    );
                }

            } catch (error) {
                console.error('Error:', error);
                if (window.Toast) {
                    window.Toast.danger('Error', error.message);
                }
            } finally {
                categorySubmit.disabled = false;
                categorySubmit.textContent = 'Guardar categoría';
            }
        });
    }

    /* ============================================
       EDITAR Y ELIMINAR
       ============================================ */
    window.editCategory = async function (id) {
        try {
            const response = await fetch(`${API_URL}/${id}`, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
            });

            if (!response.ok) {
                throw new Error(`Error ${response.status}: ${response.statusText}`);
            }

            const data = await response.json();
            openCategoryModal(data.data);

        } catch (error) {
            console.error('Error:', error);
            if (window.Toast) {
                window.Toast.danger('Error', 'No se pudo cargar la categoría');
            }
        }
    };

    window.deleteCategory = async function (id) {
        if (!confirm('¿Estás seguro de eliminar esta categoría?')) return;

        try {
            const response = await fetch(`${API_URL}/${id}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
            });

            const result = await response.json();

            if (!response.ok) {
                throw new Error(result.message || 'Error al eliminar la categoría');
            }

            loadCategories();

            if (window.Toast) {
                window.Toast.success('Categoría eliminada', result.message);
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
    loadCategories();
});