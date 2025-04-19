<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Accommodation') }}: {{ $accommodation->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            {{-- Accommodation Details Form --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                     <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100 mb-4">Accommodation Details</h3>
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

                    <form method="POST" action="{{ route('admin.accommodations.update', $accommodation) }}">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Name --}}
                            <div class="md:col-span-2">
                                <x-input-label for="name" :value="__('Accommodation Name')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $accommodation->name)" required autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            {{-- School Selection --}}
                            <div>
                                <x-input-label for="school_id" :value="__('School')" />
                                <select name="school_id" id="school_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                    <option value="">-- Select School --</option>
                                    @foreach($schools as $id => $name)
                                        <option value="{{ $id }}" {{ old('school_id', $accommodation->school_id) == $id ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('school_id')" class="mt-2" />
                            </div>

                            {{-- Type --}}
                            <div>
                                <x-input-label for="type" :value="__('Type (e.g., Homestay, Residence)')" />
                                <x-text-input id="type" class="block mt-1 w-full" type="text" name="type" :value="old('type', $accommodation->type)" />
                                <x-input-error :messages="$errors->get('type')" class="mt-2" />
                            </div>

                            {{-- Room Type --}}
                            <div>
                                <x-input-label for="room_type" :value="__('Room Type (e.g., Single, Twin)')" />
                                <x-text-input id="room_type" class="block mt-1 w-full" type="text" name="room_type" :value="old('room_type', $accommodation->room_type)" />
                                <x-input-error :messages="$errors->get('room_type')" class="mt-2" />
                            </div>

                            {{-- Meal Plan --}}
                            <div>
                                <x-input-label for="meal_plan" :value="__('Meal Plan (e.g., Half Board, None)')" />
                                <x-text-input id="meal_plan" class="block mt-1 w-full" type="text" name="meal_plan" :value="old('meal_plan', $accommodation->meal_plan)" />
                                <x-input-error :messages="$errors->get('meal_plan')" class="mt-2" />
                            </div>

                             {{-- Min Age --}}
                             <div>
                                 <x-input-label for="min_age" :value="__('Min Age (Optional)')" />
                                 <x-text-input id="min_age" class="block mt-1 w-full" type="number" step="1" min="0" name="min_age" :value="old('min_age', $accommodation->min_age)" />
                                 <x-input-error :messages="$errors->get('min_age')" class="mt-2" />
                             </div>

                             {{-- Max Age --}}
                             <div>
                                 <x-input-label for="max_age" :value="__('Max Age (Optional)')" />
                                 <x-text-input id="max_age" class="block mt-1 w-full" type="number" step="1" min="0" name="max_age" :value="old('max_age', $accommodation->max_age)" />
                                 <x-input-error :messages="$errors->get('max_age')" class="mt-2" />
                             </div>

                            {{-- Description --}}
                            <div class="md:col-span-2">
                                <x-input-label for="description" :value="__('Description (Optional)')" />
                                <textarea id="description" name="description" rows="3" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('description', $accommodation->description) }}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>

                             {{-- Seasonal Fees Section --}}
                             <div class="md:col-span-2 mt-4 border-t pt-4 border-gray-200 dark:border-gray-700">
                                 <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100">Seasonal Fees / Requirements</h3>
                             </div>

                             {{-- Summer Fee Per Week --}}
                             <div>
                                 <x-input-label for="summer_fee_per_week" :value="__('Summer Supplement (Per Week)')" />
                                 <x-text-input id="summer_fee_per_week" class="block mt-1 w-full" type="number" step="0.01" name="summer_fee_per_week" :value="old('summer_fee_per_week', $accommodation->summer_fee_per_week)" />
                                 <x-input-error :messages="$errors->get('summer_fee_per_week')" class="mt-2" />
                             </div>
                             <div class="md:col-span-1"></div> {{-- Spacer --}}
                             {{-- Summer Start Date --}}
                             <div>
                                 <x-input-label for="summer_start_date" :value="__('Summer Supplement Start Date')" />
                                 <x-text-input id="summer_start_date" class="block mt-1 w-full" type="date" name="summer_start_date" :value="old('summer_start_date', $accommodation->summer_start_date ? $accommodation->summer_start_date->format('Y-m-d') : '')" />
                                 <x-input-error :messages="$errors->get('summer_start_date')" class="mt-2" />
                             </div>
                             {{-- Summer End Date --}}
                             <div>
                                 <x-input-label for="summer_end_date" :value="__('Summer Supplement End Date')" />
                                 <x-text-input id="summer_end_date" class="block mt-1 w-full" type="date" name="summer_end_date" :value="old('summer_end_date', $accommodation->summer_end_date ? $accommodation->summer_end_date->format('Y-m-d') : '')" />
                                 <x-input-error :messages="$errors->get('summer_end_date')" class="mt-2" />
                             </div>
                             {{-- Summer Fee Note --}}
                             <div class="md:col-span-2">
                                 <x-input-label for="summer_fee_note" :value="__('Summer Supplement Note')" />
                                 <x-text-input id="summer_fee_note" class="block mt-1 w-full" type="text" name="summer_fee_note" :value="old('summer_fee_note', $accommodation->summer_fee_note)" />
                                 <x-input-error :messages="$errors->get('summer_fee_note')" class="mt-2" />
                             </div>

                             {{-- Requires Guardianship Checkbox --}}
                             <div class="block mt-4 md:col-span-1">
                                 <label for="requires_guardianship" class="inline-flex items-center">
                                     <input id="requires_guardianship" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="requires_guardianship" value="1" {{ old('requires_guardianship', $accommodation->requires_guardianship) ? 'checked' : '' }}>
                                     <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Requires Guardianship (U18)') }}</span>
                                 </label>
                                  <x-input-error :messages="$errors->get('requires_guardianship')" class="mt-2" />
                             </div>

                             {{-- Requires Christmas Supplement Checkbox --}}
                             <div class="block mt-4 md:col-span-1">
                                 <label for="requires_christmas_supplement" class="inline-flex items-center">
                                     <input id="requires_christmas_supplement" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="requires_christmas_supplement" value="1" {{ old('requires_christmas_supplement', $accommodation->requires_christmas_supplement) ? 'checked' : '' }}>
                                     <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Applies Christmas Supplement') }}</span>
                                 </label>
                                  <x-input-error :messages="$errors->get('requires_christmas_supplement')" class="mt-2" />
                             </div>

                        </div> {{-- End Grid --}}

                        {{-- Active Checkbox --}}
                        <div class="block mt-6 border-t pt-4 border-gray-200 dark:border-gray-700">
                            <label for="active" class="inline-flex items-center">
                                <input id="active" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="active" value="1" {{ old('active', $accommodation->active) ? 'checked' : '' }}>
                                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Active') }}</span>
                            </label>
                             <x-input-error :messages="$errors->get('active')" class="mt-2" />
                        </div>


                        <div class="flex items-center justify-end mt-6">
                             <a href="{{ route('admin.accommodations.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 mr-4">
                                {{ __('Cancel') }}
                            </a>

                            <x-primary-button>
                                {{ __('Update Accommodation') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

             {{-- Accommodation Prices Section --}}
             <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                 <div class="p-6 text-gray-900 dark:text-gray-100">
                     <div class="flex justify-between items-center mb-4">
                         <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100">Weekly Prices</h3>
                         {{-- Use correct route name 'admin.accommodations.prices.create' --}}
                         <a href="{{ route('admin.accommodations.prices.create', $accommodation) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                             {{ __('Add Price Tier') }}
                         </a>
                     </div>
                     {{-- Include the partial view, passing both the prices and the parent accommodation --}}
                     @include('admin.accommodation_prices._index_table', [
                         'accommodationPrices' => $accommodation->accommodationPrices,
                         'accommodation' => $accommodation
                     ])
                 </div>
             </div>

        </div>
    </div>
</x-app-layout>
