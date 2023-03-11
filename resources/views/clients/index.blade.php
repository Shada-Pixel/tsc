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
            <table id="clientTable" class="display stripe" style="width:100%">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>


    <x-slot name="script">
        <script>
            var datatablelist = $('#clientTable').DataTable({
                processing: true,
                serverSide: true,
                    ajax: "{!! route('clients.index') !!}",
                    columns: [
                        {"render": function(data, type, full, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'phone',
                            name: 'phone'
                        },
                        {
                            data: null,
                            render: function(data) {
                                return `<div class="flex justify-end">
                                    <a href="${BASE_URL}clients/${data.id}" class="bg-gray-600 rounded-md text-gray-200 hover:text-white py-2 px-2 mx-1 hover:bg-blue-400" ><span class="iconify" data-icon="ic:outline-remove-red-eye"></span>
                                        </a>
                                    <a href="${BASE_URL}clients/${data.id}/edit" class="bg-gray-600 rounded-md text-gray-200 hover:text-white py-2 px-2 mx-1 hover:bg-green-400" ><span class="iconify" data-icon="dashicons:edit"></span>
                                        </a>
                                <button type="button"  class="bg-gray-600 rounded-md text-white py-2 px-2 mx-1 hover:bg-red-400" onclick="supplierDelete(${data.id});"><span class="iconify" data-icon="bi:trash-fill"></span></button>
                                </div>`;
                            }
                        }
                    ]
                });


            function supplierDelete(supplierID) {
                Swal.fire({
                    title: "Delete ?",
                    text: "Are you sure to delete this Client ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "Delete",
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            method: 'DELETE',
                            url: BASE_URL +'clients/'+supplierID,
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


        </script>
    </x-slot>
</x-app-layout>
