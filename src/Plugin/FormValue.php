<?php

namespace Tourbillon\Plugin;

use Tourbillon\Form\Form;

class FormValue
{
    public function get(Form $form, $fieldname)
    {
        return $form->get($fieldname)->getValue();
    }
}