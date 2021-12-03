<div>
    @push('styles')
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    @endpush


    <div class="text-right">
        <x-button class="btn-primary" wire:click.prevent="create">
            <x-icon icon="user-plus" /> Add New User
        </x-button>
    </div>


    <livewire:users.users-table searchable="name, email" />

    <div wire:ignore.self class="modal fade" id="new_user_modal" aria-hidden="true">
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
                        <x-form.input name="user.name" placeholder="Enter name" />
                        <x-form.input type="email" name="user.email" placeholder="Enter email" />
                        @if (!$editMode)
                            <x-form.input type="password" name="user.password" placeholder="Enter password" />
                        @endif
                        <div class="form-group">
                            <select class="form-control @error('user.role_id') is-invalid @enderror" id="role"
                                wire:model="user.role_id">
                                <option>Select Role</option>
                                <option value="1">Admin</option>
                                <option value="2">Manager</option>
                                <option value="3">Cashier</option>
                            </select>
                            <x-form.error name="user.role_id" />
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




    <div wire:ignore.self class="modal fade" id="delete_user_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title text-lg">Delete User</h4>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this user?</p>
                </div>
                <div class="modal-footer ">

                    <x-button class="btn-default" data-dismiss="modal">
                        Close
                    </x-button>
                    <x-button class="btn-danger" wire:click.prevent="destroy">
                        Delete
                    </x-button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div wire:ignore.self class="modal fade" id="change_user_password" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-lg">Change Password</h4>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form wire:submit.prevent="changePassword">
                    <div class="modal-body">
                        <x-form.input type="password" name="password" placeholder="New Password" />
                        <x-form.input type="password" name="password_confirmation" placeholder="Confirm Password" />
                    </div>
                    <div class="modal-footer ">
                        <x-button class="btn-default" data-dismiss="modal">
                            Close
                        </x-button>
                        <x-button type="submit" class="btn-primary">
                            Update
                        </x-button>
                    </div>
                </form>
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

            const createModal = $("#new_user_modal");
            const deleteModal = $("#delete_user_modal");
            const passwordModal = $("#change_user_password");

            window.addEventListener('create', event => {
                createModal.modal();
            });

            window.addEventListener('userAdded', event => {
                createModal.modal('hide');
                toastr.success(event.detail.message, 'success');
            });

            window.addEventListener('edit', event => {
                createModal.modal();
            });

            window.addEventListener('userUpdated', event => {
                createModal.modal('hide');
                toastr.success(event.detail.message, 'success');
            });

            window.addEventListener('confirmDelete', event => {
                deleteModal.modal();
            });

            window.addEventListener('userDeleted', event => {
                deleteModal.modal('hide');
                toastr.success(event.detail.message, 'success');
            });

            window.addEventListener('editPassword', event => {
                passwordModal.modal();
            });

            window.addEventListener('passwordUpdate', event => {
                passwordModal.modal('hide');
                toastr.success(event.detail.message, 'success');
            });

        });
    </script>
@endpush
