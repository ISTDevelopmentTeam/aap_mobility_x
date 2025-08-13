<x-app-layout class='flex flex-row w-h-screen'
    :x_data="['open' => false, 'deleteUrl' => '', 'viewOpen' => false, 'asset' => new stdClass()]"
    navbar_selected='Asset Management'>

    <div class="flex flex-1 flex-col lg:ml-52 overflow-y-auto py-10 px-5 lg:p-10 gap-7 mt-12 bg-[#f3f4f6]">
        <!-- Options Container -->
        <div class="rounded-md  bg-white shadow-lg -mt-7 ">
            <div class="flex h-14  border-b border-gray-200 relative" x-data="{ openCMS: false, openAssets: false }">
                <x-ams.submodules selected="Assets" />
            </div>
        </div>

        <div class="@container/main rounded-md  bg-white justify-center items-center flex w-full flex-col shadow-lg">
            <main x-data="{
                    selectedCategory: '',
                    init() {
                        // Enable edit mode if URL has ?edit=1
                        const urlParams = new URLSearchParams(window.location.search);
                        this.editMode = urlParams.get('edit') === '1';

                        // Listen to Livewire dispatch and reload with edit mode retained
                        window.addEventListener('asset-saved', () => {
                            const assetId = document.getElementById('currentAssetId').value;
                            window.location.href = `/ams/assets/view/${assetId}?edit=1`;
                        });

                        // Optional: Watch for toggling editMode off and reload cleanly
                        this.$watch('editMode', value => {
                            if (value === false) {
                                const assetId = document.getElementById('currentAssetId').value;
                                window.location.href = `/ams/assets/view/${assetId}`;
                            }
                        });
                    }
                }" class="space-y-1 w-full">
                <div class="flex flex-col justify-between w-full -mb-4">
                    {{-- Breadcrumbs --}}
                    <div class="flex flex-wrap items-center gap-x-1 text-blue-900 text-sm px-2 pt-3 lg:p-5">
                        <a href="/ams" class="hover:underline">Asset Management</a>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                            <path fill-rule="evenodd"
                                d="M16.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 0 1-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 0 1 1.06-1.06l7.5 7.5Z"
                                clip-rule="evenodd" />
                        </svg>
                        <a href="/ams/all-assets" class="hover:underline">Assets</a>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                            <path fill-rule="evenodd"
                                d="M16.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 0 1-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 0 1 1.06-1.06l7.5 7.5Z"
                                clip-rule="evenodd" />
                        </svg>
                        <a href="/ams/all-assets" class="hover:underline">All Assets</a>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                            <path fill-rule="evenodd"
                                d="M16.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 0 1-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 0 1 1.06-1.06l7.5 7.5Z"
                                clip-rule="evenodd" />
                        </svg>
                        <a href="" class="hover:underline font-semibold ">
                            View Asset
                        </a>

                    </div>
                </div>

                {{-- CONTENT --}}
                <div x-data="{ showQR: false }" class="bg-transparent  px-6 pb-6 w-full max-w-6xl mx-auto space-y-5">
                    <input type="hidden" id="currentAssetId" value="{{ $asset->asset_id }}">
                    <!-- Header Info -->
                    <div
                        class="grid grid-cols-2 items-start w-full px-5 py-3 rounded-xl shadow-sm -mt-6 bg-[FAFBFF] border border-gray-200 ">

                            <div class="col-span-1 flex items-start ">

                                <!-- SVG Icon based on category_id -->
                                <div class="flex mr-5 rounded-xl p-2 text-blue-800 bg-yellow-400 self-center">
                                    @switch($asset->category_id)
                                    @case(1)
                                    {{-- Icon for IT Equipment --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="size-10  lucide lucide-cpu-icon lucide-cpu">
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
                                        stroke-linejoin="round" class="size-10 lucide lucide-sofa-icon lucide-sofa">
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
                                        stroke-linejoin="round" class="size-10  lucide lucide-cog-icon lucide-cog">
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
                                        stroke-linejoin="round" class="size-10  lucide lucide-car-icon lucide-car">
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
                                        stroke-linejoin="round"
                                        class="size-10  lucide lucide-building-icon lucide-building">
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
                                        class="size-10  lucide lucide-tablet-smartphone-icon lucide-tablet-smartphone">
                                        <rect width="10" height="14" x="3" y="8" rx="2" />
                                        <path d="M5 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2h-2.4" />
                                        <path d="M8 18h.01" />
                                    </svg>
                                    @break

                                    @case(7)
                                    {{-- Icon for High Value Assets --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="size-10  lucide lucide-microwave-icon lucide-microwave">
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
                                        stroke-linejoin="round"
                                        class="size-10  lucide lucide-microscope-icon lucide-microscope">
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
                                        stroke-linejoin="round" class="size-10  lucide lucide-drill-icon lucide-drill">
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
                                        class="size-10  lucide lucide-fire-extinguisher-icon lucide-fire-extinguisher">
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
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                    @endswitch
                                </div>


                                <div class="flex flex-col text-left w-full -space-y-1 self-center">
                                    <!-- Brand + Model on single line -->
                                    <div
                                        class="flex items-center gap-2 text-xl font-semibold uppercase text-black whitespace-nowrap overflow-hidden">
                                        @if (in_array($asset->category_id, [1, 6]))
                                        <span class="truncate max-w-[70%]">{{ $asset->brand->brand_name ?? 'NO DATA'
                                            }}</span>
                                        @else
                                        <span class="truncate max-w-[70%]">{{ $asset->brand_name_custom ?? 'NO DATA'
                                            }}</span>
                                        @endif

                                        <span class="truncate max-w-[70%]">{{ $asset->model_name ?? 'NO DATA' }}</span>

                                        <svg @click="openSectionEditor('name')" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            class="size-5 text-gray-600 hover:scale-110 hover:text-blue-600 self-center">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                    </div>

                                    <!-- Asset Name -->
                                    <div class="flex items-center gap-2">
                                        <div class="text-lg font-medium uppercase text-gray-600 truncate w-full">
                                            {{ $asset->asset_name ?? 'NO DATA' }}
                                        </div>
                                    </div>
                                </div>

                            </div>


                            {{-- QR Code --}}
                            <div x-data="{ showQR: false }"
                                class="flex flex-col items-start relative group ml-auto self-center">

                                <button @click="showQR = true"
                                    class="size-14 inline-flex items-center justify-center rounded-xl bg-black text-white hover:scale-110 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="size-14">
                                        <path fill-rule="evenodd"
                                            d="M3 4.875C3 3.839 3.84 3 4.875 3h4.5c1.036 0 1.875.84 1.875 1.875v4.5c0 1.036-.84 1.875-1.875 1.875h-4.5A1.875 1.875 0 0 1 3 9.375v-4.5ZM4.875 4.5a.375.375 0 0 0-.375.375v4.5c0 .207.168.375.375.375h4.5a.375.375 0 0 0 .375-.375v-4.5a.375.375 0 0 0-.375-.375h-4.5Zm7.875.375c0-1.036.84-1.875 1.875-1.875h4.5C20.16 3 21 3.84 21 4.875v4.5c0 1.036-.84 1.875-1.875 1.875h-4.5a1.875 1.875 0 0 1-1.875-1.875v-4.5Zm1.875-.375a.375.375 0 0 0-.375.375v4.5c0 .207.168.375.375.375h4.5a.375.375 0 0 0 .375-.375v-4.5a.375.375 0 0 0-.375-.375h-4.5ZM6 6.75A.75.75 0 0 1 6.75 6h.75a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-.75.75h-.75A.75.75 0 0 1 6 7.5v-.75Zm9.75 0A.75.75 0 0 1 16.5 6h.75a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-.75.75h-.75a.75.75 0 0 1-.75-.75v-.75ZM3 14.625c0-1.036.84-1.875 1.875-1.875h4.5c1.036 0 1.875.84 1.875 1.875v4.5c0 1.035-.84 1.875-1.875 1.875h-4.5A1.875 1.875 0 0 1 3 19.125v-4.5Zm1.875-.375a.375.375 0 0 0-.375.375v4.5c0 .207.168.375.375.375h4.5a.375.375 0 0 0 .375-.375v-4.5a.375.375 0 0 0-.375-.375h-4.5Zm7.875-.75a.75.75 0 0 1 .75-.75h.75a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-.75.75h-.75a.75.75 0 0 1-.75-.75v-.75Zm6 0a.75.75 0 0 1 .75-.75h.75a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-.75.75h-.75a.75.75 0 0 1-.75-.75v-.75ZM6 16.5a.75.75 0 0 1 .75-.75h.75a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-.75.75h-.75a.75.75 0 0 1-.75-.75v-.75Zm9.75 0a.75.75 0 0 1 .75-.75h.75a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-.75.75h-.75a.75.75 0 0 1-.75-.75v-.75Zm-3 3a.75.75 0 0 1 .75-.75h.75a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-.75.75h-.75a.75.75 0 0 1-.75-.75v-.75Zm6 0a.75.75 0 0 1 .75-.75h.75a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-.75.75h-.75a.75.75 0 0 1-.75-.75v-.75Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <div
                                    class="absolute -top-8  mb-2 left-1/2 -translate-x-1/2 z-10 hidden group-hover:flex px-2 py-1 rounded bg-black text-white text-xs whitespace-nowrap">
                                    Show QR Code
                                </div>

                                <!-- QR Modal -->
                                <div x-show="showQR" x-transition
                                    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60">
                                    <div @click.outside="showQR = false"
                                        class="bg-white p-6 rounded-xl shadow-xl w-[350px] h-[350px] flex flex-col items-center justify-center relative">
                                        <img src="{{ asset('qr-code.png') }}" alt="QR Code"
                                            class="w-80 h-80 object-contain">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Group Cards: 2 Columns -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8 overflow-visible">

                            <!-- Classification -->
                            <div
                                class="rounded-lg p-4 transform transition duration-200 ease-in-out bg-blue-700/10 hover:z-10 shadow-[0_-4px_8px_rgba(0,0,0,0.1),4px_0_8px_rgba(0,0,0,0.1),0_4px_8px_rgba(0,0,0,0.1),-4px_0_8px_rgba(0,0,0,0.1)] hover:scale-110 border-l-[16px] border-blue-700">
                                <div class="flex justify-between items-center mb-3 text-[540d6e]">
                                    <!-- Icon + Title -->
                                    <div class="flex items-center gap-x-2 text-blue-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="size-4">
                                            <path fill-rule="evenodd"
                                                d="M5.25 2.25a3 3 0 0 0-3 3v4.318a3 3 0 0 0 .879 2.121l9.58 9.581c.92.92 2.39 1.186 3.548.428a18.849 18.849 0 0 0 5.441-5.44c.758-1.16.492-2.629-.428-3.548l-9.58-9.581a3 3 0 0 0-2.122-.879H5.25ZM6.375 7.5a1.125 1.125 0 1 0 0-2.25 1.125 1.125 0 0 0 0 2.25Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <h3 class="text-sm font-bold uppercase">Asset Information</h3>
                                    </div>

                                    <!-- Click to Edit -->
                                    <svg @click="openSectionEditor('info')" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="size-5 text-gray-600 hover:scale-110 hover:text-blue-600 self-center">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>

                                </div>


                                <div class="grid grid-cols-1  gap-1 text-sm text-gray-900">
                                    <!-- Column Items -->
                                    <div class="flex justify-between">
                                        <span>PROPERTY CODE:</span>
                                        <span class="font-semibold text-gray-800">{{ $asset->property_code ?? 'NO DATA'
                                            }}</span>
                                    </div>

                                    <div class="flex justify-between">
                                        <span>CATEGORY:</span>
                                        <span class="font-semibold  text-gray-800">{{ $asset->category->category_name ??
                                            'NO DATA'
                                            }}</span>
                                    </div>

                                    <div class="flex justify-between">
                                        <span>STATUS:</span>
                                        <span class="font-semibold  text-gray-800">{{ $asset->status->status_name ?? 'NO
                                            DATA'
                                            }}</span>
                                    </div>

                                    <div class="flex justify-between">
                                        <span>CONDITION:</span>
                                        <span class="font-semibold  text-gray-800">{{ $asset->condition->condition_name
                                            ?? 'NO DATA'
                                            }}</span>
                                    </div>

                                    <div class="flex justify-between">
                                        <span>DEVICE SERIAL NUMBER:</span>
                                        <span class="font-semibold  text-gray-800">{{ $asset->device_serial_number ??
                                            'NO DATA'
                                            }}</span>
                                    </div>

                                    <div class="flex justify-between">
                                        <span>CHARGER SERIAL NUMBER:</span>
                                        <span class="font-semibold  text-gray-800">{{ $asset->charger_serial_number ??
                                            'NO DATA'
                                            }}</span>
                                    </div>
                                </div>
                            </div>


                            <!-- Maintenance -->
                            <div
                                class="rounded-lg p-4 transform transition duration-200 ease-in-out bg-[#FF5C00]/10 hover:z-10 shadow-[0_-4px_8px_rgba(0,0,0,0.1),4px_0_8px_rgba(0,0,0,0.1),0_4px_8px_rgba(0,0,0,0.1),-4px_0_8px_rgba(0,0,0,0.1)] hover:scale-110 border-l-[16px] border-[#FF5C00]">
                                <div class="flex items-center justify-between mb-3">
                                    <!-- Left Section: Icon + Heading -->
                                    <div class="flex items-center gap-x-2 text-[#FFA500]">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="size-4">
                                            <path fill-rule="evenodd"
                                                d="M11.078 2.25c-.917 0-1.699.663-1.85 1.567L9.05 4.889c-.02.12-.115.26-.297.348a7.493 7.493 0 0 0-.986.57c-.166.115-.334.126-.45.083L6.3 5.508a1.875 1.875 0 0 0-2.282.819l-.922 1.597a1.875 1.875 0 0 0 .432 2.385l.84.692c.095.078.17.229.154.43a7.598 7.598 0 0 0 0 1.139c.015.2-.059.352-.153.43l-.841.692a1.875 1.875 0 0 0-.432 2.385l.922 1.597a1.875 1.875 0 0 0 2.282.818l1.019-.382c.115-.043.283-.031.45.082.312.214.641.405.985.57.182.088.277.228.297.35l.178 1.071c.151.904.933 1.567 1.85 1.567h1.844c.916 0 1.699-.663 1.85-1.567l.178-1.072c.02-.12.114-.26.297-.349.344-.165.673-.356.985-.57.167-.114.335-.125.45-.082l1.02.382a1.875 1.875 0 0 0 2.28-.819l.923-1.597a1.875 1.875 0 0 0-.432-2.385l-.84-.692c-.095-.078-.17-.229-.154-.43a7.614 7.614 0 0 0 0-1.139c-.016-.2.059-.352.153-.43l.84-.692c.708-.582.891-1.59.433-2.385l-.922-1.597a1.875 1.875 0 0 0-2.282-.818l-1.02.382c-.114.043-.282.031-.449-.083a7.49 7.49 0 0 0-.985-.57c-.183-.087-.277-.227-.297-.348l-.179-1.072a1.875 1.875 0 0 0-1.85-1.567h-1.843ZM12 15.75a3.75 3.75 0 1 0 0-7.5 3.75 3.75 0 0 0 0 7.5Z"
                                                clip-rule="evenodd" />
                                        </svg>

                                        <h3 class="text-sm font-bold uppercase">Maintenance</h3>
                                    </div>

                                    <!-- Right Section: Edit Hint -->
                                    <svg @click="openSectionEditor('maintenance')" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="size-5 text-gray-600 hover:scale-110 hover:text-blue-600 self-center">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </div>

                                <div class="grid grid-cols-1 gap-1 text-sm text-gray-900">
                                    <div class="flex justify-between">
                                        <span>NEXT MAINTENANCE SCHEDULE:</span>
                                        <span class="text-gray-800 font-semibold">
                                            {{ $asset->maint_sched ? strtoupper(optional($asset->maint_sched)->format('F
                                            d, Y')) : 'NO DATA' }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>LAST MAINTENANCE:</span>
                                        <span class="text-gray-800 font-semibold">
                                            {{ $asset->last_maint_sched ?
                                            strtoupper(optional($asset->last_maint_sched)->format('F d, Y')) : 'NO DATA'
                                            }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>MAINTENANCE SERVICE PROVIDER:</span>
                                        <span class="text-gray-800 font-semibold">
                                            {{ $asset->service_provider ?? 'NO DATA' }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>CHECK-OUT STATUS:</span>
                                        <span class="text-gray-800 font-semibold">
                                            {{ $asset->check_out_status ?? 'NO DATA' }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>CHECK-OUT DATE:</span>
                                        <span class="text-gray-800 font-semibold">
                                            {{ $asset->check_out_date ?
                                            strtoupper(optional($asset->check_out_date)->format('F d, Y')) : 'NO DATA'
                                            }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>CHECK-IN DATE:</span>
                                        <span class="text-gray-800 font-semibold">
                                            {{ $asset->check_in_date ?
                                            strtoupper(optional($asset->check_in_date)->format('F d, Y')) : 'NO DATA' }}
                                        </span>
                                    </div>
                                </div>


                            </div>

                            <!-- Assignment -->
                            <div
                                class="rounded-lg p-4 transform transition duration-200 ease-in-out bg-[#3bceac]/10 hover:z-10 shadow-[0_-4px_8px_rgba(0,0,0,0.1),4px_0_8px_rgba(0,0,0,0.1),0_4px_8px_rgba(0,0,0,0.1),-4px_0_8px_rgba(0,0,0,0.1)] hover:scale-110 border-l-[16px] border-[3bceac]">
                                <div class="flex items-center justify-between mb-3 text-[3bceac]">
                                    <!-- Left Side: Icon + Label -->
                                    <div class="flex items-center gap-x-2 text-[3bceac]">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="size-4">
                                            <path fill-rule="evenodd"
                                                d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <h3 class="text-sm font-bold  uppercase">Assignment</h3>
                                    </div>

                                    <!-- Right Side: Edit Tip -->
                                    <svg @click="openSectionEditor('assignment')" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="size-5 text-gray-600 hover:scale-110 hover:text-blue-600 self-center">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </div>


                                <div class="grid grid-cols-1 gap-1 text-sm text-gray-900">
                                    <div class="flex justify-between">
                                        <span>ASSET TYPE:</span>
                                        <span class="text-gray-800 font-semibold">
                                            @if ($asset->asset_type === '1')
                                            COMMON
                                            @elseif ($asset->asset_type === '2')
                                            NON-COMMON
                                            @else
                                            UNKNOWN
                                            @endif
                                        </span>
                                    </div>

                                    <div class="flex justify-between">
                                        <span>ASSIGNED TO:</span>
                                        <span class="text-gray-800 font-semibold">
                                            @if ($asset->asset_type === '2')
                                            {{ strtoupper(($asset->employee->employee_lastname ?? '') . ', ' .
                                            ($asset->employee->employee_firstname ?? '')) }}
                                            @elseif ($asset->asset_type === '1')
                                            {{ strtoupper($asset->department->department_name ?? 'NO DATA') }}
                                            @else
                                            NO DATA
                                            @endif
                                        </span>
                                    </div>

                                    <div class="flex justify-between">
                                        <span>DATE ASSIGNED:</span>
                                        <span class="text-gray-800 font-semibold">
                                            {{ $asset->date_accountable ?
                                            strtoupper(optional($asset->date_accountable)->format('F d, Y')) : 'NO DATA'
                                            }}
                                        </span>
                                    </div>
                                </div>

                            </div>


                            <!-- Warranty -->
                            <div
                                class="rounded-lg p-4 transform transition duration-200 ease-in-out bg-red-600/10 hover:z-10 shadow-[0_-4px_8px_rgba(0,0,0,0.1),4px_0_8px_rgba(0,0,0,0.1),0_4px_8px_rgba(0,0,0,0.1),-4px_0_8px_rgba(0,0,0,0.1)] hover:scale-110 border-l-[16px] border-red-600">
                                <div class="flex items-center justify-between mb-3">
                                    <!-- Left: Icon + Heading -->
                                    <div class="flex items-center gap-x-2 text-red-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="size-4">
                                            <path fill-rule="evenodd"
                                                d="M12.516 2.17a.75.75 0 0 0-1.032 0 11.209 11.209 0 0 1-7.877 3.08.75.75 0 0 0-.722.515A12.74 12.74 0 0 0 2.25 9.75c0 5.942 4.064 10.933 9.563 12.348a.749.749 0 0 0 .374 0c5.499-1.415 9.563-6.406 9.563-12.348 0-1.39-.223-2.73-.635-3.985a.75.75 0 0 0-.722-.516l-.143.001c-2.996 0-5.717-1.17-7.734-3.08Zm3.094 8.016a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <h3 class="text-sm font-bold uppercase">Warranty</h3>
                                    </div>

                                    <!-- Right: Conditional Edit Hint -->
                                    <svg @click="openSectionEditor('warranty')" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="size-5 text-gray-600 hover:scale-110 hover:text-blue-600 self-center">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </div>

                                <div class="grid grid-cols-1 gap-1 text-sm text-gray-900">
                                    <!-- Purchase Date -->
                                    <div class="flex justify-between">
                                        <span>PURCHASE DATE:</span>
                                        <span class="text-gray-800 font-semibold">
                                            {{ $asset->purchase_date ?
                                            strtoupper(optional($asset->purchase_date)->format('F d, Y')) : 'NO DATA' }}
                                        </span>
                                    </div>

                                    <!-- Free Replacement Period -->
                                    <div class="flex justify-between">
                                        <span>FREE REPLACEMENT PERIOD:</span>
                                        <span class="text-gray-800 font-semibold">
                                            {{ $asset->free_replacement_period ?
                                            strtoupper(optional($asset->free_replacement_period)->format('F d, Y')) :
                                            'NO DATA' }}
                                        </span>
                                    </div>

                                    <!-- Warranty Expiration Date -->
                                    <div class="flex justify-between">
                                        <span>WARRANTY EXPIRATION DATE:</span>
                                        <span class="text-gray-800 font-semibold">
                                            {{ $asset->warranty_exp_date ?
                                            strtoupper(optional($asset->warranty_exp_date)->format('F d, Y')) : 'NO
                                            DATA' }}
                                        </span>
                                    </div>
                                </div>

                            </div>

                            <!-- Description -->
                            <div
                                class="rounded-lg p-4 transform transition duration-200 ease-in-out bg-yellow-400/10 hover:z-10 shadow-[0_-4px_8px_rgba(0,0,0,0.1),4px_0_8px_rgba(0,0,0,0.1),0_4px_8px_rgba(0,0,0,0.1),-4px_0_8px_rgba(0,0,0,0.1)] hover:scale-110 border-l-[16px] border-yellow-400">
                                <div class="flex items-center justify-between mb-3">
                                    <!-- Left: Icon + Label -->
                                    <div class="flex items-center gap-x-2 text-yellow-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="size-4">
                                            <path fill-rule="evenodd"
                                                d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0 0 16.5 9h-1.875a1.875 1.875 0 0 1-1.875-1.875V5.25A3.75 3.75 0 0 0 9 1.5H5.625ZM7.5 15a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 7.5 15Zm.75 2.25a.75.75 0 0 0 0 1.5H12a.75.75 0 0 0 0-1.5H8.25Z"
                                                clip-rule="evenodd" />
                                            <path
                                                d="M12.971 1.816A5.23 5.23 0 0 1 14.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 0 1 3.434 1.279 9.768 9.768 0 0 0-6.963-6.963Z" />
                                        </svg>
                                        <h3 class="text-sm font-bold uppercase">Description</h3>
                                    </div>

                                    <!-- Right: Edit Mode Hint -->
                                    <svg @click="openSectionEditor('description')" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="size-5 text-gray-600 hover:scale-110 hover:text-blue-600 self-center">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </div>

                                <p class="text-sm text-gray-800 text-justify">{{ $asset->description }}</p>
                            </div>



                        </div>

                        <livewire:ams.asset.edit-asset-modal />


                        <div class="flex justify-end gap-x-3 mt-6">
                            <!-- Back Button -->
                            <a href="/ams/all-assets"
                                class="inline-flex items-center gap-2 px-4 py-2 bg-blue-900 text-white rounded-md text-sm hover:bg-blue-700 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-5 h-5">
                                    <path fill-rule="evenodd"
                                        d="M9.53 2.47a.75.75 0 0 1 0 1.06L4.81 8.25H15a6.75 6.75 0 0 1 0 13.5h-3a.75.75 0 0 1 0-1.5h3a5.25 5.25 0 1 0 0-10.5H4.81l4.72 4.72a.75.75 0 1 1-1.06 1.06l-6-6a.75.75 0 0 1 0-1.06l6-6a.75.75 0 0 1 1.06 0Z"
                                        clip-rule="evenodd" />
                                </svg>
                                Back to Assets List
                            </a>
                        </div>
                    </div>
            </main>
        </div>

        <script>
            function openSectionEditor(cardId) {
                // Get the asset ID from a hidden input field or global JS variable
                const assetId = document.getElementById('currentAssetId')?.value;

                if (!assetId) {
                    console.error("Asset ID not found.");
                    return;
                }
                const payload = {
                    section: cardId,
                    assetId: assetId
                };

                // Log values for debugging
                console.log("Card ID:", cardId);
                console.log("Asset ID:", assetId);
                console.log('Dispatching to Livewire with:', payload);

                // Dispatch Livewire event with section and asset ID
                Livewire.dispatch('open-edit-asset-modal', { payload });
            }
        </script>
</x-app-layout>