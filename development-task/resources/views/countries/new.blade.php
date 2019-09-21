@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Countries
                        <a href="{{route('countries.index')}}" class="float-right btn btn-sm btn-info">Back to List</a>
                    </div>
                    <div class="card-body">
                        @if(\Illuminate\Support\Facades\Session::has('message'))
                            <div class="alert alert-info">{{ \Illuminate\Support\Facades\Session::get('message') }}</div>
                        @endif

                            <form method="post" action="{{route('countries.store')}}" enctype="multipart/form-data">
                            @csrf
                                @method("post")
                                <div class="form-group">
                                    <label for="country_name">Name</label>
                                    <input id="country_name" type="text" name="name" value="{{old('name')}}" class="form-control">
                                    @if ($errors->has('name'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="country_code">Code</label>
                                    <input id="country_code" type="text" name="code" value="{{old('code')}}" class="form-control">
                                    @if ($errors->has('code'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('code') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Save Item">
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection