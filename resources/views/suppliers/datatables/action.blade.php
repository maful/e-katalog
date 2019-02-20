<form action="{{ route('suppliers.destroy', $supplier->id) }}" method="post">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <a class="btn btn-sm btn-secondary" href="{{ route('suppliers.edit', $supplier->id) }}">Edit</a>
    <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Yakin ingin menghapus data?')">Hapus</button>
</form>
