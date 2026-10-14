/**
 * MODALS.JS - Sistema de modales
 */

document.addEventListener('DOMContentLoaded', () => {

    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        if (!modal) return;
        modal.classList.add('is-open');
        modal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('modal-open');
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        if (!modal) return;
        modal.classList.remove('is-open');
        modal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('modal-open');
    }

    function closeCurrentModal(modal) {
        modal.classList.remove('is-open');
        modal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('modal-open');
    }

    // Cerrar con botones
    document.querySelectorAll('[data-modal-close]').forEach((button) => {
        button.addEventListener('click', () => {
            const modal = button.closest('.modal-overlay');
            if (modal) closeCurrentModal(modal);
        });
    });

    // Cerrar al hacer clic fuera
    document.querySelectorAll('.modal-overlay').forEach((overlay) => {
        overlay.addEventListener('click', (event) => {
            if (event.target === overlay) {
                closeCurrentModal(overlay);
            }
        });
    });

    // Cerrar con Escape
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            const openModalElement = document.querySelector('.modal-overlay.is-open');
            if (openModalElement) {
                closeCurrentModal(openModalElement);
            }
        }
    });

    window.Modal = {
        open: openModal,
        close: closeModal
    };
});