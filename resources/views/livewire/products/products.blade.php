<div>
    @push('styles')
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    @endpush

    <div class="text-right">
        <x-button class="btn-primary" wire:click.prevent="create">
            <x-icon icon="plus nav-icon" /> Add New Product
        </x-button>
    </div>

    <livewire:products.products-table searchable="name" />


    <div wire:ignore.self class="modal fade" id="new_product_modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-lg">{{ $editMode ? 'Edit Product' : 'Add Product' }}</h4>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form enctype="multipart/form-data" wire:submit.prevent="{{ $editMode ? 'update' : 'store' }}">
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm">
                                    <x-form.input type="number" name="product.code" placeholder="Enter Product Code" />
                                </div>
                                <div class="col-sm">
                                    <x-form.input name="product.name" placeholder="Enter Product Name" />
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">

                                        <select class="form-control @error('product.category_id') is-invalid @enderror"
                                            name="product.category_id" id="product.category_id"
                                            wire:model="product.category_id">
                                            <option value="">Select a Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-form.error name="product.category_id" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    <x-form.input type="number" min="0" name="product.quantity"
                                        placeholder="Enter Product Quantity" />
                                </div>
                                <div class="col-sm">

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">PKR</span>
                                        </div>

                                        <input type="number" step="any" class="form-control"
                                            id="product.purchase_price" name="product.purchase_price"
                                            wire:model="product.purchase_price" placeholder="Enter Purchase Price">
                                        <x-form.error name="product.purchase_price" />
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">PKR</span>
                                        </div>

                                        <input type="number" step="any" class="form-control" id="product.sale_price"
                                            name="product.sale_price" wire:model.lazy="product.sale_price"
                                            placeholder="Enter Sale Price">
                                        <x-form.error name="product.sale_price" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <textarea name="product.description" id="product.description"
                                            class="form-control" wire:model="product.description"
                                            placeholder="Enter Product Description">
                                    </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex align-items-center">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="image" wire:model="image">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                        <x-form.error name="image" />
                                    </div>
                                </div>
                                <div class="col-sm">
                                    @if ($image)
                                        <img class="img-fluid img-thumbnail upload-preview"
                                            src="{{ $image->temporaryUrl() }}">
                                    @endif

                                    @if ($editMode && !$image)
                                        <img wire:show="" class="img-fluid img-thumbnail upload-preview"
                                            src="{{ $product->getImage() }}">
                                    @endif

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

    {{-- <div wire:ignore.self class="modal fade" id="delete_category_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title text-lg">Delete Category</h4>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this category?</p>
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
    </div> --}}

</div>
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.5.1/cdn.js"></script>
    <script>
        $(function() {

            const createModal = $("#new_product_modal");
            const deleteModal = $("#delete_category_modal");

            window.addEventListener('create', event => {
                createModal.modal();
            });

            window.addEventListener('productAdded', event => {
                createModal.modal('hide');
                toastr.success(event.detail.message, 'success');
            });
            window.addEventListener('edit', event => {
                createModal.modal();
            });
            window.addEventListener('categoryUpdated', event => {
                createModal.modal('hide');
                toastr.success(event.detail.message, 'success');
            });
            window.addEventListener('confirmDelete', event => {
                deleteModal.modal();
            });
            window.addEventListener('categoryDeleted', event => {
                deleteModal.modal('hide');
                toastr.success(event.detail.message, 'success');
            });
        });
    </script> --}}
@endpush
