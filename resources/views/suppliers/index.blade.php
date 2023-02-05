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
            <table id="supplierTable" class="display stripe" style="width:100%">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Address</th>
                        <th>Payable</th>
                        <th>Reciveable</th>
                        <th>Action</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>


    <x-slot name="script">
        <script>
            var datatablelist = $('#supplierTable').DataTable({
                processing: true,
                serverSide: true,
                    ajax: "{!! route('suppliers.index') !!}",
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
                            data: 'contact',
                            name: 'contact'
                        },
                        {
                            data: 'address',
                            name: 'address'
                        },
                        {
                            data: 'initial_payable',
                            name: 'initial_payable'
                        },
                        {
                            data: 'initial_receivable',
                            name: 'initial_receivable'
                        },
                        {
                            data: null,
                            render: function(data) {
                                return `<div class="flex justify-end"><a href="${BASE_URL}suppliers/${data.id}/edit" class="bg-gray-600 rounded-md text-gray-200 hover:text-white py-2 px-2 mx-1 hover:bg-green-400" ><span class="iconify" data-icon="dashicons:edit"></span></a>
                                <button type="button"  class="bg-gray-600 rounded-md text-white py-2 px-2 mx-1 hover:bg-red-400" onclick="supplierDelete(${data.id});"><span class="iconify" data-icon="bi:trash-fill"></span></button></div>`;
                            }
                        }
                    ]
                });


            function supplierDelete(supplierID) {
                Swal.fire({
                    title: "Delete ?",
                    text: "Are you sure to delete this Supplier ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "Delete",
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            method: 'DELETE',
                            url: BASE_URL +'suppliers/'+supplierID,
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

            $('form#supplierAddForm').submit(function (e) {
                e.preventDefault();

                $.ajax({
                    data: $('form#supplierAddForm').serialize(),
                    url: "{{ route('suppliers.store') }}",
                    type: "POST",
                    beforeSend: function () {
                        $('form#supplierAddForm button').html('Saving..');
                    },
                    success: function (response) {
                        $('form#supplierAddForm button').html('Create Supplier');
                        $('form#supplierAddForm').trigger("reset");
                        datatablelist.draw();
                        console.log('Success:', response.message);

                    },
                    error: function (response) {
                        datatablelist.draw();
                        $('form#supplierAddForm button').html('Create Supplier');
                        console.log('Error:', response.responseJSON.message+' '+response.status);
                    }

                });
            });

        </script>
    </x-slot>
</x-app-layout>
