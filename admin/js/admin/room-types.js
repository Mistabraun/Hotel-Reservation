import { DeleteModal } from "../components/DeleteModal.js";

const container = document.querySelector("#roomTypesContainer");

const modal = document.getElementById("addTypeModal");
const form = document.getElementById("addTypeForm");

if (container) {
    loadRoomTypes();
}

if (modal && form) {

    const modalTitle = modal.querySelector("[data-title]");
    const modalMessage = modal.querySelector("#modalMessage");
    console.log(modalMessage)
    const popModal = popModalMessage(form, modalMessage);

    let modalMode = "create";
    let editingId = null;

    function clearAmenities() {

        form.querySelectorAll('input[name="amenities[]"]')
            .forEach(item => item.checked = false);

    }

    function prepareCreateModal() {

        modalMode = "create";
        editingId = null;

        modalTitle.textContent = "Add New Room Type";

        form.reset();
        clearAmenities();

        modalMessage.classList.add("d-none");

    }

    async function prepareEditModal(id) {

        modalMode = "edit";
        editingId = id;

        modalTitle.textContent = "Edit Room Type";

        modalMessage.classList.add("d-none");

        const response = await fetch(
            `../../api/room-types/getById.php?id=${id}`
        );

        const result = await response.json();

        if (!result.success) {

            popModal(false, result.message);
            return;

        }

        const roomType = result.data;

        form.name.value = roomType.name;
        form.description.value = roomType.description;
        form.price.value = roomType.price_per_night;
        form.capacity.value = roomType.capacity;

        clearAmenities();

        const selected = new Set(
            roomType.amenities.map(item => Number(item.id))
        );

        form.querySelectorAll('input[name="amenities[]"]')
            .forEach(item => {

                item.checked =
                    selected.has(Number(item.value));

            });

    }

    form.addEventListener("submit", async e => {

        e.preventDefault();

        const formData = new FormData(form);

        let endpoint =
            "../../api/room-types/create.php";

        if (modalMode === "edit") {

            endpoint =
                "../../api/room-types/update.php";

            formData.append(
                "id",
                editingId
            );

        }

        const response = await fetch(endpoint, {

            method: "POST",
            body: formData

        });

        const result =
            await response.json();

        popModal(
            result.success,
            result.message
        );

        if (!result.success) {
            return;
        }

        bootstrap.Modal
            .getInstance(modal)
            .hide();

        await loadRoomTypes();

    });

    document
        .getElementById("addTypeButton")
        ?.addEventListener(
            "click",
            prepareCreateModal
        );

    document.addEventListener("click", e => {

        const editButton =
            e.target.closest("[data-edit]");

        if (editButton) {

            prepareEditModal(
                editButton.dataset.id
            );

            return;

        }

    });

}

new DeleteModal({

    modal:
        document.querySelector("#removeTypeModal"),

    endpoint:
        "../../api/room-types/delete.php",

    refresh: () => loadRoomTypes()

});

async function loadRoomTypes() {

    const response = await fetch(
        "../../api/room-types/get.php"
    );

    const result = await response.json();

    if (!result.success) {
        return;
    }

    container.innerHTML = "";

    result.data.forEach(roomType => {

        container.insertAdjacentHTML(
            "beforeend",
            createCard(roomType)
        );

    });

}

function createCard(roomType) {

    return `
        <div class="col-md-6">

            <div class="card shadow-sm border-0 rounded-4">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <h4 class="fw-bold">
                                ${roomType.name}
                            </h4>

                            <p class="text-secondary">
                                ${roomType.description}
                            </p>

                        </div>

                        <div>

                            <button
                                class="btn btn-warning text-white"
                                data-edit
                                data-id="${roomType.id}"
                                data-bs-toggle="modal"
                                data-bs-target="#addTypeModal">

                                <i class="fa-solid fa-pen"></i>
                                Edit

                            </button>

                            <button
                                class="btn btn-danger ms-1"
                                data-remove
                                data-id="${roomType.id}"
                                data-bs-toggle="modal"
                                data-bs-target="#removeTypeModal">

                                <i class="fa-solid fa-trash"></i>
                                Delete

                            </button>

                        </div>

                    </div>

                    <hr>

                    <div class="row mb-3">

                        <div class="col">

                            <small class="text-secondary">
                                Base Price
                            </small>

                            <h5>
                                ₱${Number(roomType.price_per_night).toLocaleString()}
                                <span class="extra-small text-secondary-2">
                                    /night
                                </span>
                            </h5>

                        </div>

                        <div class="col">

                            <small class="text-secondary">
                                Capacity
                            </small>

                            <h5>
                                ${roomType.capacity}
                                ${roomType.capacity == 1 ? "Guest" : "Guests"}
                            </h5>

                        </div>

                    </div>

                    <div class="mt-2 border-top">

                        <div class="text-secondary-2 fw-semibold mt-3">

                            <p class="small mb-2">
                                Amenities (${roomType.amenities.length})
                            </p>

                        </div>

                        <div class="d-flex flex-wrap gap-2">

                            ${roomType.amenities.map(amenity => `
                                <span class="badge bg-light text-dark border">
                                    ${amenity.name}
                                </span>
                            `).join("")}

                        </div>

                    </div>

                </div>

            </div>

        </div>
    `;
}