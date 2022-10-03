<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SelectCategory extends Component
{
    public $categories;
    public $multiple;
    public $selectedCategory;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($categories, $multiple = false,  $selectedCategory = null)
    {
        $this->categories = $categories;
        $this->multiple = $multiple;
        $this->selectedCategory = $selectedCategory;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.select-category');
    }
}
