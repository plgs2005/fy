<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SelectLanguage extends Component
{
    public $languages;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($languages)
    {
        $this->languages = $languages;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.select-language');
    }
}
