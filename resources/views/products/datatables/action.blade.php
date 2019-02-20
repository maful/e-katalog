<form action="{{ route('products.destroy', $product->id) }}" method="post">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <a class="btn btn-sm btn-secondary" href="{{ route('products.edit', $product->id) }}">Edit</a>
    <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Yakin ingin menghapus data?')">Hapus</button>
</form>
