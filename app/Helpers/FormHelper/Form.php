<?php

namespace App\Helpers\FormHelper;

class Form
{

    /**
     * @param string $type
     * @param string|null $is
     * @param string $name
     * @param string $label
     * @param string|null $placeholder
     * @param string|null $value
     * @param string|null $control
     * @param int $maxlenght
     * @param string|null $attributes
     * @return string
     */
    public function getInput(string $type, ?string $is, string $name, string $label, ?string $placeholder = " ", ?string $value = null, ?string $control = null, int $maxlenght = 100, ?string $attributes = null) : string
    {
        if ($type == "hidden") {
            return <<<FORM
            <input type="hidden" name="{$name}" value="{$value}">
FORM;
        }
        if($placeholder == null){
            $placeholder = " ";
        }

        return <<<FORM
                    <div class="field">
                        <div class="input-area">
                            <input autocomplete="off" type="{$type}" data-control="{$control}" maxlength="{$maxlenght}" is="{$is}"
                                   placeholder="{$placeholder}" value="{$value}" id="{$name}" name="{$name}" {$attributes}>
                            <label for="{$name}">{$label}</label>
                            <i class="error error-icon fi-rr-exclamation" title="champ obligatoire"></i>
                        </div>
                        <div class="error error-txt">Veuillez renseigner cet champ</div>
                    </div>
FORM;
    }

    public function getFile(string $name, string $label, ?string $value = null, ?string $control = null, ?string $attributes = null) : string
    {

        $image_placeholder = "/vendors/images/logo.png";
        if ($value !== null){
            $image_placeholder = asset('storage/'.$value);
        }
        return <<<FORM
                    <div class="field">
                        <div class="input-area">
                            <input autocomplete="off" class="JS_load__previewImg" type="file" data-control="{$control}"
                                   placeholder=" " value="{$value}" id="{$name}" name="{$name}" {$attributes}>
                            <label for="{$name}">{$label}</label>
                            <a href="" class="deleteUploadPreview">Retirer</a>
                            <i class="error error-icon fi-rr-exclamation" title="champ obligatoire"></i>
                            <img data-img="{$image_placeholder}" src="{$image_placeholder}" alt="" id="load__previewImg_{$name}" class="previewImg">
                        </div>
                        <div class="error error-txt">Veuillez renseigner cet champ</div>
                    </div>
FORM;
    }

    public function getTextArea(string $name, string $label, ?string $placeholder = " ", ?string $value = null, ?string $control = null) : string
    {
        if($placeholder == null){
            $placeholder = " ";
        }

        return <<<FORM
                    <div class="field">
                        <div class="input-area">
                           <textarea style="height: 100px;" autocomplete="off" name="{$name}" id="{$name}" placeholder="{$placeholder}" data-control="{$control}">{$value}</textarea>
                            <label for="{$name}">{$label}</label>
                            <i class="error error-icon fi-rr-exclamation" title="champ obligatoire"></i>
                        </div>
                        <div class="error error-txt">Veuillez renseigner cet champ</div>
                    </div>
FORM;
    }

    public function getSelectInput(?string $is, string $name, string $label, $value = null, ?string $control = null, $data = [], ?string $attributes = null): string{

        $text = "";
        $text = <<<FORM
                    <div class="field">
                        <div class="input-area">
                            <select name="{$name}" id="{$name}" data-control="{$control}" {$attributes}
                                        is="{$is}" placeholder=" ">
                                    <option data-placeholder="true">{$label}</option>
FORM;
        foreach ($data as $key => $item){
            $item = (object)$item;
            $check = trim($value) == (trim($item->id) ?? $key) ? "Selected" : "";
            $text .= "<option value='" . (trim($item->id ?? $key)) . "' ".$check.">". ($item->libelle ?? $item->scalar) ."</option>";
        }
        $text .= <<<FORM
                                </select>
                            <label for="{$name}">{$label}</label>
                            <i class="error error-icon fi-rr-exclamation" title="champ obligatoire"></i>
                        </div>
                        <div class="error error-txt">Veuillez renseigner cet champ</div>
                    </div>
FORM;

        return $text;
    }

}
