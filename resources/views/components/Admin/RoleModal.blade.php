@php
    use App\Role;
    use App\Permission;
    $title = "Role";
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
                    <!-- Role Name input field -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-file-signature"></i></span>
                        </div>
                        <input type="text" class="form-control" name="name" placeholder="Role name" value="{{ $mode }}" aria-label="Role name">
                    </div>

                    <!-- Role Description input field -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-audio-description"></i></span>
                        </div>
                        <textarea class="form-control" name="description" value="{{ old('description') }}" placeholder="Description..." aria-label="Role description"></textarea>
                    </div>

                    <!-- Role Permissions input fields -->
                    <h3><i class="fas fa-shield-alt"></i> Permissions</h3>

                    <div class="input-group mb-1">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <input type="checkbox" name="select-all" id="select-all" value="all" aria-label="Check this permission!">
                            </div>
                        </div>
                        <div class="form-control">Check all</div>
                    </div>
                    @foreach(Permission::All() as $permission)
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" aria-label="Check this permission!">
                                </div>
                            </div>
                            <div class="form-control">{{ $permission->name }}</div>
                        </div>
                    @endforeach

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
        $('#{{ $mode }}RoleModal #select-all').click(function(event) {
            if(this.checked) {
                // Iterate each checkbox
                $('#{{ $mode }}RoleModal :checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $('#{{ $mode }}RoleModal :checkbox').each(function() {
                    this.checked = false;
                });
            }
        });
        @if($mode == 'Edit')
            $('#EditRoleModal').on('show.bs.modal', function (event) {
                let button = $(event.relatedTarget) // Button that triggered the modal
                let role_id = button.data('role_id');
                let role_name = button.data('role_name');
                let role_description = button.data('role_description');
                let role_permissions = button.data('role_permissions').split(',');
                let modal = $(this)
                modal.find('.modal-title').text(`Edit Role: '${ role_name }'`)
                let form = modal.find("form");
                form.attr('action', "{{ url(app()->getLocale().'/admin/roles') }}" + `/${ role_id }`);
                modal.find(".modal-body input[name='name']").val(role_name);
                modal.find(".modal-body textarea[name='description']").val(role_description)
                $('#EditRoleModal :checkbox').each(function() {
                    this.checked = false;
                });
                role_permissions.forEach((perm) => {
                    modal.find(`.modal-body :checkbox[value='${perm}']`).prop('checked', true);
                })
            });
        @endif
    </script>
@endpush

