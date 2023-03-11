<x-app-layout>
    <!-- Navigation Links -->
    <x-slot name="submenu">
        <x-nav-link :href="route('sales.index')" :active="request()->routeIs('sales.index')">
            {{ __('All Sales') }}
        </x-nav-link>
        <x-nav-link :href="route('sales.create')" :active="request()->routeIs('sales.create')">
            {{ __('New Sales') }}
        </x-nav-link>
    </x-slot>

    <div class="p-6">
        <div class="p-6 bg-white dark:bg-gray-700 rounded-md text-gray-900 dark:text-white">
            <div class="mb-6">
                <form id="saleFilterForm">
                    @csrf
                    <div class="flex justify-between items-center gap-5">
                        <x-text-input type="date" name="from_date" required />
                        <p>To</p>
                        <x-text-input type="date" name="to_date" required />
                        <x-primary-button id="saleFilterBtn">Filter</x-primary-button>
                    </div>
                </form>
            </div>
            <table id="saleTable" class="display stripe" style="width:100%">
                <thead class="text-center">
                    <tr class="text-right">
                        <th>Sl</th>
                        <th>Supplier</th>
                        <th>Chalan</th>
                        <th>Total Weight</th>
                        <th>Total Price</th>
                        <th>Total Paid</th>
                        <th>Sale Date</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>


    <x-slot name="script">
        <script>
            var datatablelist = $('#saleTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{!! route('sales.index') !!}",
                columns: [{
                        "render": function(data, type, full, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: null,
                        render: function(data) {
                            return `${data.supplier.name}`;
                        }
                    },
                    {
                        data: null,
                        render: function(data) {
                            return `${data.chalan_number}`;
                        }
                    },

                    {
                        data: null,
                        render: function(data) {
                            return `${data.total_weight} MTN`;
                        }
                    },
                    {
                        data: null,
                        render: function(data) {
                            return `${data.total_price} TK`;
                        }
                    },
                    {
                        data: null,
                        render: function(data) {
                            return `${data.total_paid} TK`;
                        }
                    },
                    {
                        data: null,
                        render: function(data) {

                            return `${data.created_at}`;

                            // var strDate = data.created_at;
                            // return strDate.substring(0, 10);

                            // return strDate;
                        }
                    },
                    {
                        data: null,
                        render: function(data) {
                            return `<div class="flex justify-end"><a href="${BASE_URL}sales/${data.id}/edit" class="bg-gray-600 rounded-md text-gray-200 hover:text-white py-2 px-2 mx-1 hover:bg-green-400" ><span class="iconify" data-icon="dashicons:edit"></span></a>
                                    <a href="${BASE_URL}sales/${data.id}" class="bg-gray-600 rounded-md text-gray-200 hover:text-white py-2 px-2 mx-1 hover:bg-green-400" ><span class="iconify" data-icon="bx:show"></span></a>
                                <button type="button"  class="bg-gray-600 rounded-md text-white py-2 px-2 mx-1 hover:bg-red-400" onclick="saleDelete(${data.id});"><span class="iconify" data-icon="bi:trash-fill"></span></button></div>`;
                        }
                    }
                ]
            });




            function saleDelete(saleDelete) {
                Swal.fire({
                    title: "Delete ?",
                    text: "Are you sure to delete this Sale ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "Delete",
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            method: 'DELETE',
                            url: BASE_URL + 'sales/' + saleDelete,
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



            $('form#saleFilterForm').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    data: $('form#saleFilterForm').serialize(),
                    url: "{{ route('sales.index') }}",
                    type: "GET",
                    beforeSend: function() {
                        $('form#saleFilterForm button').html('-----');
                    },
                    success: function(response) {
                        $('form#saleFilterForm button').html('Filter');
                        $('form#saleFilterForm').trigger("reset");
                        datatablelist.draw();
                        console.log('Success:', response.message);
                    },
                    error: function(response) {
                        datatablelist.draw();
                        $('form#saleFilterForm button').html('Filter');
                        console.log('Error:', response.responseJSON.message + ' ' + response.status);
                    }

                });
            });
        </script>
    </x-slot>
</x-app-layout>
