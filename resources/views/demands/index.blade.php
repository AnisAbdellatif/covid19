@extends('layouts.app')

@section('content')
    <div class="container w-75">
        <div class="d-flex justify-content-between mb-2">
            <div class="d-flex justify-content-end align-middle" style="font-size: 25px">
                Count: {{ $demands->count() }}
            </div>

            @role('volunteer')
                <div class="d-flex justify-content-end">
                    <a class="btn btn-primary" href="{{ route('demands.taken') }}">{{ __('Taken Demands') }}</a>
                </div>
            @endrole
        </div>
        <div id="demands">
            @foreach($demands as $demand)
                <div class="card mx-auto mb-3">
                    <div class="card-header">
                        {{ $demand->user()->first()->name }} | {{ $demand->user()->first()->country }} | {{ $demand->user()->first()->phone }}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $demand->title }}</h5>
                        <p class="card-text">
                            {{ $demand->description }}
                        </p>
                        <form method="post" action="{{ route('demands.update', $demand->id) }}">
                            @csrf
                            @method("PATCH")
                            <input class="btn btn-primary" type="submit" name="{{ $demand->taken ? 'finish' : 'take' }}" value="{{ $demand->taken ? 'Finish' : 'Take' }}">
                        </form>
                    </div>
                    <div class="card-footer text-muted">
                        {{ $demand->created_at->diffForHumans() }}
                    </div>
                </div>
            @endforeach

                {{ $demands->links() }}
        </div>
    </div>
@endsection

@push('scripts')
{{--    <script !src="">--}}
{{--        $()--}}
{{--    </script>--}}
@endpush
