<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Bayswater') }}</title>

        <!-- Favicon -->
        <link rel="icon" href="{{ asset('images/bayswater-leaf-icon.svg') }}" type="image/svg+xml">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('build/assets/app-BykFQO7u.css') }}">
        <link rel="stylesheet" href="{{ asset('build/assets/app-CksuuEqD.css') }}">
        <link rel="stylesheet" href="{{ asset('css/bayswater-styles.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('build/assets/app-CZ6VcyOX.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased text-bayswater-gray">
        {{-- Use Bayswater light background --}}
        <div class="min-h-screen bg-bayswater-gray-light flex">
            {{-- Include Sidebar --}}
            @include('layouts.sidebar')

            {{-- Main Content Area --}}
            <div id="main-content" class="flex-1 flex flex-col ml-64"> {{-- Added ml-64 for sidebar width --}}

                {{-- Bayswater Top Bar --}}
                <nav class="bg-bayswater-blue border-b border-bayswater-blue-dark">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="flex justify-between h-16">
                             {{-- Hamburger Menu Toggle --}}
                             <div class="flex items-center">
                                 <button id="sidebar-toggle" class="p-2 text-white focus:outline-none relative z-50">
                                     <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                     </svg>
                                 </button>
                             </div>

                             <!-- Empty space or other top-bar elements -->
                             <div class="flex-1"></div>

                             <!-- Settings Dropdown -->
                             <div class="hidden sm:flex sm:items-center sm:ms-6">
                                 <div class="flex items-center space-x-4">
                                     <a href="#" class="text-white hover:text-bayswater-yellow transition-colors duration-300">
                                         <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                         </svg>
                                     </a>
                                     <a href="#" class="text-white hover:text-bayswater-yellow transition-colors duration-300">
                                         <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                         </svg>
                                     </a>
                                 </div>
                             </div>
                        </div>
                    </div>
                </nav>

                <!-- Page Heading -->
                @isset($header)
                <header class="bg-bayswater-blue shadow">
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

                <!-- Page Content -->
                <main class="flex-1 overflow-y-auto bg-gray-100"> {{-- Added overflow-y-auto and bg-gray-100 --}}
                    {{ $slot }}
                </main>

            </div> {{-- End Main Content Area --}}
        </div>


        {{-- Sidebar Toggle Script --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const sidebar = document.getElementById('sidebar');
                const toggleButton = document.getElementById('sidebar-toggle');

                // Function to toggle sidebar
                function toggleSidebar() {
                    sidebar.classList.toggle('-translate-x-full');
                }

                // Toggle sidebar when button is clicked
                toggleButton.addEventListener('click', function() {
                    toggleSidebar();
                });
            });
        </script>

        @stack('scripts') {{-- Add stack for scripts pushed from views --}}
    </body>
</html>
