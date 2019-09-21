@extends('layouts.app')

@section('stylesheets')
    <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('javascripts')
    <script type="text/javascript" src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" defer></script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Taxes
                        <a href="{{route('taxes.create')}}" class="float-right btn btn-sm btn-info">Add New</a>
                    </div>
                    <div class="card-body">
                        <table width="100%" class="table datatable" data-ajaxurl="{{ route('taxes.datatable') }}">
                            <thead>
                            <th>#</th>
                            <th>Amount</th>
                            <th>County</th>
                            <th>State</th>
                            <th>Country</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                            <th>#</th>
                            <th>Amount</th>
                            <th>County</th>
                            <th>State</th>
                            <th>Country</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
