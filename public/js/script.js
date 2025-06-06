
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
 