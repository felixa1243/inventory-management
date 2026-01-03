<div>
    Product List
    <table>
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
                            {{ $product->price }}
                        </td>
                        <td>
                            {{ $product->description }}
                        </td>
                        <td>
                            1 {{ $product->unit_abv }}
                        </td>
                        <td class="flex gap-3">
                            <button class="bg-green-600 px-5 py-3 text-white">Stock In</button>
                            <button class="bg-blue-600 px-5 py-3 text-white">Stock Out</button>
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
</div>
