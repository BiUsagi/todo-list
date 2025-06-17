<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Todo;
use App\Models\User;
class TodoController extends Controller
{
    /**
     * Hiển thị form tạo task mới
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Xử lý lưu task mới vào database
     */
    public function store(Request $request)
    {
        // Validate dữ liệu đầu vào
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:todo,doing,finish',
            'deadline' => 'nullable|date|after_or_equal:today'
        ], [
            'title.required' => 'Tiêu đề công việc là bắt buộc',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự',
            'status.required' => 'Trạng thái là bắt buộc',
            'status.in' => 'Trạng thái không hợp lệ',
            'deadline.date' => 'Định dạng ngày không hợp lệ',
            'deadline.after_or_equal' => 'Hạn hoàn thành không được là ngày trong quá khứ'
        ]);

        // Nếu validation thất bại
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Tạo task mới
            $task = Todo::create([
                'title' => $request->title,
                'description' => $request->description,
                'status' => $request->status,
                'deadline' => $request->deadline,
                'user_id' => auth()->id(),
            ]);

            // Redirect với thông báo thành công
            return redirect()->route('task.index')
                ->with('success', 'Công việc đã được tạo thành công!');

        } catch (\Exception $e) {
            // Xử lý lỗi
            return redirect()->back()
                ->with('error', 'Có lỗi xảy ra khi tạo công việc: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Hiển thị danh sách tasks
     */
    public function index()
    {
        $todoCounts = Todo::where('status', 'todo')->count();
        $doingCounts = Todo::where('status', 'doing')->count();
        $finishCounts = Todo::where('status', 'finish')->count();
        $tasks = Todo::orderBy('created_at', 'desc')->paginate(10);
        return view('index', compact('tasks', 'todoCounts', 'doingCounts', 'finishCounts'));
    }

    /**
     * Hiển thị chi tiết một task
     */
    public function show($id)
    {
        $task = Todo::findOrFail($id);
        return view('tasks.show', compact('task'));
    }

    /**
     * Hiển thị form chỉnh sửa task
     */
    public function edit($id)
    {
        $task = Todo::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    /**
     * Cập nhật task
     */
    public function update(Request $request, $id)
    {
        $task = Todo::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:todo,doing,finish',
            'deadline' => 'nullable|date'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $task->update([
                'title' => $request->title,
                'description' => $request->description,
                'status' => $request->status,
                'deadline' => $request->deadline,
            ]);

            return redirect()->route('task.show', $task->id)
                ->with('success', 'Công việc đã được cập nhật thành công!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Có lỗi xảy ra khi cập nhật: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Xóa task
     */
    public function destroy($id)
    {
        try {
            $task = Todo::findOrFail($id);
            $task->delete();

            return redirect()->route('task.index')
                ->with('success', 'Công việc đã được xóa thành công!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Có lỗi xảy ra khi xóa: ' . $e->getMessage());
        }
    }
}