function formatCurrency(price, targetCurrency = "PHP") {
    return new Intl.NumberFormat('fil-PH', {
        style: 'currency',
        currency: targetCurrency,
        minimumFractionDigits: 0
    }).format(price)
}

function updateCurrency(targetCurrency) {
    const priceElements = document.querySelectorAll('[data-price]');

    priceElements.forEach(el => {
        const price = parseFloat(el.getAttribute('data-price'));

        el.textContent = formatCurrency(price, targetCurrency);

    });

}

function shakeElement(element) {
    element.classList.add('modal-shake');

    element.addEventListener('animationend', function () {
        element.classList.remove('modal-shake');
    }, { once: true });
}


function bindFormToModal(modal, modalMessage) {
    modal.addEventListener('hidden.bs.modal', function (event) {
        const modalMessage = modal.querySelector(modalMessage);
        if (modalMessage) {
            modalMessage.classList.remove("d-block")
            modalMessage.classList.add("d-none")
        }
    });
}

function popModalMessage(form, modalMessage) {
    return (status, message) => {
        modalMessage.classList.remove("d-none")

        if (status) {
            form.reset();
            modalMessage.classList.remove("alert-danger")
            modalMessage.classList.add("alert-success")
            modalMessage.textContent = message
            return
        }

        shakeElement(modalMessage)

        modalMessage.classList.add("alert-danger")
        modalMessage.classList.remove("alert-success")
        modalMessage.textContent = message
    }
}

document.addEventListener('DOMContentLoaded', () => {

    const profileMenu = document.querySelector(".profile-menu")
    if (profileMenu) {
        document.querySelector(".profile-menu").addEventListener("click", function (e) {
            e.stopPropagation();
        });
    }

    document.querySelectorAll(".sidebar-category .sidebar-link").forEach(link => {
        link.classList.remove("active");

        const currentPath = window.location.pathname;
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
            console.log("ret")
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

    const loginForm = document.querySelector("#loginForm");

    if (loginForm) {
        loginForm.addEventListener("submit", async function (event) {
            event.preventDefault();

            const formData = new FormData(event.target);
            const errorMessage = document.querySelector("#errorMessage")

            const response = await fetch("../api/auth/login.php", {
                method: "POST",
                body: formData,
            });

            const result = await response.json();

            console.log(!response.ok, !result.success)
            if (!response.ok || !result.success) {
                errorMessage.classList.remove("d-none")
                errorMessage.textContent = result.message ?? "Internal Server Error."
                return;
            }

            console.log("redirect")
            if (result.admin) {
                window.location.href = "/admin/dashboard.php"
            } else {
                window.location.href = "/rooms.php"
            }

        });
    }

    const registerForm = document.querySelector("#registerForm");

    if (registerForm) {
        registerForm.addEventListener("submit", async function (event) {
            event.preventDefault();
            const errorMessage = document.querySelector("#errorMessage")

            const passwordElement = registerForm.querySelector("#password")
            const confirmPasswordElement = registerForm.querySelector("#cpassword")

            if (passwordElement.value !== confirmPasswordElement.value) {
                errorMessage.classList.remove("d-none")
                errorMessage.textContent = "Password doesn't match."
                return
            }

            const formData = new FormData(event.target);
            formData.delete("cpassword")

            const response = await fetch("../api/auth/register.php", {
                method: "POST",
                body: formData,
            });

            const result = await response.json();

            console.log(!response.ok, !result.success)
            if (!response.ok || !result.success) {
                errorMessage.classList.remove("d-none")
                errorMessage.textContent = result.message ?? "Internal Server Error."
                return;
            }

            window.location.href = "/rooms.php"


        })
    }

    const logout = document.getElementById("logout")
    if (logout) {
        logout.addEventListener("click", async function (e) {
            const response = await fetch("../api/auth/logout.php", {
                method: "post"
            })

            if (response.ok) {
                window.location.href = "/"
            }
        })
    }

    const observerOptions = {
        root: document.getElementById('scroll-container'),
        rootMargin: '0px',
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.fade-on-scroll').forEach((el) => {
        observer.observe(el);
    });

});