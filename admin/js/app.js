document.addEventListener("DOMContentLoaded", () => {
    document.addEventListener("click", function (e) {

        const button = e.target.closest("[data-remove]");

        if (!button) return;

        const roomId = button.dataset.id;

        if (!confirm("Delete this room?")) {
            return;
        }

        const formData = new FormData();
        formData.append("id", roomId);

        fetch("../../api/rooms/delete.php", {
            method: "POST",
            body: formData
        })
            .then(res => res.json())
            .then(async result => {

                alert(result.message);

                if (result.success) {
                    await roomsPagination.refresh();
                }

            });

    });

})