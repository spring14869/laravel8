@extends('web.components.layout')

@section('title', $title)

@section('main')
    @include('web/components/session')
    <div class="card">
        <div class="card-header">
            <h1>{{$title}}</h1>
        </div>
        <div class="card-body">
            <form name="userForm" id="userForm"
                  method="post"
                  onsubmit="return formSubmit()"
                  action="{{ $route }}"
                  enctype="multipart/form-data">
                @csrf
                @if (!empty($user['u_id']))
                    @method('patch')
                @endif

                <input type="hidden" name="u_id" value="{{ $user['u_id'] }}" />
                <div class="mb-3 row">
                    <label for="account" class="col-sm-2 col-form-label">Status</label>

                    <div class="col-sm-10">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="u_status" id="status_enabled" value="1"
                                {{ $user['u_status'] == 1 ? 'checked' : ''}}>
                            <label class="form-check-label" for="status_enabled">
                                Enabled
                            </label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="u_status" id="status_disabled" value="0"
                                {{ $user['u_status'] == 0 ? 'checked' : ''}}>
                            <label class="form-check-label" for="status_disabled" style="color:red">
                                Disabled
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="account" class="col-sm-2 col-form-label">Account</label>
                    <div class="col-sm-10">
                        @if (empty($user['u_id']))
                            <input type="text" class="form-control" id="u_account" name="u_account" value="{{ old('u_account') }}">
                        @else
                            <p>{{$user['u_account']}}</p>
                            <input type="hidden" id="u_account" name="u_account" value="{{$user['u_account']}}">
                        @endif
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="u_password" id="password" autocomplete="off">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        @if (empty($user['u_id']))
                            <input type="text" class="form-control" name="u_name" id="name" value="{{ old('u_name') }}">
                        @else
                            <input type="text" class="form-control" name="u_name" id="name" value="{{ $user['u_name'] }}">
                        @endif
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        @if (empty($user['u_id']))
                            <input type="text" class="form-control" name="u_email" id="u_email" value="{{ old('u_email') }}">
                        @else
                            <input type="text" class="form-control" name="u_email" id="u_email" value="{{ $user['u_email'] }}">
                        @endif
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="image" class="col-sm-2 form-label">上傳大頭貼</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="file" id="image" name="u_image">
                    </div>
                </div>

                @if (!empty($user['u_image']))
                <div class="mb-3 row">
                    <div class="col-sm-8 offset-md-4">
                        <img src="{{ asset($user['u_image']) }}" />
                    </div>
                </div>
                @endif

                <div id="alert-box" class="mb-3 row" style="display: none">
                    <div class="alert alert-warning" role="alert" id="alert-message"></div>
                </div>
            </form>

            <div class="mb-3 row">
                <div class="col-sm-12">
                    @if (!empty($user['u_id']))
                        <button type="submit" class="btn btn-danger float-start" form="deleteForm">Delete</button>
                    @endif
                    <button type="submit" class="btn btn-primary float-end" form="userForm">Save</button>
                </div>
            </div>
        </div>
    </div>

    @if (!empty($user['u_id']))
    <form name="deleteForm" id="deleteForm"
          method="post"
          onsubmit="return userDelete()"
          action="{{ $deleteRoute }}">
        @csrf
        @method('delete')
        <input type="hidden" name="u_id" value="{{ $user['u_id'] }}" />
    </form>
    @endif

@endsection

@section('script')
    <script>
        function userDelete() {
            return confirm('刪除此User？');
        }
        function formSubmit() {
            let form = document.forms['userForm'];
            let uid = form.u_id.value;
            let account = form.u_account.value;
            let password = form.u_password.value;
            let name = form.u_name.value;
            let alert = '';
            let pass = true;
            let passwordNeedValid = true;

            if (uid != 0 && password.length == 0) {
                passwordNeedValid = false;
            }

            document.getElementById('alert-box').style.display = 'none';
            document.getElementById('alert-message').innerHTML = '';

            if (uid == 0) {
                if (account == '') {
                    alert = '請輸入Account';
                    pass = false;
                }
            }

            if (passwordNeedValid) {
                if (password.length <= 5 || password.length >= 33) {
                    alert = '請輸入account 6~32字元';
                    pass = false;
                }
            }

            if (name == '') {
                alert = '請輸入Name';
                pass = false;
            }

            if (!pass) {
                document.getElementById('alert-box').style.display = 'block';
                document.getElementById('alert-message').innerHTML = alert;
            }

            return pass;
        }
    </script>
@endsection
