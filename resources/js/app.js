import './bootstrap';
document.addEventListener('alpine:init', () => {
    Alpine.store('stockInModal', {
        open: false,
        productID: null,
        openModal(productID) {
            this.productID = productID
            this.open = true
        },
        toggle() {
            this.open = !this.open
        }
    });
})