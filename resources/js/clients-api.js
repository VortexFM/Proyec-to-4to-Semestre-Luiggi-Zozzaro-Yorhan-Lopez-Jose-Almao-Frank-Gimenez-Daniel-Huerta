document.addEventListener('DOMContentLoaded', () => {
    const usersTbody = document.getElementById('users-tbody');
    if (!usersTbody) return;

    const API_URL = '/api/usuarios';
    const csrf = document.querySelector('meta[name="csrf-token"]')?.content;
    const searchInput = document.getElementById('search-user');
    const roleFilter = document.getElementById('filter-role');

    async function cargarUsuarios() {
        try {
            const params = new URLSearchParams();
            if (searchInput.value) params.set('search', searchInput.value);
            if (roleFilter.value) params.set('role', roleFilter.value);

            const res = await fetch(`${API_URL}?${params}`, { headers: { 'Accept': 'application/json' } });
            const json = await res.json();

            if (!json.success) throw new Error('Error al cargar');

            renderizarTabla(json.data.data);
        } catch (error) {
            console.error(error);
            usersTbody.innerHTML = `<tr><td colspan="6" style="text-align: center; color: red;">Error al cargar usuarios</td></tr>`;
        }
    }

    function renderizarTabla(users) {
        if (users.length === 0) {
            usersTbody.innerHTML = `<tr><td colspan="6" style="text-align: center;">No hay usuarios registrados</td></tr>`;
            return;
        }

        usersTbody.innerHTML = users.map(u => {
            const fecha = new Date(u.created_at).toLocaleDateString('es-ES');
            const rolBadge = u.role === 'admin' 
                ? '<span class="badge badge--primary">Emprendedor</span>' 
                : '<span class="badge badge--info">Cliente</span>';

            return `
                <tr>
                    <td><strong>${u.name}</strong></td>
                    <td>${u.email}</td>
                    <td>${u.phone || '—'}</td>
                    <td>${rolBadge}</td>
                    <td>${fecha}</td>
                    <td>
                        <button class="btn btn--sm btn--ghost" onclick="cambiarRol(${u.id}, '${u.role}')" title="Cambiar Rol">🔄</button>
                        <button class="btn btn--sm btn--ghost" onclick="eliminarUsuario(${u.id})" title="Eliminar">🗑️</button>
                    </td>
                </tr>
            `;
        }).join('');
    }

    // Filtrar
    let debounce;
    searchInput.addEventListener('input', () => {
        clearTimeout(debounce);
        debounce = setTimeout(cargarUsuarios, 400);
    });
    roleFilter.addEventListener('change', cargarUsuarios);

    // Cambiar Rol (Rápido)
    window.cambiarRol = async function(id, currentRole) {
        const newRole = currentRole === 'admin' ? 'cliente' : 'admin';
        if (!confirm(`¿Cambiar el rol de este usuario a ${newRole === 'admin' ? 'Emprendedor' : 'Cliente'}?`)) return;

        try {
            const res = await fetch(`${API_URL}/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrf
                },
                body: JSON.stringify({ role: newRole })
            });
            const json = await res.json();
            if (json.success) cargarUsuarios();
            else alert(json.message);
        } catch (e) { console.error(e); }
    };

    // Eliminar Usuario
    window.eliminarUsuario = async function(id) {
        if (!confirm('¿Estás seguro de eliminar a este usuario?')) return;

        try {
            const res = await fetch(`${API_URL}/${id}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrf
                }
            });
            const json = await res.json();
            if (json.success) cargarUsuarios();
            else alert(json.message);
        } catch (e) { console.error(e); }
    };

    cargarUsuarios();
});