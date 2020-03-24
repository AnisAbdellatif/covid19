@extends('layouts.app')

@section('content')
    <div class="container w-75">
        {{ $demands->count() }}
        <div id="demands">
            @foreach($demands as $demand)
                <div class="card mx-auto mb-3">
                    <div class="card-header">
                        {{ $demand->user()->first()->name }}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $demand->title }}</h5>
                        <p class="card-text">
                            {{ $demand->description }}
                        </p>
                        <form method="post" action="{{ route('demands.update', [app()->getLocale(), $demand->id]) }}">
                            @csrf
                            @method("PATCH")
                            <input class="btn btn-primary" type="submit" name="taken" value="Take">
                        </form>
                    </div>
                    <div class="card-footer text-muted">
                        {{ $demand->created_at->diffForHumans() }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@push('scripts')
{{--    <script !src="">--}}
{{--        $()--}}
{{--    </script>--}}
@endpush
