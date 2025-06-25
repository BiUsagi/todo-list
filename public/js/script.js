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

// Sử dụng Swal từ CDN (window.Swal)
document.addEventListener("DOMContentLoaded", function () {
    const deleteButtons = document.querySelectorAll(".btn-delete-task");

    deleteButtons.forEach((button) => {
        button.addEventListener("click", function (e) {
            e.preventDefault();

            const form = this.closest("form");

            if (typeof Swal === "undefined") {
                alert("Không tìm thấy SweetAlert2! Kiểm tra lại script CDN.");
                return;
            }

            Swal.fire({
                title: "Xác nhận xóa nhiệm vụ này?",
                text: "Thao tác này không thể hoàn tác!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Vâng, xóa nó!",
                cancelButtonText: "Hủy",
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
