@extends('layouts.app')

@section('content')
    <!-- Main Content -->
    <div class="container main-container">
        <!-- Statistics -->
        <div class="row mb-4">
            <div class="col-md-3 col-6">
                <div class="stats-card">
                    <p class="stats-number text-danger" id="todoCount">{{ $todoCounts }}</p>
                    <small class="text-white">Cần làm</small>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stats-card">
                    <p class="stats-number text-warning" id="doingCount">{{ $doingCounts }}</p>
                    <small class="text-white">Đang làm</small>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stats-card">
                    <p class="stats-number text-success" id="finishCount">{{ $finishCounts }}</p>
                    <small class="text-white">Hoàn thành</small>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stats-card">
                    <p class="stats-number text-primary" id="totalCount">{{ $todoCounts + $doingCounts + $finishCounts }}</p>
                    <small class="text-white">Tổng cộng</small>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Add Task Form -->
            <div class="col-lg-4 mb-4">
                <div class="card todo-card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-plus-circle me-2"></i>Thêm Công Việc Mới
                        </h5>
                    </div>
                    <div class="card-body">
                        <form id="todoForm" method="POST" action="{{ route('task.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="taskTitle" class="form-label">Tiêu đề công việc</label>
                                <input type="text" class="form-control" id="taskTitle" name="title" required>
                            </div>
                            <div class="mb-3">
                                <label for="taskDescription" class="form-label">Mô tả</label>
                                <textarea class="form-control" id="taskDescription" name="description" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="taskStatus" class="form-label">Trạng thái</label>
                                <select class="form-select" id="taskStatus" name="status">
                                    <option value="todo">Cần làm</option>
                                    <option value="doing">Đang làm</option>
                                    <option value="finish">Hoàn thành</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="taskDeadline" class="form-label">Hạn hoàn thành</label>
                                <input type="datetime-local" class="form-control" id="taskDeadline" name="deadline">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-plus me-2"></i>Thêm Công Việc
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Task List -->
            <div class="col-lg-8">
                <div class="card todo-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-list me-2"></i>Danh Sách Công Việc
                        </h5>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-outline-light btn-sm" onclick="filterTasks('all')">Tất
                                cả</button>
                            <button type="button" class="btn btn-outline-light btn-sm" onclick="filterTasks('todo')">Cần
                                làm</button>
                            <button type="button" class="btn btn-outline-light btn-sm" onclick="filterTasks('doing')">Đang
                                làm</button>
                            <button type="button" class="btn btn-outline-light btn-sm" onclick="filterTasks('finish')">Hoàn
                                thành</button>
                        </div>
                    </div>
                    <div class="card-body text-white" style="max-height: 600px; overflow-y: auto;">
                        
                        @if ($tasks->isEmpty())
                            <div id="todoList">
                                <div class="empty-state">
                                    <i class="fas fa-clipboard-list"></i>
                                    <h5>Chưa có công việc nào</h5>
                                    <p>Hãy thêm công việc đầu tiên của bạn!</p>
                                </div>
                            </div>
                        @endif

                        @foreach ($tasks as $item)
                            <div class="todo-item {{ $item->status }}" data-id="{{ $item->id }}">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="mb-1 flex-grow-1">{{ $item->title }}</h6>
                                    <div class="d-flex align-items-center">
                                        <span class="status-badge status-{{ $item->status }} me-2">{{ $item->status }}</span>
                                        <div class="btn-group">
                                            <button class="btn btn-outline-warning btn-sm" onclick="editTask({{ $item->id }})"
                                                title="Chỉnh sửa">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-outline-danger btn-sm" onclick="deleteTask({{ $item->id }})"
                                                title="Xóa">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <p class="mb-2 text-secondary">{{ $item->description }}</p>
                                </p>
                                <small class="deadline-text">
                                    <i class="fas fa-clock me-1"></i>{{ $item->deadline }}
                                </small>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Chỉnh Sửa Công Việc</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <input type="hidden" id="editTaskId">
                        <div class="mb-3">
                            <label for="editTaskTitle" class="form-label">Tiêu đề công việc</label>
                            <input type="text" class="form-control" id="editTaskTitle" required>
                        </div>
                        <div class="mb-3">
                            <label for="editTaskDescription" class="form-label">Mô tả</label>
                            <textarea class="form-control" id="editTaskDescription" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editTaskStatus" class="form-label">Trạng thái</label>
                            <select class="form-select" id="editTaskStatus">
                                <option value="todo">Cần làm</option>
                                <option value="doing">Đang làm</option>
                                <option value="finish">Hoàn thành</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editTaskDeadline" class="form-label">Hạn hoàn thành</label>
                            <input type="datetime-local" class="form-control" id="editTaskDeadline">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-primary" onclick="saveEdit()">Lưu Thay Đổi</button>
                </div>
            </div>
        </div>
    </div>
@endsection
