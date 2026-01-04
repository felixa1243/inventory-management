<div>
    Product List
    <table class="table">
        <thead>
            <tr>
                <td>
                    Product Name
                </td>
                <td>
                    Product Price
                </td>
                <td>
                    Product Description
                </td>
                <td>
                    Stocks
                </td>
                <td>
                    Action
                </td>
            </tr>
        </thead>
        <tbody>
            @if ($this->products->count() > 0)
                @foreach ($this->products as $product)
                    <tr>
                        <td>
                            {{ $product->name }}
                        </td>
                        <td>
                            {{ Number::format($product->price) }}
                        </td>
                        <td>
                            {{ $product->description }}
                        </td>
                        <td>
                            {{ Number::format($product->quantity) }} {{ $product->unit_abv }}
                        </td>
                        <td class="flex gap-3">
                            <button type="button" class="btn bg-green-700 text-white"
                                @click="document.getElementById('stock-in').showModal();Livewire.dispatch('load-stock-info', { id: {{ $product->id }} });
    ">
                                Stock In
                            </button>
                            <button type="button" class="btn bg-blue-600 px-5 py-3 text-white"
                                @click="document.getElementById('stock-out').showModal();Livewire.dispatch('load-stock-info', { id: {{ $product->id }} });">Stock
                                Out</button>
                            <button class="bg-red-500 px-5 py-3 text-white">Delete</button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" class="colspan-5 text-center">
                        No Product Found
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
    <script type="module">
        Livewire.on('stockUpdated', (event) => {
            Toastify({
                text: 'Stock Have been Updated'
            }).showToast();
        })
        Livewire.on('stockNotUpdated', (event) => {
            Toastify({
                text: 'Stock Not Updated',
                backgroundColor: 'red'
            }).showToast();
        })
        Livewire.on('stockCannotBeBelowZero', (event) => {
            Toastify({
                text: 'Stock Cannot Be Below Zero',
                backgroundColor: 'red'
            }).showToast();
        })
    </script>
</div>
