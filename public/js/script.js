// document.addEventListener("DOMContentLoaded", function () {
//     // tasks được gán từ Blade bằng inline script
//     window.editTask = function (id) {
//         const task = window.tasks.find((t) => t.id === id);
//         if (!task) {
//             alert("Không tìm thấy công việc!");
//             return;
//         }

//         document.getElementById("editTaskId").value = task.id;
//         document.getElementById("editTaskTitle").value = task.title;
//         document.getElementById("editTaskDescription").value =
//             task.description || "";
//         document.getElementById("editTaskStatus").value = task.status;
//         document.getElementById("editTaskDeadline").value = task.deadline
//             ? new Date(task.deadline).toISOString().slice(0, 16)
//             : "";

//         const modal = new bootstrap.Modal(document.getElementById("editModal"));
//         modal.show();
//     };
// });
