@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Counties
                        <a href="{{route('counties.index')}}" class="float-right btn btn-sm btn-info">Back to List</a>
                    </div>
                    <div class="card-body">
                        @if(\Illuminate\Support\Facades\Session::has('message'))
                            <div class="alert alert-info">{{ \Illuminate\Support\Facades\Session::get('message') }}</div>
                        @endif

                            <form method="post" action="{{route('counties.store')}}" enctype="multipart/form-data">
                            @csrf
                                @method("post")
                                <div class="form-group">
                                    <label for="item_name">Name</label>
                                    <input id="item_name" type="text" name="name" value="{{old('name')}}" class="form-control">
                                    @if ($errors->has('name'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="item_code">Code</label>
                                    <input id="item_code" type="text" name="code" value="{{old('code')}}" class="form-control">
                                    @if ($errors->has('code'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('code') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="item_state">State</label>
                                    <select id="item_state" name="state_id" class="form-control">
                                        @foreach($countries as $country)
                                            <optgroup label="{{$country->name}}">
                                                @if($country->states)
                                                    @foreach($country->states as $state)
                                                    <option value="{{ $state->id }}" @if(old("state_id") == $state->id) selected="selected" @endif>{{ $state->name }}</option>
                                                    @endforeach
                                                @endif
                                            </optgroup>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('state_id'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('state_id') }}
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
