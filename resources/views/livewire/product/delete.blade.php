<div class="form grid gap-4 w-full">
    <div wire:loading class="text-sm text-gray-500">
        Loading product details...
    </div>

    <div class="grid gap-3">
        <label for="stock-in-name">Product Name</label>
        <input type="text" wire:model="name" id="stock-in-name" disabled class="input" />
    </div>

    <div class="grid gap-3">
        <label for="stock-in-price">Price</label>
        <input type="text" wire:model="price" id="stock-in-price" disabled class="input" />
    </div>
    <footer>
        <button type="button" class="btn-outline" onclick="this.closest('dialog').close()">
            Cancel
        </button>

        <button class="btn bg-red-600" wire:click="deleteProduct">
            Delete Product
        </button>
    </footer>
</div>
