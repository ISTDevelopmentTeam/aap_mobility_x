@props(['module'])

<!DOCTYPE html>
{{-- The color design so far is "light themed", 
    change this if changes to the design will be made. 
--}}
<html data-theme="light" lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>AAP Mobility X</title>
        @include('layouts.icons')
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
        @livewireStyles
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <!-- Tom Select CSS -->
        <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">

        <style>
            [x-cloak] {
                display: none !important;
            }

            body {
                touch-action: manipulation;
                /* Prevents double-tap zoom */
            }

            /* For older browsers */
            * {
                -ms-touch-action: manipulation;
                touch-action: manipulation;
            }
        </style>

        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
    </head>

    {{-- <body class="{{ $class }}" x-data='@json($x_data)'> --}}
    <body>
        <x-sidebar :$module />
        <div class="flex flex-col w-full gap-5 bg-[#f3f4f6] xs:w-full sm:w-full">
            <x-layouts.header/>
            
            <div class="flex flex-1 flex-col lg:ml-52 mt-12 overflow-y-auto py-10 px-5 lg:p-10 gap-7 bg-[#f3f4f6]">
                <x-navigation-bar :$module />
                
                {{ $slot }}  
            </div>          
        </div>
        @livewireScripts
    </body>
</html>
