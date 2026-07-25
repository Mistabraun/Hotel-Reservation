import { paymentsPagination } from "../pages/Payments.js";
import { DeleteModal } from "../components/DeleteModal.js";
import { FilterGroup } from "../components/FilterGroup.js";


const paymentModal = document.getElementById("addPaymentModal");
const paymentForm = document.getElementById("addRoomForm");

if (paymentModal && paymentForm) {

    const modalTitle =
        paymentModal.querySelector("[data-title]");

    const modalMessage =
        paymentModal.querySelector("#modalMessage");

    const popModal =
        popModalMessage(paymentForm, modalMessage);

    let paymentMode = "create";
    let editingPaymentId = null;

    let reservations = [];

    async function loadReservations() {

        const response = await fetch(
            "../../api/payments/getAvailableReservations.php"
        );

        const result = await response.json();

        if (!result.success) {
            return;
        }


        reservations = result.data;

        const select = paymentForm.reservation_id;

        if (!reservations) {
            select.innerHTML = `<option value="">Reservations is empty</option>`;
            return
        }

        select.innerHTML =
            `<option value="">Select reservation...</option>`;

        reservations.forEach(reservation => {

            select.innerHTML += `
                <option value="${reservation.id}">
                    ${reservation.booking_reference}
                    — ${reservation.guest}
                </option>
            `;

        });

    }

    async function loadPaymentMethods() {

        const response = await fetch(
            "../../api/payments/getPaymentMethods.php"
        );

        const result = await response.json();

        if (!result.success) {
            return;
        }

        const select =
            paymentForm.payment_method_id;

        select.innerHTML = "";

        result.data.forEach(method => {

            select.innerHTML += `
                <option value="${method.id}">
                    ${method.name}
                </option>
            `;

        });

    }

    async function loadStatuses() {

        const response = await fetch(
            "../../api/payments/getStatuses.php"
        );

        const result = await response.json();

        if (!result.success) {
            return;
        }

        const select =
            paymentForm.status_id;

        select.innerHTML = "";

        result.data.forEach(status => {

            select.innerHTML += `
                <option value="${status.id}">
                    ${status.name}
                </option>
            `;

        });

    }

    function updateAmount() {

        const reservation = reservations.find(
            item =>
                Number(item.id) ===
                Number(paymentForm.reservation_id.value)
        );

        paymentForm.amount.value =
            reservation
                ? formatCurrency(reservation.total_amount)
                : "";

    }

    paymentForm.reservation_id.addEventListener(
        "change",
        updateAmount
    );

    async function prepareViewModal(paymentId) {

        const response = await fetch(
            `../../api/payments/getById.php?id=${paymentId}`
        );

        const result = await response.json();

        if (!result.success) {
            return;
        }

        const payment = result.data;

        viewDetailsModal.querySelector("[data-id]").textContent =
            payment.payment_reference;

        viewDetailsModal.querySelector("[data-guest]").textContent =
            payment.guest;

        viewDetailsModal.querySelector("[data-reservation]").textContent =
            payment.booking_reference;

        viewDetailsModal.querySelector("[data-method]").textContent =
            payment.payment_method;

        viewDetailsModal.querySelector("[data-date]").textContent =
            formatDate(payment.paid_at);

        viewDetailsModal.querySelector("[data-amount]").textContent =
            formatCurrency(payment.amount);

        viewDetailsModal.querySelector("[data-status]").textContent =
            payment.status;

    }

    async function prepareCreateModal() {

        paymentMode = "create";
        editingPaymentId = null;

        modalTitle.textContent = "Add Payment";

        paymentForm.reset();

        modalMessage.classList.add("d-none");

        await Promise.all([
            loadReservations(),
            loadPaymentMethods(),
            loadStatuses()
        ]);

        paymentForm.amount.value = "";
        paymentForm.payment_reference.value = "";
    }

    async function prepareEditModal(paymentId) {

        paymentMode = "edit";
        editingPaymentId = paymentId;

        modalTitle.textContent = "Edit Payment";

        modalMessage.classList.add("d-none");

        await Promise.all([
            loadReservations(),
            loadPaymentMethods(),
            loadStatuses()
        ]);

        const response = await fetch(
            `../../api/payments/getById.php?id=${paymentId}`
        );

        const result = await response.json();

        if (!result.success) {
            popModal(false, result.message);
            return;
        }

        const payment = result.data;

        paymentForm.payment_reference.value =
            payment.payment_reference;

        paymentForm.reservation_id.value =
            payment.reservation_id;

        paymentForm.payment_method_id.value =
            payment.payment_method_id;

        paymentForm.status_id.value =
            payment.status_id;

        paymentForm.paid_at.value =
            payment.paid_at
                ? payment.paid_at.substring(0, 10)
                : "";

        updateAmount();

    }

    paymentForm.addEventListener(
        "submit",
        async function (e) {

            e.preventDefault();

            const formData = new FormData(paymentForm);

            let endpoint =
                "../../api/payments/create.php";

            if (paymentMode === "edit") {

                endpoint =
                    "../../api/payments/update.php";

                formData.append(
                    "id",
                    editingPaymentId
                );

            }

            const response = await fetch(
                endpoint,
                {
                    method: "POST",
                    body: formData
                }
            );

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
                .getInstance(paymentModal)
                .hide();

            await paymentsPagination.refresh();

        }
    );

    document
        .getElementById("addPaymentButton")
        ?.addEventListener(
            "click",
            prepareCreateModal
        );

    document.addEventListener("click", (e) => {

        const button = e.target.closest("[data-view]");

        if (!button) return;

        prepareViewModal(button.dataset.id);

    });

    document.addEventListener("click", (e) => {

        const button = e.target.closest("[data-edit]");

        if (!button) return;

        prepareEditModal(button.dataset.id);

    });

    /* ===========================
   View Receipt
=========================== */

    async function openReceipt(paymentId) {

        const response = await fetch(
            `../../api/payments/getById.php?id=${paymentId}`
        );

        const result = await response.json();

        if (!result.success) {
            return;
        }

        const payment = result.data;

        const modal = document.getElementById("viewDetailsModal");

        modal.querySelector("[data-id]").textContent =
            payment.payment_reference;

        modal.querySelector("[data-guest]").textContent =
            payment.guest;

        modal.querySelector("[data-reservation]").textContent =
            payment.booking_reference;

        modal.querySelector("[data-method]").textContent =
            payment.payment_method;

        const transactionContainer =
            modal.querySelector("[data-transaction]").parentElement;

        if (payment.transaction_reference) {

            transactionContainer.classList.remove("d-none");

            modal.querySelector("[data-transaction]").textContent =
                payment.transaction_reference;

        } else {

            transactionContainer.classList.add("d-none");

        }

        modal.querySelector("[data-date]").textContent =
            formatDate(payment.paid_at);

        modal.querySelector("[data-amount]").textContent =
            formatCurrency(payment.amount);

        const status = modal.querySelector("[data-status]");

        status.className = "combo-success py-2 rounded-3 text-center";


        switch (payment.status.toLowerCase()) {

            case "paid":
                status.parentElement.className =
                    "combo-success py-2 rounded-3 text-center";

                status.innerHTML = `
                <i class="fa-solid fa-check-double"></i>
                <span class="fw-semibold">
                    Payment Received
                </span>
            `;

                break;

            case "pending":

                status.parentElement.className =
                    "combo-warning py-2 rounded-3 text-center";

                status.className =
                    "combo-warning py-2 rounded-3 text-center";

                status.innerHTML = `
                <i class="fa-solid fa-clock"></i>
                <span class="fw-semibold">
                    Pending
                </span>
            `;

                break;

            case "refunded":

                status.parentElement.className =
                    "combo-danger py-2 rounded-3 text-center";

                status.className =
                    "combo-danger py-2 rounded-3 text-center";

                status.innerHTML = `
                <i class="fa-solid fa-rotate-left"></i>
                <span class="fw-semibold">
                    Refunded
                </span>
            `;

                break;
            case "cancelled":
                status.parentElement.className =
                    "combo-gray py-2 rounded-3 text-center";

                status.className =
                    "combo-gray py-2 rounded-3 text-center";

                status.innerHTML = `
                <i class="fa-solid fa-cancel"></i>
                <span class="fw-semibold">
                    Cancelled
                </span>`

                break;
        }

    }


    /* ===========================
       Confirm Payment
    =========================== */

    document.addEventListener(
        "click",
        async function (e) {

            const button =
                e.target.closest("[data-confirm-payment]");

            if (!button) {
                return;
            }

            const response = await fetch(
                "../../api/payments/confirm.php",
                {
                    method: "POST",
                    headers: {
                        "Content-Type":
                            "application/x-www-form-urlencoded"
                    },
                    body:
                        "id=" + button.dataset.id
                }
            );

            const result =
                await response.json();

            if (!result.success) {
                alert(result.message);
                return;
            }

            await paymentsPagination.refresh();

        }
    );


    /* ===========================
       Refund
    =========================== */

    let refundPaymentId = null;

    document.addEventListener(
        "click",
        async function (e) {

            const button =
                e.target.closest("[data-refund]");

            if (!button) {
                return;
            }

            refundPaymentId =
                button.dataset.id;

            const response = await fetch(
                `../../ api / payments / getById.php ? id = ${refundPaymentId} `
            );

            const result =
                await response.json();

            if (!result.success) {
                return;
            }

            document.getElementById("refund-message")
                .textContent =
                `This will refund payment ${result.data.payment_reference}. This action may be irreversible.`;

        }
    );

    document
        .getElementById("refund-confirm")
        ?.addEventListener(
            "click",
            async function () {

                const response =
                    await fetch(
                        "../../api/payments/refund.php",
                        {
                            method: "POST",
                            headers: {
                                "Content-Type":
                                    "application/x-www-form-urlencoded"
                            },
                            body:
                                "id=" + refundPaymentId
                        }
                    );

                const result =
                    await response.json();

                if (!result.success) {
                    alert(result.message);
                    return;
                }

                bootstrap.Modal
                    .getInstance(
                        document.getElementById("refundModal")
                    )
                    .hide();

                await paymentsPagination.refresh();

            }
        );


    /* ===========================
       Receipt Button
    =========================== */

    document.addEventListener(
        "click",
        function (e) {

            const button =
                e.target.closest("[data-view]");

            if (!button) {
                return;
            }

            openReceipt(
                button.dataset.id
            );

        }
    );


    /* ===========================
       Delete
    =========================== */

    new DeleteModal({

        modal:
            document.querySelector(
                "#deletePaymentModal"
            ),

        endpoint:
            "../../api/payments/delete.php",

        refresh: () =>
            paymentsPagination.refresh()

    });


    /* ===========================
       Search
    =========================== */

    const paymentSearch =
        document.querySelector("#paymentSearch");

    if (paymentSearch) {

        let timeout;

        paymentSearch.addEventListener(
            "input",
            () => {

                clearTimeout(timeout);

                timeout =
                    setTimeout(() => {

                        paymentsPagination.setSearch(
                            paymentSearch.value.trim()
                        );

                    }, 200);

            });

    }


    /* ===========================
       Filter
    =========================== */

    const paymentSort =
        document.querySelector(".sort-group");

    if (paymentSort) {

        paymentSort.addEventListener(
            "change",
            e => {

                if (e.target.name !== "sort") {
                    return;
                }

                paymentsPagination.setFilter(
                    e.target.value
                );

            });

    }


    paymentsPagination.load(1, "all");

}