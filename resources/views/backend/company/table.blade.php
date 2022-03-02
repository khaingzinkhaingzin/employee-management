@forelse ($companies as $key => $value)
<tr>
    <td>{{ $companies->firstItem() + $key }}</td>
    <td>{{ $value->name }}</td>
    <td>{{ $value->email }}</td>
    <td>{{ $value->address }}</td>
    <td class="action">
        {{-- @can('company-list')
        <a  href="{{route('admin.companies.show', $value->id)}}" class="btn btn-xs" title="Detail">
            <i class="fas fa-info-circle text-info"></i>
        </a>
        @endcan --}}
        @can('update-company')
        <a data-href="{{ route('admin.company.edit', $value->id) }}" href="#" class="btn btn-xs edit" data-toggle="tooltip" data-placement="top" title="Edit">
            <i class="fas fa-edit text-warning"></i>
        </a>
        @endcan
        @can('delete-company')
        <a href="#" class="btn btn-xs delete" data-id="{{$value->id}}" data-toggle="tooltip" data-placement="top" title="Delete">
            <i class="fas fa-trash-alt text-danger"></i>
        </a>
        @endcan
    </td>
</tr>
@empty
    
@endforelse