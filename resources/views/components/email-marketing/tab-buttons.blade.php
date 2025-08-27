<div class="flex w-full justify-center">
    <div class="flex flex-col lg:flex-row w-[90%] md:w-[80%] md:ml-0 lg:w-full lg:justify-between lg:h-10 gap-y-2 lg:gap-y-0 gap-x-5 mt-2 lg:mt-0">
        <div class="flex flex-row w-full lg:w-[60%] gap-2">
            <a href=" {{route('email-marketing')}} " 
                class="{{ request()->routeIs('email-marketing') 
                ? ' border-2 border-[#abcae9] bg-[#abcae9] text-[#071d49]' 
                : 'bg-[#071d49] text-white hover:bg-white hover:border-2 border-[#071d49] hover:text-[#071d49]' }}  
                w-[33.3%] border-2 p-1.5 px-4 py-2 text-sm items-center flex justify-center rounded-lg font-inter font-medium truncate">Celebrant List</a>
            <a href="{{ route('message-template') }}" 
                class="{{ request()->routeIs('message-template') 
                ? ' border-2 border-[#abcae9] bg-[#abcae9] text-[#071d49]' 
                : 'bg-[#071d49] text-white hover:bg-white hover:border-2 border-[#071d49] hover:text-[#071d49]' }}  
                w-[33.3%] border-2 p-1.5 px-4 py-2 text-sm items-center flex justify-center text-center rounded-lg font-inter font-medium truncate">Message Templates</a>
            <a href="{{ route('message-list') }}" 
                class="{{ request()->routeIs('message-list') 
                ? ' border-2 border-[#abcae9] bg-[#abcae9] text-[#071d49]' 
                : 'bg-[#071d49] text-white hover:bg-white hover:border-2 border-[#071d49] hover:text-[#071d49]' }}
                w-[33.3%] border-2 p-1.5 px-4 py-2 text-sm items-center flex justify-center rounded-lg font-inter font-medium truncate">Message List</a>
        </div>

        <div class="flex flex-row w-full lg:w-[40%] gap-2">
            <a href="{{ route('compose-email') }}" 
                class="{{ request()->routeIs('compose-email') 
                ? ' border-2 border-[#abcae9] bg-[#abcae9] text-[#071d49]' 
                : 'bg-[#F6D400] text-black hover:bg-white hover:border-2 border-[#F6D400] hover:text-[#071d49]' }} 
                w-[50%] lg:w-[45%] border-2 p-1.5 px-4 py-2 text-sm text-center rounded-lg font-inter font-medium truncate">Send To All Via Email</a>
            <a href="{{ route('compose-mobile') }}" 
                class="{{ request()->routeIs('compose-mobile') 
                ? ' border-2 border-[#abcae9] bg-[#abcae9] text-[#071d49]' 
                : 'bg-[#F6D400] text-black hover:bg-white hover:border-2 border-[#F6D400] hover:text-[#071d49]' }} 
                w-[50%] lg:w-[55%] border-2 p-1.5 px-4 py-2 text-sm text-center rounded-lg font-inter font-medium truncate">Send To All Via Mobile No.</a>
        </div>
    </div>  
</div>