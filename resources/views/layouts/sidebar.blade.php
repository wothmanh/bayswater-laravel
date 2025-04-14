{{-- Vertical Sidebar Navigation --}}
<div id="sidebar" class="w-64 h-screen fixed top-0 left-0 bg-bayswater-blue text-gray-100 flex flex-col shadow-lg overflow-auto transition-all duration-300 transform z-50"> {{-- Use Primary Dark Blue --}}
    {{-- Logo/Brand --}}
    <div class="h-16 flex items-center justify-center bg-bayswater-blue-dark"> {{-- Use Darker Shade --}}
        <a href="{{ route('dashboard') }}" class="flex items-center justify-center">
            <x-application-logo class="h-10 w-auto" />
        </a>
    </div>

    {{-- User Info --}}
    <div class="p-4 border-b border-bayswater-blue-dark"> {{-- Subtle border --}}
         {{-- Placeholder - Replace with dynamic user data --}}
        <div class="flex items-center">
            {{-- User Avatar with Bayswater colors --}}
            <div class="w-10 h-10 rounded-full bg-bayswater-orange mr-3 flex items-center justify-center text-white font-bold">
                {{-- Initials Placeholder --}}
                {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
            </div>
            <div>
                <div class="font-semibold text-white">{{ Auth::user()->name ?? 'Admin User' }}</div>
                <div class="text-xs text-bayswater-yellow flex items-center">
                    <span class="w-2 h-2 bg-bayswater-yellow rounded-full mr-1"></span> Online
                </div>
            </div>
        </div>
    </div>

    {{-- Navigation Links --}}
    <nav class="flex-1 overflow-y-auto py-4 space-y-1">
        {{-- Use custom Bayswater blue for hover/active states, ensure text is light --}}
        <a href="{{ route('admin.settings.edit') }}" class="flex items-center px-4 py-2 text-sm font-medium rounded-md hover:bg-bayswater-blue-dark {{ request()->routeIs('admin.settings.*') ? 'bg-bayswater-blue-dark text-white' : 'text-gray-100 hover:text-white' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span class="nav-text">System Settings</span>
        </a>

        <a href="{{ route('admin.quotations.create') }}" class="flex items-center px-4 py-2 text-sm font-medium rounded-md hover:bg-bayswater-blue-dark {{ request()->routeIs('admin.quotations.*') ? 'bg-bayswater-blue-dark text-white' : 'text-gray-100 hover:text-white' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
            </svg>
            <span class="nav-text">Fees Calculator</span>
        </a>

        {{-- Placeholder Links based on screenshot (Update hrefs when implemented) --}}
        {{-- <a href="#" class="flex items-center px-4 py-2 text-sm font-medium rounded-md hover:bg-gray-700"> <span class="ml-3">Admins</span> </a> --}}
        {{-- <a href="#" class="flex items-center px-4 py-2 text-sm font-medium rounded-md hover:bg-gray-700"> <span class="ml-3">Clients</span> </a> --}}
        {{-- <a href="#" class="flex items-center px-4 py-2 text-sm font-medium rounded-md hover:bg-gray-700"> <span class="ml-3">Notes</span> </a> --}}
        {{-- <a href="#" class="flex items-center px-4 py-2 text-sm font-medium rounded-md hover:bg-gray-700"> <span class="ml-3">Regions</span> </a> --}}

        {{-- <a href="#" class="flex items-center px-4 py-2 text-sm font-medium rounded-md hover:bg-blue-700 text-gray-200 hover:text-white"> <span class="ml-3">Admins</span> </a> --}}
        {{-- <a href="#" class="flex items-center px-4 py-2 text-sm font-medium rounded-md hover:bg-blue-700 text-gray-200 hover:text-white"> <span class="ml-3">Clients</span> </a> --}}
        {{-- <a href="#" class="flex items-center px-4 py-2 text-sm font-medium rounded-md hover:bg-blue-700 text-gray-200 hover:text-white"> <span class="ml-3">Notes</span> </a> --}}
        <a href="{{ route('admin.regions.index') }}" class="flex items-center px-4 py-2 text-sm font-medium rounded-md hover:bg-bayswater-blue-dark {{ request()->routeIs('admin.regions.*') ? 'bg-bayswater-blue-dark text-white' : 'text-gray-200 hover:text-white' }}">
             <span class="ml-3 nav-text">Regions</span>
        </a>

        {{-- Links for implemented CRUDs --}}
        <a href="{{ route('admin.countries.index') }}" class="flex items-center px-4 py-2 text-sm font-medium rounded-md hover:bg-bayswater-blue-dark {{ request()->routeIs('admin.countries.*') ? 'bg-bayswater-blue-dark text-white' : 'text-gray-100 hover:text-white' }}">
             <span class="w-6 h-6 mr-3"></span> {{-- Icon Placeholder --}}
             <span class="nav-text">Countries</span>
        </a>
        <a href="{{ route('admin.cities.index') }}" class="flex items-center px-4 py-2 text-sm font-medium rounded-md hover:bg-bayswater-blue-dark {{ request()->routeIs('admin.cities.*') ? 'bg-bayswater-blue-dark text-white' : 'text-gray-100 hover:text-white' }}">
             <span class="w-6 h-6 mr-3"></span> {{-- Icon Placeholder --}}
             <span class="nav-text">Cities</span>
        </a>
         <a href="{{ route('admin.schools.index') }}" class="flex items-center px-4 py-2 text-sm font-medium rounded-md hover:bg-bayswater-blue-dark {{ request()->routeIs('admin.schools.*') ? 'bg-bayswater-blue-dark text-white' : 'text-gray-100 hover:text-white' }}">
             <span class="w-6 h-6 mr-3"></span> {{-- Icon Placeholder --}}
             <span>Schools</span>
        </a>
        <a href="{{ route('admin.airports.index') }}" class="flex items-center px-4 py-2 text-sm font-medium rounded-md hover:bg-bayswater-blue-dark {{ request()->routeIs('admin.airports.*') ? 'bg-bayswater-blue-dark text-white' : 'text-gray-100 hover:text-white' }}">
            <span class="w-6 h-6 mr-3"></span> {{-- Icon Placeholder --}}
            <span class="nav-text">Airports</span>
       </a>
         <a href="{{ route('admin.courses.index') }}" class="flex items-center px-4 py-2 text-sm font-medium rounded-md hover:bg-bayswater-blue-dark {{ request()->routeIs('admin.courses.*') || request()->routeIs('admin.prices.*') || request()->routeIs('admin.schedules.*') ? 'bg-bayswater-blue-dark text-white' : 'text-gray-100 hover:text-white' }}">
             <span class="w-6 h-6 mr-3"></span> {{-- Icon Placeholder --}}
             <span>Courses</span>
        </a>
         <a href="{{ route('admin.accommodations.index') }}" class="flex items-center px-4 py-2 text-sm font-medium rounded-md hover:bg-bayswater-blue-dark {{ request()->routeIs('admin.accommodations.*') || request()->routeIs('admin.accommodation-prices.*') ? 'bg-bayswater-blue-dark text-white' : 'text-gray-100 hover:text-white' }}">
             <span class="w-6 h-6 mr-3"></span> {{-- Icon Placeholder --}}
             <span>Accommodation</span>
        </a>
         <a href="{{ route('admin.currencies.index') }}" class="flex items-center px-4 py-2 text-sm font-medium rounded-md hover:bg-bayswater-blue-dark {{ request()->routeIs('admin.currencies.*') ? 'bg-bayswater-blue-dark text-white' : 'text-gray-100 hover:text-white' }}">
             <span class="w-6 h-6 mr-3"></span> {{-- Icon Placeholder --}}
             <span>Currency</span>
        </a>
         <a href="{{ route('admin.addons.index') }}" class="flex items-center px-4 py-2 text-sm font-medium rounded-md hover:bg-bayswater-blue-dark {{ request()->routeIs('admin.addons.*') ? 'bg-bayswater-blue-dark text-white' : 'text-gray-100 hover:text-white' }}">
             <span class="w-6 h-6 mr-3"></span> {{-- Icon Placeholder --}}
             <span>Addons</span>
        </a>
         <a href="{{ route('admin.discount-rules.index') }}" class="flex items-center px-4 py-2 text-sm font-medium rounded-md hover:bg-bayswater-blue-dark {{ request()->routeIs('admin.discount-rules.*') ? 'bg-bayswater-blue-dark text-white' : 'text-gray-100 hover:text-white' }}">
             <span class="w-6 h-6 mr-3"></span> {{-- Icon Placeholder --}}
             <span>Discounts</span>
        </a>
         <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-2 text-sm font-medium rounded-md hover:bg-bayswater-blue-dark {{ request()->routeIs('admin.users.*') ? 'bg-bayswater-blue-dark text-white' : 'text-gray-100 hover:text-white' }}">
             <span class="w-6 h-6 mr-3"></span> {{-- Icon Placeholder --}}
             <span>Users</span>
        </a>

        {{-- Placeholder Links based on screenshot (Update hrefs when implemented) --}}
        {{-- <a href="#" class="flex items-center px-4 py-2 text-sm font-medium rounded-md hover:bg-gray-700"> <span class="ml-3">Branches</span> </a> --}}

    </nav>

    {{-- Footer/Logout Section --}}
    <div class="mt-auto p-4 border-t border-bayswater-blue-dark">
        <div class="flex justify-between items-center">
            <a href="{{ route('profile.edit') }}" class="flex items-center text-sm font-medium text-gray-100 hover:text-bayswater-yellow transition duration-150 ease-in-out">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                {{ __('Profile') }}
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center text-sm font-medium text-gray-100 hover:text-bayswater-yellow transition duration-150 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>

</div>
