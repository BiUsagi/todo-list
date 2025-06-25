import "bootstrap/dist/css/bootstrap.min.css";
import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();
import * as bootstrap from "bootstrap";
window.bootstrap = bootstrap;

import Swal from "sweetalert2";

document.addEventListener("DOMContentLoaded", function () {
    // Tạo biến global
    window.editTask = function (id) {
        const task = window.tasks.find((t) => t.id === id);
        if (!task) {
            alert("Không tìm thấy công việc!");
            return;
        }

        document.getElementById("editTaskId").value = task.id;
        document.getElementById("editTaskTitle").value = task.title;
        document.getElementById("editTaskDescription").value =
            task.description || "";
        document.getElementById("editTaskStatus").value = task.status;
        document.getElementById("editTaskDeadline").value = task.deadline
            ? new Date(task.deadline).toISOString().slice(0, 16)
            : "";

        document.getElementById("editForm").action = `/tasks/${task.id}`;
        const modal = new bootstrap.Modal(document.getElementById("editModal"));
        modal.show();
    };

    
});
