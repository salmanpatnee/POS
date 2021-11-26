<div>
    @push('styles')
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    @endpush

    <div class="text-right">
        <x-button class="btn-primary" wire:click.prevent="create">
            <x-icon icon="layer-group nav-icon" /> Add New Category
        </x-button>
    </div>

    <livewire:categories-table searchable="name" />


    <div wire:ignore.self class="modal fade" id="new_category_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-lg">{{ $editMode ? 'Edit Category' : 'Add Category' }}</h4>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form wire:submit.prevent="{{ $editMode ? 'update' : 'store' }}">
                    <div class="modal-body">
                        <x-form.input name="category.name" placeholder="Enter category" />
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


    <div wire:ignore.self class="modal fade" id="delete_category_modal" aria-hidden="true">
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
    </div>

</div>
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.5.1/cdn.js"></script>
    <script>
        $(function() {

            const createModal = $("#new_category_modal");
            const deleteModal = $("#delete_category_modal");
            window.addEventListener('create', event => {
                createModal.modal();
            });

            window.addEventListener('categoryAdded', event => {
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
    </script>
@endpush
