const addRoomForm = document.querySelector("#addRoomForm");

if (addRoomForm) {
    addRoomForm.addEventListener("submit", async function (e) {
        e.preventDefault()

        const formData = new FormData(e.target);

        const response = await fetch("../../api/rooms/add.php", {
            method: "post",
            body: formData
        })

    })
}