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
                            <h3 class="box-title">Edit Employee</h3>
                        </div>

                        <form class="" action="{{ action('\Modules\Employee\EmployeeController@update', $resource->id) }}" method="POST">
                            {!! method_field('PUT') !!}
                            {{ csrf_field() }}
                            <div class="box-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label">First Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" value="{{ null !== old('firstname') ? old('firstname') : $resource->firstname }}">
                                        @include("Pluma::errors.span", ['field' => 'firstname'])
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 control-label">Last Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" value="{{ null !== old('lastname') ? old('lastname') : $resource->lastname }}">
                                        @include("Pluma::errors.span", ['field' => 'lastname'])
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 control-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="{{ null !== old('username') ? old('username') : $resource->username }}">
                                        @include("Pluma::errors.span", ['field' => 'username'])
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 control-label">Email Address</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" disabled="" value="{{ null !== old('email') ? old('email') : $resource->email }}">
                                        @include("Pluma::errors.span", ['field' => 'email'])
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Department</label>

                                    <div class="col-sm-10">
                                        <select name="department_id" class="form-control">
                                            @foreach ( $departments as $id => $department )
                                            <option value="{{ $id }}" {{ isset( $resource->detail ) && $resource->detail->department_id  == $id ? 'selected="selected"' : '' }}>{{ $department }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 control-label">Designation</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="designation" name="designation" placeholder="Designation" value="{{ null !== old('designation') ? old('designation') : $resource->detail->designation }}">
                                        @include("Pluma::errors.span", ['field' => 'designation'])
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 control-label">Role</label>
                                    <div class="col-sm-10">
                                        <select name="role_id[]" id="role_id" class="selectize" multiple>
                                            @foreach ( $roles as $id => $role )
                                            <option value="{{ $id }}" {{ isset($resource->roles) && $resource->roles->contains( $id ) ? 'selected="selected"' : '' }}>{{ $role }}</option>
                                            @endforeach
                                        </select>
                                        @include("Pluma::errors.span", ['field' => 'role_id'])
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary pull-right">Update</button>
                            </div>
                        </form>
                    </div>

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Change Password</h3>
                        </div>
                        <form class="" action="{{ action('\Modules\Employee\PasswordController@update', $resource->id) }}" method="POST">
                            {!! method_field('PUT') !!}
                            {{ csrf_field() }}
                            <div class="box-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label">Old Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="password" name="old_password" placeholder="Password" value="{{ old('old_password') }}">
                                        @include("Pluma::errors.span", ['field' => 'old_password'])
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 control-label">New Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                        @include("Pluma::errors.span", ['field' => 'password'])
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 control-label">Confirm Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="password" name="password_confirmation" placeholder="Confirm Password">
                                        @include("Pluma::errors.span", ['field' => 'password_confirmation'])
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary pull-right">Update</button>
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
@endpush

@push('js')
    <script type="text/javascript" src="{{ asset('vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/admin-lte/dist/js/app.min.js') }}"></script>
    <script src="{{ asset('vendor/selectize.js/dist/js/standalone/selectize.min.js') }}"></script>
    <script>
        $('.selectize').selectize({
            delimiter: ',',
            persist: false,
            maxItems: 2,
        });
    </script>
@endpush