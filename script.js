document.addEventListener("DOMContentLoaded", function () {
    let deletes = document.querySelectorAll(".confirm");

    deletes.forEach(btn => {
        btn.addEventListener("click", function (e) {
            if (!confirm("Are you sure you want to delete this spot?")) {
                e.preventDefault();
            }
        });
    });
});
