<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;

class PreviewController extends Controller
{
    public function preview_form($id)
    {
        $form = Form::find($id);
        $formData = json_decode($form->data);
        $bgColor = $form->bg_color;

        $formBuilderOrder = [];
        $textValue  = '';
        $textColor = '';
        $inputPlaceholder = '';
        $buttonText = '';

        foreach ($formData as $data) {
            if ($data->type == 'text') {
                $textValue = $data->value;
                $textColor = $data->color;
            }
            if ($data->type == 'input') {
                $inputPlaceholder = $data->placeholder;
            }
            if ($data->type == 'button') {
                $buttonText = $data->value;
            }
            array_push($formBuilderOrder, $data->type);
        }

        return view('preview')->with([
            'formBuilderOrder' => $formBuilderOrder,
            'textValue' => $textValue,
            'textColor' => $textColor,
            'bgColor' => $bgColor,
            'inputPlaceholder' => $inputPlaceholder,
            'buttonText' => $buttonText
        ]);
    }
}
