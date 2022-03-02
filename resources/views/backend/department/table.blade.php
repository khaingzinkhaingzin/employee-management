@forelse ($data as $key => $value)
<tr>
    <td>{{ $data->firstItem() + $key }}</td>
    <td>{{ $value->name }}</td>
    @if (auth()->user()->hasRole('Admin'))
    <td class="action">
        @can('update-department')
        <a data-href="{{ route('admin.department.edit', $value->id) }}" href="#" class="btn btn-sm edit" data-toggle="tooltip" data-placement="top" title="Edit">
            <i class="fas fa-edit text-warning"></i>
        </a>
        @endcan
        @can('delete-department')
        <a href="#" class="btn btn-sm delete" data-id="{{$value->id}}" data-toggle="tooltip" data-placement="top" title="Delete">
            <i class="fas fa-trash-alt text-danger"></i>
        </a>
        @endcan
    </td>
    @endif
</tr>
@empty
<tr>
    @if (auth()->user()->hasRole('Admin'))
    <td colspan="3">
        <h5 class="text-muted text-center">There is no record. </h5>
    </td>
    @else
    <td colspan="2">
        <h5 class="text-muted text-center">There is no record. </h5>
    </td>
    @endif
</tr>
@endforelse