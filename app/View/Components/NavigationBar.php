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

    public $submodules;
    
    public function __construct($module)
    {
        $currentModule = Module::where('module_name', $module)->firstOrFail();
        $currentSubmodules = $currentModule->submodules;
        
        $isIncludedInTabs = [];
        $tabs = [];
        foreach($currentSubmodules as $currentSubmodule){
            if(isset($isIncludedInTabs[$currentSubmodule->])
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layouts.navigation-bar');
    }
}
