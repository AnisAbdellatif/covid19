@php
    use App\Role;
    use App\Permission;
    $title = "User";
@endphp

<!-- {{ $title }} {{ $mode }} Modal -->
<div class="modal fade" id="{{ $mode.$title }}Modal" tabindex="-1" role="dialog" aria-labelledby="{{ $mode.$title }}ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ $route }}" method="POST">
                @csrf
                @method($method)
                <div class="modal-header">
                    <h5 class="modal-title" id="{{ $mode.$title }}ModalLabel">{{ $mode }} a {{ $title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <!-- User Name input field -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user-edit"></i></span>
                        </div>
                        <input type="text" class="form-control" name="name" placeholder="User name" value="{{ old('name') }}" aria-label="User name">
                    </div>

                    <!-- User Email input field -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="example@example.com" aria-label="User Email">
                    </div>

                    <!-- User Password input field -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" class="form-control" name="password" value="" placeholder="User Password" aria-label="User Password">
                    </div>

                    <!-- User Roles input fields -->
                    <div>
                        <h3><i class="fas fa-user-tag"></i> Roles</h3>

                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="checkbox" name="select-all" id="select-all-roles" value="all" aria-label="Check this Role!">
                                </div>
                            </div>
                            <div class="form-control">Check all</div>
                        </div>
                        <div class="overflow-auto" style="height: 124px" id="roles-field">
                            @foreach(auth()->user()->groups()->get() as $role)
                                <div class="input-group mb-1">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="checkbox" name="roles[]" value="{{ $role->slug }}" aria-label="Check this Role!">
                                        </div>
                                    </div>
                                    <div class="form-control">{{ $role->name }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- User Permissions input fields -->
                    <div class="mt-3">
                        <h3><i class="fas fa-user-shield"></i> Permissions</h3>

                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="checkbox" name="select-all" id="select-all-permissions" value="all" aria-label="Check this Permission!">
                                </div>
                            </div>
                            <div class="form-control">Check all</div>
                        </div>
                        <div class="overflow-auto" style="height: 124px" id="permissions-field">
                            @foreach(auth()->user()->getAllPermissions() as $permission)
                                <div class="input-group mb-1">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="checkbox" name="permissions[]" value="{{ $permission->slug }}" aria-label="Check this Permission!">
                                        </div>
                                    </div>
                                    <div class="form-control">{{ $permission->name }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">{{ $mode }} {{ $title }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        $('#{{ $mode }}UserModal #select-all-roles').click(function(event) {
            if(this.checked) {
                // Iterate each checkbox
                $('#{{ $mode }}UserModal #roles-field :checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $('#{{ $mode }}UserModal #roles-field :checkbox').each(function() {
                    this.checked = false;
                });
            }
        });
        $('#{{ $mode }}UserModal #select-all-permissions').click(function(event) {
            if(this.checked) {
                // Iterate each checkbox
                $('#{{ $mode }}UserModal #permissions-field :checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $('#{{ $mode }}UserModal #permissions-field :checkbox').each(function() {
                    this.checked = false;
                });
            }
        });
        @if($mode == 'Edit')
            $('#EditUserModal').on('show.bs.modal', function (event) {
                let button = $(event.relatedTarget) // Button that triggered the modal
                let user_id = button.data('user_id');
                let user_name = button.data('user_name');
                let user_email = button.data('user_email');
                let user_roles = button.data('user_roles').split(',');
                let user_permissions = button.data('user_permissions').split(',');
                let modal = $(this)
                modal.find('.modal-title').text(`Edit User: '${ user_name}'`)
                let form = modal.find("form");
                form.attr('action', "{{ route('admin.users.update', '') }}" + `/${user_id}`);
                modal.find(".modal-body input[name='name']").val(user_name);
                modal.find(".modal-body input[name='email']").val(user_email);
                $('#{{ $mode }}UserModal #roles-field :checkbox').each(function() {
                    this.checked = false;
                });
                $('#{{ $mode }}UserModal #permissions-field :checkbox').each(function() {
                    this.checked = false;
                });
                user_roles.forEach((role) => {
                    modal.find(`.modal-body #roles-field :checkbox[value='${role}']`).prop('checked', true);
                })
                user_permissions.forEach((permission) => {
                    modal.find(`.modal-body #permissions-field :checkbox[value='${permission}']`).prop('checked', true);
                })
            });
        @endif
    </script>
@endpush

