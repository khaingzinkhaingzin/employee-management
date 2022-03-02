@extends('layouts.app')

@section('title', 'Employee Detail')

@section('css')
<style>
   
</style>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Employee Detail</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <div id="show_info_item"></div>
                            <table class="table table-bordered table-striped">
                                <thead class="text-white">
                                    <tr class="bg-info">
                                        <th width="40%">Name</th>
                                        <th width="60%">Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Employee Name</td>
                                        <td>{{ $item->first_name }} {{ $item->first_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>{{ $item->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        <td>{{ $item->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td>Staff Id</td>
                                        <td>{{ $item->staff_id }}</td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td>{{ $item->address }}</td>
                                    </tr>
                                    <tr>
                                        <td>Company</td>
                                        <td>{{ $item->company ? $item->company->name : '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Department</td>
                                        <td>{{ $item->department ? $item->department->name : '-' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop