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
                        <button class="bg-blue-500 rounded-xl px-5 py-3 text-white">Edit</button>
                        <button class="bg-red-500 rounded-xl px-5 py-3 text-white">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
