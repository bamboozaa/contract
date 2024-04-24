<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContractRequest extends FormRequest
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
            'contract_no' => 'required',
            'contract_year' => 'required',
            'dep_id' => 'required',
            'contract_name' => 'required|string|max:255',
            'partners' => 'required|string|max:255',
            'acquisition_value' => 'required|regex:/^\d+(\.\d{1,2})?$/',

        ];
    }

    public function messages(): array
    {
        return [
            'contract_no.required' => 'กรุณากรอกเลขที่สัญญา',
            'contract_year.required' => 'กรุณากรอกปีการศึกษา',
            'dep_id.required' => 'กรุณาเลือกหน่วยงาน',
            'contract_name.required' => 'กรุณากรอกชื่อสัญญา',
            'partners.required' => 'กรุณากรอกชื่อคู่สัญญา',
            'acquisition_value.required' => 'กรุณากรอกมูลค่างานตามสัญญา',
        ];
    }
}
