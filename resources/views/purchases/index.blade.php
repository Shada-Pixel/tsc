<x-app-layout>
    <!-- Navigation Links -->
    <x-slot name="submenu">
            <x-nav-link :href="route('purchases.index')" :active="request()->routeIs('purchases.index')">
                {{ __('All Purchases') }}
            </x-nav-link>
            <x-nav-link :href="route('purchases.create')" :active="request()->routeIs('purchases.create')">
                {{ __('New Purchases') }}
            </x-nav-link>
    </x-slot>

    <div class="p-6">
        <div class="p-6 bg-white dark:bg-gray-700 rounded-md text-gray-900 dark:text-white">
            <div class="mb-6">
                <form id="purchaseFilterForm">
                    @csrf
                    <div class="flex justify-between items-center gap-5">
                        <x-text-input type="date" name="from_date" required/>
                        <p>To</p>
                        <x-text-input type="date" name="to_date" required/>
                        <x-primary-button id="purchaseFilterBtn">Filter</x-primary-button>
                    </div>
                </form>
            </div>
            <table id="purchaseTable" class="display stripe" style="width:100%">
                <thead class="text-center">
                    <tr class="text-right">
                        <th>Sl</th>
                        <th>Supplier</th>
                        <th>Total Weight</th>
                        <th>Total Price</th>
                        <th>Total Paid</th>
                        <th>Purchase Date</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>


    <x-slot name="script">
        <script>
            var datatablelist = $('#purchaseTable').DataTable({
                processing: true,
                serverSide: true,
                    ajax: "{!! route('purchases.index') !!}",
                    columns: [
                        {"render": function(data, type, full, meta) {
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
                                return `<div class="flex justify-end"><a href="${BASE_URL}purchases/${data.id}/edit" class="bg-gray-600 rounded-md text-gray-200 hover:text-white py-2 px-2 mx-1 hover:bg-green-400" ><span class="iconify" data-icon="dashicons:edit"></span></a>
                                    <a href="${BASE_URL}purchases/${data.id}" class="bg-gray-600 rounded-md text-gray-200 hover:text-white py-2 px-2 mx-1 hover:bg-green-400" ><span class="iconify" data-icon="bx:show"></span></a>
                                <button type="button"  class="bg-gray-600 rounded-md text-white py-2 px-2 mx-1 hover:bg-red-400" onclick="purchaseDelete(${data.id});"><span class="iconify" data-icon="bi:trash-fill"></span></button></div>`;
                            }
                        }
                    ]
                });




            function purchaseDelete(purchaseDelete) {
                Swal.fire({
                    title: "Delete ?",
                    text: "Are you sure to delete this Purchase ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "Delete",
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            method: 'DELETE',
                            url: BASE_URL +'purchases/'+purchaseDelete,
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



            $('form#purchaseFilterForm').submit(function (e) {
                e.preventDefault();

                $.ajax({
                    data: $('form#purchaseFilterForm').serialize(),
                    url: "{{ route('purchases.index') }}",
                    type: "GET",
                    beforeSend: function () {
                        $('form#purchaseFilterForm button').html('-----');
                    },
                    success: function (response) {
                        $('form#purchaseFilterForm button').html('Filter');
                        $('form#purchaseFilterForm').trigger("reset");
                        datatablelist.draw();
                        console.log('Success:', response.message);
                    },
                    error: function (response) {
                        datatablelist.draw();
                        $('form#purchaseFilterForm button').html('Filter');
                        console.log('Error:', response.responseJSON.message+' '+response.status);
                    }

                });
            });

        </script>
    </x-slot>
</x-app-layout>
