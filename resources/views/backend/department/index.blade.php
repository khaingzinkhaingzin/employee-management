@extends('layouts.app')

@section('title', 'Department')

@section('css')
@parent
<style>
    .card-title, label {
        font-weight: 500 !important;
    }
    #table_data td {
        vertical-align: middle;
    }
    .card-header {
        background: #eee;
    }
    .card-header:first-child {
        border-radius: 0;
    }
</style>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Department List</h3>
                <div class="card-tools mr-0">
                    @can('create-department')
                    <a data-href="{{ route('admin.department.create')}}" href="#" class="float-right btn btn-success btn-sm" id="newButton"><i class="fa fa-plus mx-1"></i> create department</a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="{{ route('admin.department.index') }}" method="GET" autocomplete="off">
                            <div class="row mb-1">
                                <div class="col-sm-3 form-group">
                                    <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Search...">
                                </div>
                                <div class="col-sm-1 form-group">
                                    <select name="limits" id="limits" class="form-control">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                                <div class="col-sm-2 form-group">
                                    <a href="{{ route('admin.department.index') }}" class="btn btn-light">Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <div id="show_info_item"></div>
                            <table class="table table-bordered table-striped">
                                <thead class="text-white">
                                    <tr class="bg-info">
                                        <th>No#</th>
                                        <th>Name</th>
                                        @if (auth()->user()->hasRole('Admin'))
                                        <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody id="table_data"></tbody>
                            </table>
                            <div class="float-right" id="pagination_link"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="modal fade" id="ajaxModal" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('script')
    @parent
    <script>
    $(function () {        
        fetchData();

        function fetchData(page = 1) {
            let data = getRequestFilters();
            if (data.keyword != null) {
                $("#table_data").mark(data.keyword);
            }
            data.page = page;
            $.ajax({
                url: "/admin/department",
                type: "GET",
                data: data,
                dataType: "JSON",
                success: function (data) {
                    $('#show_info_item').html(data.showItemInfo);
                    setTimeout(() => {
                        $('#table_data').html(data.tableRowData);
                        $('#pagination_link').html(data.pagination);
                        let keyword = $("#keyword").val();
						// $("#table_data").mark(keyword);
                    }, 400);
                }
            });
        }

        $(document).on('click', '.pagination a', function(e){
			e.preventDefault(); 
			var page = $(this).attr('href').split('page=')[1];
			fetchData(page);
		});

        // show create modal form
        $(document).on('click', '#newButton', function(e) {
            e.preventDefault(); 
            let modal = $('#ajaxModal');
            let container = $('#ajaxModal .modal-body');
            let url = $(this).data('href');
            $.ajax({
                url: url,
                dataType: 'HTML',
                success: function(result) {
                    $(container).html(result);
                    $(modal).modal('show');
                },
            });
        });

        $(document).on('click', '.edit', function(e) {
            e.preventDefault(); 
            let modal = $('#ajaxModal');
            let container = $('#ajaxModal .modal-body');
            let url = $(this).data('href');
            $.ajax({
                url: url,
                dataType: 'HTML',
                success: function(result) {
                    $(container).html(result);
                    $(modal).modal('show');
                },
            });
        });

        $(document).on('click', '.delete', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this record!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dd3333',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Delete',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    let current_page_number = $('.page-item.active span').html();
                    let id = $(this).data('id');
                    $.ajax({
                        url: `/admin/department/${id}`,
                        type: 'JSON',
                        method: 'DELETE',
                        success: function (res) {
                            console.log(res);
                            if(res.status == 'success') {
                              fetchData(current_page_number);
                              toastr.success(res.message); 
                            }
                        }
                    });
                }
            });
        });

        function getRequestFilters(){
			return {
				keyword : $('#keyword').val(),
				limits : $('#limits').val(),
			}
		}

        $('#keyword').keyup(function(){
			fetchData();
            let keyword = $('#keyword').val();
            $("#table_data").mark(keyword);
		});

        $('body').on('change', '#limits', function(){
			fetchData();
		});
    });
</script>
@stop