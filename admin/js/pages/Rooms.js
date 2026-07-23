import { PaginatedTable } from "../components/PaginatedTable.js";


const roomsTable = document.querySelector("#roomsTable");

function populateTable(table, rooms) {

    const tbody = table.querySelector("tbody");
    tbody.innerHTML = "";


    if (rooms.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="7" class="text-center py-4">
                    No rooms found.
                </td>
            </tr>
        `;
        return;
    }


    rooms.forEach(room => {

        const tr = document.createElement("tr");
        tr.setAttribute("data-id", room.id)


        let statusClass = "status-secondary";


        switch (room.status.toLowerCase()) {

            case "available":
                statusClass = "status-success";
                break;

            case "occupied":
                statusClass = "status-danger";
                break;

            case "maintenance":
                statusClass = "status-warning";
                break;

        }


        tr.innerHTML = `
            <td>
                <p class="fw-semibold small" id="room_name">${room.room_name}</p>

                <p class="text-gray-light extra-small mt-1">
                    ${room.bed_type} · ${room.size} sq ft
                </p>
            </td>

            <td>
                <span class="small text-gray-light fw-semibold">
                    Room ${room.room_number}
                </span>
            </td>

            <td>
                <span class="status py-1 extra-small rounded-2">
                    ${room.room_type}
                </span>
            </td>

            <td>
                <p class="fw-semibold small">
                 ${formatCurrency(room.price_per_night)}
           
                </p>
            </td>

            <td>
                <span class="small text-gray-light">
                    ${room.capacity}
                    ${room.capacity == 1 ? "guest" : "guests"}
                </span>
            </td>

            <td>
                <span class="status ${statusClass} rounded-2 text-uppercase small fw-bold">
                    ${room.status}
                </span>
            </td>

            <td>
                <div class="action-group">

                    <button
                        class="btn btn-outline action-edit text-gray-light hover-animation "
                        title="Edit details"
                        data-edit
                        data-id="${room.id}"
                        data-bs-toggle="modal"
                        data-bs-target="#addRoom">

                        <i class="fa-regular fa-pen-to-square"></i>

                    </button>


                    <button
                        class="btn btn-outline action-remove hover-animation "
                        title="Remove"
                        data-remove
                        data-id="${room.id}"
                        data-bs-toggle="modal"
                        data-bs-target="#removeRoomModal">

                        <i class="fa-solid fa-xmark"></i>

                    </button>

                </div>
            </td>
        `;


        tbody.appendChild(tr);

    });

}



export const roomsPagination = new PaginatedTable({
    table: roomsTable,
    endpoint: "../../api/rooms/get.php",
    limit: 10,
    renderRows: populateTable
});

