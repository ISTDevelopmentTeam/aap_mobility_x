@props(['navbar_selected' => ""])

<style>

.back {
  position: relative;
  background: #F3F4F6;
}

.back:before {
  
  content: '';
  position: absolute;
  top: -20px;
  right: 0;
  height: 20px;
  width: 20px;
  border-bottom-right-radius: 0.25rem;
  background-color: #071d49;
  z-index: 2;
}

.back::after {
  
  content: '';
  position: absolute;
  bottom: -20px;
  right: 0;
  height: 20px;
  width: 20px;
  border-top-right-radius: 0.25rem;
  background-color: #071d49;
  z-index: 2;
}

.edge::before {
  content: '';
  position: absolute;
  top: -20px;
  right: 0;
  height: 20px;
  width: 20px;
  background-color: white;
  z-index: 1;
}

.edge::after {
  content: '';
  position: absolute;
  bottom: -20px;
  right: 0;
  height: 20px;
  width: 20px;
  background-color: white;
  z-index: 1;
}
</style>

@php

$user = auth()->user()->load('organization', 'employee', 'roles');

$modules_access = auth()->user()->roles->flatMap->modules->pluck('module_name')->toArray();

@endphp

<div class="fixed lg:flex hidden top-0 w-52 h-dvh flex flex-col items-center gap-4 bg-[#071d49] py-4 text-white z-50" id="menu">
  <button class="self-end mr-4 text-white lg:hidden" onclick="menuToggle()">✖</button>
  <div class="w-28 flex justify-center">
    <a href="{{ route('dashboard') }}">
      <img src="{{ asset('aaplogo1.png') }}" alt="aap-logo" class="max-w-full h-auto" />
    </a>
  </div>
  
  <div class="text-xs w-full">
    @foreach($modules_access as $module)
   
      @php

        $links = [
          'Dashboard' => '/dashboard',
          'Roles Management' => '/role',
          'RBAC Management' => '/user',
          'Modules' => '/module',
          'Employee Management' => '/employee',
          'Permissions' => '/permission',
          'CRM' => '/customer',
          'Asset Management' => '/ams',
          'CMS' => '/cms',
        ];
      @endphp
      
      @if(isset($links[$module]))
        <div class="group cursor-pointer flex items-center px-2 py-3 gap-2 ml-2 rounded-l-xl {{ $module === $navbar_selected ? 'bg-[#F3F4F6] text-blue-900 font-medium rounded-1 back' : 'hover:text-[#F6D400]' }}">
          <span class="edge"></span>
          <svg class="w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            @switch($module)
              @case('Dashboard')
                <path fill-rule="evenodd" d="M3 6a3 3 0 0 1 3-3h12a3 3 0 0 1 3 3v12a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm4.5 7.5a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-1.5 0v-2.25a.75.75 0 0 1 .75-.75Zm3.75-1.5a.75.75 0 0 0-1.5 0v4.5a.75.75 0 0 0 1.5 0V12Zm2.25-3a.75.75 0 0 1 .75.75v6.75a.75.75 0 0 1-1.5 0V9.75A.75.75 0 0 1 13.5 9Zm3.75-1.5a.75.75 0 0 0-1.5 0v9a.75.75 0 0 0 1.5 0v-9Z" clip-rule="evenodd" />
                @break
              @case('Employee Management')
                <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                @break
              @case('RBAC Management')
                <path d="M4.5 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0ZM14.25 8.625a3.375 3.375 0 1 1 6.75 0 3.375 3.375 0 0 1-6.75 0ZM1.5 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122Z" />
                @break
              @case('Modules')
                <path d="M6 3a3 3 0 0 0-3 3v2.25a3 3 0 0 0 3 3h2.25a3 3 0 0 0 3-3V6a3 3 0 0 0-3-3H6ZM15.75 3a3 3 0 0 0-3 3v2.25a3 3 0 0 0 3 3H18a3 3 0 0 0 3-3V6a3 3 0 0 0-3-3h-2.25Z" />
                @break
              @case('CRM')
                <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z" clip-rule="evenodd" />
                <path d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                @break
              @case('Asset Management')
                <path fill-rule="evenodd" d="M2.25 5.25a3 3 0 0 1 3-3h13.5a3 3 0 0 1 3 3V15a3 3 0 0 1-3 3h-3v.257c0 .597.237 1.17.659 1.591l.621.622a.75.75 0 0 1-.53 1.28h-9a.75.75 0 0 1-.53-1.28l.621-.622a2.25 2.25 0 0 0 .659-1.59V18h-3a3 3 0 0 1-3-3V5.25Zm1.5 0v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5Z" clip-rule="evenodd" />
              @break
              @case('CMS')
                <path fill-rule="evenodd" d="M5.25 2.25a3 3 0 0 0-3 3v4.318a3 3 0 0 0 .879 2.121l9.58 9.581c.92.92 2.39 1.186 3.548.428a18.849 18.849 0 0 0 5.441-5.44c.758-1.16.492-2.629-.428-3.548l-9.58-9.581a3 3 0 0 0-2.122-.879H5.25ZM6.375 7.5a1.125 1.125 0 1 0 0-2.25 1.125 1.125 0 0 0 0 2.25Z" clip-rule="evenodd" />
              @break
            @endswitch
          </svg>
          <a href="{{ $links[$module] }}">{{ $module }}</a>
        </div>
      @endif
    @endforeach
  </div>

  <div class="items-end w-full h-full flex">
            <livewire:clock />
  </div>


  {{-- <div class="mt-auto w-full px-4 pb-6">
    <div class="flex flex-col gap-4">
      <div>
        <a href="{{ route('profile.edit') }}" class="hover:underline font-medium">
          {{ $user->employee->employee_firstname }} {{ $user->employee->employee_lastname }}
        </a>
        <span class="text-sm block">{{ $user->roles->first()->role_name ?? 'No Role Assigned' }}</span>
      </div>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="bg-red-600 hover:bg-red-700 text-white font-medium uppercase px-3 py-2 rounded text-xs" type="submit">Logout</button>
      </form>
    </div>
  </div> --}}
  
</div>

<script>
  function menuToggle() {
    const menu = document.getElementById("menu");
    if (menu.classList.contains("hidden")) {
      menu.classList.remove("hidden");
      menu.classList.add("flex");
    } else {
      menu.classList.remove("flex");
      menu.classList.add("hidden");
    }
  }
</script>


  {{-- <div class="h-dvh fixed top-0 w-64 flex flex-col items-center gap-5 bg-gradient-to-r from-blue-800 to-indigo-900 p-6 font-sans shadow-md">
    
    <div class=" flex w-40 items-center justify-center">
      <a href="https://ibb.co/3m6zQj6d"> 
        <img src="{{ asset('storage/'.$user->organization->org_logo) }}" alt="aap-logo" class="max-w-full h-auto" />
    </a>
    </div>

    <div class="space-y-2">
      @if(in_array('Dashboard', $modules_access))
          < class="flex items-center text-white rounded-md">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
              <path fill-rule="evenodd" d="M3 6a3 3 0 0 1 3-3h12a3 3 0 0 1 3 3v12a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm4.5 7.5a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-1.5 0v-2.25a.75.75 0 0 1 .75-.75Zm3.75-1.5a.75.75 0 0 0-1.5 0v4.5a.75.75 0 0 0 1.5 0V12Zm2.25-3a.75.75 0 0 1 .75.75v6.75a.75.75 0 0 1-1.5 0V9.75A.75.75 0 0 1 13.5 9Zm3.75-1.5a.75.75 0 0 0-1.5 0v9a.75.75 0 0 0 1.5 0v-9Z" clip-rule="evenodd" />
            </svg>
            <a href="/dashboard" class="pl-3">Dashboard</a>
          </>
      @endif

      @if(in_array('Roles Management', $modules_access))
        < class="flex items-center text-white rounded-md">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
            <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
          </svg>
          <a href="/role" class="pl-3">Roles Management</a>
        </>
      @endif

      @if(in_array('RBAC Management', $modules_access))
        <div class="flex items-center text-white rounded-md bg-purple-500 w-full ">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
            <path d="M4.5 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0ZM14.25 8.625a3.375 3.375 0 1 1 6.75 0 3.375 3.375 0 0 1-6.75 0ZM1.5 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122ZM17.25 19.128l-.001.144a2.25 2.25 0 0 1-.233.96 10.088 10.088 0 0 0 5.06-1.01.75.75 0 0 0 .42-.643 4.875 4.875 0 0 0-6.957-4.611 8.586 8.586 0 0 1 1.71 5.157v.003Z" />
          </svg>
          
          <a href="/user" class="pl-3">RBAC Management</a>
        </div>
        @endif
        @if(in_array('Modules', $modules_access))
        <div class="flex items-center text-white rounded-md">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
            <path d="M6 3a3 3 0 0 0-3 3v2.25a3 3 0 0 0 3 3h2.25a3 3 0 0 0 3-3V6a3 3 0 0 0-3-3H6ZM15.75 3a3 3 0 0 0-3 3v2.25a3 3 0 0 0 3 3H18a3 3 0 0 0 3-3V6a3 3 0 0 0-3-3h-2.25ZM6 12.75a3 3 0 0 0-3 3V18a3 3 0 0 0 3 3h2.25a3 3 0 0 0 3-3v-2.25a3 3 0 0 0-3-3H6ZM17.625 13.5a.75.75 0 0 0-1.5 0v2.625H13.5a.75.75 0 0 0 0 1.5h2.625v2.625a.75.75 0 0 0 1.5 0v-2.625h2.625a.75.75 0 0 0 0-1.5h-2.625V13.5Z" />
          </svg>
                
          <a href="/module" class="pl-3">Modules</a>
        </div>
        @endif
        @if(in_array('Employee Management', $modules_access))
        <div class="flex items-center text-white rounded-md">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
            <path fill-rule="evenodd" d="M4.5 3.75a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3V6.75a3 3 0 0 0-3-3h-15Zm4.125 3a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5Zm-3.873 8.703a4.126 4.126 0 0 1 7.746 0 .75.75 0 0 1-.351.92 7.47 7.47 0 0 1-3.522.877 7.47 7.47 0 0 1-3.522-.877.75.75 0 0 1-.351-.92ZM15 8.25a.75.75 0 0 0 0 1.5h3.75a.75.75 0 0 0 0-1.5H15ZM14.25 12a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H15a.75.75 0 0 1-.75-.75Zm.75 2.25a.75.75 0 0 0 0 1.5h3.75a.75.75 0 0 0 0-1.5H15Z" clip-rule="evenodd" />
          </svg>   
          <a href="/employee" class="pl-3">Employee Management</a>
        </div>
        @endif
        @if(in_array('Permissions', $modules_access))
        <div class="flex items-center text-white rounded-md">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
            <path fill-rule="evenodd" d="M15.75 1.5a6.75 6.75 0 0 0-6.651 7.906c.067.39-.032.717-.221.906l-6.5 6.499a3 3 0 0 0-.878 2.121v2.818c0 .414.336.75.75.75H6a.75.75 0 0 0 .75-.75v-1.5h1.5A.75.75 0 0 0 9 19.5V18h1.5a.75.75 0 0 0 .53-.22l2.658-2.658c.19-.189.517-.288.906-.22A6.75 6.75 0 1 0 15.75 1.5Zm0 3a.75.75 0 0 0 0 1.5A2.25 2.25 0 0 1 18 8.25a.75.75 0 0 0 1.5 0 3.75 3.75 0 0 0-3.75-3.75Z" clip-rule="evenodd" />
          </svg>
          
          <a href="/permission" class="pl-3">Permissions</a>
        </div>
        @endif

      </div>

    <div class="absolute bottom-0 left-0 px-6 py-10 text-white">
      <div class="flex flex-col gap-6 justify-between">
        <div class="flex flex-col">
          <a href="{{ route('profile.edit') }}" class="hover:underline font-medium">
            {{ $user->employee->employee_firstname }} {{ $user->employee->employee_lastname }}
          </a>
          <span class="text-sm">{{ $user->roles->first()->role_name ?? 'No Role Assigned' }}</span>
        </div>
        <form method="POST" action="{{ route('logout') }}" class="inline">
          @csrf
          <button class="bg-red-600 hover:bg-red-700 text-white font-medium uppercase px-3 py-2 rounded-md text-xs" type="submit">Logout</button>
        </form>
      </div>
    </div>
  </div> --}}