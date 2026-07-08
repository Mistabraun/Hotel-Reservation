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