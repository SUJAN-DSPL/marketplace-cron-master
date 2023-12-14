<?php

namespace App\Http\Requests;

use App\Models\Scheduler;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class SchedulerUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return !!Auth::user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', Rule::unique(Scheduler::class, 'uuid')->ignore($this->scheduler->name, 'name')],
            'description' => ['required', 'string'],
            'is_active' => ['required', 'boolean'],
            'timezone' => ['required', 'string'],
            'frequencies' => ['array', 'required'],
            'frequencies.*.frequency_id' => ['numeric', 'required'],
            'frequencies.*.frequency_params' => ['array', 'nullable'],
            'frequencies.*.frequency_params.*' => ['numeric', 'required'],
            'notifiable_emails' => ['array', 'nullable'],
            'notifiable_emails.*' => ['email', 'string'],
            'notify_on_slack' => ['boolean']
        ];
    }
}
