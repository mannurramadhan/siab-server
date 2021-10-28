@extends('layouts.app', [
    'class' => '',
    'title' => 'Input Data Siswa - SIAB SMAN 2 BALIKPAPAN',
    'titlepage' => 'Input Data Siswa',
    'elementActive' => 'ids'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('store.siswa') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                @csrf
                @method('post')
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('Formulir Data Siswa') }}</h4>
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
                                    <label for="nis" class=" form-control-label">NIS</label>
                                    <input type="text" id="nis" name="nis" placeholder="NIS" class="input-sm form-control-sm form-control" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-sm-4">
                                    <label for="nisn" class=" form-control-label">NISN</label>
                                    <input type="text" id="nisn" name="nisn" placeholder="NISN" class="input-sm form-control-sm form-control" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-sm-4">
                                    <label for="nama_siswa" class=" form-control-label">Nama Siswa</label>
                                    <input type="text" id="nama_siswa" name="nama_siswa" placeholder="Nama Siswa" class="input-sm form-control-sm form-control" required>
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
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-dot-circle-o"></i> {{ __('Simpan') }}
                            </button>
                        </div>
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