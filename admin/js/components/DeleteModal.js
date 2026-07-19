export class DeleteModal {

    constructor({
        modal,
        endpoint,
        refresh,
        messageElement = "#modalMessage",
        confirmButton = "[data-confirm]"
    }) {

        this.modal = modal;
        this.endpoint = endpoint;
        this.refresh = refresh;
        this.id = null;

        this.message = modal.querySelector(messageElement);
        this.confirm = modal.querySelector(confirmButton);


        this.popModal = popModalMessage(this.message);

        this.initialize();
    }

    initialize() {

        document.addEventListener("click", e => {

            const button = e.target.closest("[data-remove]");

            if (!button) return;

            this.id = button.dataset.id;

        });

        this.confirm.addEventListener("click", () => this.delete());

    }

    async delete() {

        if (!this.id) return;

        const formData = new FormData();
        formData.append("id", this.id);

        const response = await fetch(this.endpoint, {
            method: "POST",
            body: formData
        });

        const result = await response.json();

        console.log(result)

        if (!result.success) {
            this.popModal(result.success, result.message);
            return;
        }

        bootstrap.Modal
            .getInstance(this.modal)
            .hide();

        if (this.refresh) {
            await this.refresh();
        }

        this.id = null;

    }

}