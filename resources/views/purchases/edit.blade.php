<x-app-layout>
    <!-- Navigation Links -->
    <x-slot name="submenu">
            <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')">
                {{ __('All Users') }}
            </x-nav-link>
            <x-nav-link :href="route('users.create')" :active="request()->routeIs('users.create')">
                {{ __('Add New User') }}
            </x-nav-link>
    </x-slot>

    <div class="p-6">
        <div class="p-6 bg-white dark:bg-gray-700 rounded-md text-gray-900 dark:text-white">
            <form id="productAddForm" action="{{route('products.update',$product->id)}}" method="POST">
                @csrf
                @method("PATCH")
                <div class="grid sm:grid-cols-2 gap-5">

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$product->name}}" required  />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Diameter -->
                    <div>
                        <x-input-label for="diameter" :value="__('Deameter (in mm)')" />
                        <x-text-input id="diameter" class="block mt-1 w-full onlynumber" type="text" name="diameter" value="{{$product->diameter}}" placeholder="12" required autofocus/>
                        <x-input-error :messages="$errors->get('diameter')" class="mt-2" />
                    </div>
                </div>


                <div class="flex items-center justify-end mt-4">

                    <x-primary-button class="ml-4">
                        {{ __('Update Product') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
