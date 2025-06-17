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
                    <p class="stats-number text-primary" id="totalCount">{{ $todoCounts + $doingCounts + $finishCounts }}
                    </p>
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
                            <a href="{{ route('task.index') }}"
                                class="btn btn-outline-light btn-sm {{ request('status') == null ? 'active' : '' }}">Tất
                                cả</a>
                            <a href="{{ route('task.index', ['status' => 'todo']) }}"
                                class="btn btn-outline-light btn-sm {{ request('status') == 'todo' ? 'active' : '' }}">Cần
                                làm</a>
                            <a href="{{ route('task.index', ['status' => 'doing']) }}"
                                class="btn btn-outline-light btn-sm {{ request('status') == 'doing' ? 'active' : '' }}">Đang
                                làm</a>
                            <a href="{{ route('task.index', ['status' => 'done']) }}"
                                class="btn btn-outline-light btn-sm {{ request('status') == 'done' ? 'active' : '' }}">Hoàn
                                thành</a>
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
                            <div class="todo-item {{ $item->status }} active" data-id="{{ $item->id }}">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    @if ($item->status === 'done')
                                        <h6 class="mb-1 flex-grow-1" style="text-decoration: line-through;">
                                            {{ $item->title }}</h6>
                                    @else
                                        <h6 class="mb-1 flex-grow-1">{{ $item->title }}</h6>
                                    @endif
                                    <div class="d-flex align-items-center">
                                        <span
                                            class="status-badge status-{{ $item->status }} me-2">{{ $item->status }}</span>
                                        <div class="btn-group">
                                            <button class="btn btn-outline-warning btn-sm"
                                                onclick="editTask({{ $item->id }})" title="Chỉnh sửa">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="{{ route('task.destroy', $item->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm"
                                                    title="Xóa"
                                                    onclick="return confirm('Bạn có chắc muốn xóa công việc này?');">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST" action="">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editTaskId" name="id">
                        <div class="mb-3">
                            <label for="editTaskTitle" class="form-label">Tiêu đề công việc</label>
                            <input type="text" class="form-control" id="editTaskTitle" name="title"
                                placeholder="Nhập tiêu đề..." required>
                        </div>
                        <div class="mb-3">
                            <label for="editTaskDescription" class="form-label">Mô tả</label>
                            <textarea class="form-control" id="editTaskDescription" name="description" rows="3"
                                placeholder="Nhập mô tả chi tiết..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editTaskStatus" class="form-label">Trạng thái</label>
                            <select class="form-select" id="editTaskStatus" name="status">
                                <option value="todo">Cần làm</option>
                                <option value="doing">Đang làm</option>
                                <option value="done">Hoàn thành</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editTaskDeadline" class="form-label">Hạn hoàn thành</label>
                            <input type="datetime-local" class="form-control" id="editTaskDeadline" name="deadline">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-primary">Lưu Thay Đổi</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
