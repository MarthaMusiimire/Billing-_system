<?php

namespace Modules\Client\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest


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
     */
    public function rules(): array
    {
        return [

            
            'client_name' => 'sometimes|required|string|max:255',
            'facility_level'=> 'sometimes|required|string|',
            'location'=> 'sometimes|required|string|max:255',
            'contact_name'=> 'sometimes|required|string|max:255',
            'contact_phone'=> 'sometimes|required|string|max:255',
            'support_engineer_name'=> 'sometimes|required|string|max:255',
            'support_engineer_phone'=> 'sometimes|required|string|max:255',
            'support_engineer_email'=> 'sometimes|required|string|max:255|email:rfc,dns',
            
        ];
    }

    


    public function messages(): array
    {
        return [
            'client_name.required' => 'This field is required.',
            'client_name.string' => 'The name must be a string.',
            'location.string' => 'This field must be a string.',
            'location.required' => 'This field is required.',
            'contact_name.required' => 'This field is required.',
            'contact_phone.required' => 'This field is required.',
            'support_engineer_email.required' => 'The email field is required.',
            'support_engineer_email.email' => 'The email must be a valid email address.',
            'support_engineer_email.max' => 'The email should greater than 50 characters.',
           
 
            
        ];
    }

    
}
