<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TextArea extends Component
{
    public $name;
    public $placeholder;
    public $value;

    public function __construct($name,$placeholder,$value=null)
    {
        //
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->value = $value;
    }

    public function render(): View|Closure|string
    {
        return view('components.text-area');
    }
}
