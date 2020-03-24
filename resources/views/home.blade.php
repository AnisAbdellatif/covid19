@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="my-auto">
                        Dashboard
                    </div>
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-primary" href="{{ route('demands.create', app()->getLocale()) }}">{{ __('Make new Demand') }}</a>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <div class="container">
                            Count: {{ $demands->count() }}
                            <div id="demands">
                                @foreach($demands as $demand)
                                    <div class="card mx-auto mb-3">
                                        <div class="card-header d-inline-flex justify-content-between">
                                            {{ $demand->user()->first()->name }}
                                            @if(!$demand->finished && !$demand->taken)
                                                <form action="{{ route('demands.destroy', [app()->getLocale(), $demand->id]) }}" method="post" onsubmit="return confirm('Do you really want to delete this Demand?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" type="submit"><i class="fas fa-trash"></i></button>
                                                </form>
                                            @endif
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $demand->title }}</h5>
                                            <p class="card-text">
                                                {{ $demand->description }}
                                            </p>
                                            <p>
                                                {{ __('State') }}: {{ $demand->finished ? __('You order has been taken care of') : ($demand->taken ? __('Your demand is being taken care of') : __('Not yet')) }}
                                            </p>
                                        </div>
                                        <div class="card-footer text-muted">
                                            {{ $demand->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
