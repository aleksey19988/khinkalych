<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int $phone Номер телефона гостя
 * @property string $name Имя гостя
 */
class StoreSealRequest extends FormRequest
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
            'phone' => ['required', 'max:10', 'min:10'],
            'name' => ['nullable'],
        ];
    }

    public function messages()
    {
        return array_merge(parent::messages(), [
            'phone.max' => 'Должно быть 10 цифр',
            'phone.min' => 'Должно быть 10 цифр',
        ]);
    }

    /**
     * Валидация имени гостя при его добавлении
     *
     * @return array
     */
    public function validateName(): array
    {
        if (strlen($this->name) < 3) {
            return [
                'success' => false,
                'message' => 'Имя слишком короткое (минимум 3 символа)',
            ];
        }

        if (strlen($this->name) > 50) {
            return [
                'success' => false,
                'message' => 'Имя слишком длинное (максимум 50 символов)',
            ];
        }

        return [
            'success' => true,
            'message' => null,
        ];
    }
}
