<?php

namespace App\View\Components\Category;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{
    /**
     * Create a new component instance.
     */
    public $categories;
    public $value;
    public function __construct($categories = [], $value = '')
    {
        $this->categories = $categories;
        $this->value = $value;
    }

    public function renderOptions($categories, $level = '')
    {
        return collect($categories)->map(function ($category) use ($level) {
            $selected = !empty($this->value) && $this->value == $category->id   ? 'selected' : '';
            $option = "<option value='{$category->id}' { $selected }>{$level} {$category->name}</option>";
            if (!empty($category)) {
                $option .= $this->renderOptions($category->children, $level . '--|');
            }
            return $option;
        })->implode('');
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $renderOptionsHtml = $this->renderOptions($this->categories);
        return view('components.category.select', ['renderOptionsHtml' => $renderOptionsHtml]);
    }
}
