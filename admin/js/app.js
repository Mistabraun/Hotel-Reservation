const addRoomModalElement = document.querySelector("#addRoom")
const addRoomForm = addRoomModalElement.querySelector("#addRoomForm");

if (addRoomModalElement && addRoomForm) {
    const closeModalBtn = addRoomModalElement.querySelector("#closeModal")
    const modalMessage = addRoomModalElement.querySelector("#modalMessage");

    addRoomModalElement.addEventListener('hidden.bs.modal', function (event) {
        modalMessage.classList.add("d-none")
    });


    addRoomForm.addEventListener("submit", async function (e) {
        e.preventDefault()

        const formData = new FormData(e.target);

        const response = await fetch("../../api/rooms/add.php", {
            method: "post",
            body: formData
        })

        const result = await response.json()

        modalMessage.classList.remove("d-none")
        if (result["success"]) {
            addRoomForm.reset();
            modalMessage.classList.remove("alert-danger")
            modalMessage.classList.add("alert-success")
            modalMessage.textContent = result["message"]
            return
        }

        shakeElement(modalMessage)

        modalMessage.classList.add("alert-danger")
        modalMessage.classList.remove("alert-success")
        modalMessage.textContent = result["message"]
        return
    })
}