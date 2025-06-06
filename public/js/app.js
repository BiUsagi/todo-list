 let tasks = [];
        let currentFilter = 'all';
        let editingTaskId = null;

        // Khởi tạo ứng dụng
        document.addEventListener('DOMContentLoaded', function() {
            loadTasks();
            renderTasks();
            updateStats();
        });

        // Xử lý form thêm công việc
        document.getElementById('todoForm').addEventListener('submit', function(e) {
            e.preventDefault();
            addTask();
        });

        // Thêm công việc mới
        function addTask() {
            const title = document.getElementById('taskTitle').value.trim();
            const description = document.getElementById('taskDescription').value.trim();
            const status = document.getElementById('taskStatus').value;
            const deadline = document.getElementById('taskDeadline').value;

            if (!title) {
                alert('Vui lòng nhập tiêu đề công việc!');
                return;
            }

            const task = {
                id: Date.now(),
                title: title,
                description: description,
                status: status,
                deadline: deadline,
                createdAt: new Date().toISOString()
            };

            tasks.push(task);
            saveTasks();
            renderTasks();
            updateStats();
            clearForm();
        }

        // Xóa form
        function clearForm() {
            document.getElementById('todoForm').reset();
        }

        // Hiển thị danh sách công việc
        function renderTasks() {
            const todoList = document.getElementById('todoList');
            let filteredTasks = tasks;

            if (currentFilter !== 'all') {
                filteredTasks = tasks.filter(task => task.status === currentFilter);
            }

            if (filteredTasks.length === 0) {
                todoList.innerHTML = `
                    <div class="empty-state">
                        <i class="fas fa-clipboard-list"></i>
                        <h5>Không có công việc nào</h5>
                        <p>${currentFilter === 'all' ? 'Hãy thêm công việc đầu tiên của bạn!' : 'Không có công việc nào trong danh mục này.'}</p>
                    </div>
                `;
                return;
            }

            const tasksHTML = filteredTasks.map(task => createTaskHTML(task)).join('');
            todoList.innerHTML = tasksHTML;
        }

        // Tạo HTML cho một công việc
        // function createTaskHTML(task) {
        //     const statusText = {
        //         'todo': 'Cần làm',
        //         'doing': 'Đang làm',
        //         'finish': 'Hoàn thành'
        //     };

        //     const deadlineText = task.deadline ? formatDeadline(task.deadline) : '';
        //     const isDeadlineSoon = task.deadline && isDeadlineClose(task.deadline);

        //     return `
        //         <div class="todo-item ${task.status}" data-id="${task.id}">
        //             <div class="d-flex justify-content-between align-items-start mb-2">
        //                 <h6 class="mb-1 flex-grow-1">${task.title}</h6>
        //                 <div class="d-flex align-items-center">
        //                     <span class="status-badge status-${task.status} me-2">${statusText[task.status]}</span>
        //                     <div class="btn-group">
        //                         <button class="btn btn-outline-warning btn-sm" onclick="editTask(${task.id})" title="Chỉnh sửa">
        //                             <i class="fas fa-edit"></i>
        //                         </button>
        //                         <button class="btn btn-outline-danger btn-sm" onclick="deleteTask(${task.id})" title="Xóa">
        //                             <i class="fas fa-trash"></i>
        //                         </button>
        //                     </div>
        //                 </div>
        //             </div>
        //             ${task.description ? `<p class="mb-2 text-muted">${task.description}</p>` : ''}
        //             ${deadlineText ? `<small class="deadline-text ${isDeadlineSoon ? 'deadline-soon' : ''}">
        //                 <i class="fas fa-clock me-1"></i>${deadlineText}
        //             </small>` : ''}
        //         </div>
        //     `;
        // }

        // Định dạng thời gian deadline
        function formatDeadline(deadline) {
            const date = new Date(deadline);
            const now = new Date();
            
            if (date < now) {
                return `Đã quá hạn: ${date.toLocaleString('vi-VN')}`;
            }
            
            return `Hạn: ${date.toLocaleString('vi-VN')}`;
        }

        // Kiểm tra deadline gần
        function isDeadlineClose(deadline) {
            const date = new Date(deadline);
            const now = new Date();
            const diffTime = date - now;
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            
            return diffDays <= 1;
        }

        // Chỉnh sửa công việc
        function editTask(id) {
            const task = tasks.find(t => t.id === id);
            if (!task) return;

            editingTaskId = id;
            document.getElementById('editTaskId').value = id;
            document.getElementById('editTaskTitle').value = task.title;
            document.getElementById('editTaskDescription').value = task.description;
            document.getElementById('editTaskStatus').value = task.status;
            document.getElementById('editTaskDeadline').value = task.deadline;

            const modal = new bootstrap.Modal(document.getElementById('editModal'));
            modal.show();
        }

        // Lưu chỉnh sửa
        function saveEdit() {
            const id = parseInt(document.getElementById('editTaskId').value);
            const title = document.getElementById('editTaskTitle').value.trim();
            const description = document.getElementById('editTaskDescription').value.trim();
            const status = document.getElementById('editTaskStatus').value;
            const deadline = document.getElementById('editTaskDeadline').value;

            if (!title) {
                alert('Vui lòng nhập tiêu đề công việc!');
                return;
            }

            const taskIndex = tasks.findIndex(t => t.id === id);
            if (taskIndex !== -1) {
                tasks[taskIndex] = {
                    ...tasks[taskIndex],
                    title: title,
                    description: description,
                    status: status,
                    deadline: deadline
                };

                saveTasks();
                renderTasks();
                updateStats();

                const modal = bootstrap.Modal.getInstance(document.getElementById('editModal'));
                modal.hide();
            }
        }

        // Xóa công việc
        function deleteTask(id) {
            if (confirm('Bạn có chắc chắn muốn xóa công việc này?')) {
                tasks = tasks.filter(task => task.id !== id);
                saveTasks();
                renderTasks();
                updateStats();
            }
        }

        // Lọc công việc
        function filterTasks(status) {
            currentFilter = status;
            
            // Cập nhật trạng thái active cho nút filter
            document.querySelectorAll('.btn-group .btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');
            
            renderTasks();
        }

        // Cập nhật thống kê
        function updateStats() {
            const todoCount = tasks.filter(task => task.status === 'todo').length;
            const doingCount = tasks.filter(task => task.status === 'doing').length;
            const finishCount = tasks.filter(task => task.status === 'finish').length;
            const totalCount = tasks.length;

            document.getElementById('todoCount').textContent = todoCount;
            document.getElementById('doingCount').textContent = doingCount;
            document.getElementById('finishCount').textContent = finishCount;
            document.getElementById('totalCount').textContent = totalCount;
        }

        // Lưu dữ liệu (sử dụng JavaScript object thay vì localStorage)
        // function saveTasks() {
            // Trong môi trường thực tế, bạn có thể lưu vào database
            // Hiện tại chỉ lưu trong memory của session
        // }

        // Tải dữ liệu
        // function loadTasks() {
            // Trong môi trường thực tế, bạn sẽ tải từ database
            // Hiện tại khởi tạo với dữ liệu mẫu
        //     if (tasks.length === 0) {
        //         tasks = [
        //             {
        //                 id: 1,
        //                 title: "Hoàn thành dự án website",
        //                 description: "Thiết kế và phát triển website todo-list với đầy đủ chức năng",
        //                 status: "doing",
        //                 deadline: "2025-06-10T23:59",
        //                 createdAt: new Date().toISOString()
        //             },
        //             {
        //                 id: 2,
        //                 title: "Học Bootstrap 5",
        //                 description: "Tìm hiểu về các component và utility class của Bootstrap",
        //                 status: "finish",
        //                 deadline: "",
        //                 createdAt: new Date().toISOString()
        //             }
        //         ];
        //     }
        // }