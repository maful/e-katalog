@extends('layouts.app')

@section('content-app')
<div class="row row-cards row-deck">
    <div class="col-10 offset-md-1">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah Produk</h3>
                <div class="card-options">
                    <a href="{{ route('products.index') }}" class="btn btn-sm btn-pill btn-secondary"><i class="fe fe-arrow-left mr-2"></i>Kembali</a>
                </div>
            </div>
            <form action="{{ route('products.store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <div class="row align-items-center">
                            <label class="col-sm-2">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" name="nama" autocomplete="off" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" required value="{{ old('nama') }}">
                                @if ($errors->has('nama'))
                                    <span class="invalid-feedback">{{ $errors->first('nama') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row align-items-center">
                            <label class="col-sm-2">Supplier</label>
                            <div class="col-sm-10">
                                <select class="form-control{{ $errors->has('supplier_id') ? ' is-invalid' : '' }}" id="select2" name="supplier_id" required>
                                    <option value="">-- Pilih --</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}" {!! (old('supplier_id') == $supplier->id ? "selected=\"selected\"" : "") !!}>{{ $supplier->nama }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('supplier_id'))
                                    <span class="invalid-feedback">{{ $errors->first('supplier_id') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row align-items-center">
                            <label class="col-sm-2">Harga Jual</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </span>
                                    <input type="number" name="harga_jual" autocomplete="off" class="form-control{{ $errors->has('harga_jual') ? ' is-invalid' : '' }}" required value="{{ old('harga_jual') }}">
                                    @if ($errors->has('harga_jual'))
                                        <span class="invalid-feedback">{{ $errors->first('harga_jual') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row align-items-center">
                            <label class="col-sm-2">Status</label>
                            <div class="col-sm-10">
                                <div class="custom-controls-stacked">
                                    <label class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" value="1"{!! old('status') == '1' ? ' checked=""' : '' !!}>
                                        <span class="custom-control-label">Aktif</span>
                                    </label>
                                    <label class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" value="0"{!! old('status') == '1' ? '' : ' checked=""' !!}>
                                        <span class="custom-control-label">Nonaktif</span>
                                    </label>
                                </div>
                                @if ($errors->has('status'))
                                    <span class="invalid-feedback">{{ $errors->first('status') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row align-items-center">
                            <label class="col-sm-2">Gambar</label>
                            <div class="col-sm-4">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input{{ $errors->has('gambar') ? ' is-invalid' : '' }}" id="imgProduct" name="gambar" aria-describedby="fileHelpBlock">
                                    <label class="custom-file-label">Choose file</label>
                                    <small id="fileHelpBlock" class="form-text text-muted">
                                        Maksimal 1MB dengan ekstensi jpeg, png, jpg
                                    </small>
                                    @if ($errors->has('gambar'))
                                        <span class="invalid-feedback">{{ $errors->first('gambar') }}</span>
                                    @endif
                                </div>
                                <img id="img_preview" class="mt-3 d-none" style="width: 100px;" src="#" alt="your image" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Tambah Produk</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://select2.github.io/select2-bootstrap-theme/css/select2-bootstrap.css">

<script>
require(['jquery', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js'], function ($, select2) {
    $(document).ready(function () {
        $('#select2').select2({
            theme: "bootstrap"
        });
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img_preview').removeClass("d-none");
                $('#img_preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgProduct").change(function(){
        readURL(this);
    });
});
</script>
@endsection
