@extends('layouts.admin')

@section('title', 'Gestión de Categorías - Panel de Administración')

@section('content')

    <section class="admin-header">
        <section>
            <h1 class="admin-header__title">Categorías</h1>
            <p class="admin-header__subtitle">Gestiona las categorías de productos</p>
        </section>
        <button type="button" class="btn btn--primary" id="btn-new-category">
            + Nueva categoría
        </button>
    </section>

    {{-- ESTADO DE CARGA --}}
    <section id="categories-loading" style="display: none; text-align: center; padding: 2rem;">
        <div class="spinner"></div>
        <p>Cargando categorías...</p>
    </section>

    {{-- ESTADO DE ERROR --}}
    <section id="categories-error" style="display: none;"></section>

    {{-- TABLA DE CATEGORÍAS --}}
    <section class="admin-table-container" id="categories-table">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Categoría</th>
                    <th>Slug</th>
                    <th>Productos</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="categories-tbody">
                {{-- Las categorías se cargan dinámicamente desde la API --}}
            </tbody>
        </table>
    </section>

    {{-- MODAL DE CREAR/EDITAR CATEGORÍA --}}
    <section class="modal-overlay" id="modal-category" aria-hidden="true">
        <article class="modal">
            <header class="modal__header">
                <h2 class="modal__title" id="modal-category-title">Nueva Categoría</h2>
                <button type="button" class="modal__close" data-modal-close aria-label="Cerrar">✕</button>
            </header>

            <form id="category-form">
                <section class="modal__body">
                    <div class="form-group">
                        <label class="form-label" for="category-name">Nombre *</label>
                        <input type="text" id="category-name" name="name" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="category-icon">Ícono (emoji)</label>
                        <input type="text" id="category-icon" name="icon" class="form-input" placeholder="Ej: 👕" maxlength="10">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="category-description">Descripción</label>
                        <textarea id="category-description" name="description" class="form-textarea" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label class="filter-checkbox">
                            <input type="checkbox" id="category-active" name="active" class="form-checkbox" checked>
                            <span>Categoría activa</span>
                        </label>
                    </div>
                </section>

                <footer class="modal__footer">
                    <button type="button" class="btn btn--ghost" data-modal-close>Cancelar</button>
                    <button type="submit" class="btn btn--primary" id="category-submit">Guardar categoría</button>
                </footer>
            </form>
        </article>
    </section>

@endsection