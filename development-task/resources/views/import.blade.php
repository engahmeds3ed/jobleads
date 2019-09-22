@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Taxes Import/Export</div>
                    <div class="card-body">
                        @if(\Illuminate\Support\Facades\Session::has('message'))
                            <div class="alert alert-info">{{ \Illuminate\Support\Facades\Session::get('message') }}</div>
                        @endif
                        <form action="{{ route('taxes.data.import') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="import_file" class="form-control">
                            <br>
                            <button class="btn btn-success">Import Taxes Data</button>
                            <a class="btn btn-warning" href="{{ route('taxes.data.export') }}">Export Taxes Data</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
