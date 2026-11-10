/**
 * ADDRESSES-API.JS - Consumo de la API RESTful de direcciones
 * - Listar direcciones
 * - Editar dirección
 * - Eliminar dirección
 */

document.addEventListener('DOMContentLoaded', () => {
    // Verificar que estamos en la página de direcciones
    const addressesTable = document.getElementById('addresses-table');
    if (!addressesTable) return;

    const API_URL = '/api/direcciones';
    const csrf = document.querySelector('meta[name="csrf-token"]')?.content;

    const loadingElement = document.getElementById('addresses-loading');
    const errorElement   = document.getElementById('addresses-error');
    const tableBody      = document.getElementById('addresses-tbody');

    const modalAddress = document.getElementById('modal-address');
    const addressForm  = document.getElementById('address-form');
    const modalTitle   = document.getElementById('modal-address-title');

    const filterSearch  = document.getElementById('filter-search');
    const filterEstado  = document.getElementById('filter-estado');
    const filterDefault = document.getElementById('filter-default');

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
                        <p class="alert__title">Error al cargar direcciones</p>
                        <p class="alert__message">${message}</p>
                    </div>
                </div>
            `;
        }
        hideLoading();
    }

    function mostrarErroresValidacion(errors) {
        if (!errors) return '';
        return Object.entries(errors)
            .map(([campo, mensajes]) => `• ${campo}: ${mensajes.join(', ')}`)
            .join('\n');
    }

    /* ============================================
       CARGAR ESTADOS PARA EL FILTRO
       ============================================ */
    async function cargarEstados() {
        try {
            const res = await fetch(`${API_URL}/state`, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                }
            });
            const json = await res.json();
            if (!json.success) return;

            json.data.forEach(estado => {
                const opt = document.createElement('option');
                opt.value = estado;
                opt.textContent = estado;
                filterEstado.appendChild(opt);
            });
        } catch (e) {
            console.error('Error al cargar estados:', e);
        }
    }

    /* ============================================
       CARGAR DIRECCIONES
       ============================================ */
    async function loadAddresses() {
        showLoading();

        try {
            const params = new URLSearchParams();
            if (filterSearch.value.trim())  params.set('search', filterSearch.value.trim());
            if (filterEstado.value)         params.set('state', filterEstado.value);
            if (filterDefault.value !== '') params.set('default', filterDefault.value);

            const response = await fetch(`${API_URL}?${params}`, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
            });

            if (!response.ok) {
                throw new Error(`Error ${response.status}: ${response.statusText}`);
            }

            const data = await response.json();
            renderAddresses(data.data.data);

        } catch (error) {
            console.error('Error:', error);
            showError(error.message);
        }
    }

    /* ============================================
       RENDERIZAR DIRECCIONES
       ============================================ */
    function renderAddresses(items) {
        if (!tableBody) return;

        tableBody.innerHTML = '';

        if (items.length === 0) {
            tableBody.innerHTML = `
                <tr>
                    <td colspan="6" style="text-align: center; padding: 2rem; color: #6b7280;">
                        No hay direcciones registradas
                    </td>
                </tr>
            `;
            hideLoading();
            return;
        }

        items.forEach((a) => {
            const ubicacion = [a.state, a.municipality, a.parish].filter(Boolean).join(' › ');
            const userName  = a.user ? a.user.name : '—';

            const row = document.createElement('tr');
            row.innerHTML = `
                <td><strong>${a.name}</strong></td>
                <td>${a.phone}</td>
                <td style="font-size: 0.85rem;">${ubicacion}</td>
                <td>${userName}</td>
                <td>
                    ${a.default
                        ? '<span class="badge badge--success">⭐ Default</span>'
                        : '<span class="badge badge--gray">—</span>'}
                </td>
                <td>
                    <div class="admin-table__actions">
                        <button class="admin-table__action admin-table__action--edit"
                                onclick="editAddress(${a.id})" title="Editar">✏️</button>
                        <button class="admin-table__action admin-table__action--delete"
                                onclick="deleteAddress(${a.id})" title="Eliminar">🗑️</button>
                    </div>
                </td>
            `;
            tableBody.appendChild(row);
        });

        hideLoading();
    }

     /* ============================================
       MODAL DE EDICIÓN
       ============================================ */
    function openAddressModal(address) {
        if (!modalAddress) return;

        addressForm.reset();

        modalTitle.textContent = 'Editar Dirección';
        document.getElementById('address-id').value                 = address.id;
        document.getElementById('address-name').value               = address.name;
        document.getElementById('address-phone').value              = address.phone;
        // 👇 Leemos en inglés (los nombres nuevos de la BD)
        document.getElementById('address-state').value              = address.state || '';
        document.getElementById('address-municipality').value       = address.municipality || '';
        document.getElementById('address-parish').value             = address.parish || '';
        document.getElementById('address-city').value               = address.city || '';
        document.getElementById('address-neighborhood').value       = address.neighborhood || '';
        document.getElementById('address-street').value             = address.street || '';
        document.getElementById('address-house-number').value       = address.house_number || '';
        document.getElementById('address-postal-code').value        = address.postal_code || '';
        document.getElementById('address-reference-point').value    = address.reference_point || '';
        document.getElementById('address-default').checked          = address.default;

        modalAddress.classList.add('is-open');
        modalAddress.setAttribute('aria-hidden', 'false');
        document.body.classList.add('modal-open');
    }

    function closeAddressModal() {
        if (!modalAddress) return;
        if (document.activeElement && modalAddress.contains(document.activeElement)) {
            document.activeElement.blur();
        }
        modalAddress.classList.remove('is-open');
        modalAddress.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('modal-open');
    }

    document.querySelectorAll('[data-modal-close]').forEach((btn) => {
        btn.addEventListener('click', closeAddressModal);
    });

    if (modalAddress) {
        modalAddress.addEventListener('click', (event) => {
            if (event.target === modalAddress) closeAddressModal();
        });
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modalAddress && modalAddress.classList.contains('is-open')) {
            closeAddressModal();
        }
    });

    /* ============================================
       GUARDAR (UPDATE)
       ============================================ */
    if (addressForm) {
        addressForm.addEventListener('submit', async (event) => {
            event.preventDefault();

            const addressId = document.getElementById('address-id').value;

            // 👇 Enviamos los datos en INGLÉS para que Laravel los acepte
            const payload = {
                name:              document.getElementById('address-name').value,
                phone:             document.getElementById('address-phone').value,
                state:             document.getElementById('address-state').value,
                municipality:      document.getElementById('address-municipality').value,
                parish:            document.getElementById('address-parish').value,
                city:              document.getElementById('address-city').value,
                neighborhood:      document.getElementById('address-neighborhood').value || null,
                street:            document.getElementById('address-street').value || null,
                house_number:      document.getElementById('address-house-number').value || null,
                postal_code:       document.getElementById('address-postal-code').value || null,
                reference_point:   document.getElementById('address-reference-point').value || null,
                default:           document.getElementById('address-default').checked ? 1 : 0,
            };

            try {
                const response = await fetch(`${API_URL}/${addressId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrf,
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: JSON.stringify(payload),
                });

                const result = await response.json();

                if (!response.ok) {
                    // Manejo de errores de validación
                    let errorMsg = result.message || 'Error al guardar';
                    if (result.errors) {
                        errorMsg += '\n' + Object.values(result.errors).flat().join('\n');
                    }
                    throw new Error(errorMsg);
                }

                closeAddressModal();
                loadAddresses();

                if (window.Toast) {
                    window.Toast.success('Dirección actualizada', 'Los cambios se guardaron correctamente.');
                }

            } catch (error) {
                console.error('Error:', error);
                if (window.Toast) {
                    window.Toast.danger('Error', error.message);
                } else {
                    alert(error.message);
                }
            }
        });
    }

    /* ============================================
       EDITAR Y ELIMINAR (funciones globales)
       ============================================ */
    window.editAddress = async function (id) {
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
            // 👇 Laravel devuelve { success: true, data: { ... } }, así que pasamos data.data
            openAddressModal(data.data);

        } catch (error) {
            console.error('Error:', error);
            if (window.Toast) {
                window.Toast.danger('Error', 'No se pudo cargar la dirección');
            }
        }
    };

    window.deleteAddress = async function (id) {
        if (!confirm('¿Estás seguro de eliminar esta dirección?')) return;

        try {
            const response = await fetch(`${API_URL}/${id}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrf,
                    'X-Requested-With': 'XMLHttpRequest',
                },
            });

            const result = await response.json();

            if (!response.ok) {
                throw new Error(result.message || 'Error al eliminar');
            }

            loadAddresses();

            if (window.Toast) {
                window.Toast.success('Dirección eliminada', 'La dirección se eliminó correctamente.');
            }

        } catch (error) {
            console.error('Error:', error);
            if (window.Toast) {
                window.Toast.danger('Error', error.message);
            }
        }
    };

    /* ============================================
       FILTROS
       ============================================ */
    let debounceTimer;
    if (filterSearch) {
        filterSearch.addEventListener('input', () => {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(loadAddresses, 400);
        });
    }

    if (filterEstado)  filterEstado.addEventListener('change', loadAddresses);
    if (filterDefault) filterDefault.addEventListener('change', loadAddresses);

    /* ============================================
       INICIALIZAR
       ============================================ */
    cargarEstados();
    loadAddresses();
});