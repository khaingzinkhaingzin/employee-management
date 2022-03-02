@forelse ($data as $key => $value)
<tr>
    <td>{{ $data->firstItem() + $key }}</td>
    <td>{{ $value->name }}</td>
    <td class="action">
        {{-- @can('company-list')
        <a  href="{{route('admin.data.show', $value->id)}}" class="btn btn-xs" title="Detail">
            <i class="fas fa-info-circle text-info"></i>
        </a>
        @endcan --}}
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
</tr>
@empty
    
@endforelse