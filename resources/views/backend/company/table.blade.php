@forelse ($companies as $key => $value)
<tr>
    <td>{{ $companies->firstItem() + $key }}</td>
    <td>{{ $value->name }}</td>
    <td>{{ $value->email }}</td>
    <td>{{ $value->address }}</td>
    @if (auth()->user()->hasRole('Admin'))
    <td class="action">
        @can('update-company')
        <a data-href="{{ route('admin.company.edit', $value->id) }}" href="#" class="btn btn-sm edit" data-toggle="tooltip" data-placement="top" title="Edit">
            <i class="fas fa-edit text-warning"></i>
        </a>
        @endcan
        @can('delete-company')
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
    <td colspan="5">
        <h5 class="text-muted text-center">There is no record. </h5>
    </td>
    @else
    <td colspan="4">
        <h5 class="text-muted text-center">There is no record. </h5>
    </td>
    @endif
</tr>
@endforelse