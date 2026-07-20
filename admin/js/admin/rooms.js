import { DeleteModal } from "../components/DeleteModal.js";
import { roomsPagination } from "../pages/Rooms.js";
import { FilterGroup } from "../components/FilterGroup.js";

const addRoomModalElement = document.getElementById("addRoom");
const addRoomForm = document.getElementById("addRoomForm");

if (addRoomModalElement && addRoomForm) {

    const modalTitle = addRoomModalElement.querySelector("[data-title]");
    const modalMessage = addRoomModalElement.querySelector("#modalMessage");
    const popModal = popModalMessage(addRoomForm, modalMessage);

    const amenitiesEdit = document.getElementById("amenitiesEdit");
    const amenitiesView = document.getElementById("amenitiesView");

    const price = addRoomForm.querySelector("#price");
    const capacity = addRoomForm.querySelector("#capacity");

    let modalMode = "create";
    let editingRoomId = null;

    function clearAmenities() {
        document
            .querySelectorAll('input[name="amenities[]"]')
            .forEach(item => item.checked = false);
    }

    function prepareCreateModal() {

        modalMode = "create";
        editingRoomId = null;

        modalTitle.textContent = "Add New Room";

        addRoomForm.reset();
        clearAmenities();

        amenitiesEdit.classList.remove("d-none");
        amenitiesView.classList.add("d-none");
        amenitiesView.innerHTML = "";

        modalMessage.classList.add("d-none");
    }

    async function prepareEditModal(roomId) {

        modalMode = "edit";
        editingRoomId = roomId;

        modalTitle.textContent = "Edit Room";

        modalMessage.classList.add("d-none");

        const roomResponse = await fetch(
            `../../api/rooms/getById.php?id=${roomId}`
        );

        const roomResult = await roomResponse.json();

        if (!roomResult.success) {
            popModal(false, roomResult.message);
            return;
        }

        const room = roomResult.data;

        const amenitiesResponse = await fetch(
            `../../api/room-types/getById.php?id=${room.room_type_id}`
        );

        const amenitiesResult = await amenitiesResponse.json();

        if (!amenitiesResult.success) {
            popModal(false, amenitiesResult.message);
            return;
        }

        addRoomForm.name.value = room.room_name;
        addRoomForm.room_number.value = room.room_number;
        addRoomForm.type.value = room.room_type_id;
        addRoomForm.status.value = room.status_id;
        addRoomForm.size.value = room.size;
        addRoomForm.bed_type.value = room.bed_type;


        price.textContent =
            `$${Number(room.price_per_night).toFixed(2)}`;

        capacity.textContent =
            `${room.capacity} ${room.capacity == 1 ? "Guest" : "Guests"}`;

        // Hide editable checkboxes
        amenitiesEdit.classList.add("d-none");

        // Show read-only amenities
        amenitiesView.classList.remove("d-none");
        amenitiesView.innerHTML = "";

        amenitiesResult.data.amenities
            .sort((a, b) => a.id - b.id)
            .forEach(amenity => {
                const badge = document.createElement("p");
                badge.className = "checkbox active mb-2 me-1";

                badge.innerHTML = `
            <span class="extra-small">${amenity.name}</span>
            <i class="fa-solid fa-check d-inline"></i>
        `;

                amenitiesView.appendChild(badge);
            });

    }

    addRoomForm.addEventListener("submit", async function (e) {

        e.preventDefault();

        const formData = new FormData(addRoomForm);

        let endpoint = "../../api/rooms/create.php";

        if (modalMode === "edit") {

            endpoint = "../../api/rooms/update.php";
            formData.append("id", editingRoomId);

        }

        const response = await fetch(endpoint, {
            method: "POST",
            body: formData
        });

        const result = await response.json();

        popModal(result.success, result.message);

        if (!result.success) {
            return;
        }

        bootstrap.Modal
            .getInstance(addRoomModalElement)
            .hide();

        await roomsPagination.refresh();

    });

    // Open Create Modal
    document
        .getElementById("addRoomButton")
        ?.addEventListener("click", prepareCreateModal);

    // Open Edit Modal
    document.addEventListener("click", function (e) {

        const button = e.target.closest("[data-edit]");

        if (!button) {
            return;
        }

        prepareEditModal(button.dataset.id);

    });

}

new DeleteModal({
    modal: document.querySelector("#removeRoomModal"),
    endpoint: "../../api/rooms/delete.php",
    refresh: () => roomsPagination.refresh()
});

const sortGroup = document.querySelector(".sort-group");

if (sortGroup) {

    sortGroup.addEventListener("change", (e) => {

        if (e.target.name !== "sort") {
            return;
        }

        roomsPagination.setFilter(e.target.value);

    });

}

const roomSearch = document.querySelector("#roomSearch");

if (roomSearch) {

    let timeout;

    roomSearch.addEventListener("input", () => {

        clearTimeout(timeout);

        timeout = setTimeout(() => {

            roomsPagination.setSearch(
                roomSearch.value.trim()
            );

        }, 200);

    });

}

roomsPagination.load(1, "all");