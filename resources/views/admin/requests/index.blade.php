@extends('layouts.admin')

@php
    use App\Permission;
@endphp

@section('panel')
    <div class="">

        @include('components.error-success')
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-dark">
                <tr class="">
                    <th scope="col" style="width: 5%">#</th>
                    <th scope="col" style="width: 8%">User ID</th>
                    <th scope="col" style="width: 10%">Wanted</th>
                    <th scope="col" style="width: 40%">Description</th>
                    <th scope="col" style="width: 10%">link</th>
                    <th scope="col" style="width: 10%">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($requests as $request)
                    <tr>
                        <th scope="row">{{ $request->id }}</th>
                        <td>{{ $request->user_id }}</td>
                        <td>{{ $request->wanted }}</td>
                        <td>{{ $request->description }}</td>
                        <td><a href="{{ $request->link }}">{{ $request->link }}</a></td>
                        <td class="w-100" style="display: inline-flex">

                            <a class="btn btn-primary mr-2" href="{{ route('admin.requests.update', $request->id).'?action=accept' }}"
                               onclick="event.preventDefault(); document.getElementById('accept-form-{{ $request->id }}').submit();">
                                <i class="fas fa-check-circle"></i>
                            </a>
                            <form id="accept-form-{{ $request->id }}" action="{{ route('admin.requests.update', $request->id).'?action=accept' }}" method="POST" style="display: none;">
                                @csrf
                                @method('PATCH')
                            </form>

                            <a class="btn btn-danger mr-2" href="{{ route('admin.requests.update', $request->id) }}"
                               onclick="event.preventDefault(); document.getElementById('deny-form-{{ $request->id }}').submit();">
                                <i class="fas fa-ban"></i>
                            </a>
                            <form id="deny-form-{{ $request->id }}" action="{{ route('admin.requests.update', $request->id).'?action=deny' }}" method="POST" style="display: none;">
                                @csrf
                                @method('PATCH')
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $requests->links() }}
    </div>
@endsection
