@extends('layouts.app')

@section('page-title', 'List Produk')

@section('content-app')
<div class="row align-items-center mb-5">
    <div class="col-lg order-lg-first">
        @if(! empty($filter))
            @if ($filter['search'] != "")
                <h4><span class="font-weight-normal">Pencarian:</span> {{ $filter['search'] }}</h4>
            @endif
        @endif
    </div>
    <div class="col-lg-3 ml-auto">
        <form method="GET" action="{{ url('/') }}" class="input-icon my-3 my-lg-0">
            <input type="search" name="search" class="form-control header-search" placeholder="Cari..." tabindex="1">
            <div class="input-icon-addon">
                <i class="fe fe-search"></i>
            </div>
        </form>
    </div>
</div>
<div class="row">
    @if (count($products) > 0)
        @foreach ($products as $product)
            <div class="col-md-3 col-sm-4">
                <div class="card card-custom">
                    <div class="card-image">
                        <img src="{{ $product->image_url }}" alt="Gambar {{ $product->nama }}">
                    </div>
                    <div class="card-body d-flex flex-column text-center">
                        <h4>{{ $product->nama }}</h4>
                        <h3 class="font-weight-normal text-red">{{ format_rupiah($product->harga_jual) }}</h3>
                        <div class="text-muted">Supplier: <a href="{{ url('/?supplier=' .$product->supplier_id) }}">{{ $product->supplier->nama }}</a></span></div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="col-12">
            {{ $products->links() }}
        </div>
    @else
        <div class="col">
            <div class="alert alert-info" role="alert">
                List Produk tidak ditemukan.
            </div>
        </div>
    @endif
</div>
@endsection
