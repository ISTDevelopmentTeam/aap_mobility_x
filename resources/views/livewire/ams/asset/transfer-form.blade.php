<div class=" bg-white rounded-lg px-6 flex items-center justify-center">
    <div class="w-full max-w-6xl overflow-hidden px-5 pb-5">
        <!-- Header -->
        <div class="border-b border-gray-300 pb-3 ">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-[#071d49] mb-1">Transfer Asset</h2>
                    <p class="text-sm text-gray-600 leading-tight">
                        <em>Enter transfer information for the selected asset/s below.</em>
                    </p>
                </div>
            </div>
        </div>

        <!-- Body Content -->
        <div class="flex">
            <!-- Asset Summary Sidebar -->
            <div class="w-[45%] p-5 border-r border-gray-200 space-y-3">
                {{-- Assets for Transfer --}}
                @foreach($assets as $asset)
                <div class="flex justify-between rounded-xl border border-gray-200 p-3 bg-[#FAFBFF] shadow-md">

                    <!-- ================= LEFT: ICON + BASIC INFO ================= -->
                    <div class="flex items-start gap-4">

                        <!-- === ICON SLOT (category-based) === -->
                        <div
                            class="w-10 h-10 rounded-lg bg-yellow-400 flex items-center justify-center self-center text-blue-800">
                            @switch($asset->category_id)
                            @case(1)
                            {{-- Icon for IT Equipment --}}
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="size-7 lucide lucide-cpu-icon lucide-cpu">
                                <path d="M12 20v2" />
                                <path d="M12 2v2" />
                                <path d="M17 20v2" />
                                <path d="M17 2v2" />
                                <path d="M2 12h2" />
                                <path d="M2 17h2" />
                                <path d="M2 7h2" />
                                <path d="M20 12h2" />
                                <path d="M20 17h2" />
                                <path d="M20 7h2" />
                                <path d="M7 20v2" />
                                <path d="M7 2v2" />
                                <rect x="4" y="4" width="16" height="16" rx="2" />
                                <rect x="8" y="8" width="8" height="8" rx="1" />
                            </svg>
                            @break

                            @case(2)
                            {{-- Icon for Furniture --}}
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="size-7 lucide lucide-sofa-icon lucide-sofa">
                                <path d="M20 9V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v3" />
                                <path
                                    d="M2 16a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-5a2 2 0 0 0-4 0v1.5a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5V11a2 2 0 0 0-4 0z" />
                                <path d="M4 18v2" />
                                <path d="M20 18v2" />
                                <path d="M12 4v9" />
                            </svg>
                            @break

                            @case(3)
                            {{-- Icon for Machinery --}}
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="size-7  lucide lucide-cog-icon lucide-cog">
                                <path d="M12 20a8 8 0 1 0 0-16 8 8 0 0 0 0 16Z" />
                                <path d="M12 14a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" />
                                <path d="M12 2v2" />
                                <path d="M12 22v-2" />
                                <path d="m17 20.66-1-1.73" />
                                <path d="M11 10.27 7 3.34" />
                                <path d="m20.66 17-1.73-1" />
                                <path d="m3.34 7 1.73 1" />
                                <path d="M14 12h8" />
                                <path d="M2 12h2" />
                                <path d="m20.66 7-1.73 1" />
                                <path d="m3.34 17 1.73-1" />
                                <path d="m17 3.34-1 1.73" />
                                <path d="m11 13.73-4 6.93" />
                            </svg>
                            @break

                            @case(4)
                            {{-- Icon for Vehicles --}}
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="size-8  lucide lucide-car-icon lucide-car">
                                <path
                                    d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2" />
                                <circle cx="7" cy="17" r="2" />
                                <path d="M9 17h6" />
                                <circle cx="17" cy="17" r="2" />
                            </svg>
                            @break

                            @case(5)
                            {{-- Icon for facilities --}}
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="size-7  lucide lucide-building-icon lucide-building">
                                <rect width="16" height="20" x="4" y="2" rx="2" ry="2" />
                                <path d="M9 22v-4h6v4" />
                                <path d="M8 6h.01" />
                                <path d="M16 6h.01" />
                                <path d="M12 6h.01" />
                                <path d="M12 10h.01" />
                                <path d="M12 14h.01" />
                                <path d="M16 10h.01" />
                                <path d="M16 14h.01" />
                                <path d="M8 10h.01" />
                                <path d="M8 14h.01" />
                            </svg>
                            @break

                            @case(6)
                            {{-- Icon for Mobile Devices --}}
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="size-7 lucide lucide-tablet-smartphone-icon lucide-tablet-smartphone">
                                <rect width="10" height="14" x="3" y="8" rx="2" />
                                <path d="M5 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2h-2.4" />
                                <path d="M8 18h.01" />
                            </svg>
                            @break

                            @case(7)
                            {{-- Icon for High Value Assets --}}
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="size-7  lucide lucide-microwave-icon lucide-microwave">
                                <rect width="20" height="15" x="2" y="4" rx="2" />
                                <rect width="8" height="7" x="6" y="8" rx="1" />
                                <path d="M18 8v7" />
                                <path d="M6 19v2" />
                                <path d="M18 19v2" />
                            </svg>
                            @break

                            @case(8)
                            {{-- Icon for laboratory equipment --}}
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="size-7 lucide lucide-microscope-icon lucide-microscope">
                                <path d="M6 18h8" />
                                <path d="M3 22h18" />
                                <path d="M14 22a7 7 0 1 0 0-14h-1" />
                                <path d="M9 14h2" />
                                <path d="M9 12a2 2 0 0 1-2-2V6h6v4a2 2 0 0 1-2 2Z" />
                                <path d="M12 6V3a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v3" />
                            </svg>
                            @break

                            @case(9)
                            {{-- Icon for Company Owned Tools --}}
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="size-7 lucide lucide-drill-icon lucide-drill">
                                <path d="M10 18a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H5a3 3 0 0 1-3-3 1 1 0 0 1 1-1z" />
                                <path
                                    d="M13 10H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1l-.81 3.242a1 1 0 0 1-.97.758H8" />
                                <path d="M14 4h3a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-3" />
                                <path d="M18 6h4" />
                                <path d="m5 10-2 8" />
                                <path d="m7 18 2-8" />
                            </svg>
                            @break

                            @case(10)
                            {{-- Icon for Safety Equipment --}}
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="size-7 lucide lucide-fire-extinguisher-icon lucide-fire-extinguisher">
                                <path d="M15 6.5V3a1 1 0 0 0-1-1h-2a1 1 0 0 0-1 1v3.5" />
                                <path d="M9 18h8" />
                                <path d="M18 3h-3" />
                                <path d="M11 3a6 6 0 0 0-6 6v11" />
                                <path d="M5 13h4" />
                                <path d="M17 10a4 4 0 0 0-8 0v10a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2Z" />
                            </svg>
                            @break

                            @default
                            {{-- Fallback Icon --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            @endswitch
                        </div>
                        <!-- === END ICON SLOT === -->

                        <!-- === BASIC INFO SLOT (brand/model/name) === -->
                        <div class="flex flex-col justify-center uppercase">
                            <div>
                                <span class="text-sm font-bold text-gray-900">
                                    {{ $asset['brand_name_custom'] ?? ($brands->firstWhere('brand_id',
                                    $asset['brand_id'])->brand_name ?? 'N/A') }}
                                </span>
                                <span class="text-sm font-bold text-gray-900">{{ $asset->model_name }}</span>
                            </div>
                            <div class="text-xs text-gray-700">{{ $asset->asset_name }}</div>
                        </div>
                        <!-- === END BASIC INFO SLOT === -->

                    </div>
                    <!-- ================= END LEFT ================= -->

                    <!-- ================= RIGHT: TOGGLE BUTTON + DETAILS ================= -->
                    @if($assets->count() > 1)
                    <div class="flex flex-row self-center gap-1">
                        <!-- === ACTION BUTTONS === -->
                        <button type="button" wire:key="asset-{{ $asset->asset_id }}"
                            wire:click.prevent="viewDetails({{ (int) $asset->asset_id }})"
                            class="relative flex items-center justify-center rounded-full text-blue-800 ">

                            <div class="relative group flex items-center justify-center">
                                <!-- Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="size-4 lucide lucide-eye-icon hover:scale-110 ease-in-out transition duration-300">
                                    <path
                                        d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>

                                <!-- Tooltip -->
                                <span
                                    class="absolute bottom-full mb-2 opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity duration-200 bg-black text-white text-xs font-medium py-1 px-2 rounded shadow-lg whitespace-nowrap">
                                    View Details
                                </span>
                            </div>
                        </button>


                        <button type="button" wire:key="asset-{{ $asset->asset_id }}"
                            wire:click.prevent="removeAsset({{ (int) $asset->asset_id }})" @disabled($loop->first)
                            class="relative flex items-center justify-center rounded-full text-red-600
                            disabled:text-gray-500 disabled:cursor-not-allowed">

                            <div class="relative group flex items-center justify-center">
                                <!-- Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="size-4 lucide lucide-trash-2 hover:scale-110 ease-in-out transition duration-300">
                                    <path d="M10 11v6" />
                                    <path d="M14 11v6" />
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6" />
                                    <path d="M3 6h18" />
                                    <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                </svg>

                                <!-- Tooltip -->
                                <span
                                    class="absolute bottom-full mb-2 opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity duration-200 bg-black text-white text-xs font-medium py-1 px-2 rounded shadow-lg whitespace-nowrap">
                                    {{ $loop->first ? 'Unable to remove the originally selected asset' : 'Remove' }}
                                </span>
                            </div>
                        </button>

                        <!-- === END ACTION BUTTONS === -->

                    </div>
                    @endif
                    <!-- ================= END RIGHT ================= -->

                </div>
                @endforeach

                @if($assets->count() === 1)
                <div class="space-y-4">
                    <div class="rounded-xl border border-gray-200 p-5 bg-[#FAFBFF] shadow-md">
                        <div>
                            {{-- Header --}}
                            <div class="flex flex-row items-center text-gray-700 mb-2 gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="size-5 lucide lucide-package-icon lucide-package">
                                    <path
                                        d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z" />
                                    <path d="M12 22V12" />
                                    <polyline points="3.29 7 12 12 20.71 7" />
                                    <path d="m7.5 4.27 9 5.15" />
                                </svg>
                                <span class="text-xs font-semibold uppercase">
                                    Asset Overview
                                </span>
                            </div>
                            <ul class="space-y-1 uppercase items-center">
                                <li class="flex justify-between items-center">
                                    <span class="text-xs text-gray-500 font-semibold">Property Code</span>
                                    <span class="text-sm text-gray-900 font-normal">{{ $asset->property_code ?? 'N/A'
                                        }}</span>
                                </li>


                                <li class="flex justify-between items-center">
                                    <span class="text-xs text-gray-500 font-semibold">Category</span>
                                    <span
                                        class="text-sm text-gray-900 font-normal ml-auto max-w-[80%] text-end whitespace-normal break-words">{{
                                        $asset->category->category_name
                                        ?? 'N/A'
                                        }}</span>
                                </li>

                                <li class="flex justify-between items-center">
                                    <span class="text-xs text-gray-500 font-semibold">Status</span>
                                    <span class="text-sm text-gray-900 font-normal">{{ $asset->status->status_name ??
                                        'N/A'
                                        }}</span>
                                </li>

                                <li class="flex justify-between items-center">
                                    <span class="text-xs text-gray-500 font-semibold">Condition</span>
                                    <span class="text-sm text-gray-900 font-normal">{{ $asset->condition->condition_name
                                        ?? 'N/A'
                                        }}</span>
                                </li>

                                @if(!empty($asset->device_serial_number))
                                <li class="flex justify-between items-center">
                                    <span class="text-xs text-gray-500 font-semibold">Device Serial #</span>
                                    <span class="text-sm text-gray-900 font-normal">{{ $asset->device_serial_number
                                        }}</span>
                                </li>
                                @endif

                                @if(!empty($asset->charger_serial_number))
                                <li class="flex justify-between items-center">
                                    <span class="text-xs text-gray-500 font-semibold">Charger Serial #</span>
                                    <span class="text-sm text-gray-900 font-normal">{{ $asset->charger_serial_number
                                        }}</span>
                                </li>
                                @endif
                                <!-- Asset Type -->
                                <li class="flex justify-between items-center">
                                    <span class="text-xs text-gray-500 font-semibold">Asset Type</span>
                                    <span class="text-sm text-gray-900 font-normal">
                                        {{ $asset->asset_type == 1 ? 'COMMON' : ($asset->asset_type == 2 ?
                                        'NON-COMMON' : 'N/A') }}
                                    </span>
                                </li>

                                <!-- Assigned To -->
                                @if($asset->asset_type == 1 && $asset->department)
                                <li class="flex justify-between items-center">
                                    <span class="text-xs text-gray-500 font-semibold ">Assigned To</span>
                                    <span
                                        class="text-sm text-gray-900 font-normal ml-auto max-w-[80%] text-end whitespace-normal break-words">
                                        {{ $asset->department->department_name }}
                                    </span>
                                </li>

                                @elseif($asset->asset_type == 2 && $asset->employee)
                                <li class="flex justify-between items-center">
                                    <span class="text-xs text-gray-500 font-semibold">Department</span>
                                    <span
                                        class="text-sm text-gray-900 font-normal ml-auto max-w-[80%] text-end whitespace-normal break-words">{{
                                        $asset->employee->department->department_name ?? 'N/A' }}</span>
                                </li>

                                <li class="flex justify-between items-center">
                                    <span class="text-xs text-gray-500 font-semibold ">Assigned To</span>
                                    <span class="text-sm text-gray-900 font-normal">
                                        {{ $asset->employee->employee_lastname }}, {{
                                        $asset->employee->employee_firstname }}
                                    </span>
                                </li>
                                @else
                                <li class="flex justify-between items-center">
                                    <span class="text-xs text-gray-500 font-semibold">Assigned To</span>
                                    <span class="text-sm text-gray-900 font-normal">N/A</span>
                                </li>
                                @endif

                                <!-- Assigned Date -->
                                <li class="flex justify-between items-center">
                                    <span class="text-xs text-gray-500 font-semibold">Date Assigned</span>
                                    <span class="text-sm text-gray-900 font-normal">
                                        {{ \Carbon\Carbon::parse($asset->date_accountable)->format('F d, Y') ?? 'N/A' }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                @endif
                <div class="flex justify-end pt-4">
                    <button type="button" wire:click="openAssetPicker"
                        class="relative flex items-center gap-1 px-3 py-2 text-sm font-semibold text-blue-950 bg-yellow-400 rounded-lg hover:bg-yellow-500">

                        <div class="relative group flex items-center gap-1">
                            <!-- Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                stroke-linejoin="round" class="size-4 lucide lucide-plus">
                                <path d="M5 12h14" />
                                <path d="M12 5v14" />
                            </svg>
                            Add More Assets

                            <!-- Tooltip -->
                            <span
                                class="absolute bottom-full left-1/2 -translate-x-1/2 mb-4 opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity duration-200 bg-black text-white text-xs font-medium py-1 px-2 rounded shadow-lg whitespace-nowrap">
                                Add more assets for transfer
                            </span>
                        </div>
                    </button>
                </div>


            </div>


            <!-- Main Transfer Form -->
            <div class="flex-1">
                <div class=" p-8">
                    <!-- Header -->
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-lg font-semibold flex items-center gap-3 text-blue-700 uppercase">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-user-pen-icon lucide-user-pen">
                                <path d="M11.5 15H7a4 4 0 0 0-4 4v2" />
                                <path
                                    d="M21.378 16.626a1 1 0 0 0-3.004-3.004l-4.01 4.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z" />
                                <circle cx="10" cy="7" r="4" />
                            </svg>
                            Transfer Information
                        </h2>
                        <span class="text-xs italic text-red-600 font-medium">* - required fields</span>
                    </div>

                    <!-- Form -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Date of Transfer -->
                        <div>
                            <label for="transfer_date" class="block text-sm font-medium text-gray-700">Date of Transfer
                                <span class="text-red-600">*</span></label>
                            <input type="date" id="transfer_date" name="transfer_date" wire:model.defer="transfer_date"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" />

                        </div>

                        <!-- Control Number -->
                        <div>
                            <label for="control_number" class="block text-sm font-medium text-gray-700">Control Number
                                <span class="text-red-600">*</span></label>
                            <input type="text" id="control_number" name="control_number"
                                wire:model.defer="control_number" placeholder="e.g. ABCD-1234-5678"
                                pattern="[A-Z]{4}-\d{4}-\d{4}" autocomplete="off"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm uppercase"
                                required />
                        </div>

                        <!-- From (conditionally rendered) -->
                        <div class="md:col-span-1">
                            @if($asset->asset_type == 1 && $asset->department)
                            <label class="block text-sm font-medium text-gray-700">Transfer from</label>
                            <input type="text" value="{{ strtoupper($asset->department->department_name) }}"
                                class="mt-1 block w-full rounded-md bg-gray-100 border-gray-300 text-sm" disabled>
                            @else
                            <label class="block text-sm font-medium text-gray-700">Transfer from</label>
                            <input type="text" value="{{ strtoupper($asset->employee->employee_lastname) }}, {{
                                        strtoupper($asset->employee->employee_firstname) ?? 'N/A' }}"
                                class="mt-1 block w-full rounded-md bg-gray-100 border-gray-300 text-sm" disabled>
                            @endif
                        </div>

                        <!-- TO (conditionally rendered dropdowns) -->
                        <div class="md:col-span-1">
                            <label class="block text-sm font-medium text-gray-700">Transfer to <span
                                    class="text-red-600">*</span></label>

                            @if($asset->asset_type == 1)
                            <div x-data="{
                                openToDept: false,
                                selectedToDeptId: @entangle('to_department_id'),
                                selectedToDeptName: @entangle('to_department_name'),
                                searchDeptText: '',
                                clearSearchTimeout: null,

                                handleToDeptClick() {
                                this.openToDept = !this.openToDept;

                                // Focus the hidden input after dropdown opens
                                this.$nextTick(() => {
                                    if (this.openToDept && this.$refs.toDeptSearch) {
                                        this.$refs.toDeptSearch.focus();
                                    }
                                    });
                                },


                                handleDeptSearch(value) {
                                    this.searchDeptText = value;
                                    console.log('Searching for department:', value); // ✅ Console log added
                                    this.$wire.set('searchTerm', value);

                                    if (this.clearSearchTimeout) clearTimeout(this.clearSearchTimeout);
                                    this.clearSearchTimeout = setTimeout(() => {
                                        this.searchDeptText = '';
                                    }, 2000);

                                },

                                resetToDept() {
                                    this.selectedToDeptId = '';
                                    this.selectedToDeptName = '';
                                }
                                }" x-init="
                                    $watch('openToDept', value => {
                                        if (!value) {
                                            searchDeptText = '';
                                            $wire.set('searchTerm', '');
                                        }
                                    });
                                " class="relative mt-1 w-full">
                                <!-- Toggle -->
                                <button type="button" @click="handleToDeptClick"
                                    class="
                                w-full bg-white rounded-md shadow-sm px-4 py-2 text-left text-sm cursor-pointer focus:outline-none border border-gray-300 focus:ring-2 focus:ring-blue-600 focus:border-blue-600">
                                    <span x-text="selectedToDeptName || 'SELECT DEPARTMENT'"
                                        class="block truncate uppercase"></span>
                                    <svg class="absolute right-3 top-[10px] w-4 h-4 text-gray-500 pointer-events-none"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                <!-- Hidden Search Input -->
                                <input x-ref="toDeptSearch" type="text" :value="searchDeptText"
                                    @input="handleDeptSearch($event.target.value)" @keydown.enter.prevent
                                    autocomplete="off" class="absolute opacity-0 pointer-events-none  w-0 h-0" />

                                <!-- Dropdown List -->
                                <ul x-show="openToDept" @click.outside="openToDept = false" x-transition
                                    class="absolute left-0 mt-1 w-full bg-white shadow-lg max-h-60 rounded-xl py-1 text-sm text-gray-800 ring-1 ring-black ring-opacity-5 overflow-auto z-50">

                                    <!-- Clear Option -->
                                    <li @click="resetToDept(); openToDept = false"
                                        class="cursor-pointer select-none px-4 py-2 hover:bg-blue-200 uppercase">
                                        SELECT DEPARTMENT
                                    </li>

                                    <!-- Dynamic List -->
                                    @foreach($departments as $department)
                                    <li @click="
                                    selectedToDeptId = '{{ $department->department_id }}';
                                    selectedToDeptName = '{{ strtoupper(addslashes($department->department_name)) }}';
                                    openToDept = false;
                                " class="cursor-pointer select-none px-4 py-2 hover:bg-blue-200 uppercase">
                                        {{ strtoupper($department->department_name) }}
                                    </li>
                                    @endforeach
                                </ul>

                                <!-- Error Message -->
                                @error('to_department_id')
                                <p class="mt-1 text-xs italic text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            @else
                            <!-- Fallback if asset type is not 1 -->
                            <div x-data="{
                            openToEmployee: false,
                            selectedToEmployeeId: @entangle('to_employee_id'),
                            selectedToEmployeeName: @entangle('to_employee_name'),
                            searchEmpText: '',
                            clearTimeoutId: null,

                            handleEmpSearch(value) {
                                this.searchEmpText = value;
                                console.log('Searching Employee:', value);
                                this.$wire.set('searchTerm', value);

                                if (this.clearTimeoutId) clearTimeout(this.clearTimeoutId);
                                this.clearTimeoutId = setTimeout(() => {
                                    this.searchEmpText = '';
                                }, 2000);
                            },

                            handleToEmployeeClick() {
                                this.openToEmployee = !this.openToEmployee;

                                this.$nextTick(() => {
                                    if (this.openToEmployee && this.$refs.toEmpSearch) {
                                        this.$refs.toEmpSearch.focus();
                                    }
                                });
                            },

                            resetToEmployee() {
                                this.selectedToEmployeeId = '';
                                this.selectedToEmployeeName = '';
                            }
                        }" x-init="
                            $watch('openToEmployee', value => {
                                if (!value) {
                                    searchEmpText = '';
                                    $wire.set('searchTerm', '');
                                }
                            });
                        " class="md:col-span-1">
                                <div class="relative mt-1 w-full">
                                    <!-- Toggle Button -->
                                    <button type="button" @click="handleToEmployeeClick"
                                        class="
                                w-full bg-white rounded-md shadow-sm px-4 py-2 text-left text-sm cursor-pointer focus:outline-none border border-gray-300 focus:ring-2 focus:ring-blue-600 focus:border-blue-600">
                                        <span x-text="selectedToEmployeeName || 'SELECT EMPLOYEE'"
                                            class="block truncate uppercase"></span>
                                        <svg class="absolute right-3 top-[10px] w-4 h-4 text-gray-500 pointer-events-none"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>

                                    <!-- Hidden Search Input -->
                                    <input x-ref="toEmpSearch" type="text" :value="searchEmpText"
                                        @input="handleEmpSearch($event.target.value)" @keydown.enter.prevent
                                        autocomplete="off" class="absolute opacity-0 pointer-events-none w-0 h-0" />

                                    <!-- Dropdown List -->
                                    <ul x-show="openToEmployee" @click.outside="openToEmployee = false" x-transition
                                        class="absolute left-0 mt-1 w-full bg-white shadow-lg max-h-60 rounded-xl py-1 text-sm text-gray-800 ring-1 ring-black ring-opacity-5 overflow-auto z-50">

                                        <!-- Clear Option -->
                                        <li @click="resetToEmployee(); openToEmployee = false"
                                            class="cursor-pointer select-none px-4 py-2 hover:bg-blue-200 uppercase">
                                            SELECT EMPLOYEE
                                        </li>

                                        <!-- Dynamic List -->
                                        @foreach($employees as $employee)
                                        <li @click="
                                            selectedToEmployeeId = '{{ $employee->employee_id }}';
                                            selectedToEmployeeName = '{{ strtoupper(addslashes($employee->employee_lastname)) }}, {{ strtoupper(addslashes($employee->employee_firstname)) }}';
                                            openToEmployee = false;
                                        " class="cursor-pointer select-none px-4 py-2 hover:bg-blue-200 uppercase">
                                            {{ strtoupper($employee->employee_lastname) }},
                                            {{ strtoupper($employee->employee_firstname) }}
                                        </li>
                                        @endforeach
                                    </ul>

                                    <!-- Validation Error -->
                                    @error('to_employee_id')
                                    <p class="mt-1 text-xs italic text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            @endif
                        </div>


                        <!-- Reason for Transfer -->
                        <div class="md:col-span-2">
                            <label for="transfer_reason" class="block text-sm font-medium text-gray-700">Reason for
                                Transfer
                                <span class="text-red-600">*</span></label>
                            <textarea id="transfer_reason" name="transfer_reason" wire:model.defer="transfer_reason"
                                rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm resize-none uppercase"
                                placeholder="STATE THE REASON FOR TRANSFER"></textarea>
                        </div>
                    </div>
                    <!-- Action Buttons -->
                    <div class="flex justify-end mt-8">
                        <button wire:click='confirmSubmit'
                            class="px-6 py-2 bg-blue-800 hover:bg-blue-900 text-white text-sm rounded-lg font-medium transition-all">
                            Submit Transfer
                        </button>
                    </div>
                </div>



            </div>
        </div>
    </div>
    <!-- Confirmation Modal -->
    <div x-data="{ show: @entangle('showConfirmModal') }" x-show="show" x-transition.opacity x-cloak
        class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center">

        <div @click.outside="show = false"
            class="bg-white rounded-xl shadow-xl p-6 w-full max-w-md text-center space-y-4 mx-4">

            <!-- Icon -->
            <div class="w-14 h-14 flex items-center justify-center rounded-full bg-yellow-200 text-yellow-800 mx-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M8 3 4 7l4 4" />
                    <path d="M4 7h16" />
                    <path d="m16 21 4-4-4-4" />
                    <path d="M20 17H4" />
                </svg>
            </div>

            <!-- Title -->
            <h3 class="text-lg font-semibold text-gray-800">Confirm Transfer</h3>
            <p class="text-sm text-gray-600">Are you sure you want to submit this transfer?</p>

            <!-- Actions -->
            <div class="flex justify-center gap-4 mt-6">
                <button @click="show = false"
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 text-sm font-medium">
                    Cancel
                </button>
                <button wire:click="submitConfirmed" @click="show = false"
                    class="px-4 py-2 bg-blue-800 text-white rounded-lg hover:bg-blue-900 text-sm font-medium">
                    Confirm
                </button>
            </div>
        </div>
    </div>

</div>