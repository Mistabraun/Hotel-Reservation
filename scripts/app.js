document.addEventListener('DOMContentLoaded', () => {
    const sidebar_btn = document.getElementById("sidebar-btn")
    const sidebar = document.getElementById("sidebar")

    sidebar_btn.addEventListener("click", function (e) {
        sidebar.classList.toggle("active")
    })
});