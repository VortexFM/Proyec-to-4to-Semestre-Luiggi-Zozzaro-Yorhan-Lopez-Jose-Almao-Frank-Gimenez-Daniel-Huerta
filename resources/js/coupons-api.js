/**
 * COUPONS-API.JS - Consumo de la API RESTful de cupones
 * - Listar cupones
 * - Crear cupón
 * - Editar cupón
 * - Eliminar cupón
 */

document.addEventListener('DOMContentLoaded', () => {
    // Verificar que estamos en la página de cupones
    const couponsTable = document.getElementById('coupons-table');
    if (!couponsTable) return;

    const API_URL = '/api/cupones';
    const csrf = document.querySelector('meta[name="csrf-token"]')?.content;

    const loadingElement = document.getElementById('coupons-loading');
    const errorElement   = document.getElementById('coupons-error');
    const tableBody      = document.getElementById('coupons-tbody');

    const modalCoupon = document.getElementById('modal-coupon');
    const couponForm  = document.getElementById('coupon-form');
    const modalTitle  = document.getElementById('modal-coupon-title');

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
                        <p class="alert__title">Error al cargar cupones</p>
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
       CARGAR CUPONES
       ============================================ */
    async function loadCoupons() {
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
            renderCoupons(data.data.data);

        } catch (error) {
            console.error('Error:', error);
            showError(error.message);
        }
    }

    /* ============================================
       RENDERIZAR CUPONES
       ============================================ */
    function renderCoupons(coupons) {
        if (!tableBody) return;

        tableBody.innerHTML = '';

        if (coupons.length === 0) {
            tableBody.innerHTML = `
                <tr>
                    <td colspan="7" style="text-align: center; padding: 2rem; color: #6b7280;">
                        No hay cupones registrados
                    </td>
                </tr>
            `;
            hideLoading();
            return;
        }

        coupons.forEach((coupon) => {
            const fechaDesde = new Date(coupon.valid_from).toLocaleDateString('es-ES');
            const fechaHasta = new Date(coupon.valid_until).toLocaleDateString('es-ES');

            const row = document.createElement('tr');
            row.innerHTML = `
                <td>
                    <strong style="color: var(--color-primary); font-family: monospace;">
                        ${coupon.code}
                    </strong>
                </td>
                <td>${coupon.discount}%</td>
                <td>${coupon.min_amount ? '$' + parseFloat(coupon.min_amount).toFixed(2) : '—'}</td>
                <td style="font-size: 0.85rem;">${fechaDesde} → ${fechaHasta}</td>
                <td>${coupon.uses}${coupon.max_uses ? ' / ' + coupon.max_uses : ''}</td>
                <td>
                    <span class="badge ${coupon.active ? 'badge--success' : 'badge--gray'}">
                        ${coupon.active ? 'Activo' : 'Inactivo'}
                    </span>
                </td>
                <td>
                    <div class="admin-table__actions">
                        <button class="admin-table__action admin-table__action--edit"
                                onclick="editCoupon(${coupon.id})" title="Editar">✏️</button>
                        <button class="admin-table__action admin-table__action--delete"
                                onclick="deleteCoupon(${coupon.id})" title="Eliminar">🗑️</button>
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
    function openCouponModal(coupon = null) {
        if (!modalCoupon) return;

        couponForm.reset();

        if (coupon) {
            modalTitle.textContent = 'Editar Cupón';
            document.getElementById('coupon-id').value         = coupon.id;
            document.getElementById('coupon-code').value       = coupon.code;
            document.getElementById('coupon-discount').value   = coupon.discount;
            document.getElementById('coupon-min-amount').value = coupon.min_amount || 0;
            document.getElementById('coupon-valid-from').value = coupon.valid_from ? coupon.valid_from.split('T')[0] : '';
            document.getElementById('coupon-valid-until').value= coupon.valid_until ? coupon.valid_until.split('T')[0] : '';
            document.getElementById('coupon-max-uses').value   = coupon.max_uses || '';
            document.getElementById('coupon-active').checked   = coupon.active;
        } else {
            modalTitle.textContent = 'Nuevo Cupón';

            const hoy = new Date().toISOString().split('T')[0];
            const mes = new Date(Date.now() + 30 * 86400000).toISOString().split('T')[0];
            document.getElementById('coupon-valid-from').value  = hoy;
            document.getElementById('coupon-valid-until').value = mes;
            document.getElementById('coupon-min-amount').value  = 0;
            document.getElementById('coupon-active').checked    = true;
        }

        modalCoupon.classList.add('is-open');
        modalCoupon.setAttribute('aria-hidden', 'false');
        document.body.classList.add('modal-open');
    }

    function closeCouponModal() {
        if (!modalCoupon) return;
        if (document.activeElement && modalCoupon.contains(document.activeElement)) {
            document.activeElement.blur();
        }
        modalCoupon.classList.remove('is-open');
        modalCoupon.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('modal-open');
    }

    // Botón "+ Nuevo cupón"
    const btnNewCoupon = document.getElementById('btn-new-coupon');
    if (btnNewCoupon) {
        btnNewCoupon.addEventListener('click', () => openCouponModal());
    }

    // Cerrar modal
    document.querySelectorAll('[data-modal-close]').forEach((btn) => {
        btn.addEventListener('click', closeCouponModal);
    });

    if (modalCoupon) {
        modalCoupon.addEventListener('click', (event) => {
            if (event.target === modalCoupon) closeCouponModal();
        });
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modalCoupon && modalCoupon.classList.contains('is-open')) {
            closeCouponModal();
        }
    });

    /* ============================================
       GUARDAR (CREAR/EDITAR)
       ============================================ */
    if (couponForm) {
        couponForm.addEventListener('submit', async (event) => {
            event.preventDefault();

            const couponId = document.getElementById('coupon-id').value;
            const isEdit = !!couponId;

            const payload = {
                code:        document.getElementById('coupon-code').value.toUpperCase(),
                discount:    parseFloat(document.getElementById('coupon-discount').value),
                min_amount:  parseFloat(document.getElementById('coupon-min-amount').value || 0),
                valid_from:  document.getElementById('coupon-valid-from').value,
                valid_until: document.getElementById('coupon-valid-until').value,
                max_uses:    document.getElementById('coupon-max-uses').value || null,
                active:      document.getElementById('coupon-active').checked ? 1 : 0,
            };

            const url    = isEdit ? `${API_URL}/${couponId}` : API_URL;
            const method = isEdit ? 'PUT' : 'POST';

            try {
                const response = await fetch(url, {
                    method: method,
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
                    const errores = mostrarErroresValidacion(result.errors);
                    throw new Error((result.message || 'Error') + (errores ? '\n\n' + errores : ''));
                }

                closeCouponModal();
                loadCoupons();

                if (window.Toast) {
                    window.Toast.success(
                        isEdit ? 'Cupón actualizado' : 'Cupón creado',
                        result.message
                    );
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
    window.editCoupon = async function (id) {
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
            openCouponModal(data.data);

        } catch (error) {
            console.error('Error:', error);
            if (window.Toast) {
                window.Toast.danger('Error', 'No se pudo cargar el cupón');
            }
        }
    };

    window.deleteCoupon = async function (id) {
        if (!confirm('¿Estás seguro de eliminar este cupón?')) return;

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

            loadCoupons();

            if (window.Toast) {
                window.Toast.success('Cupón eliminado', result.message);
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
    loadCoupons();
});