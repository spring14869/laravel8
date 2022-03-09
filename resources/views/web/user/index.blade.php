@extends('web.components.layout')

@section('title', 'Users')

@section('main')
    @include('web/components/session')

    <div class="card">
        <div class="card-header">
            <h1>Users</h1>

            <a class="btn btn-outline-primary float-end" href="{{ url('user/create') }}">Add</a>
        </div>
        <div class="card-body">
            <table class="table table-light table-bordered">
                <thead>
                <tr class="text-center">
                    <td>ID</td>
                    <td>Status</td>
                    <td>Account</td>
                    <td>Name</td>
                    <td>Email</td>
                    <td>Function</td>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="text-center">{{ $user->u_id }}</td>
                        <td class="text-center" style="width: 80px">
                            @if ($user->u_status == 1)
                                <span class="badge bg-success">{{ $user->status->us_name }}</span>
                            @else
                                <span class="badge bg-danger">{{ $user->status->us_name }}</span>
                            @endif
                        </td>
                        <td>{{ $user->u_account }}</td>
                        <td>{{ $user->u_name }}</td>
                        <td>{{ $user->u_email }}</td>
                        <td class="text-center" style="width: 80px">
                            <a class="btn btn-outline btn-secondary" href="{{ url('user/' . $user->u_id . '/edit') }}">Edit</a>
                        </td>
                    </tr>
                @endforeach

                <tfoot>
                    <tr>
                        <td colspan="6">
                            {{$users->links()}}
                        </td>
                    </tr>
                </tfoot>
                </tbody>
            </table>
        </div>
    </div>

@endsection
