@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Error!</h4>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Great!</h4>
        <p>{{ session('success') }}</p>
        <hr>
    </div>
@endif
