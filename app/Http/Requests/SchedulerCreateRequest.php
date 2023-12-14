<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SchedulerCreateRequest extends FormRequest
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
            'name' => ['unique:schedulers,name','required', 'string'],
            'description' => ['required', 'string'],
            'is_active' => ['required', 'boolean'],
            'timezone' => ['required', 'string'],
            'cron_job_class' => ['required', 'string'],
            'frequencies' => ['array', 'required'],
            'frequencies.*.frequency_id' => ['numeric', 'required',function(){
                
            }],
            'frequencies.*.frequency_params' => ['array', 'nullable'],
            'frequencies.*.frequency_params.*' => ['numeric', 'required'],
            'notifiable_emails' => ['array', 'nullable'],
            'notifiable_emails.*' => ['email', 'string'],
            'notify_on_slack' => ['boolean']
        ];
    }
}
