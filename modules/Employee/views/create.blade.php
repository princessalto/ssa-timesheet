@extends('Pluma::layouts.admin')

@section("content")
    <div class="content-wrapper">
        @include("Pluma::partials.breadcrumb")

        <section class="content">
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    @include("Pluma::partials.flash")
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Employee</h3>
                        </div>
                        <form action="{{ action('\Modules\Employee\EmployeeController@store') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="box-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label">First Name</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" value="{{ old('firstname') }}">
                                        @include("Pluma::errors.span", ['field' => 'firstname'])
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 control-label">Last Name</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" value="{{ old('lastname') }}">
                                        @include("Pluma::errors.span", ['field' => 'lastname'])
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 control-label">Username</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="{{ old('username') }}">
                                        @include("Pluma::errors.span", ['field' => 'username'])
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 control-label">Email Address</label>
                                    <div class="col-md-10">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" value="{{ old('email') }}">
                                        @include("Pluma::errors.span", ['field' => 'email'])
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 control-label">Department</label>
                                    <div class="col-md-10">
                                        <select name="department_id" id="department_id" class="form-control">
                                            @foreach ( $departments as $id => $department )
                                            <option value="{{ $id }}" {{ old('department_id') == $id ? 'selected="selected"' : '' }}>{{ $department }}</option>
                                            @endforeach
                                        </select>
                                        @include("Pluma::errors.span", ['field' => 'department_id'])
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 control-label">Designation</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" id="designation" name="designation" placeholder="Username" value="{{ old('designation') }}">
                                        @include("Pluma::errors.span", ['field' => 'designation'])
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 control-label">Password</label>
                                    <div class="col-md-10">

                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="{{ old('password') }}">
                                        @include("Pluma::errors.span", ['field' => 'password'])
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label">Confirm Password</label>
                                    <div class="col-md-10">
                                        <input type="password" class="form-control" id="password" name="password_confirmation" placeholder="Confirm Password">
                                        @include("Pluma::errors.span", ['field' => 'password_confirmation'])
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 control-label">Role</label>
                                    <div class="col-md-10">
                                        <div class="control-group input-default">
                                            <select name="role_id" id="tag-role" class="demo-default">
                                                @foreach ( $roles as $id => $role )
                                                <option value="{{ $id }}" {{ old('role_id') == $id ? 'selected="selected"' : '' }}>{{ $role }}</option>
                                                @endforeach
                                            </select>
                                            @include("Pluma::errors.span", ['field' => 'role_id'])
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary pull-right">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </section>
    </div>

@stop

@push('css')
    <link rel="stylesheet" href="{{ asset('vendor/selectize.js/dist/css/selectize.css') }}">
    <script src="{{ asset('vendor/selectize.js/dist/js/standalone/selectize.min.js') }}"></script>
@endpush

@push('js')
    <script src="{{ asset('vendor/selectize.js/dist/js/selectize.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/admin-lte/dist/js/app.min.js') }}"></script>

    <script>
        $('#tag-role').selectize({
            delimiter: ',',
            persist: false,
            maxItems: 2,
        });
    </script>
@endpush