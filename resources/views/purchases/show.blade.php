<x-app-layout>
    <!-- Navigation Links -->
    <x-slot name="submenu">
        <x-nav-link :href="route('purchases.index')" :active="request()->routeIs('purchases.index')">
            {{ __('All Purchases') }}
        </x-nav-link>
        <x-nav-link :href="route('purchases.create')" :active="request()->routeIs('purchases.create')">
            {{ __('New Purchases') }}
        </x-nav-link>
        <x-nav-link :href="route('purchases.show', $purchase->id)" :active="request()->routeIs('purchases.show', $purchase->id)">
            {{ __('Invoice') }}
        </x-nav-link>
    </x-slot>

    <div class="p-6 text-gray-800 dark:text-white">
        <div class="text-center">

            <h1 class="font-bold text-3xl uppercase">Tara Steel Corporation</h1>
            <p class="font-bold text-xl my-2">Importer of steel materials</p>
            <p>Stockist of: M.S. Rod, Flat Bar, Z.Bar, Chanel, Angel, M.S. Plate and <br> General Order Supplier.</p>
            <p class="font-bold px-2 py-1 bg-blue-900 text-white inline-block rounded-full my-2">Purchase Order</p>
        </div>
        <div class="flex justify-between my-2">
            <div class="">
                <p>To,</p>
                <p>{{$purchase->supplier->name}}</p>
                <p>{{$purchase->supplier->address}}</p>
                <p>{{$purchase->supplier->email}}</p>
                <p>{{$purchase->supplier->contact}}</p>
            </div>
            <div class="">
                <p>No: {{$purchase->purchase_number}}</p>
                <p>Date: {{date('d-M, Y', strtotime($purchase->created_at))}}</p>
            </div>
        </div>
        <p class="uppercase underline underline-offset-4 font-bold text-xl">Sub: Order for {{$purchase->total_weight}} MTons Rod 500W</p>
        <div class="mt-4 border border-gray-800 dark:border-gray-500">
            <table class="w-full">
                <thead class="uppercase">
                    <th class="text-center border border-gray-800 dark:border-gray-500">Rod Size</th>
                    <th class="text-center border border-gray-800 dark:border-gray-500">Quantity (M/Tons)</th>
                    <th class="text-center border border-gray-800 dark:border-gray-500">@PMT</th>
                    <th class="text-center border border-gray-800 dark:border-gray-500">Taka</th>
                    <th class="text-center border border-gray-800 dark:border-gray-500">Delivery point</th>
                </thead>
                <tbody>
                    @foreach ($purchase->purchaseItems as $purchaseItem)
                    @if ($purchaseItem->total_weight > 0)

                    <tr>
                        <td class="border border-gray-800 dark:border-gray-500 p-1 text-center">{{$purchaseItem->product->diameter}} mm</td>
                        <td class="border border-gray-800 dark:border-gray-500 p-1 text-center">{{$purchaseItem->total_weight}} MTN</td>
                        <td class="border border-gray-800 dark:border-gray-500 p-1 text-center">{{$purchaseItem->unit_price}} TK/MTN</td>
                        <td class="border border-gray-800 dark:border-gray-500 p-1 text-center">{{$purchaseItem->total_paid}} TK</td>
                        @if ($loop->index == 0)
                        <td class="border border-gray-800 dark:border-gray-500 p-1 text-center" rowspan="7">Delivery Point</td>

                        @endif
                    </tr>
                    @endif
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td class="border border-gray-800 dark:border-gray-500 p-1 text-right" colspan="2">Total Weight: {{$purchase->total_weight}} MTN</td>
                        <td class="border border-gray-800 dark:border-gray-500 p-1 text-right" colspan="2">Total Price: {{$purchase->total_price}}</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="flex justify-between">
            <div class="h-28 flex flex-col justify-end">
                <p class="p-1 border-t border-gray-800 dark:border-gray-500">Received</p>
            </div>
            <div class="h-28 flex flex-col justify-between">
                <p>Thanks & regards</p>
                <p class="p-1 border-t border-gray-800 dark:border-gray-500">Authorized Signature</p>
            </div>
        </div>
        <hr class="border-gray-800 dark:border-gray-400 my-2">
        <div class="invoice-footer text-center">
            <p><span class="font-bold">Corporate Office:</span> 44/2, Khan Jahan Ali Road, Khulna. Bangladesh</p>
            <p><span class="font-bold">Admin Office:</span> 6, KStation Road, Khulna-9100. Mobile: 01716-19070</p>
            <p>Phone Office: 0088-041720653, 0088-041-720895 Fax:+88-041-731253,Mobile:01711-298777, Email: taraeximcorporation@gmail.com</p>
        </div>
    </div>
</x-app-layout>
