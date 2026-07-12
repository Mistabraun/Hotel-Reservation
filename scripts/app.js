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

    const profileMenu = document.querySelector(".profile-menu")
    if (profileMenu) {
        document.querySelector(".profile-menu").addEventListener("click", function (e) {
            e.stopPropagation();
        });
    }

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

    const passwordGroup = document.querySelectorAll(".password-group")
    passwordGroup.forEach((e) => {
        let target = e.querySelector("input[type='password']")
        let eye = e.querySelector(".toggle-password")
        let icon = eye.querySelector("i")

        if (!target && !eye) {
            return;
        }

        function setIcon(status) {
            if (!icon) {
                return
            }
            if (status) {
                icon.classList.add("fa-eye-slash")
                icon.classList.remove("fa-eye")
            } else {
                icon.classList.remove("fa-eye-slash")
                icon.classList.add("fa-eye")
            }
        }

        eye.addEventListener("click", (e) => {
            const isAPassword = target.type == "password"
            if (isAPassword) {
                target.type = "text"
            } else {
                target.type = "password"
            }
            setIcon(isAPassword)
        })
    })

    const loginForm = document.getElementById("loginForm")
    if (loginForm) {
        loginForm.addEventListener("submit", async function (element) {
            element.preventDefault();

            const form = element.target;
            const formData = new FormData(form);

            try {
                const response = fetch("../api/auth/login.php", {
                    method: "post",
                    body: formData,
                })

                const result = await response.json();
                console.log(result);

            } catch (e) {

            }

        })

    }

    const logout = document.getElementById("logout")
    if (logout) {
        logout.addEventListener("click", async function (e) {
            const response = fetch("../api/auth/logout.php", {
                method: "post"
            })

        })
    }

});