{{-- <x-app-layout class='flex flex-row w-h-screen'
    :x_data="['open' => false, 'deleteUrl' => '', 'viewOpen' => false, 'branch' => new stdClass()]"
    navbar_selected='CMS'> --}}

    <x-app-layout class='flex flex-row w-h-screen'
    :x_data="['open' => false, 'deleteUrl' => '', 'viewOpen' => false, 'asset' => new stdClass()]"
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
                        'IT Brands' => 'brands',
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
        <livewire:cms.assetstatus.list />
    </div>
</x-app-layout>
