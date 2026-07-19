const addRoomModalElement = document.querySelector("#addRoom")
const addRoomForm = addRoomModalElement.querySelector("#addRoomForm");

function popModalMessage() {

    addRoomModalElement.addEventListener('hidden.bs.modal', function (event) {
        modalMessage.classList.add("d-none")
    });


    return (status, message) => {
        modalMessage.classList.remove("d-none")

        if (status) {
            addRoomForm.reset();
            modalMessage.classList.remove("alert-danger")
            modalMessage.classList.add("alert-success")
            modalMessage.textContent = message
            return
        }

        shakeElement(modalMessage)

        modalMessage.classList.add("alert-danger")
        modalMessage.classList.remove("alert-success")
        modalMessage.textContent = message
    }
}

document.addEventListener("DOMContentLoaded", () => {

    if (addRoomModalElement && addRoomForm) {
        const closeModalBtn = addRoomModalElement.querySelector("#closeModal")
        const modalMessage = addRoomModalElement.querySelector("#modalMessage");
        const popModal = popModalMessage(modalMessage)

        addRoomForm.addEventListener("submit", async function (e) {
            e.preventDefault()

            const formData = new FormData(e.target);

            const response = await fetch("../../api/rooms/create.php", {
                method: "post",
                body: formData
            })

            const result = await response.json()
            const status = result["success"];
            const message = result["message"]

            popModal(status, message)

        })
    }

})