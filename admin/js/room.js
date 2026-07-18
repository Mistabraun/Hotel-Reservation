const filterButtons = document.querySelectorAll('.filter-btn');
const tableRows = document.querySelectorAll('tbody tr');

filterButtons.forEach(button => {
    button.addEventListener('click', () => {
 
        document.querySelector('.filter-btn.active').classList.remove('active');
        button.classList.add('active');
        const filterValue = button.textContent.toLowerCase();

        tableRows.forEach(row => {
            const rowStatus = row.getAttribute('data-status');
            if (filterValue === 'all') {
                row.style.display = '';

                } else if (rowStatus === filterValue) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
        });
    });
});
const overlay = document.getElementById("overlay");

const addModal = document.getElementById("addModal");
const editModal = document.getElementById("editModal");
const deleteModal = document.getElementById("deleteModal");

document.querySelector(".btn-add-room").addEventListener("click", function () {
    overlay.classList.add("show");
    addModal.classList.add("show");
});

document.querySelectorAll(".action-btn:not(.delete-btn)").forEach(button => {
    button.addEventListener("click", function () {
        overlay.classList.add("show");
        editModal.classList.add("show");
    });
});

document.querySelectorAll(".delete-btn").forEach(button => {
    button.addEventListener("click", function () {
        overlay.classList.add("show");
        deleteModal.classList.add("show");
    });
});

function closeModal() {
    overlay.classList.remove("show");
    addModal.classList.remove("show");
    editModal.classList.remove("show");
    deleteModal.classList.remove("show");
}

overlay.addEventListener("click", closeModal);

document.querySelectorAll(".amenity-badge").forEach(badge => {
    badge.addEventListener("click", function () {
       
        if (this.classList.contains("active")) {
            this.classList.remove("active");
            this.innerHTML = this.innerHTML.replace("✓ ", "");
        } else {
            this.classList.add("active");
            this.innerHTML = "✓ " + this.innerHTML;
        }
    });
});