function updateCurrency(targetCurrency) {
    const priceElements = document.querySelectorAll('[data-currency]');

    priceElements.forEach(el => {
        const price = parseFloat(el.getAttribute('data-price'));
        // Format the currency string
        el.textContent = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: targetCurrency,
            minimumFractionDigits: 0
        }).format(price);
    });
}

document.addEventListener('DOMContentLoaded', () => {

    document.querySelector(".profile-menu").addEventListener("click", function (e) {
        e.stopPropagation();
    });

    const currentPath = window.location.pathname;

    document.querySelectorAll(".sidebar-category .sidebar-link").forEach(link => {
        link.classList.remove("active");

        const linkPath = new URL(link.href, window.location.origin).pathname;

        if (linkPath === currentPath) {
            link.classList.add("active");
        }
    });

    const savedCurrency = localStorage.getItem('preferredCurrency') || 'PHP';
    updateCurrency(savedCurrency);



});