<div class="text-sm rounded-md border-2 border-gray-100 bg-white shadow-lg -mt-7">
    <div class="flex items-center justify-content h-9 lg:flex-row border-b border-gray-200 relative gap-8 pl-3">
        @foreach ($currentModule->submodules as $submodule)
            <div class="flex w-auto {{ request()->routeIs($submodule->submodule_route_name)
            ? 'border-b-2 border-blue-900' : '' }} p-1 text-center">
                <a href="{{ route($submodule->submodule_route_name) }}"
                    class="{{ request()->routeIs($submodule->submodule_route_name)
                    ? 'font-semibold text-blue-900' : 'text-gray-600 hover:text-blue-800 font-inter' }}">
                    {{ $submodule->submodule_name }}
                </a>
            </div>
        @endforeach
    </div>
</div>
