<x-app-layout class='flex flex-row w-h-screen'
    :x_data="['open' => false, 'deleteUrl' => '', 'viewOpen' => false, 'branch' => new stdClass()]"
    navbar_selected='CMS'>


    <div 
        class="flex flex-1 flex-col lg:ml-52 mt-12 overflow-y-auto py-10 px-5 lg:p-10 gap-7 bg-[#f3f4f6]">
        {{-- Navigation Bar --}}
        <div class="text-sm rounded-md border-2 border-gray-100 bg-white shadow-lg -mt-7">
            <div class="flex items-center justify-content h-9 lg:flex-row border-b border-gray-200 relative gap-8 pl-3"
                x-data="{ openCMS: false, openAssets: false }">
                @php
                    $submodules = [
                        'Departments' => 'departments',
                        'IT Brands' => 'it-brands',
                        'Asset Categories' => 'asset-categories',
                        'Asset Status' => 'asset-statuses',
                        'Asset Conditions' => 'asset-conditions'
                    ]
                @endphp
                @foreach ($submodules as $key => $value)
                    <div class="flex w-auto {{ request()->routeIs($value)
                    ? 'border-b-2 border-blue-900' : '' }} p-1 text-center">
                        <a href="/cms/{{ $value }}"
                            class="{{ request()->routeIs($value)
                            ? 'font-semibold text-blue-900' : 'text-gray-600 hover:text-blue-800 font-inter' }}">
                            {{ $key }}
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="rounded-md border-2 border-gray-100 bg-white shadow-lg -mt-4">
            <div class="flex flex-col justify-between">

                <!-- Breadcrumbs -->
                <div
                    class="flex flex-wrap items-center gap-x-1 text-blue-900 text-sm px-4 pt-4">
                    <a href="/cms" class="hover:underline">CMS</a>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                        <path fill-rule="evenodd"
                            d="M16.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 0 1-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 0 1 1.06-1.06l7.5 7.5Z"
                            clip-rule="evenodd" />
                    </svg>
                    <a href="/cms/departments" class="hover:underline">Department</a>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between px-4 py-3 gap-4">
                <div>
                    <h2 class="font-semibold text-md text-blue-900"
                        x-text="'Manage AAP Departments'"></h2>
                    <p class="text-gray-900 text-sm"
                        x-text="'Create, update, and delete department details.'">
                    </p>
                </div>

                <div class="flex flex-wrap justify-between items-center gap-4 px-0 lg:px-5">
                    {{-- search --}}
                    <div>
                        <livewire:cms.department.components.search />
                    </div>
                    {{-- CREATE an instance of a model --}}
                    <livewire:cms.department.create />
                </div>
            </div>
        
            <div class="px-5 pb-5" x-transition>
                {{-- READ the insances of a model --}}
                <livewire:cms.department.list />
                {{-- UPDATE an instance of a model --}}
                <livewire:cms.department.edit />
                {{-- DELETE an instance of a model --}}
                <livewire:cms.department.delete />
            </div>
        </div>
    </div>
</x-app-layout>