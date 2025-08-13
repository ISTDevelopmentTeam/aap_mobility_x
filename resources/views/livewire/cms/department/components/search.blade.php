<div>
    <div x-data="{ open: false }" class="relative flex flex-1 min-w-0 sm:w-72">
        <div
            class="flex items-center flex-grow bg-white border border-gray-300 rounded-2xl shadow-sm w-full relative">

            <!-- Search Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                class="w-5 h-5 text-gray-400 ml-3">
                <path fill-rule="evenodd"
                    d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z"
                    clip-rule="evenodd" />
            </svg>


            <!-- Search Input -->
            <input type="text" placeholder="Search"
                class="text-sm h-8 px-2 py-2 w-full bg-transparent border-white outline-none focus:outline-none focus:ring-0 focus:border-white"
                x-data
                wire:model.live.debounce.300ms="search">




            {{-- <div class="relative group">
                <button @click="open = !open"
                    class="p-2 border-l border-gray-300 hover:bg-gray-100 focus:outline-none relative z-10">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="w-5 h-5 text-gray-700">
                        <path
                            d="M18.75 12.75h1.5a.75.75 0 0 0 0-1.5h-1.5a.75.75 0 0 0 0 1.5ZM12 6a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 12 6ZM12 18a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 12 18ZM3.75 6.75h1.5a.75.75 0 1 0 0-1.5h-1.5a.75.75 0 0 0 0 1.5ZM5.25 18.75h-1.5a.75.75 0 0 1 0-1.5h1.5a.75.75 0 0 1 0 1.5ZM3 12a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 3 12ZM9 3.75a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5ZM12.75 12a2.25 2.25 0 1 1 4.5 0 2.25 2.25 0 0 1-4.5 0ZM9 15.75a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5Z" />
                    </svg>
                </button>

                <!-- Tooltip -->
                <div
                    class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 bg-black text-white text-xs rounded py-1 px-2 whitespace-nowrap opacity-0 group-hover:opacity-100 transition z-10">
                    Show Filters
                </div>
            </div> --}}

        </div>



        {{-- <!-- Filter Dropdown -->
        <div x-show="open" @click.away="open = false"
            class="absolute right-0 mt-9 w-full sm:w-72 bg-white border border-gray-300 rounded-md shadow-lg z-50 text-sm">

            <div class="p-3 space-y-2 text-gray-700">

                <!-- CATEGORY -->
                <div x-data="{ open: false, selected: 'ALL CATEGORIES', categoryId: '' }"
                    class="relative w-full text-xs">
                    <!-- Label with Icon -->
                    <div class="flex items-center gap-1 mb-1 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="currentColor" class="w-4 h-4">
                            <path
                                d="M12.378 1.602a.75.75 0 0 0-.756 0L3 6.632l9 5.25 9-5.25-8.622-5.03ZM21.75 7.93l-9 5.25v9l8.628-5.032a.75.75 0 0 0 .372-.648V7.93ZM11.25 22.18v-9l-9-5.25v8.57a.75.75 0 0 0 .372.648l8.628 5.033Z" />
                        </svg>
                        <label class="font-medium">CATEGORY</label>
                    </div>

                    <!-- Trigger -->
                    <button type="button" @click="open = !open"
                        class="w-full bg-white border border-gray-300 rounded-xl shadow-sm pl-3 pr-8 py-2 text-left text-xs text-gray-700 focus:outline-none focus:ring-1 focus:ring-blue-600 focus:border-blue-600 uppercase relative">

                        <!-- Selected Text -->
                        <span x-text="selected"></span>

                        <!-- Chevron Icon -->
                        <span class="absolute right-2 top-2 text-gray-500 pointer-events-none">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </span>
                    </button>

                    <!-- Options -->
                    <ul x-show="open" @click.outside="open = false" x-transition
                        class="absolute z-10 mt-1 w-full bg-white shadow-lg max-h-60 rounded-xl py-1 text-xs ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none">
                        <li @click="selected = 'ALL CATEGORIES'; categoryId=''; open = false"
                            class="cursor-pointer select-none px-4 py-2 hover:bg-blue-100 uppercase">
                            ALL CATEGORIES
                        </li>
                        @foreach ($categories as $category)
                            <li @click="selected = '{{ strtoupper($category->category_name) }}'; categoryId = '{{ $category->category_id }}'; open = false"
                                class="cursor-pointer select-none px-4 py-2 hover:bg-blue-100 uppercase">
                                {{ strtoupper($category->category_name) }}
                            </li>
                        @endforeach
                    </ul>

                    <!-- Hidden input -->
                    <input type="hidden" name="category" :value="categoryId">
                </div>



                <!-- STATUS -->
                <div x-data="{ open: false, selected: 'ALL STATUS', statusId: '' }"
                    class="relative w-full text-xs">
                    <div class="flex items-center gap-1 mb-1 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="currentColor" class="w-4 h-4">
                            <path fill-rule="evenodd"
                                d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
                                clip-rule="evenodd" />
                        </svg>
                        <label class="font-medium">STATUS</label>
                    </div>
                    <button type="button" @click="open = !open"
                        class="w-full bg-white border border-gray-300 rounded-xl shadow-sm pl-3 pr-8 py-2 text-left text-xs text-gray-700 focus:outline-none focus:ring-1 focus:ring-blue-600 focus:border-blue-600 uppercase relative">
                        <span x-text="selected"></span>
                        <span class="absolute right-2 top-2 text-gray-500 pointer-events-none">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </span>
                    </button>
                    <ul x-show="open" @click.outside="open = false" x-transition
                        class="absolute z-10 mt-1 w-full bg-white shadow-lg max-h-60 rounded-xl py-1 text-xs ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none">
                        <li @click="selected = 'ALL STATUS'; statusId=''; open = false"
                            class="cursor-pointer px-4 py-2 hover:bg-blue-100 uppercase">
                            ALL STATUS
                        </li>
                        @foreach ($statuses as $status)
                            <li @click="selected = '{{ strtoupper($status->status_name) }}'; statusId = '{{ $status->status_id }}'; open = false"
                                class="cursor-pointer px-4 py-2 hover:bg-blue-100 uppercase">
                                {{ strtoupper($status->status_name) }}
                            </li>
                        @endforeach
                    </ul>
                    <input type="hidden" name="status" :value="statusId">
                </div>



                <!-- CONDITION -->
                <div x-data="{ open: false, selected: 'ALL CONDITIONS', conditionId: '' }"
                    class="relative w-full text-xs">
                    <div class="flex items-center gap-1 mb-1 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="currentColor" class="w-4 h-4">
                            <path fill-rule="evenodd"
                                d="M12 6.75a5.25 5.25 0 0 1 6.775-5.025.75.75 0 0 1 .313 1.248l-3.32 3.319c.063.475.276.934.641 1.299.365.365.824.578 1.3.64l3.318-3.319a.75.75 0 0 1 1.248.313 5.25 5.25 0 0 1-5.472 6.756c-1.018-.086-1.87.1-2.309.634L7.344 21.3A3.298 3.298 0 1 1 2.7 16.657l8.684-7.151c.533-.44.72-1.291.634-2.309A5.342 5.342 0 0 1 12 6.75Z"
                                clip-rule="evenodd" />
                        </svg>
                        <label class="font-medium">CONDITION</label>
                    </div>
                    <button type="button" @click="open = !open"
                        class="w-full bg-white border border-gray-300 rounded-xl shadow-sm pl-3 pr-8 py-2 text-left text-xs text-gray-700 focus:outline-none focus:ring-1 focus:ring-blue-600 focus:border-blue-600 uppercase relative">
                        <span x-text="selected"></span>
                        <span class="absolute right-2 top-2 text-gray-500 pointer-events-none">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </span>
                    </button>
                    <ul x-show="open" @click.outside="open = false" x-transition
                        class="absolute z-10 mt-1 w-full bg-white shadow-lg max-h-60 rounded-xl py-1 text-xs ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none">
                        <li @click="selected = 'ALL CONDITIONS'; conditionId=''; open = false"
                            class="cursor-pointer px-4 py-2 hover:bg-blue-100 uppercase">
                            ALL CONDITIONS
                        </li>
                        @foreach ($conditions as $condition)
                            <li @click="selected = '{{ strtoupper($condition->condition_name) }}'; conditionId = '{{ $condition->condition_id }}'; open = false"
                                class="cursor-pointer px-4 py-2 hover:bg-blue-100 uppercase">
                                {{ strtoupper($condition->condition_name) }}
                            </li>
                        @endforeach
                    </ul>
                    <input type="hidden" name="condition" :value="conditionId">
                </div>



                <!-- DEPARTMENT -->
                <div x-data="{ open: false, selected: 'ALL DEPARTMENTS', departmentId: '' }"
                    class="relative w-full text-xs">
                    <div class="flex items-center gap-1 mb-1 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="currentColor" class="w-4 h-4">
                            <path fill-rule="evenodd"
                                d="M4.5 2.25a.75.75 0 0 0 0 1.5v16.5h-.75a.75.75 0 0 0 0 1.5h16.5a.75.75 0 0 0 0-1.5h-.75V3.75a.75.75 0 0 0 0-1.5h-15ZM9 6a.75.75 0 0 0 0 1.5h1.5a.75.75 0 0 0 0-1.5H9Zm-.75 3.75A.75.75 0 0 1 9 9h1.5a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75ZM9 12a.75.75 0 0 0 0 1.5h1.5a.75.75 0 0 0 0-1.5H9Zm3.75-5.25A.75.75 0 0 1 13.5 6H15a.75.75 0 0 1 0 1.5h-1.5a.75.75 0 0 1-.75-.75ZM13.5 9a.75.75 0 0 0 0 1.5H15A.75.75 0 0 0 15 9h-1.5Zm-.75 3.75a.75.75 0 0 1 .75-.75H15a.75.75 0 0 1 0 1.5h-1.5a.75.75 0 0 1-.75-.75ZM9 19.5v-2.25a.75.75 0 0 1 .75-.75h4.5a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-.75.75h-4.5A.75.75 0 0 1 9 19.5Z"
                                clip-rule="evenodd" />
                        </svg>
                        <label class="font-medium">DEPARTMENT</label>
                    </div>
                    <button type="button" @click="open = !open"
                        class="w-full bg-white border border-gray-300 rounded-xl shadow-sm pl-3 pr-8 py-2 text-left text-xs text-gray-700 focus:outline-none focus:ring-1 focus:ring-blue-600 focus:border-blue-600 uppercase relative">
                        <span x-text="selected"></span>
                        <span class="absolute right-2 top-2 text-gray-500 pointer-events-none">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </span>
                    </button>
                    <ul x-show="open" @click.outside="open = false" x-transition
                        class="absolute z-10 mt-1 w-full bg-white shadow-lg max-h-60 rounded-xl py-1 text-xs ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none">
                        <li @click="selected = 'ALL DEPARTMENTS'; departmentId=''; open = false"
                            class="cursor-pointer px-4 py-2 hover:bg-blue-100 uppercase">
                            ALL DEPARTMENTS
                        </li>
                        @foreach ($departments as $department)
                            <li @click="selected = '{{ strtoupper($department->department_name) }}'; departmentId = '{{ $department->department_id }}'; open = false"
                                class="cursor-pointer px-4 py-2 hover:bg-blue-100 uppercase">
                                {{ strtoupper($department->department_name) }}
                            </li>
                        @endforeach
                    </ul>
                    <input type="hidden" name="department" :value="departmentId">
                </div>


                <!-- APPLY FILTERS BUTTON -->
                <div class="pt-2">
                    <button @click="open=false; applyLivewireFilters()" type="button"
                        class="w-full flex items-center justify-center gap-2 bg-blue-900 text-white text-xs font-semibold px-3 py-2 rounded-md shadow hover:bg-blue-800 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                        APPLY FILTERS
                    </button>
                </div>
            </div>
        </div> --}}
    </div>
</div>
