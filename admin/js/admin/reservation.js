import { DeleteModal } from "../components/DeleteModal.js";
import { reservationPagination } from "../pages/Reservation.js";
import { FilterGroup } from "../components/FilterGroup.js";

const addReservationModalElement = document.getElementById("addReservation");
const addReservationForm = document.getElementById("addReservationForm");

if (addReservationModalElement && addReservationForm) {

    const modalTitle = addReservationModalElement.querySelector("[data-title]");
    const modalReference = addReservationModalElement.querySelector("[data-description]");
    const modalMessage = addReservationModalElement.querySelector("#modalMessage");

    const modalNights = addReservationModalElement.querySelector("[data-nights]")
    const modalPricePerNight = addReservationForm.querySelector("[data-price]")
    const modalTotal = addReservationForm.querySelector("[data-total]")

    const popModal = popModalMessage(addReservationForm, modalMessage);

    let modalMode = "create";
    let editingReservationId = null;

    function updateSummary() {

        const checkIn = addReservationForm.check_in.value;
        const checkOut = addReservationForm.check_out.value;

        const room =
            addReservationForm.room_id.options[
            addReservationForm.room_id.selectedIndex
            ];

        if (!checkIn || !checkOut || !room) {
            return;
        }

        const start = new Date(checkIn);
        const end = new Date(checkOut);

        const milliseconds =
            end.getTime() - start.getTime();

        const nights = Math.max(
            1,
            Math.ceil(milliseconds / (1000 * 60 * 60 * 24))
        );

        const pricePerNight =
            Number(room.dataset.amount ?? 0);

        const total =
            nights * pricePerNight;

        modalNights.textContent = nights;

        modalPricePerNight.dataset.amount =
            pricePerNight;

        modalTotal.dataset.amount =
            total;

        modalPricePerNight.textContent =
            formatCurrency(pricePerNight);

        modalTotal.textContent =
            formatCurrency(total);

    }

    function prepareCreateModal() {
        modalMode = "create";
        editingReservationId = null;

        modalTitle.textContent = "Add New Reservation";

        addReservationForm.reset();


        modalMessage.classList.add("d-none");
    }

    async function prepareEditModal(reservationId) {

        modalMode = "edit";
        editingReservationId = reservationId;

        modalTitle.textContent = "Edit Reservation";

        modalMessage.classList.add("d-none");

        const response = await fetch(
            `../../api/reservations/getById.php?id=${reservationId}`
        );

        const result = await response.json();

        if (!result.success) {
            popModal(false, result.message);
            return;
        }

        const reservation = result.data;

        modalReference.textContent = reservation.booking_reference
        addReservationForm.room_id.value = reservation.room_id
        addReservationForm.check_in.value = reservation.check_in

        addReservationForm.check_out.value = reservation.check_out
        addReservationForm.check_out.min = reservation.check_in

        addReservationForm.guests.value = Math.min(reservation.number_of_guests, reservation.capacity)
        addReservationForm.guests.max = reservation.capacity

        addReservationForm.status.value = reservation.status
        modalNights.textContent = reservation.nights
        modalPricePerNight.textContent = formatCurrency(reservation.price_per_night)
        modalTotal.textContent = formatCurrency(reservation.total_amount)
        updateSummary()

    }

    addReservationForm.addEventListener("submit", async function (e) {

        e.preventDefault();

        const formData = new FormData(addReservationForm);

        let endpoint = "../../api/reservations/create.php";

        if (modalMode === "edit") {

            endpoint = "../../api/reservations/update.php";

            formData.append("id", editingReservationId);
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
            .getInstance(addReservationModalElement)
            .hide();

        await reservationPagination.refresh();

    });

    // Open Create Modal
    document
        .getElementById("addReservationButton")
        ?.addEventListener("click", prepareCreateModal);

    // Open Edit Modal
    document.addEventListener("click", function (e) {

        const button = e.target.closest("[data-edit]");

        if (!button) return;

        prepareEditModal(button.dataset.id);

    });


    addReservationForm.room_id.addEventListener(
        "change",
        updateSummary
    );

    addReservationForm.check_in.addEventListener(
        "change",
        () => {

            addReservationForm.check_out.min =
                addReservationForm.check_in.value;

            updateSummary();

        }
    );

    addReservationForm.check_out.addEventListener(
        "change",
        updateSummary
    );

}


new DeleteModal({
    modal: document.querySelector("#removeReservationModal"),
    endpoint: "../../api/reservations/delete.php",
    refresh: () => reservationPagination.refresh()
});


const sortGroup = document.querySelector(".sort-group");
if (sortGroup) {
    sortGroup.addEventListener("change", (e) => {

        if (e.target.name !== "sort") {
            return;
        }

        reservationPagination.setFilter(e.target.value);

    });
}

const reservationSearch = document.querySelector("#reservationSearch");
if (reservationSearch) {
    let timeout;
    reservationSearch.addEventListener("input", () => {

        clearTimeout(timeout);

        timeout = setTimeout(() => {

            reservationPagination.setSearch(
                reservationSearch.value.trim()
            );

        }, 200);

    });
}

reservationPagination.load(1, "all");