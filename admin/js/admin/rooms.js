import { DeleteModal } from "../components/DeleteModal.js";
import { roomsPagination } from "../pages/Rooms.js";
import { FilterGroup } from "../components/FilterGroup.js";

const addRoomModalElement = document.getElementById("addRoom");
const addRoomForm = document.getElementById("addRoomForm");

if (addRoomModalElement && addRoomForm) {

    const modalTitle = addRoomModalElement.querySelector("[data-title]");
    const modalMessage = addRoomModalElement.querySelector("#modalMessage");
    const popModal = popModalMessage(modalMessage);

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

        modalMessage.classList.add("d-none");
    }

    async function prepareEditModal(roomId) {

        modalMode = "edit";
        editingRoomId = roomId;

        modalTitle.textContent = "Edit Room";

        modalMessage.classList.add("d-none");

        const response = await fetch(
            `../../api/rooms/getById.php?id=${roomId}`
        );

        const result = await response.json();

        if (!result.success) {
            popModal(false, result.message);
            return;
        }

        const room = result.data;

        addRoomForm.name.value = room.room_name;
        addRoomForm.room_number.value = room.room_number;
        addRoomForm.type.value = room.room_type_id;
        addRoomForm.status.value = room.status_id;
        addRoomForm.price.value = room.price_per_night;
        addRoomForm.capacity.value = room.capacity;
        addRoomForm.size.value = room.size;
        addRoomForm.bed_type.value = room.bed_type;


        clearAmenities();

        document
            .querySelectorAll('input[name="amenities[]"]')
            .forEach(item => {

                item.checked = room.amenities.includes(
                    Number(item.value)
                );

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

        if (!button) return;

        prepareEditModal(button.dataset.id);

    });

}



new DeleteModal({
    modal: document.querySelector("#removeRoomModal"),
    endpoint: "../../api/rooms/delete.php",
    refresh: () => roomsPagination.refresh()
});



const filter = new ClientFilter({

    container: document.querySelector("#roomFilter"),

    field: "status",

    render(items) {

        populateTable(roomsTable, items);

    }

});