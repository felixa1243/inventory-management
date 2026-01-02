<div class="flex w-full justify-center py-12">
    <div class="w-1/2 h-full flex-col">
        <form wire:submit.prevent="createProduct" class="flex flex-col items-center gap-7">
            <div class="input-group">
                <label for="name">Product Name</label>
                <input type="text" wire:model="name" name="name">
            </div>
            <div class="input-group">
                <label for="price">Price</label>
                <input type="number" wire:model="price" name="price">
            </div>
            <div class="input-group">
                <label for="description">Description</label>
                <textarea wire:model="description" name="description"></textarea>
            </div>
            <button type="submit" class="bg-blue-500 px-5 py-3 w-1/2 rounded-xl text-white">Add Product</button>
        </form>
    </div>
</div>

<script type="module">
    Livewire.on('productCreated', (event) => {
        Toastify({
            text: 'Product Have been Created'
        }).showToast();
    })
</script>
