@extends('layouts.admin')

@section('title', 'Gestión de Clientes - Panel de Administración')

@section('content')
    <section class="admin-header">
        <section>
            <h1 class="admin-header__title">Clientes y Usuarios</h1>
            <p class="admin-header__subtitle">Gestiona los usuarios registrados en el sistema</p>
        </section>
    </section>

    {{-- FILTROS --}}
    <section style="background: white; border-radius: 1rem; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div class="form-group" style="margin: 0;">
                <label class="form-label">Buscar por nombre o email</label>
                <input type="text" id="search-user" class="form-input" placeholder="Ej: Juan Pérez...">
            </div>
            <div class="form-group" style="margin: 0;">
                <label class="form-label">Filtrar por Rol</label>
                <select id="filter-role" class="form-input">
                    <option value="">Todos los roles</option>
                    <option value="cliente">Cliente</option>
                    <option value="admin">Emprendedor / Admin</option>
                </select>
            </div>
        </div>
    </section>

    {{-- TABLA --}}
    <section class="admin-table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Rol</th>
                    <th>Registro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="users-tbody">
                <tr><td colspan="6" style="text-align: center;">Cargando...</td></tr>
            </tbody>
        </table>
    </section>
@endsection