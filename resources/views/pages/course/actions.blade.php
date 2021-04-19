@if (!$deleted_at)
    <a href="{{ route('course.edit', $id) }}">Edit</a>
    <br>
@endif
<form action="{{ route('course.destroy', $id) }}" method="post">
    @csrf
    @method('DELETE')
    @if ($deleted_at)
        <button type="submit" class="text-success btn btn-link"
            onclick="return confirm('Do you confirm restore this record?')">Restore</button>
    @else
        <button type="submit" class="text-danger btn btn-link"
            onclick="return confirm('Do you confirm delete this record?')">Delete</button>
    @endif
</form>
