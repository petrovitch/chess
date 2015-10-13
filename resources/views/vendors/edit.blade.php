@extends('master')
@section('name', 'Edit Vendor')

@section('content')
    <div class="container col-md-6 col-md-offset-3">
        <div class="well well bs-component">

            <form class="form-horizontal" method="post">
                {!! csrf_field() !!}
                <fieldset>
                    <legend>Edit Vendor</legend>

                    <div class="form-group">
                        <label for="vendor" class="col-lg-2 control-label">Vendor</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="vendor"
                                   placeholder="Vendor" name="vendor"
                                   value="{{ $vendor->vendor }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="street" class="col-lg-2 control-label">Street</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="street"
                                   placeholder="Street" name="street"
                                   value="{{ $vendor->street }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="city" class="col-lg-2 control-label">City</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="city"
                                   placeholder="City" name="city"
                                   value="{{ $vendor->city }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="state" class="col-lg-2 control-label">State</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="state"
                                   placeholder="AR" name="state"
                                   value="{{ $vendor->state }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="zip" class="col-lg-2 control-label">Zip</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="zip"
                                   placeholder="Zip" name="zip"
                                   value="{{ $vendor->zip }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="reset" class="btn btn-default">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </fieldset>

                @foreach ($errors->all() as $error)
                    <p class="alert alert-danger">{{ $error }}</p>
                @endforeach

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
            </form>
        </div>
    </div>
@endsection



