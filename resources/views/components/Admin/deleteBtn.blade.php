<form action="{{ $route }}" method="post" onsubmit="return confirm('Do you really want to delete this {{ $title }}?');">
    @csrf
    @method('DELETE')
    <button class="btn btn-danger" type="submit">{{ $icon }}</button>
</form>
