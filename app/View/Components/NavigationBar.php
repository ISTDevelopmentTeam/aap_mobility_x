<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use App\Models\Module;

class NavigationBar extends Component
{
    /**
     * Create a new component instance.
     */

    public $currentModule;
    
    public function __construct($module)
    {
        $this->currentModule = Module::where('module_name', $module)->firstOrFail();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layouts.navigation-bar');
    }
}
