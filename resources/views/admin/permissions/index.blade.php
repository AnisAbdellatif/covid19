@extends('layouts.admin')

@section('header-links')

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#CreatePermissionModal">
        Create Permission
    </button>
    @component('components.Admin.PermissionModal')
        @slot('mode')
            Create
        @endslot

        @slot('method')
            POST
        @endslot

        @slot('route')
            {{ route('admin.permissions.store') }}
        @endslot
    @endcomponent
@endsection

@section('panel')
    <div class="">

        @include('components.error-success')

        @component('components.Admin.PermissionModal')
            @slot('mode')
                Edit
            @endslot

            @slot('method')
                PATCH
            @endslot

            @slot('route')
                {{ route('admin.permissions.update', ['']) }}
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
            @foreach($permissions as $permission)
                <tr>
                    <th scope="row">{{ $permission->id }}</th>
                    <td>{{ $permission->name }}</td>
                    <td>{{ $permission->description }}</td>
                    <td>
                        <ul>
                            @foreach($permission->roles()->get() as $role)
                                <li>{{ $role->name }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="w-100" style="display: inline-flex">
                        <button type="button"
                                class="btn btn-primary mr-2"
                                data-toggle="modal"
                                data-target="#EditPermissionModal"
                                data-permission_id="{{ $permission->id }}"
                                data-permission_name="{{ $permission->name }}"
                                data-permission_description="{{ $permission->description }}">
                            <i class="fas fa-edit"></i>
                        </button>
                        @component('components.Admin.deleteBtn')
                            @slot('title')
                                Permission
                            @endslot

                            @slot('route')
                                {{ route('admin.permissions.destroy', $permission->id)}}
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
