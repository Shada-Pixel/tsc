<x-app-layout>
    <!-- Navigation Links -->
    <x-slot name="submenu">
            <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')">
                {{ __('All Products') }}
            </x-nav-link>
    </x-slot>

    <div class="p-6">
        <div class="p-6 bg-white dark:bg-gray-700 rounded-md text-gray-900 dark:text-white">
            <form id="productAddForm">
                @csrf
                <div class="grid sm:grid-cols-2 gap-5">

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="Steel Bar" required  />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Diameter -->
                    <div>
                        <x-input-label for="diameter" :value="__('Deameter (in mm)')" />
                        <x-text-input id="diameter" class="block mt-1 w-full onlynumber" type="text" name="diameter" placeholder="12" required autofocus/>
                        <x-input-error :messages="$errors->get('diameter')" class="mt-2" />
                    </div>
                </div>


                <div class="flex items-center justify-end mt-4">

                    <x-primary-button class="ml-4">
                        {{ __('Create Product') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <div class="p-6 pt-0">
        <div class="p-6 bg-white dark:bg-gray-700 rounded-md text-gray-900 dark:text-white">
            <table id="productTable" class="display stripe" style="width:100%">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Full Name</th>
                        <th>Diameter</th>
                        <th>Action</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>


    <x-slot name="script">
        <script>
            var datatablelist = $('#productTable').DataTable({
                processing: true,
                serverSide: true,
                    ajax: "{!! route('products.index') !!}",
                    columns: [
                        {"render": function(data, type, full, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: null,
                            render: function(data) {
                                return `${data.diameter} mm ${data.name}`;
                            }
                        },
                        {
                            data: null,
                            render: function(data) {
                                return `${data.diameter} mm`;
                            }
                        },
                        {
                            data: null,
                            render: function(data) {
                                return `<div class="flex justify-end"><a href="${BASE_URL}products/${data.id}/edit" class="bg-gray-600 rounded-md text-gray-200 hover:text-white py-2 px-2 mx-1 hover:bg-green-400" ><span class="iconify" data-icon="dashicons:edit"></span></a>
                                <button type="button"  class="bg-gray-600 rounded-md text-white py-2 px-2 mx-1 hover:bg-red-400" onclick="productDelete(${data.id});"><span class="iconify" data-icon="bi:trash-fill"></span></button></div>`;
                            }
                        }
                    ]
                });


            function productDelete(productID) {
                Swal.fire({
                    title: "Delete ?",
                    text: "Are you sure to delete this Product ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "Delete",
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            method: 'DELETE',
                            url: BASE_URL +'products/'+productID,
                            success: function(response) {
                                if (response.status == "success") {
                                    Swal.fire('Success!', response.message, 'success');
                                    datatablelist.draw();
                                } else if (response.status == "error") {
                                    Swal.fire('This item is not deletable!', response.message, 'error');
                                    datatablelist.draw();
                                }
                            }
                        });
                    }
                });
            }

            $('form#productAddForm').submit(function (e) {
                e.preventDefault();

                $.ajax({
                    data: $('form#productAddForm').serialize(),
                    url: "{{ route('products.store') }}",
                    type: "POST",
                    beforeSend: function () {
                        $('form#productAddForm button').html('Saving..');
                    },
                    success: function (response) {
                        $('form#productAddForm button').html('Create Product');
                        $('form#productAddForm').trigger("reset");
                        datatablelist.draw();
                        console.log('Success:', response.message);

                    },
                    error: function (response) {
                        datatablelist.draw();
                        $('form#productAddForm button').html('Create Product');
                        console.log('Error:', response.responseJSON.message+' '+response.status);
                    }

                });
            });

        </script>
    </x-slot>
</x-app-layout>
