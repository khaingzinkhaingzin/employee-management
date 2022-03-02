@forelse ($data as $key => $value)
@if ($value->id != 1)
<tr>
    <td>{{ $data->firstItem() + $key }}</td>
    <td>{{ $value->first_name }}</td>
    <td>{{ $value->last_name }}</td>
    <td>{{ $value->company ? $value->company->name : '-' }}</td>
    <td>{{ $value->department ? $value->department->name : '-' }}</td>
    <td>{{ $value->staff_id }}</td>
    <td class="action">
        <a  href="{{route('admin.employee.show', $value->id)}}" class="btn btn-sm" title="Detail">
            <i class="fas fa-info-circle text-info"></i>
        </a>
        @can('update-employee')
        <a data-href="{{ route('admin.employee.edit', $value->id) }}" href="#" class="btn btn-sm edit" data-toggle="tooltip" data-placement="top" title="Edit">
            <i class="fas fa-edit text-warning"></i>
        </a>
        @endcan
        @can('delete-employee')
        <a href="#" class="btn btn-sm delete" data-id="{{$value->id}}" data-toggle="tooltip" data-placement="top" title="Delete">
            <i class="fas fa-trash-alt text-danger"></i>
        </a>
        @endcan
    </td>
</tr>
@endif
@empty
    
@endforelse