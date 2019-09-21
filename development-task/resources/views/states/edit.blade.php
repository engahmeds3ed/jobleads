@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        States
                        <a href="{{route('states.index')}}" class="float-right btn btn-sm btn-info">Back to List</a>
                    </div>
                    <div class="card-body">
                        @if(\Illuminate\Support\Facades\Session::has('message'))
                            <div class="alert alert-info">{{ \Illuminate\Support\Facades\Session::get('message') }}</div>
                        @endif

                        <form method="post" action="{{route('states.update', [$item->id])}}" enctype="multipart/form-data">
                            @csrf
                            @method("patch")

                            <div class="form-group">
                                <label for="item_name">Name</label>
                                <input id="item_name" type="text" name="name" value="{{old('name', $item->name)}}" class="form-control">
                                @if ($errors->has('name'))
                                    <div class="alert alert-danger">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="item_code">Code</label>
                                <input id="item_code" type="text" name="code" value="{{old('code', $item->code)}}" class="form-control">
                                @if ($errors->has('code'))
                                    <div class="alert alert-danger">
                                        {{ $errors->first('code') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="item_country">Country</label>
                                <select id="item_country" name="country_id" class="form-control">
                                    @foreach($countries as $id => $name)
                                        <option value="{{ $id }}" @if(old("country_id", $item->country_id) == $id) selected="selected" @endif>{{ $name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('country_id'))
                                    <div class="alert alert-danger">
                                        {{ $errors->first('country_id') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Update Item">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
