function hideAlertAfterDelay(selector, delay = 3000) {
    setTimeout(() => {
        const alert = document.querySelector(selector);
        if (alert) {
            alert.remove();
        }
    }, delay);
}
