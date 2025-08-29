@props(['selected' => 'Dashboard'])

@php
    $moduleId = 5; // Example

    // $submodules = auth()->user()->roles
    //     ->flatMap->submodules
    //     ->filter(fn($submodule) => $submodule->module_id == $moduleId)
    //     ->sortBy('submodule_id') 
    //     ->pluck('submodule_name')
    //     ->toArray();

    $submodules  = [
        "Dashboard", "Assets", "Scan QR",
    ];


    $links = [
        'Dashboard' => '/ams',
        'CMS' => [
            'Departments' => '/ams/cms/departments',
            'IT Brands' => '/ams/cms/it-brands',
            'Asset Categories' => '/ams/cms/asset-categories',
            'Asset Status' => '/ams/cms/asset-status',
            'Asset Conditions' => '/ams/cms/departments'
        ],
        'Assets' => [
            'All Assets' => '/ams/all-assets',
            'Available Assets' => '/ams/common-assets',
            'Assets for Sale' => '/ams/assets-for-sale',
        ],
        'Scan QR' => '/ams/scan-qr',
    ];

    $submoduleParents = [];
    foreach ($links as $parent => $child) {
        if (is_array($child)) {
            foreach (array_keys($child) as $childLabel) {
                $submoduleParents[$childLabel] = $parent;
            }
        }
    }

    $activeTab = $submoduleParents[$selected] ?? $selected;
@endphp


@foreach ($submodules as $submodule)
    @php
        $link = $links[$submodule] ?? null;
        $isDropdown = is_array($link);
        $dropdownVar = Str::camel("open$submodule");
    @endphp

    @if ($isDropdown)
        <div class="relative w-auto lg:mx-0 py-4 px-2 lg:p-4 text-center {{ $submodule === $activeTab
 ? 'border-b-2 border-blue-900' : '' }}">
            <button 
                @click="{{ $dropdownVar }} = !{{ $dropdownVar }}"
                class="flex justify-center items-center gap-x-1 w-full font-inter transition-colors duration-150"
                :class="{{ $dropdownVar }} ? 'text-blue-800 font-semibold' : 'text-gray-600 hover:text-blue-800'">
                <span class="{{ $submodule === $activeTab
 ? 'font-semibold text-blue-900' : 'text-gray-600 hover:text-blue-800 font-inter' }}">{{ $submodule }}</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"
                    class="size-4 transition-transform duration-200"
                    :class="{ 'rotate-180': {{ $dropdownVar }} }">
                    <path fill-rule="evenodd"
                        d="M12.53 16.28a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 0 1 1.06-1.06L12 14.69l6.97-6.97a.75.75 0 1 1 1.06 1.06l-7.5 7.5Z"
                        clip-rule="evenodd" />
                </svg>
            </button>

            <div 
                x-show="{{ $dropdownVar }}" 
                @click.outside="{{ $dropdownVar }} = false"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="absolute text-start left-1/2 -translate-x-1/2 mt-5 w-48 rounded-md border border-gray-200 bg-white shadow-lg z-10">
                
                @foreach ($link as $label => $url)
                    <a href="{{ $url }}" 
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-800">
                        {{ $label }}
                    </a>
                @endforeach
            </div>
        </div>
    @elseif(is_string($link))
        <div class="flex-none w-auto {{ $submodule === $activeTab
 ? 'border-b-2 border-blue-900' : '' }} p-4 text-center">
            <a href="{{ $link }}" 
                class="{{ $submodule === $activeTab
 ? 'font-semibold text-blue-900' : 'text-gray-600 hover:text-blue-800 font-inter' }}">
                {{ $submodule }}
            </a>
        </div>
    @endif
@endforeach


