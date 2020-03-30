@extends('layouts.admin')

@section('header-links')

    <form action="{{ route('admin.users.search') }}">
        <div class="input-group">
            <span class="mr-4 pt-1">
                <a href="{{ route('admin.users.index') }}"><i class="fas fa-backward fa-2x"></i></a>
            </span>
            <input type="search" name="query" class="form-control" value="{{ request('query') }}">
            <span class="input-group-prepend">
                <select class="custom-select" name="category">
                    <option value="name" {{ request('category') == 'name' ? 'selected' : '' }}>name</option>
                    <option value="email" {{ request('category') == 'email' ? 'selected' : '' }}>email</option>
                    <option value="id" {{ request('category') == 'id' ? 'selected' : '' }}>id</option>
                </select>
            </span>
            <span class="input-group-prepend">
                <button type="submit" class="btn btn-primary">Search</button>
            </span>
        </div>
    </form>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#CreateUserModal">
        Create User
    </button>
    @component('components.Admin.UserModal')
        @slot('mode')
            Create
        @endslot

        @slot('method')
            POST
        @endslot

        @slot('route')
            {{ route('admin.users.store') }}
        @endslot
    @endcomponent
@endsection

@section('panel')
    <div class="">

        @include('components.error-success')

        @component('components.Admin.UserModal')
            @slot('mode')
                Edit
            @endslot

            @slot('method')
                PATCH
            @endslot

            @slot('route')
                {{ route('admin.users.update', '') }}
            @endslot
        @endcomponent

        <div class="table-responsive">
            <table class="table">
                <thead class="thead-dark">
                <tr class="">
                    <th scope="col" style="width: 10%">#</th>
                    <th scope="col" style="width: 20%">Name</th>
                    <th scope="col" style="width: 20%">Email</th>
                    <th scope="col" style="width: 30%">Roles</th>
                    <th scope="col" style="width: 20%">Actions</th>
                </tr>
                </thead>
                <tbody>

                @foreach($users as $user)
                    @if(! ($user->hasGroup('superadmin') || $user->id == auth()->user()->id))

                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <ul>
                                    @foreach($user->groups()->get() as $role)
                                        <li>{{ $role->name }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="w-100" style="display: inline-flex">
                                @permission('edit-users-panel')
                                    <button type="button"
                                            class="btn btn-primary mr-2"
                                            data-toggle="modal"
                                            data-target="#EditUserModal"
                                            data-user_id="{{ $user->id }}"
                                            data-user_name="{{ $user->name }}"
                                            data-user_email="{{ $user->email }}"
                                            data-user_roles="@foreach($user->groups()->get() as $role){{ $role->slug."," }}@endforeach"
                                            data-user_permissions="@foreach($user->getAllPermissions() as $permission){{ $permission->slug."," }}@endforeach">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    @component('components.Admin.deleteBtn')
                                        @slot('title')
                                            Role
                                        @endslot

                                        @slot('route')
                                            {{ route('admin.users.destroy', $user->id)}}
                                        @endslot

                                        @slot('icon')
                                            <i class="fas fa-user-minus"></i>
                                        @endslot
                                    @endcomponent
                                @endpermission
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
            <div class="text-xs-center">
                {{ $users->links() }}
            </div>

        </div>
    </div>
@endsection
