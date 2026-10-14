/**
 * PASSWORD-TOGGLE.JS - Mostrar/ocultar contraseña
 */

document.addEventListener('DOMContentLoaded', () => {
    const toggles = document.querySelectorAll('.form-password__toggle');

    toggles.forEach((toggle) => {
        toggle.addEventListener('click', () => {
            const targetId = toggle.getAttribute('data-target');
            const input = document.getElementById(targetId);

            if (!input) return;

            const isPassword = input.type === 'password';
            input.type = isPassword ? 'text' : 'password';
            toggle.classList.toggle('is-visible');
            toggle.setAttribute(
                'aria-label',
                isPassword ? 'Ocultar contraseña' : 'Mostrar contraseña'
            );
            input.focus();
        });
    });
});