<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('System Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Display Success Message --}}
                    @if (session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Success!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    {{-- Display Validation Errors --}}
                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Validation Error!</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Logo Section --}}
                            <div class="col-span-1 md:col-span-2">
                                <h3 class="text-lg font-semibold text-bayswater-blue mb-4">Company Logo</h3>
                                <div class="flex items-start space-x-6">
                                    <div class="w-40 h-40 bg-gray-100 flex items-center justify-center rounded border">
                                        @if($settings->logo_path)
                                            <img src="{{ asset('storage/' . $settings->logo_path) }}" alt="Company Logo" class="max-w-full max-h-full p-2">
                                        @else
                                            <div class="text-gray-400 text-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                <p class="text-sm">No logo uploaded</p>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <label for="logo" class="block text-sm font-medium text-gray-700">Upload Logo</label>
                                        <p class="text-xs text-gray-500 mb-2">Recommended size: 200x80px. Max file size: 2MB.</p>
                                        <input type="file" id="logo" name="logo" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-bayswater-blue file:text-white hover:file:bg-bayswater-blue-dark">
                                        
                                        @if($settings->logo_path)
                                            <div class="mt-2">
                                                <a href="{{ route('admin.settings.remove-logo') }}" class="text-red-600 hover:text-red-800 text-sm" onclick="return confirm('Are you sure you want to remove the logo?')">Remove Logo</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- Company Information --}}
                            <div>
                                <h3 class="text-lg font-semibold text-bayswater-blue mb-4">Company Information</h3>
                                
                                <div class="mb-4">
                                    <x-input-label for="company_name" :value="__('Company Name')" />
                                    <x-text-input id="company_name" class="block mt-1 w-full" type="text" name="company_name" :value="old('company_name', $settings->company_name)" />
                                    <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
                                </div>
                                
                                <div class="mb-4">
                                    <x-input-label for="company_email" :value="__('Company Email')" />
                                    <x-text-input id="company_email" class="block mt-1 w-full" type="email" name="company_email" :value="old('company_email', $settings->company_email)" />
                                    <x-input-error :messages="$errors->get('company_email')" class="mt-2" />
                                </div>
                                
                                <div class="mb-4">
                                    <x-input-label for="company_phone" :value="__('Company Phone')" />
                                    <x-text-input id="company_phone" class="block mt-1 w-full" type="text" name="company_phone" :value="old('company_phone', $settings->company_phone)" />
                                    <x-input-error :messages="$errors->get('company_phone')" class="mt-2" />
                                </div>
                            </div>
                            
                            <div>
                                <h3 class="text-lg font-semibold text-bayswater-blue mb-4">Address</h3>
                                
                                <div class="mb-4">
                                    <x-input-label for="company_address" :value="__('Company Address')" />
                                    <textarea id="company_address" name="company_address" rows="5" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('company_address', $settings->company_address) }}</textarea>
                                    <x-input-error :messages="$errors->get('company_address')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>
                                {{ __('Save Settings') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
