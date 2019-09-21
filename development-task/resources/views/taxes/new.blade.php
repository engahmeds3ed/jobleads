@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Taxes
                        <a href="{{route('taxes.index')}}" class="float-right btn btn-sm btn-info">Back to List</a>
                    </div>
                    <div class="card-body">
                        @if(\Illuminate\Support\Facades\Session::has('message'))
                            <div class="alert alert-info">{{ \Illuminate\Support\Facades\Session::get('message') }}</div>
                        @endif

                            <form method="post" action="{{route('taxes.store')}}" enctype="multipart/form-data">
                            @csrf
                                @method("post")
                                <div class="form-group">
                                    <label for="item_amount">Amount</label>
                                    <input id="item_amount" type="text" name="amount" value="{{old('amount')}}" class="form-control">
                                    @if ($errors->has('name'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('amount') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="item_rate">Tax Rate</label>
                                    <select id="item_rate" name="taxrate_id" class="form-control">
                                        @foreach($taxrates as $id => $name)
                                            <option value="{{ $id }}" @if(old("taxrate_id") == $id) selected="selected" @endif>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('taxrate_id'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('taxrate_id') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="item_county">County</label>
                                    <select id="item_county" name="county_id" class="form-control">
                                        @foreach($countries as $country)
                                            <optgroup label="{{$country->name}}">
                                                @if($country->states)
                                                    @foreach($country->states as $state)
                                                        <optgroup label=">> {{$state->name}}">
                                                            @if($state->counties)
                                                                @foreach($state->counties as $county)
                                                                    <option value="{{ $county->id }}" @if(old("county_id") == $county->id) selected="selected" @endif>{{ $county->name }}</option>
                                                                @endforeach
                                                            @endif
                                                        </optgroup>
                                                    @endforeach
                                                @endif
                                            </optgroup>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('county_id'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('county_id') }}
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
