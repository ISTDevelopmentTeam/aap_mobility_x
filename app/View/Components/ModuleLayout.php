<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use App\Models\Module;

class ModuleLayout extends Component
{
    /**
     * Create a new component instance.
     */

    public $module;

    public function __construct(Module $module)
    {
        $this->module = $module;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layouts.module-layout');
    }
}
