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
    <div class="grid gap-3">
        <label for="stock-in-quantity-before">Quantity Before</label>
        <input type="text" wire:model="quantityBefore" id="stock-in-quantity-before" class="input" disabled />
    </div>
    <div class="grid gap-3">
        <label for="stock-type">Stock Type</label>
        <input type="text" class="input" wire:model="unitAbbreviation" disabled>
    </div>
    <div class="grid gap-3">
        <label for="stock-in-quantiy">Amount Added</label>
        <input type="number" wire:model.live="quantityAfter" id="stock-in-quantiy" class="input"
            placeholder="place your desired stock" />
        @error('quantityAfter')
            <span class="text-sm text-red-500">{{ $message }}</span>
        @enderror
    </div>
    <p class="mt-2 text-gray-700">
        Current: {{ $quantityBefore }} + Added: {{ $quantityAfter >= 0.1 ? (float) $quantityAfter : 'N/A' }}
        =
        @if ($quantityAfter >= 0.1)
            <span class="font-bold text-green-600">
                {{ $this->projectedStock }}
            </span>
        @else
            <span class="font-bold text-red-600">
                Not A Valid Number
            </span>
        @endif
    </p>
    <footer>
        <button type="button" class="btn-outline" onclick="this.closest('dialog').close()">
            Cancel
        </button>

        <button class="btn" wire:click="updateStockIn"
            @if ($this->quantityAfter < 0.1) disabled class="opacity-50 cursor-not-allowed btn" @endif>
            Save changes
        </button>
    </footer>
</div>
