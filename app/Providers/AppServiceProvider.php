<?php

namespace App\Providers;

use App\Models\Submodule;
use Livewire\Livewire;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Livewire::component('view-asset-modal', \App\Livewire\Ams\Asset\ViewAssetModal::class);

        Blade::if('canAccessModule', function ($module) {
            $user = auth()->user();

            if (!$user || !$module) {
                return false;
            }

            return $user->can($module->getModulePermissionName());
        });


        Blade::if('canAccessSubmodule', function ($submodule = null) {
            $user = auth()->user();

            if(!$user || !$submodule) {
                return false;
            }
            
            return $user->can($submodule->getSubmodulePermissionName());
        });

        Blade::if('canDoAction', function ($actionName, $submoduleName) {
            $submodule = Submodule::where('submodule_name', $submoduleName)->first();

            if(! $submodule){
                return false;
            }

            $user = auth()->user();
            $action = $submodule->actions->where('action_name', $actionName)->first();

            if (!$user || !$action) {
                return false;
            }
 
            return $user->can($action->getActionPermissionName());
        });
    }
}
