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
    <section class="modal-overlay" id="modal-category" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.6); backdrop-filter: blur(3px);">
        <article class="modal-category" style="background-color: #ffffff !important; border-radius: 12px; max-width: 500px; width: 100%; max-height: 90vh; overflow-y: auto; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);">
            
            <header style="padding: 1.5rem; border-bottom: 1px solid #e5e7eb; display: flex; justify-content: space-between; align-items: center;">
                <h2 id="modal-category-title" style="margin: 0; font-size: 1.25rem; font-weight: 700; color: #1f2937 !important;">Nueva Categoría</h2>
                <button type="button" data-modal-close style="background: none; border: none; font-size: 1.5rem; cursor: pointer; color: #6b7280 !important;">✕</button>
            </header>

            <form id="category-form">
                <section style="padding: 1.5rem; display: flex; flex-direction: column; gap: 1rem;">
                    
                    <div>
                        <label for="category-name" style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151 !important; margin-bottom: 0.5rem;">Nombre de la Categoría *</label>
                        <input type="text" id="category-name" name="name" required style="width: 100%; padding: 0.625rem; border: 1px solid #d1d5db; border-radius: 6px; color: #1f2937 !important; background-color: #ffffff !important;">
                    </div>

                    <div>
                        <label for="category-icon" style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151 !important; margin-bottom: 0.5rem;">Ícono (Emoji)</label>
                        <input type="text" id="category-icon" name="icon" placeholder="Ej: 👕" maxlength="10" style="width: 100%; padding: 0.625rem; border: 1px solid #d1d5db; border-radius: 6px; color: #1f2937 !important; background-color: #ffffff !important;">
                    </div>

                    <div>
                        <label for="category-description" style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151 !important; margin-bottom: 0.5rem;">Descripción</label>
                        <textarea id="category-description" name="description" rows="3" style="width: 100%; padding: 0.625rem; border: 1px solid #d1d5db; border-radius: 6px; color: #1f2937 !important; background-color: #ffffff !important; resize: vertical;"></textarea>
                    </div>

                    <div style="display: flex; align-items: center; gap: 0.5rem; margin-top: 0.5rem;">
                        <input type="checkbox" id="category-active" name="active" checked style="width: 1rem; height: 1rem; accent-color: #7c3aed;">
                        <label for="category-active" style="color: #374151 !important; font-size: 0.875rem; cursor: pointer;">Categoría activa</label>
                    </div>

                </section>

                <footer style="padding: 1.5rem; border-top: 1px solid #e5e7eb; display: flex; justify-content: flex-end; gap: 1rem;">
                    <button type="button" data-modal-close class="btn btn--ghost">Cancelar</button>
                    <button type="submit" id="category-submit" class="btn btn--primary">Guardar Categoría</button>
                </footer>
            </form>
        </article>
    </section>
@endsection