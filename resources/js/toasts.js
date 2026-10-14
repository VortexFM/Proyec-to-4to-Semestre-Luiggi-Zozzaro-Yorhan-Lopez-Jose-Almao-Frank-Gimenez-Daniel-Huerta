/**
 * TOASTS.JS - Notificaciones flotantes con temporizador
 */

document.addEventListener('DOMContentLoaded', () => {

    function getToastContainer() {
        let container = document.querySelector('.toast-container');
        if (!container) {
            container = document.createElement('div');
            container.className = 'toast-container';
            container.setAttribute('aria-live', 'polite');
            document.body.appendChild(container);
        }
        return container;
    }

    const icons = {
        success: '✓',
        danger: '✕',
        warning: '⚠',
        info: 'ℹ'
    };

    function showToast(type = 'info', title = '', message = '', duration = 5) {
        const container = getToastContainer();

        const toast = document.createElement('div');
        toast.className = `toast toast--${type}`;
        toast.setAttribute('role', 'alert');

        toast.innerHTML = `
            <span class="toast__icon">${icons[type] || 'ℹ'}</span>
            <div class="toast__content">
                ${title ? `<p class="toast__title">${title}</p>` : ''}
                ${message ? `<p class="toast__message">${message}</p>` : ''}
            </div>
            <span class="toast__timer">${duration}s</span>
            <button type="button" class="toast__close" aria-label="Cerrar">✕</button>
            <div class="toast__progress" style="animation-duration: ${duration}s;"></div>
        `;

        container.appendChild(toast);

        let timeLeft = duration;
        const timerElement = toast.querySelector('.toast__timer');

        const interval = setInterval(() => {
            timeLeft--;
            if (timerElement) timerElement.textContent = `${timeLeft}s`;
            if (timeLeft <= 0) {
                clearInterval(interval);
                removeToast(toast);
            }
        }, 1000);

        const closeButton = toast.querySelector('.toast__close');
        if (closeButton) {
            closeButton.addEventListener('click', () => {
                clearInterval(interval);
                removeToast(toast);
            });
        }

        return toast;
    }

    function removeToast(toast) {
        toast.style.transition = 'all 0.3s ease-in-out';
        toast.style.opacity = '0';
        toast.style.transform = 'translateX(100%)';
        setTimeout(() => {
            if (toast.parentElement) toast.parentElement.removeChild(toast);
        }, 300);
    }

    window.Toast = {
        success: (title, message, duration = 5) => showToast('success', title, message, duration),
        danger: (title, message, duration = 5) => showToast('danger', title, message, duration),
        warning: (title, message, duration = 5) => showToast('warning', title, message, duration),
        info: (title, message, duration = 5) => showToast('info', title, message, duration)
    };
});