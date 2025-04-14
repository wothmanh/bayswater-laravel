<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Discount Rule') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
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

                    <form method="POST" action="{{ route('admin.discount-rules.store') }}">
                        @csrf

                        {{-- Rule Details --}}
                        <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100 mb-4">Rule Details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            {{-- Name --}}
                            <div class="md:col-span-2">
                                <x-input-label for="name" :value="__('Rule Name')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            {{-- Description --}}
                            <div class="md:col-span-2">
                                <x-input-label for="description" :value="__('Description (Optional)')" />
                                <textarea id="description" name="description" rows="2" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('description') }}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                             {{-- Priority --}}
                             <div>
                                 <x-input-label for="priority" :value="__('Priority (Lower number applied first)')" />
                                 <x-text-input id="priority" class="block mt-1 w-full" type="number" step="1" name="priority" :value="old('priority', 0)" required />
                                 <x-input-error :messages="$errors->get('priority')" class="mt-2" />
                             </div>
                             {{-- Combinable --}}
                             <div class="flex items-center mt-6">
                                 <label for="combinable" class="inline-flex items-center">
                                     <input id="combinable" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="combinable" value="1" {{ old('combinable') ? 'checked' : '' }}>
                                     <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Combinable with other discounts?') }}</span>
                                 </label>
                                  <x-input-error :messages="$errors->get('combinable')" class="mt-2" />
                             </div>
                        </div>

                        {{-- Discount Effect --}}
                        <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100 mb-4 border-t pt-4 border-gray-200 dark:border-gray-700">Discount Effect</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                             {{-- Discount Type --}}
                             <div>
                                 <x-input-label for="discount_type" :value="__('Discount Type')" />
                                 <select name="discount_type" id="discount_type" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                     <option value="">-- Select Type --</option>
                                     @foreach($discountTypes as $key => $label)
                                         <option value="{{ $key }}" {{ old('discount_type') == $key ? 'selected' : '' }}>{{ $label }}</option>
                                     @endforeach
                                 </select>
                                 <x-input-error :messages="$errors->get('discount_type')" class="mt-2" />
                             </div>
                             {{-- Discount Value --}}
                             <div>
                                 <x-input-label for="discount_value" :value="__('Value (%, Amount, or N/A for Waiver)')" />
                                 <x-text-input id="discount_value" class="block mt-1 w-full" type="number" step="0.01" name="discount_value" :value="old('discount_value')" />
                                 <x-input-error :messages="$errors->get('discount_value')" class="mt-2" />
                             </div>
                             {{-- Applies To --}}
                             <div>
                                 <x-input-label for="applies_to" :value="__('Applies To')" />
                                 <select name="applies_to" id="applies_to" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                     <option value="">-- Select Target --</option>
                                     @foreach($appliesToOptions as $key => $label)
                                         <option value="{{ $key }}" {{ old('applies_to') == $key ? 'selected' : '' }}>{{ $label }}</option>
                                     @endforeach
                                 </select>
                                 <x-input-error :messages="$errors->get('applies_to')" class="mt-2" />
                             </div>
                             {{-- Specific Addon (Conditional) --}}
                             <div id="addon_select_div" style="{{ old('applies_to') == 'addon' ? '' : 'display: none;' }}">
                                 <x-input-label for="addon_id" :value="__('Specific Addon')" />
                                 <select name="addon_id" id="addon_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                     <option value="">-- Select Addon --</option>
                                     @foreach($addons as $id => $name)
                                         <option value="{{ $id }}" {{ old('addon_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                     @endforeach
                                 </select>
                                 <x-input-error :messages="$errors->get('addon_id')" class="mt-2" />
                             </div>
                        </div>

                        {{-- Conditions --}}
                        <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100 mb-4 border-t pt-4 border-gray-200 dark:border-gray-700">Conditions (Optional - Leave blank if not applicable)</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                             {{-- Region --}}
                             <div>
                                 <x-input-label for="region_id" :value="__('Specific Region')" />
                                 <select name="region_id" id="region_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                     <option value="">-- Any Region --</option>
                                     @foreach($regions as $id => $name) {{-- Assuming $regions is passed --}}
                                         <option value="{{ $id }}" {{ old('region_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                     @endforeach
                                 </select>
                                 <x-input-error :messages="$errors->get('region_id')" class="mt-2" />
                             </div>
                             {{-- School --}}
                             <div>
                                 <x-input-label for="school_id" :value="__('Specific School')" />
                                 <select name="school_id" id="school_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                     <option value="">-- Any School --</option>
                                     @foreach($schools as $id => $name)
                                         <option value="{{ $id }}" {{ old('school_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                     @endforeach
                                 </select>
                                 <x-input-error :messages="$errors->get('school_id')" class="mt-2" />
                             </div>
                             {{-- Country --}}
                             <div>
                                 <x-input-label for="country_id" :value="__('Specific Nationality')" />
                                 <select name="country_id" id="country_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                     <option value="">-- Any Nationality --</option>
                                     @foreach($countries as $id => $name)
                                         <option value="{{ $id }}" {{ old('country_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                     @endforeach
                                 </select>
                                 <x-input-error :messages="$errors->get('country_id')" class="mt-2" />
                             </div>
                             {{-- Course --}}
                             <div>
                                 <x-input-label for="course_id" :value="__('Specific Course')" />
                                 <select name="course_id" id="course_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                     <option value="">-- Any Course --</option>
                                     @foreach($courses as $id => $name)
                                         <option value="{{ $id }}" {{ old('course_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                     @endforeach
                                 </select>
                                 <x-input-error :messages="$errors->get('course_id')" class="mt-2" />
                             </div>
                             {{-- Course Type --}}
                             <div>
                                 <x-input-label for="course_type_id" :value="__('Specific Course Type')" />
                                 <select name="course_type_id" id="course_type_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                     <option value="">-- Any Course Type --</option>
                                     @foreach($courseTypes as $id => $name)
                                         <option value="{{ $id }}" {{ old('course_type_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                     @endforeach
                                 </select>
                                 <x-input-error :messages="$errors->get('course_type_id')" class="mt-2" />
                             </div>
                             {{-- Accommodation --}}
                             <div>
                                 <x-input-label for="accommodation_id" :value="__('Specific Accommodation')" />
                                 <select name="accommodation_id" id="accommodation_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                     <option value="">-- Any Accommodation --</option>
                                     @foreach($accommodations as $id => $name)
                                         <option value="{{ $id }}" {{ old('accommodation_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                     @endforeach
                                 </select>
                                 <x-input-error :messages="$errors->get('accommodation_id')" class="mt-2" />
                             </div>
                             {{-- Accommodation Type --}}
                             <div>
                                 <x-input-label for="accommodation_type" :value="__('Specific Accommodation Type (e.g., Homestay)')" />
                                 <x-text-input id="accommodation_type" class="block mt-1 w-full" type="text" name="accommodation_type" :value="old('accommodation_type')" />
                                 <x-input-error :messages="$errors->get('accommodation_type')" class="mt-2" />
                             </div>

                             {{-- Course Weeks --}}
                             <div>
                                 <x-input-label for="min_course_weeks" :value="__('Min Course Weeks')" />
                                 <x-text-input id="min_course_weeks" class="block mt-1 w-full" type="number" step="1" min="1" name="min_course_weeks" :value="old('min_course_weeks')" />
                                 <x-input-error :messages="$errors->get('min_course_weeks')" class="mt-2" />
                             </div>
                             <div>
                                 <x-input-label for="max_course_weeks" :value="__('Max Course Weeks')" />
                                 <x-text-input id="max_course_weeks" class="block mt-1 w-full" type="number" step="1" min="1" name="max_course_weeks" :value="old('max_course_weeks')" />
                                 <x-input-error :messages="$errors->get('max_course_weeks')" class="mt-2" />
                             </div>
                             {{-- Accommodation Weeks --}}
                             <div>
                                 <x-input-label for="min_accommodation_weeks" :value="__('Min Accommodation Weeks')" />
                                 <x-text-input id="min_accommodation_weeks" class="block mt-1 w-full" type="number" step="1" min="1" name="min_accommodation_weeks" :value="old('min_accommodation_weeks')" />
                                 <x-input-error :messages="$errors->get('min_accommodation_weeks')" class="mt-2" />
                             </div>
                             <div>
                                 <x-input-label for="max_accommodation_weeks" :value="__('Max Accommodation Weeks')" />
                                 <x-text-input id="max_accommodation_weeks" class="block mt-1 w-full" type="number" step="1" min="1" name="max_accommodation_weeks" :value="old('max_accommodation_weeks')" />
                                 <x-input-error :messages="$errors->get('max_accommodation_weeks')" class="mt-2" />
                             </div>

                             {{-- Date Condition Type --}}
                             <div>
                                 <x-input-label for="date_condition_type" :value="__('Date Condition Based On')" />
                                 <select name="date_condition_type" id="date_condition_type" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                     <option value="">-- No Date Condition --</option>
                                     @foreach($dateConditionTypes as $key => $label)
                                         <option value="{{ $key }}" {{ old('date_condition_type') == $key ? 'selected' : '' }}>{{ $label }}</option>
                                     @endforeach
                                 </select>
                                 <x-input-error :messages="$errors->get('date_condition_type')" class="mt-2" />
                             </div>
                             <div class="md:col-span-1"></div> {{-- Spacer --}}
                             {{-- Valid From Date --}}
                             <div>
                                 <x-input-label for="valid_from_date" :value="__('Valid From Date')" />
                                 <x-text-input id="valid_from_date" class="block mt-1 w-full" type="date" name="valid_from_date" :value="old('valid_from_date')" />
                                 <x-input-error :messages="$errors->get('valid_from_date')" class="mt-2" />
                             </div>
                             {{-- Valid To Date --}}
                             <div>
                                 <x-input-label for="valid_to_date" :value="__('Valid To Date')" />
                                 <x-text-input id="valid_to_date" class="block mt-1 w-full" type="date" name="valid_to_date" :value="old('valid_to_date')" />
                                 <x-input-error :messages="$errors->get('valid_to_date')" class="mt-2" />
                             </div>
                        </div>

                        {{-- Active Checkbox --}}
                        <div class="block mt-6 border-t pt-4 border-gray-200 dark:border-gray-700">
                            <label for="active" class="inline-flex items-center">
                                <input id="active" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="active" value="1" {{ old('active', true) ? 'checked' : '' }}>
                                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Active') }}</span>
                            </label>
                             <x-input-error :messages="$errors->get('active')" class="mt-2" />
                        </div>


                        <div class="flex items-center justify-end mt-6">
                             <a href="{{ route('admin.discount-rules.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 mr-4">
                                {{ __('Cancel') }}
                            </a>

                            <x-primary-button>
                                {{ __('Save Discount Rule') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- JS to show/hide specific addon dropdown --}}
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const appliesToSelect = document.getElementById('applies_to');
            const addonSelectDiv = document.getElementById('addon_select_div');
            const addonSelect = document.getElementById('addon_id');

            function toggleAddonSelect() {
                const show = appliesToSelect.value === 'addon';
                addonSelectDiv.style.display = show ? '' : 'none';
                addonSelect.required = show; // Make required only if applies_to is 'addon'
                if (!show) {
                    addonSelect.value = ''; // Clear value if hidden
                }
            }

            appliesToSelect.addEventListener('change', toggleAddonSelect);
            toggleAddonSelect(); // Initial check on page load
        });
    </script>
    @endpush

</x-app-layout>
