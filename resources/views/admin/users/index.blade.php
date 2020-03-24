@extends('layouts.admin')

@php
    $lang = app()->getLocale();
@endphp

@section('header-links')
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
            {{ route('admin.users.store', $lang) }}
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
                {{ route('admin.users.update', [$lang, '']) }}
            @endslot
        @endcomponent

        <div class="table-responsive">
            <table class="table">
                <thead class="thead-dark">
                <tr class="">
                    <th scope="col" style="width: 10%">#</th>
                    <th scope="col" style="width: 20%">Name</th>
                    <th scope="col" style="width: 20%">Roles</th>
                    <th scope="col" style="width: 30%">Permissions</th>
                    <th scope="col" style="width: 20%">Actions</th>
                </tr>
                </thead>
                <tbody>

                @foreach($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <ul>
                                @foreach($user->roles()->get() as $role)
                                    <li>{{ $role->name }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="w-100" style="display: inline-flex">
                            <button type="button"
                                    class="btn btn-primary mr-2"
                                    data-toggle="modal"
                                    data-target="#EditUserModal"
                                    data-user_id="{{ $user->id }}"
                                    data-user_name="{{ $user->name }}"
                                    data-user_email="{{ $user->email }}"
                                    data-user_roles="@foreach($user->roles()->get() as $role){{ $role->name."," }}@endforeach"
                                    data-user_permissions="@foreach($user->permissions()->get() as $permission){{ $permission->name."," }}@endforeach">
                                <i class="fas fa-edit"></i>
                            </button>
                            @component('components.Admin.deleteBtn')
                                @slot('title')
                                    Role
                                @endslot

                                @slot('route')
                                    {{ route('admin.users.destroy', [$lang, $user->id])}}
                                @endslot

                                @slot('icon')
                                    <i class="fas fa-user-minus"></i>
                                @endslot
                            @endcomponent
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
