@extends('layouts.app')

@section('head')
    <script src="{{ asset('js/all.js') }}" defer></script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create new Demand</div>

                    <div class="card-body">
                        <form action="{{ route('demands.store')) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon3">Title</span>
                                </div>
                                <input type="text" name="title" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                            </div>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Description of your demand</span>
                                </div>
                                <textarea class="form-control" aria-label="With textarea" name="description"></textarea>
                            </div>

                            <div class="text-center">
                                <button class="btn btn-primary mt-3" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
