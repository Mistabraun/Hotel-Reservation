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
    // const buttons = document.querySelectorAll('.currency-btn');

    // buttons.forEach(button => {
    //     button.addEventListener('click', (e) => {
    //         const selectedCurrency = e.target.getAttribute('data-currency-code');
    //         localStorage.setItem('preferredCurrency', selectedCurrency);
    //         updateCurrency(selectedCurrency);
    //     });
    // });

    const savedCurrency = localStorage.getItem('preferredCurrency') || 'PHP';
    updateCurrency(savedCurrency);

});
