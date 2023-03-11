<x-app-layout>
    <!-- Navigation Links -->
    <x-slot name="submenu">
        <x-nav-link :href="route('clients.index')" :active="request()->routeIs('clients.index')">
            {{ __('All Clients') }}
        </x-nav-link>
        <x-nav-link :href="route('clients.create')" :active="request()->routeIs('clients.create')">
            {{ __('New Clients') }}
        </x-nav-link>
</x-slot>

    <div class="p-6">
        <div class="p-6 bg-white dark:bg-gray-700 rounded-md text-gray-900 dark:text-white">
            <form action="{{route('clients.store')}}" method="POST" class="sm:grid sm:grid-cols-3 gap-5">
                @csrf
                <div class="sm:col-span-3">
                    <p>Personal Information</p>
                </div>

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
                <!-- Phone -->
                <div>
                    <x-input-label for="phone" :value="__('Phone')" />
                    <x-text-input id="phone" class="block mt-1 w-full onlynumber" type="text" name="phone" required  />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>
                <!-- Home Address -->
                <div>
                    <x-input-label for="home_address" :value="__('Home Address')" />
                    <x-text-input id="home_address" class="block mt-1 w-full" type="text" name="home_address"  />
                    <x-input-error :messages="$errors->get('home_address')" class="mt-2" />
                </div>
                <!-- Company Name -->
                <div>
                    <x-input-label for="com_name" :value="__('Company Name')" />
                    <x-text-input id="com_name" class="block mt-1 w-full" type="text" name="com_name"  />
                    <x-input-error :messages="$errors->get('com_name')" class="mt-2" />
                </div>

                <!-- Company Address -->
                <div>
                    <x-input-label for="com_address" :value="__('Company Address')" />
                    <x-text-input id="com_address" class="block mt-1 w-full" type="text" name="com_address"  />
                    <x-input-error :messages="$errors->get('com_address')" class="mt-2" />
                </div>
                <!-- NID -->
                <div>
                    <x-input-label for="nid" :value="__('NID')" />
                    <x-text-input id="nid" class="block mt-1 w-full" type="text" name="nid"  />
                    <x-input-error :messages="$errors->get('nid')" class="mt-2" />
                </div>
                <hr class="sm:col-span-3 my-4"/>
                <div class="sm:col-span-3">
                    <p>Bank Details</p>
                </div>
                <div class="sm:col-span-3 sm:grid sm:grid-cols-4 gap-5">
                    <div>
                        <x-input-label for="bank_name " :value="__('Bank Name')" />
                        <x-text-input id="bank_name " class="block mt-1 w-full" type="text" name="bank_name "  />
                        <x-input-error :messages="$errors->get('bank_name ')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="bank_branch_name " :value="__('Branch Name')" />
                        <x-text-input id="bank_branch_name " class="block mt-1 w-full" type="text" name="bank_branch_name "  />
                        <x-input-error :messages="$errors->get('bank_branch_name ')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="bank_account_number " :value="__('Account Number')" />
                        <x-text-input id="bank_account_number " class="block mt-1 w-full" type="text" name="bank_account_number "  />
                        <x-input-error :messages="$errors->get('bank_account_number ')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="bank_routing_number " :value="__('Routing Number')" />
                        <x-text-input id="bank_routing_number " class="block mt-1 w-full" type="text" name="bank_routing_number "  />
                        <x-input-error :messages="$errors->get('bank_routing_number ')" class="mt-2" />
                    </div>
                </div>
                <hr class="sm:col-span-3 my-4"/>
                <div class="sm:col-span-3">
                    <p>Financial Information</p>
                </div>
                <div class="sm:col-span-3 sm:grid sm:grid-cols-3 gap-5">
                    {{-- Total Purchase --}}
                    <div>
                        <x-input-label for="total_purchase " :value="__('Total PUrchase')" />
                        <x-text-input id="total_purchase " class="block mt-1 w-full" type="text" name="total_purchase "  />
                        <x-input-error :messages="$errors->get('total_purchase ')" class="mt-2" />
                    </div>
                    {{-- Payeabla --}}
                    <div>
                        <x-input-label for="amount_payable " :value="__('Payable')" />
                        <x-text-input id="amount_payable " class="block mt-1 w-full" type="text" name="amount_payable "  />
                        <x-input-error :messages="$errors->get('amount_payable ')" class="mt-2" />
                    </div>
                    {{-- Receivable --}}
                    <div>
                        <x-input-label for="amount_receivable " :value="__('Receivable')" />
                        <x-text-input id="amount_receivable " class="block mt-1 w-full" type="text" name="amount_receivable "  />
                        <x-input-error :messages="$errors->get('amount_receivable ')" class="mt-2" />
                    </div>
                </div>

                <div class="flex items-center justify-end mt-4 sm:col-span-3">
                    <x-primary-button class="ml-4">
                        {{ __('Create Client') }}
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
