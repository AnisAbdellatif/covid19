@php
    use App\Role;
    use App\Permission;
    $title = "Permission";
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
                    <!-- Permission Name input field -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-file-signature"></i></span>
                        </div>
                        <input type="text" class="form-control" name="name" placeholder="Permission name" value="{{ old('name') }}" aria-label="Role name">
                    </div>

                    <!-- Permission Description input field -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-audio-description"></i></span>
                        </div>
                        <textarea class="form-control" name="description" value="{{ old('description') }}" placeholder="Description..." aria-label="Role description"></textarea>
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
        @if($mode == 'Edit')
            $('#EditPermissionModal').on('show.bs.modal', function (event) {
                let button = $(event.relatedTarget) // Button that triggered the modal
                let permission_id = button.data('permission_id');
                let permission_name = button.data('permission_name');
                let permission_description = button.data('permission_description');
                let modal = $(this)
                modal.find('.modal-title').text(`Edit Permission: '${ permission_name }'`)
                let form = modal.find("form");
                form.attr('action', `${form.attr('action')}/${ permission_id }`);
                modal.find(".modal-body input[name='name']").val(permission_name);
                modal.find(".modal-body textarea[name='description']").val(permission_description)
            });
        @endif
    </script>
@endpush

