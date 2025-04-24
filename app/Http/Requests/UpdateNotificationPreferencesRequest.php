<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNotificationPreferencesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'notifications' => 'array',
            'notifications.security' => 'nullable|boolean',
            'notifications.payments' => 'nullable|boolean',
            'notifications.reminders' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'notifications.security.boolean' => 'La notificación de seguridad debe ser verdadero o falso.',
            'notifications.payments.boolean' => 'La notificación de pagos debe ser verdadero o falso.',
            'notifications.reminders.boolean' => 'La notificación de recordatorios debe ser verdadero o falso.',
        ];
    }
}
