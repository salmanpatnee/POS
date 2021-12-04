<div>
    @push('styles')
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    @endpush

    <div class="text-right">
        <a class="btn btn-primary" href="{{ route('sales.create') }}">
            <x-icon icon="cart-plus nav-icon" /> Add New Sale
        </a>
    </div>

    {{-- <livewire:sales.sales-table searchable="" /> --}}

    <div wire:ignore.self class="modal fade" id="delete_customer_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title text-lg">Delete Product</h4>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this product?</p>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" wire:click.prevent="destroy" class="btn btn-danger">Delete
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

</div>
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.5.1/cdn.js"></script>
    <script>
        $(function() {
            const deleteModal = $("#delete_customer_modal");

            window.addEventListener('create', event => {
                createModal.modal();
            });

            window.addEventListener('customerAdded', event => {
                createModal.modal('hide');
                toastr.success(event.detail.message, 'success');
            });
            window.addEventListener('edit', event => {
                createModal.modal();
            });
            window.addEventListener('customerUpdated', event => {
                createModal.modal('hide');
                toastr.success(event.detail.message, 'success');
            });
            window.addEventListener('confirmDelete', event => {
                deleteModal.modal();
            });
            window.addEventListener('customerDeleted', event => {
                deleteModal.modal('hide');
                toastr.success(event.detail.message, 'success');
            });
        });
    </script>
@endpush
