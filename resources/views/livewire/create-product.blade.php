<div class="flex w-full justify-center py-12">
    <div class="w-1/2 h-full flex-col">
        <form wire:submit.prevent="createProduct" class="flex flex-col items-center gap-7">
            <div class="input-group">
                <label for="name">Product Name</label>
                <input type="text" wire:model="name" name="name" class="input">
            </div>
            <div class="input-group">
                <label for="price">Price</label>
                <input type="number" wire:model="price" name="price" class="input">
            </div>
            <div class="input-group">
                <label for="description">Description</label>
                <textarea wire:model="description" name="description" class="textarea resize-none"></textarea>
            </div>
            <div class="input-group">
                <select wire:model="unitID" class="select w-full">
                    @foreach ($this->units as $unit)
                        <option value="{{ $unit->id }}">{{ $unit->name }}({{ $unit->abbreviation }})</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-blue-500 px-5 py-3 w-1/2  text-white">Add Product</button>
        </form>
    </div>
</div>

<script type="module">
    Livewire.on('productCreated', (event) => {
        Toastify({
            text: 'Product Have been Created'
        }).showToast();
    })
    Livewire.on('productNotCreated', (event) => {
        Toastify({
            text: 'Product Not Created',
            backgroundColor: 'red'
        }).showToast();
    })
</script>
