
<div>
    @push('styles')
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    @endpush
    
    <div class="text-right">
        <button type="button" class="btn btn-primary add-user-modal" data-toggle="modal" data-target="#new-user-modal"><i class="fas fa-user-plus"></i> Add New User</button>
    </div>

<livewire:users-table searchable="name, email"/>
    

      <div wire:ignore.self class="modal fade" id="new-user-modal"  aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">{{$editMode ? 'Edit User' : 'Add User'}}</h4>
              <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <form wire:submit.prevent="store">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" id="name" class="form-control @error('user.name') is-invalid @enderror" wire:model="user.name" placeholder="Name">
                        @error('user.name')
                            <small class="text-danger d-block w-100">{{$message}}</small>    
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="email" id="email" class="form-control @error('user.email') is-invalid @enderror" wire:model="user.email" placeholder="Email">
                        @error('user.email')
                            <small class="text-danger d-block w-100">{{$message}}</small>    
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="password" id="password" class="form-control @error('user.password') is-invalid @enderror" wire:model="user.password" placeholder="Password">
                        @error('user.password')
                            <small class="text-danger d-block w-100">{{$message}}</small>    
                        @enderror
                    </div>
                    <div class="form-group">
                        <select class="form-control @error('user.role_id') is-invalid @enderror" id="role" wire:model="user.role_id">
                            <option>Select Role</option>
                            <option value="1">Admin</option>
                            <option value="2">Manager</option>
                            <option value="3">Cashier</option>
                          </select>
                        @error('user.role_id')
                          <small class="text-danger d-block w-100">{{$message}}</small>    
                        @enderror
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button  type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">{{$editMode ? 'Update User' : 'Add User'}}</button>
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
        $(function () {
            
            window.addEventListener('userAdded', event => {
                $("#new-user-modal").modal('hide');
                 toastr.success(event.detail.message, 'success');
            });

            window.addEventListener('editUser', event => {
                $("#new-user-modal").modal();
            });

        });
    </script>
@endpush