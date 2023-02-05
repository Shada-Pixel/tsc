<x-app-layout>
    <!-- Navigation Links -->
    <x-slot name="submenu">
            <x-nav-link :href="route('suppliers.index')" :active="request()->routeIs('suppliers.index')">
                {{ __('All Suppliers') }}
            </x-nav-link>
            <x-nav-link :href="route('suppliers.create')" :active="request()->routeIs('suppliers.create')">
                {{ __('New Suppliers') }}
            </x-nav-link>
    </x-slot>

    <div class="p-6">
        <div class="p-6 bg-white dark:bg-gray-700 rounded-md text-gray-900 dark:text-white">
            <form action="{{route('suppliers.store')}}" method="POST" class="grid sm:grid-cols-2 gap-5">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required  />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" required  />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <!-- Contact -->
                <div>
                    <x-input-label for="contact" :value="__('Contact')" />
                    <x-text-input id="contact" class="block mt-1 w-full onlynumber" type="text" name="contact" required  />
                    <x-input-error :messages="$errors->get('contact')" class="mt-2" />
                </div>
                <!-- Address -->
                <div>
                    <x-input-label for="address" :value="__('Address')" />
                    <x-text-input id="address" class="block mt-1 w-full" type="text" name="address"  />
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>
                <!-- ID Number -->
                <div>
                    <x-input-label for="id_number" :value="__('ID Number')" />
                    <x-text-input id="id_number" class="block mt-1 w-full" type="text" name="id_number"  />
                    <x-input-error :messages="$errors->get('id_number')" class="mt-2" />
                </div>
                <!-- Laisence -->
                <div>
                    <x-input-label for="laisence" :value="__('Licence')" />
                    <x-text-input id="laisence" class="block mt-1 w-full" type="text" name="laisence"  />
                    <x-input-error :messages="$errors->get('laisence')" class="mt-2" />
                </div>
                <!-- Initial Payable -->
                <div>
                    <x-input-label for="initial_payable" :value="__('Initial Payable')" />
                    <x-text-input id="initial_payable" class="block mt-1 w-full onlynumber" type="text" name="initial_payable"  value="0"/>
                    <x-input-error :messages="$errors->get('initial_payable')" class="mt-2" />
                </div>
                <!-- initial_receivable -->
                <div>
                    <x-input-label for="initial_receivable" :value="__('Initial Receivable')" />
                    <x-text-input id="initial_receivable" class="block mt-1 w-full onlynumber" type="text" name="initial_receivable"  value="0"/>
                    <x-input-error :messages="$errors->get('initial_receivable')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4 sm:col-span-2">
                    <x-primary-button class="ml-4">
                        {{ __('Create Supplier') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>


    <x-slot name="script">
        <script>
        </script>
    </x-slot>
</x-app-layout>
