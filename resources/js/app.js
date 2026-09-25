/**
 * Menú hamburguesa móvil
 */
document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.querySelector('.site-header__toggle');
    const mobileMenu = document.querySelector('.site-header__mobile-menu');

    if (toggle && mobileMenu) {
        toggle.addEventListener('click', () => {
            const isOpen = toggle.getAttribute('aria-expanded') === 'true';

            // Cambiar estado
            toggle.setAttribute('aria-expanded', !isOpen);
            mobileMenu.classList.toggle('is-open');
            mobileMenu.setAttribute('aria-hidden', isOpen);
        });

        // Cerrar el menú al hacer clic en un enlace
        const links = mobileMenu.querySelectorAll('a');
        links.forEach((link) => {
            link.addEventListener('click', () => {
                toggle.setAttribute('aria-expanded', 'false');
                mobileMenu.classList.remove('is-open');
                mobileMenu.setAttribute('aria-hidden', 'true');
            });
        });
    }
});
