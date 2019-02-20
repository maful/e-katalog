@extends('layouts.app')

@section('content-app')
<div class="row row-cards row-deck">
    <div class="col-10 offset-md-1">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Supplier</h3>
                <div class="card-options">
                    <a href="{{ route('suppliers.index') }}" class="btn btn-sm btn-pill btn-secondary"><i class="fe fe-arrow-left mr-2"></i>Kembali</a>
                </div>
            </div>
            <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
                @csrf
                {{ method_field('PATCH') }}
                <div class="card-body">
                    <div class="form-group">
                        <div class="row align-items-center">
                            <label class="col-sm-2">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" name="nama" autocomplete="off" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" required value="{{ old('nama', $supplier->nama) }}">
                                @if ($errors->has('nama'))
                                    <span class="invalid-feedback">{{ $errors->first('nama') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row align-items-center">
                            <label class="col-sm-2">Email</label>
                            <div class="col-sm-10">
                                <input type="email" name="email" autocomplete="off" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required value="{{ old('email', $supplier->email) }}">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row align-items-center">
                            <label class="col-sm-2">Kota Asal</label>
                            <div class="col-sm-10">
                                <select class="form-control{{ $errors->has('city_id') ? ' is-invalid' : '' }}" id="select2" name="city_id" required>
                                    <option value="">-- Pilih --</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}"{!! (old('city_id', $supplier->city_id) == $city->id ? " selected=\"selected\"" : "") !!}>{{ $city->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('city_id'))
                                    <span class="invalid-feedback">{{ $errors->first('city_id') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row align-items-center">
                            <label class="col-sm-2">Tahun Kelahiran</label>
                            <div class="col-sm-2">
                                <input type="text" id="onlyear" required name="tahun_lahir" autocomplete="off" class="form-control{{ $errors->has('tahun_lahir') ? ' is-invalid' : '' }}" value="{{ old('tahun_lahir', $supplier->tahun_lahir) }}">
                                @if ($errors->has('tahun_lahir'))
                                    <span class="invalid-feedback">{{ $errors->first('tahun_lahir') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Simpan Supplier</button>
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
require(['jquery', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/i18n/id.js'], function ($, select2, select2id) {
    $(document).ready(function () {
        $('#select2').select2({
            theme: "bootstrap",
            language: "id"
        });
    });
});
</script>
@endsection
