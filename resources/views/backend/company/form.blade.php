<div class="modal-content">
    <div class="modal-header">
        @if (!isset($old_data))
        <h5 class="modal-title mt-0">New Company</h5>
        @else
        <h5 class="modal-title mt-0">Edit Company</h5>
        @endif
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @if (!isset($old_data))
    <form action="{{ route('admin.company.store') }}" method="POST" id='form' autocomplete="off">
    @else
    <form action="{{ route('admin.company.update', $old_data->id) }}" method="POST" id='form' autocomplete="off">
    @if (isset($old_data)) @method('PUT') @endif
    @endif
        @csrf
        <div class="modal-body" style="overflow: hidden;">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="text" name="name" @if (isset($old_data)) value="{{ $old_data->name }}" @endif autofocus>
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" class="form-control" name="email" @if (isset($old_data)) value="{{ $old_data->email }}" @endif autofocus>
                </div>
                <div class="form-group">
                    <label for="">Address</label>
                    <textarea name="address" id="" class="form-control" rows="3">@if (isset($old_data)) {{ $old_data->address }} @endif</textarea>
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
{!! JsValidator::formRequest('App\Http\Requests\StoreCompany', '#form') !!}
@else
{!! JsValidator::formRequest('App\Http\Requests\UpdateCompany', '#form') !!}
@endif