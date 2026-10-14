/// ============================================
// CRUD DE CUPONES - API JS
// ============================================

const API_URL = '/api/cupones';
const csrf = document.querySelector('meta[name="csrf-token"]')?.content;

// Elementos del DOM
const tbody    = document.getElementById('coupons-tbody');
const modal    = document.getElementById('modal-coupon');
const form     = document.getElementById('coupon-form');
const loading  = document.getElementById('coupons-loading');
const errorBox = document.getElementById('coupons-error');
const tableBox = document.getElementById('coupons-table');

// ============================================
// HELPERS
// ============================================

function showLoading() {
    loading.style.display = 'block';
    tableBox.style.display = 'none';
    errorBox.style.display = 'none';
}

function hideLoading() {
    loading.style.display = 'none';
    tableBox.style.display = 'block';
}

function showError(msg) {
    errorBox.innerHTML = `
        <div class="alert alert--danger">
            <div class="alert__content">
                <div class="alert__title">Error</div>
                <div class="alert__message">${msg}</div>
            </div>
        </div>`;
    errorBox.style.display = 'block';
    tableBox.style.display = 'none';
    loading.style.display = 'none';
}

function openModal() {
    modal.classList.add('is-open');
    modal.setAttribute('aria-hidden', 'false');
}

function closeModal() {
    // Quita el foco del modal antes de cerrarlo (evita warning aria-hidden)
    if (document.activeElement && modal.contains(document.activeElement)) {
        document.activeElement.blur();
    }
    modal.classList.remove('is-open');
    modal.setAttribute('aria-hidden', 'true');
}

function mostrarErroresValidacion(errors) {
    if (!errors) return '';
    return Object.entries(errors)
        .map(([campo, mensajes]) => `• ${campo}: ${mensajes.join(', ')}`)
        .join('\n');
}

// ============================================
// LISTAR CUPONES
// ============================================

async function cargarCupones() {
    showLoading();
    try {
        const res = await fetch(`${API_URL}?per_page=100`, {
            headers: { 'Accept': 'application/json' }
        });
        const json = await res.json();

        if (!json.success) throw new Error(json.message || 'Error al cargar');

        renderTabla(json.data.data);
        hideLoading();
    } catch (e) {
        console.error(e);
        showError('No se pudieron cargar los cupones.');
    }
}

function renderTabla(coupons) {
    if (!coupons.length) {
        tbody.innerHTML = `
            <tr>
                <td colspan="7" style="text-align: center; padding: 2rem; color: #6b7280;">
                    No hay cupones registrados
                </td>
            </tr>`;
        return;
    }

    tbody.innerHTML = coupons.map(c => {
        const fechaDesde = new Date(c.valid_from).toLocaleDateString('es-ES');
        const fechaHasta = new Date(c.valid_until).toLocaleDateString('es-ES');

        return `
            <tr>
                <td>
                    <strong style="color: var(--color-primary); font-family: monospace;">
                        ${c.code}
                    </strong>
                </td>
                <td>${c.discount}%</td>
                <td>${c.min_amount ? '$' + parseFloat(c.min_amount).toFixed(2) : '—'}</td>
                <td style="font-size: 0.85rem;">${fechaDesde} → ${fechaHasta}</td>
                <td>${c.uses}${c.max_uses ? ' / ' + c.max_uses : ''}</td>
                <td>
                    <span class="badge ${c.active ? 'badge--success' : 'badge--gray'}">
                        ${c.active ? 'Activo' : 'Inactivo'}
                    </span>
                </td>
                <td>
                    <button type="button" class="btn btn--sm btn--ghost" data-action="edit" data-id="${c.id}" title="Editar">✏️</button>
                    <button type="button" class="btn btn--sm btn--ghost" data-action="delete" data-id="${c.id}" title="Eliminar">🗑️</button>
                </td>
            </tr>
        `;
    }).join('');
}

// ============================================
// EVENT DELEGATION (reemplaza onclick inline)
// ============================================

tbody.addEventListener('click', (e) => {
    const btn = e.target.closest('button[data-action]');
    if (!btn) return;

    const id     = parseInt(btn.dataset.id);
    const action = btn.dataset.action;

    if (action === 'edit')   editarCupon(id);
    if (action === 'delete') eliminarCupon(id);
});

// ============================================
// CREAR / EDITAR
// ============================================

form.addEventListener('submit', async (e) => {
    e.preventDefault();
    const id = document.getElementById('coupon-id').value;

    const payload = {
        code:        document.getElementById('coupon-code').value.toUpperCase(),
        discount:    parseFloat(document.getElementById('coupon-discount').value),
        min_amount:  parseFloat(document.getElementById('coupon-min-amount').value || 0),
        valid_from:  document.getElementById('coupon-valid-from').value,
        valid_until: document.getElementById('coupon-valid-until').value,
        max_uses:    document.getElementById('coupon-max-uses').value || null,
        active:      document.getElementById('coupon-active').checked ? 1 : 0,
    };

    // Si estamos editando, quitamos el code para no chocar con la validación unique
    if (id) {
        // Igual lo mandamos, pero Laravel lo ignora con `unique:...,$id`
    }

    const url    = id ? `${API_URL}/${id}` : API_URL;
    const method = id ? 'PUT' : 'POST';

    try {
        const res = await fetch(url, {
            method,
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrf,
            },
            body: JSON.stringify(payload),
        });

        const json = await res.json();

        if (json.success) {
            closeModal();
            cargarCupones();
        } else {
            const errores = mostrarErroresValidacion(json.errors);
            alert(`${json.message || 'Error al guardar'}\n\n${errores}`);
            console.error('Errores de validación:', json.errors);
        }
    } catch (e) {
        console.error(e);
        alert('Error de conexión');
    }
});

async function editarCupon(id) {
    try {
        const res = await fetch(`${API_URL}/${id}`, {
            headers: { 'Accept': 'application/json' }
        });
        const json = await res.json();
        if (!json.success) return alert('Error al cargar cupón');

        const c = json.data;
        document.getElementById('coupon-id').value         = c.id;
        document.getElementById('coupon-code').value       = c.code;
        document.getElementById('coupon-discount').value   = c.discount;
        document.getElementById('coupon-min-amount').value = c.min_amount || 0;
        document.getElementById('coupon-valid-from').value = c.valid_from ? c.valid_from.split('T')[0] : '';
        document.getElementById('coupon-valid-until').value= c.valid_until ? c.valid_until.split('T')[0] : '';
        document.getElementById('coupon-max-uses').value   = c.max_uses || '';
        document.getElementById('coupon-active').checked   = c.active;

        document.getElementById('modal-coupon-title').textContent = 'Editar Cupón';
        openModal();
    } catch (e) {
        console.error(e);
        alert('Error de conexión');
    }
}

// ============================================
// ELIMINAR
// ============================================

async function eliminarCupon(id) {
    if (!confirm('¿Eliminar este cupón?')) return;

    try {
        const res = await fetch(`${API_URL}/${id}`, {
            method: 'DELETE',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrf,
            },
        });
        const json = await res.json();

        if (json.success) cargarCupones();
        else alert(json.message || 'Error al eliminar');
    } catch (e) {
        console.error(e);
        alert('Error de conexión');
    }
}

// ============================================
// BOTÓN NUEVO CUPÓN
// ============================================

document.getElementById('btn-new-coupon').addEventListener('click', () => {
    form.reset();
    document.getElementById('coupon-id').value = '';

    const hoy = new Date().toISOString().split('T')[0];
    const mes = new Date(Date.now() + 30 * 86400000).toISOString().split('T')[0];
    document.getElementById('coupon-valid-from').value  = hoy;
    document.getElementById('coupon-valid-until').value = mes;

    document.getElementById('coupon-min-amount').value = 0;
    document.getElementById('coupon-active').checked   = true;
    document.getElementById('modal-coupon-title').textContent = 'Nuevo Cupón';

    openModal();
});

// ============================================
// CERRAR MODAL
// ============================================

document.querySelectorAll('[data-modal-close]').forEach(btn => {
    btn.addEventListener('click', closeModal);
});

modal.addEventListener('click', (e) => {
    if (e.target === modal) closeModal();
});

document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && modal.classList.contains('is-open')) closeModal();
});

// ============================================
// INICIALIZAR
// ============================================

cargarCupones();