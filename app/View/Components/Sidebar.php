<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use App\Models\Module;
use Illuminate\Support\Facades\Auth;


class Sidebar extends Component
{
    /**
     * Create a new component instance.
     */
    public $module;
    public $user;
    public function __construct(Module $module)
    {
        $this->module = $module;
        $this->user = Auth::user();
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layouts.sidebar');
    }
}
