<div class="modal-content">
    <div class="modal-header">
        @if (!isset($old_data))
        <h5 class="modal-title mt-0">New Department</h5>
        @else
        <h5 class="modal-title mt-0">Edit Department</h5>
        @endif
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @if (!isset($old_data))
    <form action="{{ route('admin.department.store') }}" method="POST" id='form' autocomplete="off">
    @else
    <form action="{{ route('admin.department.update', $old_data->id) }}" method="POST" id='form' autocomplete="off">
    @if (isset($old_data)) @method('PUT') @endif
    @endif
        @csrf
        <div class="modal-body" style="overflow: hidden;">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="text" name="name" @if (isset($old_data)) value="{{ $old_data->name }}" @endif autofocus>
                </div>
            </div>              
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm waves-effect" data-dismiss="modal">Cancel</button>
            <button type="submit" id="saveForm" class="btn btn-sm btn-success">@if (isset($old_data)) Update @else Create @endif</button>
        </div>
    </form>
</div>

@if (!isset($old_data))
{!! JsValidator::formRequest('App\Http\Requests\StoreDepartment', '#form') !!}
@else
{!! JsValidator::formRequest('App\Http\Requests\UpdateDepartment', '#form') !!}
@endif