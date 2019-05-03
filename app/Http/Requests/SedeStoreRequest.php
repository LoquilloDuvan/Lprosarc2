<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SedeStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if(Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador')){
            return [
                'SedeName'      => 'required|max:128|min:1',
                'SedeAddress'   => 'required|max:255|min:1',
                'SedePhone1'    => 'max:11|min:11|nullable',
                'SedeExt1'      => 'min:2|max:5|nullable',
                'SedePhone2'    => 'max:11|min:11|nullable',
                'SedeExt2'      => 'min:2|max:5|nullable',
                'SedeEmail'     => 'required|email|max:128',
                'SedeCelular'   => 'required|min:12|max:12',
                'FK_SedeMun'    => 'required',
                
                'FK_SedeCli'    => 'required',
            ];
        }else{
            return [
                'SedeName'      => 'required|max:128|min:1',
                'SedeAddress'   => 'required|max:255|min:1',
                'SedePhone1'    => 'max:11|min:11|nullable',
                'SedeExt1'      => 'min:2|max:5|nullable',
                'SedePhone2'    => 'max:11|min:11|nullable',
                'SedeExt2'      => 'min:2|max:5|nullable',
                'SedeEmail'     => 'required|email|max:128',
                'SedeCelular'   => 'required|min:12|max:12',
                'FK_SedeMun'    => 'required',
            ];

        }
    }
}
