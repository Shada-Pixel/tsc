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
        <div class="bg-white dark:bg-gray-700 rounded-md text-gray-900 dark:text-white overflow-hidden">
            <h1 class="pl-6 pt-6 mb-4 text-xl">Create New Purchase</h1>
            <form action="{{route('purchases.store')}}" method="post" class="">
                @csrf
                <div class="px-6 grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div class="">
                        <x-input-label>Supplier</x-input-label>
                        <div class="flex items-end ">
                            <x-select-input name="supplier_id" required>
                                @foreach ($suppliers as $supplier)
                                    <option class="capotalize " value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </x-select-input>
                            <a href="{{route('suppliers.create')}}" class="inline-block bg-gray-600 rounded-md text-gray-200 hover:text-white py-3 px-3 mx-1 hover:bg-blue-500"><span class="iconify" data-icon="material-symbols:add-rounded"></span></a>
                        </div>
                    </div>
                    <div class="">
                        <x-input-label>Purchase Type</x-input-label>
                        <x-select-input name="purchase_type" required>
                            <option class="capotalize" value="1">Store Stock</option>
                            <option class="capotalize" value="2">Clienc Site</option>
                        </x-select-input>
                    </div>
                    <div class="">
                        <x-input-label>Delivery Point</x-input-label>
                        <x-text-input type="text" name="purchase_dp"/>
                    </div>
                    <div class="">
                        <x-input-label>Chalan Number</x-input-label>
                        <x-text-input type="text" name="chalan_number" class="onlynumber" required/>
                    </div>
                </div>

                <h2 class="my-3 pl-6">Purchases Items</h2>
                <div class="p-6">
                    <table class="w-full border-collapse text-left overflow-scroll" id="purctable">
                        <thead>
                            <tr class="border-b border-gray-600 uppercase">
                                <th class="text-left">Rod Size</th>
                                <th>Quantity MTN</th>
                                <th>&#64;PKG</th>
                                <th class="text-right">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td class="pr-5">
                                        <p>{{ $product->diameter . ' mm' }}</p>
                                        <x-text-input type="hidden" value="{{ $product->id }}" name="product_id[]"/>
                                    </td>

                                    <td>
                                        <div class="px-2 flex items-center justify-start gap-4">
                                            <x-text-input type="number" class="w-40 qty" value="0" name="product_qty[]" step="0.001"/>
                                            <p>KG</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="px-2 flex items-center justify-start gap-4">
                                            <x-text-input type="number" class=" w-40 unit_price" value="0" name="product_up[]" step="0.01"/>
                                            <p>TK</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="px-2 flex items-center justify-end gap-4">
                                            <x-text-input type="text" class="onlynumber w-40 total" value="0" name="product_st[]" readonly />
                                            <p>TK</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            <tr>
                                <td colspan="4" class="pt-4">
                                    <hr>
                                    <div class="flex justify-end items-center mt-4">
                                        <p class="mr-4">Total Weight:</p>
                                        <x-text-input type="number" class="w-40 totalweight" value="0" name="totalweight" readonly/>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" class="pt-1">

                                    <div class="flex justify-end items-center">
                                        <p class="mr-4">Total Amount:</p>
                                        <x-text-input type="number" class="w-40 subtotal" value="0" name="subtotal" readonly/>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" class="pt-1">
                                    <div class="flex justify-end items-center">
                                        <p class="mr-4">Paid :</p>
                                        <x-text-input type="number" class="w-40 paid" value="0" name="paid" />
                                        <button class="ml-2 inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                        onclick="payFull(event);">
                                            Full
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" class="pt-1">
                                    <div class="flex justify-end items-center">
                                        <p class="mr-4">Remaining :</p>
                                        <x-text-input type="number" class="w-40 remain" value="0" name="remain" readonly/>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-end mt-6 bg-gray-300 dark:bg-gray-600 p-6">
                    <x-reset-button>Reset</x-reset-button>
                    <x-primary-button>Purchase</x-primary-button>
                </div>

            </form>
        </div>
    </div>


    <x-slot name="script">
        <script>
            $(document).ready(function () {
                calc_remain();
            });

            // On quantity change
            $("#purctable tbody").on("input", ".qty", function() {
                var qty = parseFloat($(this).val());
                var unit_price = parseFloat($(this).closest("tr").find(".unit_price").val());
                var total = $(this).closest("tr").find(".total");
                total.val(unit_price * qty);
                calc_totalw()
                calc_total();
            });

            // On unit price change
            $("#purctable tbody").on("input", ".unit_price", function() {
                var unit_price = parseFloat($(this).val());
                var qty = parseFloat($(this).closest("tr").find(".qty").val());
                var total = $(this).closest("tr").find(".total");
                total.val(unit_price * qty);

                calc_total();
            });

            // On paid
            $("#purctable tbody").on("input", ".paid", function() {
                calc_remain();
            });

            function payFull(e) {
                e.preventDefault();
                var subtotal = $(".subtotal").val();
                $(".paid").val(subtotal);
                calc_remain();
             }





            function calc_total() {
                var sum = 0;

                $(".total").each(function() {
                    sum += parseFloat($(this).val());
                });

                $(".subtotal").val(sum);

                var amounts = sum;
                var tax = 100;
                $(document).on("change keyup blur", "#qty", function() {
                    var qty = $("#qty").val();
                    var discount = $(".discount").val();
                    $(".total").val(amounts * qty);
                    $("#sum_total").val(amounts * qty);
                    $("#tax_1").val((amounts * qty) / tax);
                    $("#grand_total").val((parseInt(amounts)) - (parseInt(discount)));
                });

                calc_remain();
            }

            function calc_remain() {
                var paid = $(".paid").val();
                var subtotal = $(".subtotal").val();
                $(".remain").val(subtotal - paid);
            }

            function calc_totalw(){
                var sum = 0;
                $(".qty").each(function() {
                    sum += parseFloat($(this).val());
                });
                $(".totalweight").val(sum);
            }


        </script>
    </x-slot>
</x-app-layout>
