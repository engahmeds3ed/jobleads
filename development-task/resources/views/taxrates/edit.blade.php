@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Tax Rates
                        <a href="{{route('taxrates.index')}}" class="float-right btn btn-sm btn-info">Back to List</a>
                    </div>
                    <div class="card-body">
                        @if(\Illuminate\Support\Facades\Session::has('message'))
                            <div class="alert alert-info">{{ \Illuminate\Support\Facades\Session::get('message') }}</div>
                        @endif

                        <form method="post" action="{{route('taxrates.update', [$item->id])}}" enctype="multipart/form-data">
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
                                <label for="item_amount">Percentage</label>
                                <input id="item_amount" type="text" name="amount" value="{{old('amount', $item->amount)}}" class="form-control">
                                @if ($errors->has('amount'))
                                    <div class="alert alert-danger">
                                        {{ $errors->first('amount') }}
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
