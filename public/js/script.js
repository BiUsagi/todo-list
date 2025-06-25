// --- Giữ trạng thái modal và vị trí cuộn ---
document.addEventListener("DOMContentLoaded", function () {
    // --- Giữ trạng thái modal ---
    var editModal = document.getElementById("editModal");
    if (editModal) {
        editModal.addEventListener("show.bs.modal", function () {
            sessionStorage.setItem("editModalOpen", "true");
        });
        editModal.addEventListener("hide.bs.modal", function () {
            sessionStorage.removeItem("editModalOpen");
        });

        // Khi load lại trang, nếu modal đang mở thì mở lại
        if (sessionStorage.getItem("editModalOpen") === "true") {
            var modal = new bootstrap.Modal(editModal);
            modal.show();
        }
    }

    // --- Giữ vị trí cuộn ---
    window.addEventListener("scroll", function () {
        sessionStorage.setItem("scrollPosition", window.scrollY);
    });

    // Khi load lại trang, cuộn đến vị trí đã lưu
    var scrollPosition = sessionStorage.getItem("scrollPosition");
    if (scrollPosition) {
        window.scrollTo(0, parseInt(scrollPosition));
    }
});
