<x-app-layout>
    <x-slot name="submenu">
        <!-- Navigation Links -->
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <x-nav-link :href="route('roles.index')" :active="request()->routeIs('roles.index')">
                {{ __('All Roles') }}
            </x-nav-link>
            <x-nav-link :href="route('roles.create')" :active="request()->routeIs('roles.create')">
                {{ __('Add New Role') }}
            </x-nav-link>
        </div>
    </x-slot>

    @if (count($errors) > 0)
        <div class="p-6">
            <div class="text-red-500 bg-red-100 px-4 py-2">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="p-6">
        <form action="{{route('roles.update', $role->id)}}" method="POST">
            @csrf
            @method('PATCH')
            <div class="shadow sm:overflow-hidden sm:rounded-md">
                <div class="space-y-6 bg-white dark:bg-gray-700 px-4 py-5 sm:p-6">
                    <div class="grid grid-cols-3 gap-6">
                        <div class="col-span-3 sm:col-span-2">
                            <x-input-label for="guard_name">Role Name:</x-input-label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <x-text-input type="text" name="name" id="name" placeholder="New role name" value="{{$role->name}}"></x-text-input>
                            </div>
                        </div>
                    </div>
                    <fieldset>
                        <div class="text-base font-medium text-gray-900 dark:text-white" aria-hidden="true">Permissions:</div>
                        <div class="mt-4 space-y-4">
                            @foreach ($permissions as $value)
                                <div class="flex items-start">
                                    <div class="flex h-5 items-center">
                                        <input id="" name="permission[]" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-blue-500 focus:ring-blue-400" value="{{$value->id,}}" {{ in_array($value->id, $rolePermissions) ? 'checked' : 'false'}}>
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <x-input-label for="comments">{{ $value->name }}</x-input-label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </fieldset>
                </div>
                <div class="bg-gray-50 dark:bg-gray-400 px-4 py-3 text-right sm:px-6">
                    <x-primary-button>Update Role</x-primary-button>
                </div>
            </div>
        </form>

    </div>
</x-app-layout>
