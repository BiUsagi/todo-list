<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'date',
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'Tiêu đề công việc là bắt buộc',
            'title.string' => 'Tiêu đề phải là một chuỗi ký tự',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự',
            'description.string' => 'Mô tả phải là một chuỗi ký tự',
            'deadline.date' => 'Ngày hết hạn phải là một ngày hợp lệ',
        ];
    }
}
