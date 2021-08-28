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
        $textXPos = '';
        $textYPos = '';
        $inputXPos = '';
        $inputYPos = '';
        $buttonXPos = '';
        $buttonYPos = '';
        $starXPos = '';
        $starYPos = '';

        foreach ($formData as $data) {
            if ($data->type == 'text') {
                $textValue = $data->value;
                $textColor = $data->color;
                $textXPos = $data->xPos;
                $textYPos = $data->yPos;
            }
            if ($data->type == 'input') {
                $inputPlaceholder = $data->placeholder;
                $inputXPos = $data->xPos;
                $inputYPos = $data->yPos;
            }
            if ($data->type == 'button') {
                $buttonText = $data->value;
                $buttonXPos = $data->xPos;
                $buttonYPos = $data->yPos;
            }
            if ($data->type == 'star') {
                $starXPos = $data->xPos;
                $starYPos = $data->yPos;
            }
            array_push($formBuilderOrder, $data->type);
        }

        return view('preview')->with([
            'formBuilderOrder' => $formBuilderOrder,
            'textValue' => $textValue,
            'textColor' => $textColor,
            'bgColor' => $bgColor,
            'inputPlaceholder' => $inputPlaceholder,
            'buttonText' => $buttonText,
            'textXPos' => $textXPos,
            'textYPos' => $textYPos,
            'inputXPos' => $inputXPos,
            'inputYPos' => $inputYPos,
            'buttonXPos' => $buttonXPos,
            'buttonYPos' => $buttonYPos,
            'starXPos' => $starXPos,
            'starYPos' => $starYPos,
        ]);
    }
}
