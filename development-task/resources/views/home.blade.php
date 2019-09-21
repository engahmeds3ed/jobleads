@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                        <div>
                        <a class="btn btn-primary" href="{{ route('countries.index') }}">Countries</a>
                        <a class="btn btn-primary" href="{{ route('states.index') }}">States</a>
                        <a class="btn btn-primary" href="{{ route('counties.index') }}">Counties</a>
                        <a class="btn btn-primary" href="{{ route('taxrates.index') }}">Tax Rates</a>
                        <a class="btn btn-primary" href="{{ route('taxes.index') }}">Taxes</a>
                        <a class="btn btn-primary" href="{{ route('taxes.data') }}">Import/Export</a>
                        <a class="btn btn-danger" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
