<div class="w-1/2 px-5 py-7 grid grid-cols-3 border">
    <div class="flex flex-col 3 items-center px-5">
        <h2 class="text-2xl text-center font-bold text-blue-500">
            Products Total
        </h2>
        <h2 class="text-xl font-bold">
            {{ $this->productCounts }}
        </h2>
    </div>
    <div class="flex flex-col 3 items-center px-5">
        <h2 class="text-2xl text-center font-bold text-blue-500">
            Products Total Value
        </h2>
        <h2 class="text-xl font-bold">
            {{ $this->productValueSum }}
        </h2>
    </div>
    <div class="flex flex-col 3 items-center px-5">
        <h2 class="text-2xl text-center font-bold text-blue-500">
            Top Product Price
        </h2>
        <h2 class="text-xl font-bold">
            {{ $this->topPriceProduct }}
        </h2>
    </div>
</div>
