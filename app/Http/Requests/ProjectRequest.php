<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'title' => 'required|max:100|min:3',
            'theme' => 'required|max:100|min:4',
            'company' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'type_id' => 'required',
            'technologies' => 'required',
            'img' => 'image|mimes:png,jpg,jpeg|max:5120'
        ];

    }

    public function messages() {

        return [

            'title.required' => 'Il titolo è obbligatorio',
            'title.max' => 'Il titolo deve contenere al massimo più di :max caratteri',
            'title.min' => 'Il titolo deve contenere almeno :min caratteri',
            'theme.required' => 'L\'argomento è obbligatorio',
            'theme.max' => 'L\'argomento deve contenere al massimo :max caratteri',
            'theme.min' => 'L\'argomento deve contenere almeno :min caratteri',
            'company.required' => 'L\'azienda è obbligatoria',
            'start_date.required' => 'La data d\'inizio è obbligatoria',
            'end_date.required' => 'La data di fine è obbligatoria',
            'end_date.date' => 'La data di fine deve essere una data valida',
            'end_date.after_or_equal' => 'La data di fine non può essere precedente alla data di inizio',
            'type_id' => 'La tipologia è obbligatoria',
            'technologies.required' => 'Le tecnologie scelte sono obbligatorie',
            'img.image' => 'L\'immagine selezionata non è valida',
            'img.mimes' => 'L\'immagine selezionata non è nel formato corretto. Inserire immgini con estensioni png, jpg o jpeg',
            'img.max' => 'L\'immagine selezionata non può superare i :max kilobytes'
        ];
    }
}
