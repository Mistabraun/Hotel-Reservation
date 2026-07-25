import { PaginatedTable } from "../components/PaginatedTable.js";

const paymentsTable = document.querySelector("#paymentsTable");

const countElements = {
    "collected": document.querySelector("#collected-count"),
    "pending": document.querySelector("#pending-count"),
    "refunded": document.querySelector("#refunded-count"),
    "count": document.querySelector("#transactions-count")
}


async function loadCounts() {
    const response = await fetch("../../api/payments/count.php");
    const result = await response.json();

    if (!response.ok || !result.success) {
        return;
    }

    let sum = 0
    Object.entries(result.data).forEach(([key, value]) => {
        if (countElements[key]) {
            if (key == "collected") {
                value = formatCurrency(value)
            }
            countElements[key].textContent = value;
            sum += parseInt(sum)
        }
    });

}

function populateTable(table, payments) {

    const tbody = table.querySelector("tbody");
    tbody.innerHTML = "";

    loadCounts()

    if (payments.length === 0) {

        tbody.innerHTML = `
            <tr>
                <td colspan="8" class="text-center py-4">
                    No payments found.
                </td>
            </tr>
        `;

        return;
    }

    payments.forEach(payment => {

        const tr = document.createElement("tr");

        tr.dataset.id = payment.id;

        let statusClass = "status-secondary";

        switch (payment.status.toLowerCase()) {

            case "paid":
                statusClass = "status-success";
                break;

            case "pending":
                statusClass = "status-warning";
                break;

            case "refunded":
                statusClass = "status-danger";
                break;

            case "failed":
                statusClass = "status-secondary";
                break;

        }

        let actionButton = "";

        switch (payment.status.toLowerCase()) {

            case "pending":

                actionButton = `
                    <button
                        class="btn btn-outline action-remove hover-animation px-1"
                        title="Confirm Payment"
                        data-confirm-payment
                        data-id="${payment.id}">
                        <i class="fa-solid fa-check text-success"></i>
                    </button>
                `;

                break;

            case "paid":

                actionButton = `
                    <button
                        class="btn btn-outline action-remove hover-animation px-1"
                        title="Refund"
                        data-refund
                        data-id="${payment.id}"
                        data-bs-toggle="modal"
                        data-bs-target="#refundModal">
                        <i class="fa-solid fa-undo"></i>
                    </button>
                `;

                break;

            case "refunded":

                actionButton = `
                    <button
                        class="btn btn-outline action-remove hover-animation px-1"
                        title="Delete"
                        data-remove
                        data-bs-toggle="modal"
                        data-bs-target="#deletePaymentModal"
                        data-id="${payment.id}">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                `;

                break;

            default:

                actionButton = "";

        }

        tr.innerHTML = `
            <td>
                <span class="extra-small fw-semibold">
                    ${payment.payment_reference}
                </span>
            </td>

            <td>
                <span class="extra-small text-gray-light">
                    ${payment.booking_reference}
                </span>
            </td>

            <td>
                <p class="extra-small fw-semibold">
                    ${payment.guest}
                </p>
            </td>

            <td>
                <span
                    class="small fw-semibold"
                    data-price="${payment.amount}">
                    ${formatCurrency(payment.amount)}
                </span>
            </td>

            <td>
                <span class="small text-gray-light">
                    ${payment.payment_method}
                </span>
            </td>

            <td>
                <span class="small text-gray-light">
                    ${formatDate(payment.payment_date)}
                </span>
            </td>

            <td>
                <span class="status ${statusClass} rounded-2 text-uppercase small fw-bold">
                    ${payment.status}
                </span>
            </td>

            <td>
                <div class="action-group">

                    <button
                        class="btn btn-outline action-edit text-gray-light hover-animation px-1"
                        title="View Details"
                        data-view
                        data-id="${payment.id}"
                        data-bs-toggle="modal"
                        data-bs-target="#viewDetailsModal">

                        <i class="fa-regular fa-file-alt"></i>

                    </button>

                    ${actionButton}

                </div>
            </td>
        `;

        tbody.appendChild(tr);

    });

}

export const paymentsPagination = new PaginatedTable({
    table: paymentsTable,
    endpoint: "../../api/payments/get.php",
    limit: 10,
    renderRows: populateTable
});