<a href="{{ route($route . ".edit", $item->id) }}" class='edit btn btn-secondary btn-sm' style="margin-left: 5px">Edit</a>
<form action="{{ route($route . ".destroy", $item->id) }}" method="POST" class="float-left">
    @method('DELETE')
    @csrf
    <button type="submit" class="delete btn btn-danger btn-sm" onclick="return confirm('Delete record?');">Delete</button>
</form>
