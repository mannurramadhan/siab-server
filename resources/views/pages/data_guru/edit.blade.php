@extends('layouts.app', [
    'class' => '',
    'title' => 'Edit Data Guru - SIAB SMAN 2 BALIKPAPAN',
    'titlepage' => 'Edit Data Guru',
    'elementActive' => 'ldg'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
            @foreach($edit as $guru)
                <form action="{{ route('update.guru') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                @csrf
                @method('post')
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('Formulir Data Guru') }}</h4>
                        </div>
                        <div class="card-body card-block">
                        @if (session('success'))
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="alert alert-success" role="alert">
                                        <span>{{ session('success') }}</span>
                                    </div>
                                </div>
                            </div>
                        @elseif (session('failed'))
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="alert alert-danger">
                                        <span>{{ session('failed') }}</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                            <div class="row form-group">
                                <div class="col col-sm-4">
                                    <label for="nip" class=" form-control-label">NIP</label>
                                    <input type="text" value="{{ $guru->Id_Guru }}" id="id_guru" name="id_guru" class="input-sm form-control-sm form-control" hidden>
                                    <input type="text" value="{{ $guru->NIP }}" id="nip" name="nip" placeholder="NIP" class="input-sm form-control-sm form-control" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-sm-4">
                                    <label for="niph" class=" form-control-label">NIPH</label>
                                    <input type="text" value="{{ $guru->NIPH }}" id="niph" name="niph" placeholder="NISN" class="input-sm form-control-sm form-control" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-sm-4">
                                    <label for="nama_guru" class=" form-control-label">Nama Guru</label>
                                    <input type="text" value="{{ $guru->Nama_Lengkap }}" id="nama_guru" name="nama_guru" placeholder="Nama Guru" class="input-sm form-control-sm form-control" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-4">
                                    <label for="jenis_kelamin" class=" form-control-label">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                                        <optgroup label="Value :">
                                            <option value="{{ $guru->Jenis_Kelamin }}" selected>{{ $guru->Jenis_Kelamin }}</option>
                                        </optgroup>    
                                        <optgroup label="Pilih Jenis Kelamin :">
                                            <option value="L">Laki-laki</option>
                                            <option value="P">Perempuan</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-sm-4">
                                    <label for="tanggal_lahir" class=" form-control-label">Tanggal Lahir</label>
                                    <input type="date" value="{{ $guru->Tanggal_Lahir }}" id="tanggal_lahir" name="tanggal_lahir" class="input-sm form-control-sm form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-dot-circle-o"></i> {{ __('Simpan') }}
                            </button>
                        </div>
                    </div>
                </form>
            @endforeach
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
            demo.initChartsPages();
        });

        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        }, 5000);
    </script>
@endpush