<!-- Asset List Modal -->
<div x-data="{ open: @entangle('showAssetModal') }" x-show="open" x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full mx-4 overflow-hidden"
        @click.away="open = false; @this.resetSelectedAssets()">
        <!-- Modal Header -->
        <div class="flex  justify-between px-6 pt-6 pb-2">

            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-[#071d49] mb-1">
                        Assets assigned to
                        <span class="text-xl font-bold text-[#071d49]">
                            {{ $assigneeName ?: '' }}
                        </span>
                    </h2>
                    <p class=" text-sm text-gray-600 leading-tight">
                        <em>Choose other assets to be transferred.</em>
                    </p>
                </div>
            </div>

        </div>

        <!-- Modal Body -->
        <div class="overflow-auto hide-scrollbar">
            <div class="min-w-auto w-full px-6 pb-2">
                <table class="w-full text-center text-sm text-gray-500">
                    <thead class="bg-gray-100 text-xs text-gray-700 uppercase">
                        <tr>
                            <th class="py-3">Asset Name</th>
                            <th class="py-3">Brand</th>
                            <th class="py-3">Model</th>
                            <th class="py-3">Status</th>
                            <th class="py-3 w-36">Select</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($availableAssets as $asset)
                        <tr class="border-b border-gray-200 {{ $loop->even ? 'bg-[#EDF0FF]' : 'bg-white' }}">
                            <td class="py-2 text-gray-900">{{ $asset->asset_name }}</td>
                            <td class="py-2 text-gray-900">
                                @if (in_array($asset->category_id, [1, 6]))
                                {{ $asset->brand->brand_name ?? 'NO DATA' }}
                                @else
                                {{ $asset->brand_name_custom ?? 'NO DATA' }}
                                @endif
                            </td>
                            <td class="py-2 text-gray-900">{{ $asset->model_name }}</td>

                            <td class="py-2 text-gray-900">
                                @php
                                $statusClass = match ($asset->status->status_name) {
                                'AVAILABLE' => 'bg-green-600',
                                'IN USE' => 'bg-blue-600',
                                'UNDER MAINTENANCE' => 'bg-yellow-500',
                                'DECOMMISSIONED' => 'bg-gray-700',
                                'ON HOLD' => 'bg-purple-600',
                                'LOST/STOLEN' => 'bg-red-600',
                                default => 'bg-gray-400',
                                };
                                @endphp
                                <span class="text-white text-xs font-medium px-2 py-1 rounded-full {{ $statusClass }}">
                                    {{ $asset->status->status_name }}
                                </span>
                            </td>
                            <td class="py-2 text-center align-middle">
                                <div x-data="{
                                        sel: @entangle('selectedAssets').live, // keep in sync with Livewire
                                        idNum(v){ return Number(v) },
                                        isSelected(id){
                                            id = this.idNum(id);
                                            return this.sel.some(v => this.idNum(v) === id);
                                        },
                                        toggle(id){
                                            id = this.idNum(id);
                                            this.sel = this.isSelected(id)
                                                ? this.sel.filter(v => this.idNum(v) !== id)
                                                : [...this.sel, id];
                                        }
                                    }" class="inline-flex">
                                    <button @click="toggle(@js($asset->asset_id))" :class="[
                                            'inline-flex items-center justify-center gap-2 px-3 h-8 text-xs text-white rounded transition-colors duration-200',
                                            isSelected(@js($asset->asset_id)) ? 'bg-green-600 hover:bg-green-700' : 'bg-blue-600 hover:bg-blue-700'
                                        ]" wire:key="picker-asset-{{ $asset->asset_id }}" type="button"
                                        :aria-pressed="isSelected(@js($asset->asset_id))">
                                        <template x-if="isSelected(@js($asset->asset_id))">
                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <polyline points="20 6 9 17 4 12" />
                                            </svg>
                                        </template>
                                        <span class="leading-none"
                                            x-text="isSelected(@js($asset->asset_id)) ? 'Selected' : 'Select'"></span>
                                    </button>
                                </div>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Footer -->
        <div class="flex justify-end px-5 py-3 gap-2">
            <button @click="open = false" wire:click="resetSelectedAssets()"
                class="px-4 py-2 text-sm border border-gray-300 rounded-lg text-gray-700 hover:text-gray-900 hover:bg-gray-200">
                Cancel
            </button>
            <button @click="open = false" wire:click="confirmSelectedAssets()"
                class="px-4 py-2 text-sm border rounded-lg bg-blue-700 text-white hover:bg-blue-800">
                Confirm
            </button>
        </div>
    </div>
</div>