<div>
    @push('styles')
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
        <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }} ">
        <style>
            .input-group>.select2-container--bootstrap {
                width: auto;
                flex: 1 1 auto;
            }

            .input-group>.select2-container--bootstrap .select2-selection--single {
                height: 100%;
                line-height: inherit;
                padding: 0.5rem 1rem;
            }

        </style>

    @endpush
    <div class="row">
        <div class="col-md-5">
            <div class="card card-outline card-success">
                <div class="card-body">
                    <form action="">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" value="Seller Name" wire:model="user" readonly>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-file-invoice"></i></span>
                            </div>
                            <input type="text" class="form-control" wire:model="invoice_id" readonly>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-users"></i></span>
                            </div>

                            <select class="form-control select2 customers">
                                <option selected="selected">Alabama</option>
                                <option>Alaska</option>
                                <option>California</option>
                                <option>Delaware</option>
                                <option>Tennessee</option>
                                <option>Texas</option>
                                <option>Washington</option>
                            </select>


                            <div class="input-group-prepend">
                                <button type="button" class="btn btn-secondary" wire:click.prevent="createCustomer">Add
                                    new
                                    client</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-danger">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <!-- /btn-group -->
                                    <input type="text" class="form-control" placeholder="Product name">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <input type="number" class="form-control" placeholder="0">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control">
                                    <div class="input-group-append">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-3">
                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col-8">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="tax">Tax</label>
                                        <div class="input-group mb-3">
                                            <input type="text" id="tax" class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-percentage"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label for="total">Total</label>
                                        <div class="input-group mb-3">

                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                            </div>
                                            <input type="number" id="total" class="form-control" placeholder="0.00"
                                                disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <select class="form-control">
                                        <option>Select Payment Method</option>
                                        <option>Cash</option>
                                        <option>Credit/Debit Card</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <input type="text" id="transaction_code" placeholder="Transaction Code"
                                        class="form-control">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="text-right">
                            <button class="btn btn-success">Save Sale</button>
                        </div>

                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <div class="col-md-7">
            <div class="card card-outline card-warning">

                <!-- /.card-header -->
                <div class="card-body">
                    <livewire:sales.product-table searchable="name" />
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>


    <div wire:ignore.self class="modal fade" id="new_customer_modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-lg">Add Customer</h4>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form wire:submit.prevent="store">
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
                            Save
                        </button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.5.1/cdn.js"></script>
        <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

        <script>
            $(function() {

                $('.select2').select2();

                const createModal = $("#new_customer_modal");
                // const deleteModal = $("#delete_customer_modal");

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
</div>
