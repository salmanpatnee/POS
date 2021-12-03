<div>
    @push('styles')
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    @endpush

    <div class="text-right">
        <x-button class="btn-primary" wire:click.prevent="create">
            <x-icon icon="plus nav-icon" /> Add New Customer
        </x-button>
    </div>

    <livewire:customers.customer-table searchable="name" />


    <div wire:ignore.self class="modal fade" id="new_customer_modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-lg">{{ $editMode ? 'Edit Customer' : 'Add Customer' }}</h4>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form wire:submit.prevent="{{ $editMode ? 'update' : 'store' }}">
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm">
                                    <x-form.input name="customer.name" placeholder="Enter Name" />
                                </div>
                                <div class="col-sm">
                                    <x-form.input type="email" name="customer.email" placeholder="Enter Email" />
                                </div>
                                <div class="col-sm">
                                    <x-form.input type="tel" name="customer.phone" placeholder="Enter Phone Number" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    <x-form.input name="customer.address" placeholder="Enter Address" />
                                </div>

                                <div class="col-sm">
                                    <x-form.input type="date" name="customer.date_of_birth"
                                        placeholder="Enter Date of Birth" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">
                            {{ $editMode ? 'Update' : 'Save' }}
                        </button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

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

            const createModal = $("#new_customer_modal");
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
