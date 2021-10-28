@extends('layouts.app', [
    'class' => '',
    'title' => 'Input Data Guru - SIAB SMAN 2 BALIKPAPAN',
    'titlepage' => 'Input Data Guru',
    'elementActive' => 'idg'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('store.guru') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
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
                                <input type="text" id="nip" name="nip" placeholder="NIP" class="input-sm form-control-sm form-control" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-sm-4">
                                <label for="niph" class=" form-control-label">NIPH</label>
                                <input type="text" id="niph" name="niph" placeholder="NIPH" class="input-sm form-control-sm form-control" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-sm-4">
                                <label for="nama_guru" class=" form-control-label">Nama Guru</label>
                                <input type="text" id="nama_guru" name="nama_guru" placeholder="Nama Guru" class="input-sm form-control-sm form-control" required>
                                <input type="text" id="jabatan" name="jabatan" value="{{ __('Guru') }}" class="input-sm form-control-sm form-control" hidden>
                                <input type="text" id="foto" name="foto" value="{{ __('new-user.png') }}" class="input-sm form-control-sm form-control" hidden>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="jenis_kelamin" class=" form-control-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                                    <option value="0">Pilih Jenis Kelamin</option>
                                    <option value="L">Laki-laki</option>
                                   <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-sm-4">
                                <label for="tanggal_lahir" class=" form-control-label">Tanggal Lahir</label>
                                <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="input-sm form-control-sm form-control" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-sm-4">
                                <label for="email" class=" form-control-label">Email</label>
                                <input type="text" id="email" name="email" placeholder="Email" class="input-sm form-control-sm form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-dot-circle-o"></i> {{ __('Simpan') }}
                        </button>
                    </div>
                </form>
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