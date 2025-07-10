@props(['customers' => ''])

<x-app-layout class='flex flex-row w-h-screen' navbar_selected='CRM' :x_data="['open' => false, 'deleteUrl' => '', 'viewOpen' => false, 'employee' => new stdClass()]">
    <div class="flex flex-1 flex-col lg:ml-52 lg:p-10 lg:gap-7 hide-scrollbar bg-[#f3f4f6]">
        <!-- Title and Subtitle -->
        {{-- <div class="">
            <h1 class="text-2xl font-semibold text-blue-900">Dashboard</h1>
            <p class="text-gray-700 text-sm"> Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rem aliquid, in minus voluptate optio illo suscipit possimus fuga explicabo necessitatibus aperiam vel at consequatur corrupti tempora sint veniam libero nisi.</p>
        </div> --}}
        
        <!-- Options Container -->
        <div class="flex justify-center w-full">
            <div class="mx-5 lg:mx-0 mt-16 lg:mt-5 lg:-mb-5 overflow-x-auto hide-scrollbar rounded-md border-2 bg-white border-gray-100 shadow-md w-[90%] lg:w-full">
                <div class="flex min-w-[680px] lg:min-w-0">
                    <x-crm.submodules selected='Dashboard'/>
                </div>
            </div>
        </div>

        <!-- Breadcrumbs-->
        <div class="flex h-10 items-center gap-x-1 text-[#071d49] text-sm px-12 lg:px-7 pt-2 lg:pt-0 pb-2 lg:pb-4 md:ml-20 lg:ml-0">
            <a href="{{ route('customer.index') }}" class="hover:underline truncate">Customer Relationship Management</a>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                <path fill-rule="evenodd"
                    d="M16.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 0 1-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 0 1 1.06-1.06l7.5 7.5Z"
                    clip-rule="evenodd" />
            </svg>
            <a href="{{ route('customer.index') }}" class="hover:underline font-semibold">Dashboard</a>
        </div>
        {{-- body --}}
        <div class="bg-[#f3f4f6] flex flex-col lg:flex-row w-full md:w-full h-[1210px] lg:h-[400px] justify-center items-center gap-5 lg:-mt-10 md:items-center">
            <div class="flex flex-col lg:flex-row justify-evenly items-center h-[1200px] lg:h-full w-[90%] md:w-[80%] md:ml-0 lg:w-full gap-5 lg:ml-0">
                <div class="flex flex-col justify-evenly lg:justify-between w-full lg:w-[70%] h-[1000px] lg:h-full gap-3">
                    {{-- Sales Div --}}
                    <div class="flex flex-col lg:flex-row lg:w-full h-[50%] lg:h-[25%] gap-2 justify-center items-start">
                        {{-- Daily Sales --}}
                        <div class="flex flex-col gap-y-2 items-start justify-center bg-gradient-to-r from-[#071d49] via-[#191d56] to-[#0c0c21] shadow-lg h-[33.3%] lg:h-full w-full lg:w-[33%] rounded-lg shadow-xs">
                            <div class="flex flex-row justify-start items-center gap-2 px-4">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 lg:size-4 text-white">
                                    <path d="M12 7.5a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5Z" />
                                    <path fill-rule="evenodd" d="M1.5 4.875C1.5 3.839 2.34 3 3.375 3h17.25c1.035 0 1.875.84 1.875 1.875v9.75c0 1.036-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 0 1 1.5 14.625v-9.75ZM8.25 9.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM18.75 9a.75.75 0 0 0-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 0 0 .75-.75V9.75a.75.75 0 0 0-.75-.75h-.008ZM4.5 9.75A.75.75 0 0 1 5.25 9h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H5.25a.75.75 0 0 1-.75-.75V9.75Z" clip-rule="evenodd" />
                                    <path d="M2.25 18a.75.75 0 0 0 0 1.5c5.4 0 10.63.722 15.6 2.075 1.19.324 2.4-.558 2.4-1.82V18.75a.75.75 0 0 0-.75-.75H2.25Z" />
                                </svg>
                                <span class="text-white font-extrabold text-sm lg:text-xs uppercase tracking-widest truncate">Daily Sales</span>
                            </div>
                            <div class="flex flex-row justify-start items-center gap-5 lg:gap-2 px-4">
                                <span class="text-white font-bold text-xl lg:text-lg">₱153.04</span>
                                <span class="text-white font-bold text-xs lg:text-xs bg-white bg-opacity-20 rounded-md">+25%</span>
                            </div>
                        </div>
                        {{-- Weekly Sales --}}
                        <div class="flex flex-col gap-y-2 items-start justify-center bg-white shadow-lg h-[33.3%] lg:h-full w-full lg:w-[33%] rounded-lg shadow-xs">
                            <div class="flex flex-row justify-start items-center gap-2 px-4">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 lg:size-4 text-green-400">
                                    <path d="M12 7.5a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5Z" />
                                    <path fill-rule="evenodd" d="M1.5 4.875C1.5 3.839 2.34 3 3.375 3h17.25c1.035 0 1.875.84 1.875 1.875v9.75c0 1.036-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 0 1 1.5 14.625v-9.75ZM8.25 9.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM18.75 9a.75.75 0 0 0-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 0 0 .75-.75V9.75a.75.75 0 0 0-.75-.75h-.008ZM4.5 9.75A.75.75 0 0 1 5.25 9h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H5.25a.75.75 0 0 1-.75-.75V9.75Z" clip-rule="evenodd" />
                                    <path d="M2.25 18a.75.75 0 0 0 0 1.5c5.4 0 10.63.722 15.6 2.075 1.19.324 2.4-.558 2.4-1.82V18.75a.75.75 0 0 0-.75-.75H2.25Z" />
                                </svg>
                                <span class="text-[#071d49] font-extrabold text-sm lg:text-xs uppercase tracking-widest truncate">Weekly Sales</span>
                            </div>
                            <div class="flex flex-row justify-start items-center gap-5 lg:gap-2 px-4">
                                <span class="text-[#071d49] font-bold text-xl lg:text-lg">₱1,240.40</span>
                                <span class="text-green-400 font-bold text-xs lg:text-xs bg-green-400 bg-opacity-20 rounded-md">+17%</span>
                            </div>
                        </div>
                        {{-- Monthly Sales --}}
                        <div class="flex flex-col gap-y-2 items-start justify-center bg-white shadow-lg h-[33.3%] lg:h-full w-full lg:w-[33%] rounded-lg shadow-xs">
                            <div class="flex flex-row justify-start items-center gap-2 px-4">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 lg:size-4 text-green-400">
                                    <path d="M12 7.5a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5Z" />
                                    <path fill-rule="evenodd" d="M1.5 4.875C1.5 3.839 2.34 3 3.375 3h17.25c1.035 0 1.875.84 1.875 1.875v9.75c0 1.036-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 0 1 1.5 14.625v-9.75ZM8.25 9.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM18.75 9a.75.75 0 0 0-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 0 0 .75-.75V9.75a.75.75 0 0 0-.75-.75h-.008ZM4.5 9.75A.75.75 0 0 1 5.25 9h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H5.25a.75.75 0 0 1-.75-.75V9.75Z" clip-rule="evenodd" />
                                    <path d="M2.25 18a.75.75 0 0 0 0 1.5c5.4 0 10.63.722 15.6 2.075 1.19.324 2.4-.558 2.4-1.82V18.75a.75.75 0 0 0-.75-.75H2.25Z" />
                                </svg>
                                <span class="text-[#071d49] font-extrabold text-sm lg:text-xs uppercase tracking-widest truncate">Monthly Sales</span>
                            </div>
                            <div class="flex flex-row justify-start items-center gap-5 lg:gap-2 px-4">
                                <span class="text-[#071d49] font-bold text-xl lg:text-lg">₱5,192.75</span>
                                <span class="text-red-600 font-bold text-xs lg:text-xs bg-red-600 bg-opacity-20 rounded-md">-10%</span>
                            </div>
                        </div>
                    </div>
                    {{-- Members & Email Div --}}
                    <div class="flex flex-col lg:flex-row bg-white shadow-lg w-full lg:h-[75%] h-[70%] rounded-lg shadow-xs justify-evenly items-center">
                        {{-- Active Members --}}
                        <div class="flex flex-col w-full lg:w-[50%] h-full justify-center items-center">
                            <div class="flex flex-row w-[90%] h-[10%] justify-center items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 text-[#071d49]">
                                <path d="M18.375 2.25c-1.035 0-1.875.84-1.875 1.875v15.75c0 1.035.84 1.875 1.875 1.875h.75c1.035 0 1.875-.84 1.875-1.875V4.125c0-1.036-.84-1.875-1.875-1.875h-.75ZM9.75 8.625c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-.75a1.875 1.875 0 0 1-1.875-1.875V8.625ZM3 13.125c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v6.75c0 1.035-.84 1.875-1.875 1.875h-.75A1.875 1.875 0 0 1 3 19.875v-6.75Z" />
                                </svg>
                                <span class="text-base text-[#071d49] font-extrabold uppercase tracking-widest">Active Members</span>
                            </div>
                            <div class="flex flex-row w-[90%] h-[75%] justify-center items-center">
                                <x-analytics-display
                                    title="Number of Members"
                                    :labels="['January', 'February', 'March', 'April', 'May', 'June','July', 'August', 'September', 'October', 'November', 'December',]"
                                    :data="[120, 150, 180, 90, 150, 120, 0, 0, 0, 0, 0 ,0]"
                                    chartType="line"
                                    :color="['#071d49', '#D9CD91', '#330000', '#6600cc', '#00ff00', '#660000', '#666600', '#cc3366', '#cc6600', '#ccff00' ,'#ff0000']"
                                />
                            </div>
                        </div>
                        {{-- Line --}}
                        <div class="flex border-2 border-[#c6c7c8] h-[90%] rounded-lg hidden lg:block"></div>
                        {{-- Email --}}
                        <div class="flex flex-col w-full lg:w-[50%] h-full justify-center items-center">
                            <div class="flex flex-row w-[90%] h-[10%] justify-center items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 text-[#071d49]">
                                    <path d="M1.5 8.67v8.58a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3V8.67l-8.928 5.493a3 3 0 0 1-3.144 0L1.5 8.67Z" />
                                    <path d="M22.5 6.908V6.75a3 3 0 0 0-3-3h-15a3 3 0 0 0-3 3v.158l9.714 5.978a1.5 1.5 0 0 0 1.572 0L22.5 6.908Z" />
                                </svg>
                                <span class="text-base text-[#071d49] font-extrabold uppercase tracking-widest">Email</span>
                            </div>
                            <div class="flex flex-row w-[90%] h-[75%] justify-center items-center">
                                <x-analytics-display
                                    title="Emails"
                                    :labels="['January', 'February', 'March', 'April', 'May']"
                                    :data="[120, 150, 180, 90, 140]"
                                    chartType="doughnut"
                                    :color="['#071d49', '#D9CD91', '#330000', '#6600cc', '#00ff00', '#660000', '#666600', '#cc3366', '#cc6600', '#ccff00' ,'#ff0000']"
                                />
                            </div>
                        </div>
                    </div>
                </div>        
                 {{-- New Members--}}
                <div class="flex justify-between h-[30%] lg:h-full w-full lg:w-[30%] gap-5">
                    <div class="flex flex-col bg-white shadow-lg h-full w-full rounded-lg shadow-xs items-center py-4 lg:py-0">
                        {{-- Header --}}
                        <div class="flex flex-row h-[15%] w-full justify-start items-center px-5 gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 text-[#071d49]">
                                <path fill-rule="evenodd" d="M2.625 6.75a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Zm4.875 0A.75.75 0 0 1 8.25 6h12a.75.75 0 0 1 0 1.5h-12a.75.75 0 0 1-.75-.75ZM2.625 12a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0ZM7.5 12a.75.75 0 0 1 .75-.75h12a.75.75 0 0 1 0 1.5h-12A.75.75 0 0 1 7.5 12Zm-4.875 5.25a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Zm4.875 0a.75.75 0 0 1 .75-.75h12a.75.75 0 0 1 0 1.5h-12a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-base font-extrabold text-[#071d49] uppercase tracking-widest">New Members</span>
                        </div>
                        {{-- Border Line --}}
                        <span class="border-b-2 border-[#071d49] w-[90%] flex h-[5px]"></span>
                        {{-- Members List --}}
                        <div class="flex h-[75%] flex-col overflow-y-auto hide-scrollbar items-center">
                            @foreach ($customers as $customer)
                                <table class="h-[20%] w-[80%] border-b-2 border-[#071d49] items-center justify-start gap-1">
                                    <tr class="flex flex-row w-full h-16">
                                        <td class="flex items-center w-[20%]">
                                            <img src="aaplogo1.png" alt="UserImage" class="w-full flex">
                                        </td>         
                                        <td class="flex items-center w-[60%]">
                                            <span class="text-sm font-semibold text-[#071d49]    ">
                                                {{ $customer -> customer_firstname }} 
                                                {{ $customer -> customer_middlename }} 
                                                {{ $customer -> customer_surname }} 
                                            </span>
                                        </td>
                                        <td class="flex items-center w-[10%]">              
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5  cursor-pointer hover:scale-125 duration-300 text-[#071d49]">
                                                <path fill-rule="evenodd" d="M4.5 3.75a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3V6.75a3 3 0 0 0-3-3h-15Zm4.125 3a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5Zm-3.873 8.703a4.126 4.126 0 0 1 7.746 0 .75.75 0 0 1-.351.92 7.47 7.47 0 0 1-3.522.877 7.47 7.47 0 0 1-3.522-.877.75.75 0 0 1-.351-.92ZM15 8.25a.75.75 0 0 0 0 1.5h3.75a.75.75 0 0 0 0-1.5H15ZM14.25 12a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H15a.75.75 0 0 1-.75-.75Zm.75 2.25a.75.75 0 0 0 0 1.5h3.75a.75.75 0 0 0 0-1.5H15Z" clip-rule="evenodd" />
                                            </svg>
                                        </td>
                                        <td class="flex items-center w-[10%]">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4  cursor-pointer hover:scale-125 duration-300 text-[#071d49]">
                                                <path fill-rule="evenodd" d="M15 3.75a.75.75 0 0 1 .75-.75h4.5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0V5.56l-4.72 4.72a.75.75 0 1 1-1.06-1.06l4.72-4.72h-2.69a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                                                <path fill-rule="evenodd" d="M1.5 4.5a3 3 0 0 1 3-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 0 1-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 0 0 6.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 0 1 1.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 0 1-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5Z" clip-rule="evenodd" />
                                            </svg>
                                        </td>
                                    </tr>
                                </table>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col lg:flex-row w-full h-[600px] lg:h-[300px] items-center gap-5 mt-3 lg:-mt-2 md:items-center md:ml-0">
            {{-- Calendar --}}
            <div class="flex pt-2 bg-white shadow-lg h-full w-[90%] md:w-[80%] lg:w-[50%] rounded-lg shadow-xs justify-center overflow-y-auto hide-scrollbar mx-auto">
                <div x-data="calendar()" x-init="init()" class="w-[90%] flex flex-col items-center justify-between">
                    <div class="flex flex-row items-center w-full">
                        <div class="flex justify-start w-[50%] items-center h-full gap-x-2">
                            <span class="text-[#071d49] text-base tracking-widest font-extrabold">CALENDAR</span>
                            <!-- Categories Info Button -->
                            <div x-data="{ showCategoriesInfo: false }" class="relative">
                                <button @click="showCategoriesInfo = !showCategoriesInfo"
                                        @click.away="showCategoriesInfo =false"
                                        @keydown.escape.window="showCategoriesInfo = false"
                                        class="items-center justify-center flex border-2 border-[#071d49] bg-[#071d49] text-white rounded-full hover:bg-white hover:text-[#071d49] hover:border-[#071d49] font-bold transition-colors duration-200">
                                    <i class="fas fa-info-circle text-xs"></i>
                                </button>
                                
                                <!-- Categories Info Modal -->
                                <div x-show="showCategoriesInfo"
                                    x-transition
                                    x-cloak
                                    class="absolute z-50 bg-[#071d49] text-white p-4 rounded-lg shadow-lg text-xs left-0 top-full mt-2 w-60 max-h-64 overflow-hidden">
                                    <div class="font-semibold mb-3 text-yellow-300 text-center">Departments</div>
                                    <div class="space-y-2 max-h-48 overflow-y-auto pr-2 hide-scrollbar">
                                        <template x-for="department in departments" :key="department.id">
                                            <div class="flex items-center gap-3 py-1">
                                                <div class="w-4 h-4 rounded-full flex-shrink-0" :style="'background-color: ' + department.color"></div>
                                                <span class="text-white" x-text="department.name"></span>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h2 class="text-base uppercase w-[35%] justify-end flex font-extrabold text-[#071d49]" x-text="monthName + ' ' + year"></h2>
                        <div class="flex justify-between w-[15%] h-[70%] px-3 bg-white rounded-md">
                            <div class="flex justify-between items-center mb-4 w-full h-full">
                                <button @click="prevMonth()" class="w-7 h-7 text-[#071d49] font-bold hover:text-[#F6D400]"><i class="fas fa-arrow-circle-left"></i></button>
                                <button @click="nextMonth()" class="w-7 h-7 text-[#071d49] font-bold hover:text-[#F6D400]"><i class="fas fa-arrow-circle-right"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-7 gap-2 text-center text-[#071d49] mb-2 font-semibold w-full">
                        <template x-for="day in ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']">
                            <div x-text="day"></div>
                        </template>
                    </div>

                    <div class="grid grid-cols-7 gap-2 w-full pb-5">
                        <template x-for="blank in startDay" :key="blank">
                            <div></div>
                        </template>

                        <template x-for="day in daysInMonth" :key="day">
                            <div @click="openNote(day)"
                                @mouseenter="showPreview = day"
                                @mouseleave="showPreview = null"
                                class="relative border border-[#071d49] rounded-md h-16 p-1 group hover:bg-[#071d49] cursor-pointer"
                                :class="getDateClass(day)">
                                
                                <!-- Day number -->
                                <div class="text-sm font-bold" 
                                    :class="getDayNumberClass(day)" 
                                    x-text="day"></div>
                                
                                <!-- Holiday indicator (star icon) -->
                                <div x-show="isHoliday(day)" 
                                    class="absolute bottom-1 right-1 text-yellow-400 text-xs">
                                    <i class="fas fa-star"></i>
                                </div>
                                
                                <!-- Category indicator (colored bar) -->
                                <div x-show="hasNote(day)" 
                                    class="absolute top-1 right-1 w-3 h-1 rounded-full"
                                    :style="'background-color: ' + getCategoryColor(day)"></div>
                                
                                <!-- Note/Holiday preview -->
                                <div class="text-xs mt-1 truncate" 
                                    :class="getTextClass(day)" 
                                    x-text="getDisplayText(day)"></div>
                                
                                <!-- Hover preview tooltip -->
                                <div x-show="showPreview === day && (hasNote(day) || isHoliday(day))" 
                                    x-cloak
                                    class="absolute z-50 bg-[#071d49] text-white p-3 rounded-lg shadow-lg text-xs pointer-events-none"
                                    :class="getTooltipPosition(day)"
                                    style="white-space: normal; word-wrap: break-word;">
                                    <div x-show="isHoliday(day)" class="mb-2">
                                        <div class="font-semibold text-yellow-300 mb-1">
                                            <i class="fas fa-star mr-1"></i>Holiday
                                        </div>
                                        <div class="leading-relaxed text-yellow-100" x-text="getHolidayName(day)"></div>
                                    </div>
                                    <div x-show="hasNote(day)">
                                        <div class="font-semibold mb-1 text-green-300" x-text="getCategoryName(day)"></div>
                                        <div class="leading-relaxed" x-text="getNote(day)"></div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                    
                    <!-- Note modal -->
                    <div x-show="showModal" x-cloak class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-10">
                        <div class="bg-white rounded-lg shadow-lg px-5 py-4 w-96 border-2 h-auto border-[#071d49]">
                            <div class="flex flex-row w-full justify-between items-start gap-5 mb-3">
                                <h3 class="flex flex-col text-lg font-semibold uppercase text-[#071d49]">
                                    Event for:&nbsp<span x-text="monthName + ' ' + activeDay + ', ' + year" class="underline cursor-pointer hover:text-yellow-400"></span>
                                    <span x-show="isHoliday(activeDay)" class="text-sm font-semibold text-yellow-600 normal-case mt-1">
                                        <i class="fas fa-star mr-1"></i><span x-text="getHolidayName(activeDay)"></span>
                                    </span>
                                </h3>
                                <div class="flex flex-col justify-start items-end">
                                    <div class="flex flex-row gap-x-2">
                                        <button @click="saveNote()" class="w-4 h-8 items-center justify-center flex px-4 py-1 border-2 border-[#071d49] bg-[#071d49] text-white rounded hover:bg-white hover:text-[#071d49] hover:border-[#071d49] font-bold"><i class="fas fa-save"></i></button>
                                        <button @click="deleteCurrentNote()" class="w-4 h-8 items-center justify-center flex px-4 py-1 border-2 border-red-600 bg-red-600 text-white rounded hover:bg-white hover:text-red-600 hover:border-red-600 font-bold"><i class="fas fa-trash"></i></button>
                                        <button @click="showModal = false" class="w-4 h-8 items-center justify-center flex px-4 py-1 bg-white border-2 border-[#071d49] rounded hover:bg-[#071d49] hover:text-white"><i class="fas fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Department Selection (Updated from Category) -->
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-[#071d49] mb-2">Department</label>
                                <select x-model="currentCategory" class="w-full border-2 border-[#071d49] rounded-md p-2 text-sm hide-scrollbar">
                                    <template x-for="dept in departments" :key="dept.id">
                                        <option class="hide-scrollbar" :value="dept.id" x-text="dept.name"></option>
                                    </template>
                                </select>
                            </div>
                            
                            <!-- Note Textarea -->
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-[#071d49] mb-2">Note</label>
                                <textarea x-ref="noteTextarea" x-model="currentNote" class="w-full border-2 border-[#071d49] rounded-md p-2 h-40 resize-none text-sm" placeholder="Enter your note here..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Revenue --}}
            <div x-data="{activeChart: 'chart1'}" class="flex flex-col bg-white shadow-lg h-full w-[90%] lg:w-[50%] md:w-[80%] rounded-lg shadow-xs justify-center items-center gap-3">
                <div class="flex flex-row h-[10%] w-[90%] items-center gap-2">
                    <div class="flex flex-row w-[50%] h-full justify-start items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 text-[#071d49]">
                            <path fill-rule="evenodd" d="M15.22 6.268a.75.75 0 0 1 .968-.431l5.942 2.28a.75.75 0 0 1 .431.97l-2.28 5.94a.75.75 0 1 1-1.4-.537l1.63-4.251-1.086.484a11.2 11.2 0 0 0-5.45 5.173.75.75 0 0 1-1.199.19L9 12.312l-6.22 6.22a.75.75 0 0 1-1.06-1.061l6.75-6.75a.75.75 0 0 1 1.06 0l3.606 3.606a12.695 12.695 0 0 1 5.68-4.974l1.086-.483-4.251-1.632a.75.75 0 0 1-.432-.97Z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-[#071d49] font-extrabold text-base uppercase tracking-widest">Revenue</span>
                    </div>
                    <div class="flex justify-end w-[50%] h-full items-center">
                        {{-- Buttons --}}
                        <div class="flex flex-row w-full lg:w-[90%] h-full lg:h-[80%] border border-[#071d49] rounded-md justify-between items-center">
                            <button @click="activeChart = 'chart1'" :class="activeChart === 'chart1' ? 'bg-[#071d49] text-[#fffff1]' : 'text-[#071d49]'"
                                class="text-xs uppercase text-[#071d49] font-semibold focus:bg-[#071d49] focus:text-white w-[33.3%] h-full text-center rounded-l-md hover:bg-[#071d49] hover:text-white">Weekly</button>
                            <button @click="activeChart = 'chart2'" :class="activeChart === 'chart2' ? 'bg-[#071d49] text-[#fffff1]' : 'text-[#071d49]'"
                                class="text-xs uppercase text-[#071d49] font-semibold focus:bg-[#071d49] focus:text-white w-[33.3%] h-full text-center hover:bg-[#071d49] hover:text-white">Monthly</button>
                            <button @click="activeChart = 'chart3'" :class="activeChart === 'chart3' ? 'bg-[#071d49] text-[#fffff1]' : 'text-[#071d49]'"
                                class="text-xs uppercase text-[#071d49] font-semibold focus:bg-[#071d49] focus:text-white w-[33.3%] h-full text-center rounded-r-md hover:bg-[#071d49] hover:text-white">Annual</button>
                        </div>
                    </div>
                </div>
                <div class="flex h-[75%] w-[90%] relative">
                    {{-- Weekly Revenue --}}
                    <div x-show="activeChart === 'chart1'" x-cloak class="h-full w-full absolute">
                        <x-analytics-display
                                title="Weekly"
                                :labels="['Week 1', 'Week 2', 'Week 3', 'Week 4']"
                                :data="[120, 150, 180, 90]"
                                chartType="bar"
                                :color="['#071d49', '#D9CD91', '#330000', '#6600cc', '#00ff00', '#660000', '#666600', '#cc3366', '#cc6600', '#ccff00' ,'#ff0000']"
                        />
                    </div>
                    {{-- Monthly Revenue --}}
                    <div x-show="activeChart === 'chart2'" x-cloak class="h-full w-full absolute">
                        <x-analytics-display
                                title="Monthly"
                                :labels="['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August']"
                                :data="[120, 150, 180, 90, 150, 180, 90, 130]"
                                chartType="bar"
                                :color="['#071d49', '#D9CD91', '#330000', '#6600cc', '#00ff00', '#660000', '#666600', '#cc3366', '#cc6600', '#ccff00' ,'#ff0000']"
                        />
                    </div>
                    {{-- Annual Revenue --}}
                    <div x-show="activeChart === 'chart3'" x-cloak class="h-full w-full absolute">
                        <x-analytics-display
                                title="Annual"
                                :labels="['2020', '2021', '2022', '2023' , '2024' , '2025']"
                                :data="[120, 150, 180, 90, 150, 140]"
                                chartType="bar"
                                :color="['#071d49', '#D9CD91', '#330000', '#6600cc', '#00ff00', '#660000', '#666600', '#cc3366', '#cc6600', '#ccff00' ,'#ff0000']"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function calendar() {
    return {
        year: new Date().getFullYear(),
        month: new Date().getMonth(),
        daysInMonth: 0,
        startDay: 0,
        showModal: false,
        activeDay: null,
        notes: {},
        categories: {},
        currentNote: '',
        currentCategory: '', // Will be set to first department ID
        showPreview: null,
        showCategoriesInfo: false,
        // Replace eventCategories with departments
        departments: [],
        today: new Date(),
        philippineHolidays: {
            // Your existing holidays data...
            '2025-0-1': 'New Year\'s Day',
            '2025-0-29': 'Chinese New Year',
            '2025-1-25': 'People Power Revolution',
            '2025-3-1': 'Eid\'l Fitr',
            '2025-3-9': 'The Day of Valor',
            '2025-3-17': 'Maundy Thursday',
            '2025-3-18': 'Good Friday',
            '2025-3-19': 'Black Saturday',
            '2025-4-1': 'Labor Day',
            '2025-4-12': 'Eid\'l Fitr (May 12)',
            '2025-5-6': 'Eidul Adha',
            '2025-5-12': 'Independence Day',
            '2025-6-27': 'Founding Anniversary of the INC',
            '2025-7-21': 'Ninoy Aquino Day',
            '2025-7-25': 'National Heroes\' Day',
            '2025-9-31': 'Additional Special Non-Working Day',
            '2025-10-1': 'All Saints\' Day',
            '2025-10-30': 'Bonifacio Day',
            '2025-11-8': 'Immaculate Conception Day',
            '2025-11-24': 'Christmas Eve',
            '2025-11-25': 'Christmas Day',
            '2025-11-30': 'Rizal Day',
            '2025-11-31': 'New Year\'s Eve',
            // Add 2026 holidays...
        },

        get monthName() {
            return new Date(this.year, this.month).toLocaleString('default', { month: 'long' });
        },

        async init() {
            await this.loadDepartments(); // Load departments first
            this.updateCalendar();
            await this.loadNotesFromDatabase(); // Load notes after departments are loaded
        },

        // Helper method to ensure category is properly initialized
        initializeCategory() {
            if (this.departments.length > 0 && (!this.currentCategory || this.currentCategory === '')) {
                this.currentCategory = String(this.departments[0].id); // Convert to string for consistency
                console.log('Initialized category to:', this.currentCategory);
            }
        },

        // New function to load departments from database
        async loadDepartments() {
            try {
                const response = await fetch('/calendar/departments');
                const data = await response.json();
                
                if (data.success) {
                    this.departments = data.departments;
                    // Set default category to first department if available
                    this.initializeCategory();
                    console.log('Departments loaded:', this.departments); // Debug log
                } else {
                    throw new Error(data.message);
                }
            } catch (error) {
                console.error('Error loading departments:', error);
                Swal.fire({
                    title: 'Error',
                    text: 'Failed to load departments from database',
                    icon: 'error',
                    width: '400px'
                });
                // Fallback to empty array
                this.departments = [];
            }
        },

        updateCalendar() {
            const firstDay = new Date(this.year, this.month, 1);
            this.startDay = firstDay.getDay();
            this.daysInMonth = new Date(this.year, this.month + 1, 0).getDate();
        },

        async prevMonth() {
            this.month--;
            if (this.month < 0) {
                this.month = 11;
                this.year--;
            }
            this.updateCalendar();
            await this.loadNotesFromDatabase();
        },

        async nextMonth() {
            this.month++;
            if (this.month > 11) {
                this.month = 0;
                this.year++;
            }
            this.updateCalendar();
            await this.loadNotesFromDatabase();
        },

        // Load notes from database
        async loadNotesFromDatabase() {
            try {
                const response = await fetch(`/calendar/notes?year=${this.year}&month=${this.month + 1}`);
                const data = await response.json();
                
                // Clear existing notes
                this.notes = {};
                this.categories = {};
                
                // Convert database format to our format
                Object.keys(data).forEach(date => {
                    const dateObj = new Date(date);
                    const dateKey = `${dateObj.getFullYear()}-${dateObj.getMonth()}-${dateObj.getDate()}`;
                    this.notes[dateKey] = data[date].note;
                    
                    // Validate category exists before assigning - convert to string for consistency
                    const categoryId = String(data[date].category);
                    const departmentExists = this.departments.some(dept => String(dept.id) === categoryId);
                    
                    if (departmentExists) {
                        this.categories[dateKey] = categoryId;
                    } else {
                        // Fallback to first department or empty string
                        this.categories[dateKey] = this.departments.length > 0 ? String(this.departments[0].id) : '';
                        console.warn(`Category ${categoryId} not found for date ${date}, using fallback`);
                    }
                });
                
                console.log('Notes loaded:', this.notes); // Debug log
                console.log('Categories loaded:', this.categories); // Debug log
            } catch (error) {
                console.error('Error loading notes:', error);
                Swal.fire({
                    title: 'Error',
                    text: 'Failed to load notes from database',
                    icon: 'error',
                    width: '400px'
                });
            }
        },

        // Helper function to create a unique date key
        getDateKey(day, month = this.month, year = this.year) {
            return `${year}-${month}-${day}`;
        },

        // Format date for database (YYYY-MM-DD)
        formatDateForDatabase(day, month = this.month, year = this.year) {
            const paddedMonth = String(month + 1).padStart(2, '0');
            const paddedDay = String(day).padStart(2, '0');
            return `${year}-${paddedMonth}-${paddedDay}`;
        },

        // Check if a specific day has notes
        hasNote(day) {
            const dateKey = this.getDateKey(day);
            return this.notes[dateKey] && this.notes[dateKey].trim() !== '';
        },

        // Get note for a specific day
        getNote(day) {
            const dateKey = this.getDateKey(day);
            return this.notes[dateKey] || '';
        },

        // Check if a day is a Philippine holiday
        isHoliday(day) {
            const dateKey = this.getDateKey(day);
            return this.philippineHolidays.hasOwnProperty(dateKey);
        },

        // Get holiday name for a specific day
        getHolidayName(day) {
            const dateKey = this.getDateKey(day);
            return this.philippineHolidays[dateKey] || '';
        },

        // Get display text (holiday or note)
        getDisplayText(day) {
            if (this.isHoliday(day)) {
                return this.getHolidayName(day);
            }
            return this.getNote(day);
        },

        // Get date class for styling
        getDateClass(day) {
            let classes = '';
            if (this.isToday(day)) {
                classes += 'bg-[#abcae9]';
            } else if (this.isHoliday(day)) {
                classes += 'bg-yellow-100 hover:bg-[#071d49] ';
            } else {
                classes += 'hover:bg-[#071d49] ';
            }
            return classes;
        },

        // Get day number class for styling
        getDayNumberClass(day) {
            if (this.isToday(day)) {
                return 'text-[#071d49] group-hover:text-white';
            } else if (this.isHoliday(day)) {
                return 'text-yellow-700 group-hover:text-white';
            } else {
                return 'text-[#071d49] group-hover:text-white';
            }
        },

        // Get text class for styling
        getTextClass(day) {
            if (this.isToday(day)) {
                return 'text-white';
            } else if (this.isHoliday(day)) {
                return 'text-yellow-700 group-hover:text-white';
            } else {
                return 'text-[#071d49] group-hover:text-white';
            }
        },

        openNote(day) {
            this.activeDay = day;
            this.currentNote = this.getNote(day);
            
            // Get category and validate it exists
            const categoryId = this.getCategory(day);
            const departmentExists = this.departments.some(dept => String(dept.id) === String(categoryId));
            
            if (departmentExists && categoryId) {
                this.currentCategory = String(categoryId);
            } else {
                // Fallback to first department
                this.initializeCategory();
            }
            
            console.log('Opening note with category:', this.currentCategory); // Debug log
            this.showModal = true;
        },

        // Save note to database
        async saveNote() {
            if (!this.currentNote.trim()) {
                Swal.fire({
                    html: `
                        <strong style="font-size: 24px;">Nothing to Save</strong>
                        <p style="font-size: 20px;">Please input a note first.</p>
                    `,
                    icon: 'info',
                    confirmButtonText: 'OK',
                    showConfirmButton: false,
                    timer: 2000,
                    width: '400px',
                    didOpen: () => {
                        const icon = document.querySelector('.swal2-icon');
                        if (icon) {
                        icon.style.width = '60px';
                        icon.style.height = '60px';
                        }
                    },
                    height: '100px'
                });
                return;
            }

            // Ensure category is initialized
            this.initializeCategory();

            // Validate current category exists with improved type checking
            if (!this.currentCategory || !this.departments.some(dept => String(dept.id) === String(this.currentCategory))) {
                console.log('Validation failed - Category:', this.currentCategory);
                console.log('Available departments:', this.departments.map(d => ({ id: d.id, name: d.name })));
                
                Swal.fire({
                    title: 'Invalid Department',
                    text: 'Please select a valid department.',
                    icon: 'error',
                    width: '400px'
                });
                return;
            }

            const result = await Swal.fire({
                title: 'Save Note?',
                text: 'Do you want to save this note?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Save',
                cancelButtonText: 'Cancel',
                width: '400px'
            });

            if (result.isConfirmed) {
                try {
                    console.log('Attempting to save with category:', this.currentCategory); // Debug log
                    
                    const response = await fetch('/calendar/save-note', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            date: this.formatDateForDatabase(this.activeDay),
                            note: this.currentNote,
                            category: this.currentCategory
                        })
                    });

                    const data = await response.json();

                    if (data.success) {
                        // Update local storage
                        const dateKey = this.getDateKey(this.activeDay);
                        this.notes[dateKey] = this.currentNote;
                        this.categories[dateKey] = String(this.currentCategory);
                        
                        console.log('Note saved with category:', this.currentCategory); // Debug log
                        
                        this.showModal = false;
                        
                        Swal.fire({
                            title: 'Saved!',
                            text: 'Your note has been saved.',
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false,
                            width: '400px',
                            height: '100px'
                        });
                    } else {
                        throw new Error(data.message);
                    }
                } catch (error) {
                    console.error('Error saving note:', error);
                    Swal.fire({
                        title: 'Error',
                        text: 'Failed to save note. Please try again.',
                        icon: 'error',
                        width: '400px'
                    });
                }
            }
        },

        // Delete note from database
        async deleteCurrentNote() {
            if (!this.currentNote.trim()) {
                Swal.fire({
                    html: `
                        <strong style="font-size: 24px;">There's no Note to Delete</strong>
                        <p style="font-size: 20px;">Click a date with a note.</p>
                    `,
                    icon: 'info',
                    confirmButtonText: 'OK',
                    showConfirmButton: false,
                    timer: 2000,
                    width: '400px',
                    didOpen: () => {
                        const icon = document.querySelector('.swal2-icon');
                        if (icon) {
                        icon.style.width = '60px';
                        icon.style.height = '60px';
                        }
                    },
                    height: '100px'
                });
                return;
            }

            const result = await Swal.fire({
                title: 'Delete Note?',
                text: 'This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                width: '400px'
            });

            if (result.isConfirmed) {
                try {
                    const response = await fetch('/calendar/delete-note', {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            date: this.formatDateForDatabase(this.activeDay)
                        })
                    });

                    const data = await response.json();

                    if (data.success) {
                        // Update local storage
                        const dateKey = this.getDateKey(this.activeDay);
                        delete this.notes[dateKey];
                        delete this.categories[dateKey];
                        
                        this.currentNote = '';
                        // Reset category to first department
                        this.initializeCategory();
                        this.showModal = false;
                        
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'Your note has been deleted.',
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false,
                            width: '400px'
                        });
                    } else {
                        throw new Error(data.message);
                    }
                } catch (error) {
                    console.error('Error deleting note:', error);
                    Swal.fire({
                        title: 'Error',
                        text: 'Failed to delete note. Please try again.',
                        icon: 'error',
                        width: '400px'
                    });
                }
            }
        },

        // Get category for a specific day
        getCategory(day) {
            const dateKey = this.getDateKey(day);
            const categoryId = this.categories[dateKey];
            
            // Validate category exists - convert to string for consistency
            if (categoryId && this.departments.some(dept => String(dept.id) === String(categoryId))) {
                return String(categoryId);
            }
            
            // Return first department as fallback
            return this.departments.length > 0 ? String(this.departments[0].id) : '';
        },

        // Get department color for a specific day
        getCategoryColor(day) {
            if (!this.hasNote(day)) {
                return 'transparent'; 
            }
            const categoryId = this.getCategory(day);
            const department = this.departments.find(dept => String(dept.id) === String(categoryId));
            return department ? department.color : '#10B981';
        },

        // Get department name for a specific day
        getCategoryName(day) {
            const categoryId = this.getCategory(day);
            const department = this.departments.find(dept => String(dept.id) === String(categoryId));
            
            if (department) {
                return department.name;
            }
            
            // Debug logging
            console.warn(`Department not found for category ID: ${categoryId}`);
            console.log('Available departments:', this.departments);
            
            return 'Unknown Department';
        },

        // Get responsive tooltip position based on day position
        getTooltipPosition(day) {
            const dayOfWeek = (day + this.startDay - 1) % 7;
            const weekNumber = Math.floor((day + this.startDay - 1) / 7);
            const totalWeeks = Math.ceil((this.daysInMonth + this.startDay) / 7);
            
            let classes = 'w-64 sm:w-72 md:w-80';
            
            if (weekNumber >= totalWeeks - 2) { 
                classes += ' bottom-full mb-2';
            } else {
                classes += ' top-full mt-2';
            }
            
            if (dayOfWeek <= 1) {
                classes += ' left-0';
            } else if (dayOfWeek >= 5) {
                classes += ' right-0';
            } else {
                classes += ' left-1/2 transform -translate-x-1/2';
            }
            
            return classes;
        },

        isToday(day) {
            return this.today.getDate() === day && 
                this.today.getMonth() === this.month && 
                this.today.getFullYear() === this.year;
        }
    };
}
    </script>

</x-app-layout>