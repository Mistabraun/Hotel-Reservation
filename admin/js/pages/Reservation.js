import { PaginatedTable } from "../components/PaginatedTable.js";

const reservationsTable = document.querySelector("#reservationsTable");
const countElements = {
    "confirmed": document.querySelector("#confirmed-count"),
    "pending": document.querySelector("#pending-count"),
    "checked_out": document.querySelector("#checked_out-count"),
    "cancelled": document.querySelector("#cancelled-count")
}

async function loadCounts() {
    const response = await fetch("../../api/reservations/count.php");
    const result = await response.json();

    if (!response.ok || !result.success) {
        return;
    }

    Object.entries(result.data).forEach(([key, value]) => {
        if (countElements[key]) {
            countElements[key].textContent = value;
        }
    });
}

function populateTable(table, reservations) {

    const tbody = table.querySelector("tbody");
    tbody.innerHTML = "";

    loadCounts()

    if (reservations.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="9" class="text-center py-4">
                    No reservations found.
                </td>
            </tr>
        `;
        return;
    }


    reservations.forEach(reservation => {

        const tr = document.createElement("tr");
        tr.setAttribute("data-id", reservation.id)


        let statusClass = "status-secondary";


        switch (reservation.status.toLowerCase()) {

            case "confirmed":
                statusClass = "status-success";
                break;

            case "cancelled":
                statusClass = "status-danger";
                break;

            case "pending":
                statusClass = "status-warning";
                break;

            case "checked out":
                statusClass = "status-info";
                break;


        }


        console.log(reservation)
        tr.innerHTML = `
             <td>
            <span class="extra-small fw-semibold">
                ${reservation.booking_reference}
            </span>
        </td>

        <td>
            <p class="fw-semibold small">
                ${reservation.guest}
            </p>

            <p class="text-gray-light extra-small mt-1">
                ${reservation.email}
            </p>
        </td>

        <td>
            <p class="small">
                ${reservation.room_name}
            </p>


            <span class="status py-1">
                ${reservation.room_type}
            </span>
        </td>

        <td>
            <span class="small text-gray-light">
                ${reservation.check_in}
            </span>
        </td>

        <td>
            <span class="small text-gray-light">
                ${reservation.check_out}
            </span>
        </td>

        <td>
            <span class="small text-gray-light fw-semibold">
                ${reservation.number_of_guests}
            </span>
        </td>

        <td>
            <span
                class="small fw-semibold"
                data-currency
                data-price="${reservation.total_amount}">
              ${formatCurrency(reservation.total_amount)}
            </span>
        </td>

        <td>
            <span class="status ${statusClass} rounded-2 text-uppercase small fw-bold">
                ${reservation.status}
            </span>
        </td>

        <td>
            <div class="action-group">

                <button
                    class="btn btn-outline action-edit text-gray-light"
                    title="Edit details"
                        data-edit
                        data-id="${reservation.id}"
                    data-bs-toggle="modal"
                    data-bs-target="#addReservation">

                    <i class="fa-regular fa-pen-to-square"></i>

                </button>

                <button
                    class="btn btn-outline action-remove"
                    title="Cancel"
                 data-remove
                        data-id="${reservation.id}"
                    data-bs-toggle="modal"
                    data-bs-target="#removeReservationModal">

                    <i class="fa-solid fa-xmark"></i>

                </button>

            </div>
        </td>
        `;


        tbody.appendChild(tr);

    });

}



export const reservationPagination = new PaginatedTable({
    table: reservationsTable,
    endpoint: "../../api/reservations/get.php",
    limit: 10,
    renderRows: populateTable
});

