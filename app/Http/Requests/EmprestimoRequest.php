<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmprestimoRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
          'titulo' => 'required',
          'descricao' => 'required',
          'data' => 'required',
          'aluno_id' => 'required|exists:aluno,id',
          'exemplar_id' => 'required|exists:exemplar,id'
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.required' => 'Título é obrigatório',
            'descricao.required' => 'Descrição é obrigatória',
            'data.required' => 'Data é obrigatória',
            'exemplar_id.required' => 'Categoria é obrigatória',
            'aluno_id.required' => 'Aluno é obrigatório',
            'aluno_id.exists' => 'Aluno não encontrado',
            'exemplar_id.exists' => 'Categoria não encontrada',


        ];
    }
}
