<x-app-layout>
    <!-- Navigation Links -->
    <x-slot name="submenu">
            <x-nav-link :href="route('permissions.index')" :active="request()->routeIs('permissions.index')">
                {{ __('All Permissions') }}
            </x-nav-link>
            <x-nav-link :href="route('permissions.create')" :active="request()->routeIs('permissions.create')">
                {{ __('Add New Permission') }}
            </x-nav-link>
    </x-slot>

    <div class="p-6">
        <form action="{{route('permissions.store')}}" method="POST">
            @csrf
            <div class="overflow-hidden shadow sm:rounded-md">
                <div class="bg-white dark:bg-gray-700 px-4 py-5 sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <x-input-label for="name">Permission Name</x-input-label>
                            <x-text-input type="text" name="name" id="name" placeholder="model-list" class=""></x-text-input>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <x-input-label for="guard_name">Guard Name</x-input-label>
                            <x-select-input id="guard_name" name="guard_name">
                                <option value="web" selected>Web</option>
                            </x-select-input>
                        </div>
                    </div>
                    <p class="mt-2 text-gray-900 dark:text-gray-200 text-sm"> <span class="text-blue-500 font-bold">Note:</span> If your model is "User", then permission name will be ('user-list', 'user-create', 'user-edit', 'user-delete').</p>
                </div>
                <div class="bg-gray-50 dark:bg-gray-400 px-4 py-3 text-right sm:px-6">
                    <x-primary-button>Save Permission</x-primary-button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
