@extends('layouts.admin')

@php
    use App\Permission;
@endphp

@section('header-links')
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#CreateRoleModal">
        Create Role
    </button>
    @component('components.Admin.RoleModal')
        @slot('mode')
            Create
        @endslot

        @slot('method')
            POST
        @endslot

        @slot('route')
            {{ route('admin.roles.store') }}
        @endslot
    @endcomponent
@endsection

@section('panel')
    <div class="">

        @include('components.error-success')

        @component('components.Admin.RoleModal')
            @slot('mode')
                Edit
            @endslot

            @slot('method')
                PATCH
            @endslot

            @slot('route')
                {{ route('admin.roles.update', '') }}
            @endslot
        @endcomponent

        <table class="table">
            <thead class="thead-dark">
            <tr class="">
                <th scope="col" style="width: 5%">#</th>
                <th scope="col" style="width: 15%">Name</th>
                <th scope="col" style="width: 20%">Description</th>
                <th scope="col" style="width: 40%">Permissions</th>
                <th scope="col" style="width: 20%">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($roles as $role)
                <tr>
                    <th scope="row">{{ $role->id }}</th>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->description }}</td>
                    <td>
                        <ul>
                            @foreach($role->permissions()->get() as $permission)
                                <li>{{ $permission->name }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="w-100" style="display: inline-flex">
                        <button type="button"
                                class="btn btn-primary mr-2"
                                data-toggle="modal"
                                data-target="#EditRoleModal"
                                data-role_id="{{ $role->id }}"
                                data-role_name="{{ $role->name }}"
                                data-role_description="{{ $role->description }}"
                                data-role_permissions="@foreach($role->permissions()->get() as $permission){{ $permission->name."," }}@endforeach">
                            <i class="fas fa-edit"></i>
                        </button>
                        @component('components.Admin.deleteBtn')
                            @slot('title')
                                Role
                            @endslot

                            @slot('route')
                                {{ route('admin.roles.destroy', $role->id)}}
                            @endslot

                            @slot('icon')
                                <i class="fas fa-minus-square"></i>
                            @endslot
                        @endcomponent
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
