@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Taxes Import/Export</div>
                    <div class="card-body">
                        <a href="{{ route("taxes.data.export") }}" class="btn btn-success">Export All Taxes</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
