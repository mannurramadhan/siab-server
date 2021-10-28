@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('update.kelas') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                @csrf
                @method('post')
                    <div class="card">
                        <div class="card-header">
                            <strong>Edit</strong> Data Kelas
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
                                <div class="col col-md-2">
                                    <label for="tingkat_kelas" class=" form-control-label">Tingkat Kelas</label>
                                </div>
                                <div class="col-12 col-md-3">
                                    <select name="tingkat_kelas" id="tingkat_kelas" class="form-control-sm form-control" required>   
                                        <option value="">Pilih Kelas</option>
                                        <option value="XII">XII</option>
                                        <option value="XI">XI</option>
                                        <option value="X">X</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-2">
                                    <label for="jurusan" class=" form-control-label">Jurusan</label>
                                </div>
                                <div class="col-12 col-md-3">
                                    <select name="jurusan" id="jurusan" class="form-control-sm form-control" required> 
                                        <option value="">Pilih Jurusan</option>
                                        <option value="IPA">IPA</option>
                                        <option value="IPS">IPS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-2">
                                    <label for="nomor_kelas" class=" form-control-label">Nomor Kelas</label>
                                </div>
                                <div class="col-12 col-md-3">
                                    <select name="nomor_kelas" id="nomor_kelas" class="form-control-sm form-control" required>
                                        <option value="">Pilih Nomor Kelas</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-12">
                                    <!-- USER DATA-->
                                    <div class="user-data m-b-30">
                                        <h3 class="title-3 m-b-30">
                                        <i class="zmdi zmdi-account-calendar"></i>Daftar Siswa</h3>
                                        <div class="filters m-b-45">
                                            <div class="rs-select2--dark rs-select2--md m-r-10 rs-select2--border">
                                                <select class="js-select2" name="filter_kelas">
                                                    <option selected="selected">Semua Kelas</option>
                                                    <option value="">Belum Ada Kelas</option>
                                                    <option value="XII">XII</option>
                                                    <option value="XI">XI</option>
                                                    <option value="X">X</option>
                                                </select>
                                                <div class="dropDownSelect2"></div>
                                            </div>
                                        </div>
                                        <div class="table-responsive table-data">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <td>
                                                            <label class="au-checkbox">
                                                                <input type="checkbox">
                                                                <span class="au-checkmark"></span>
                                                            </label>
                                                        </td>
                                                        <td class="text-center">NIS</td>
                                                        <td>Nama Siswa</td>
                                                        <td class="text-center">Kelas</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($edit as $kelas)
                                                    <tr>
                                                        <td>
                                                            <label class="au-checkbox">
                                                                <input name="list_siswa[]" value="{{ $kelas->Id_Siswa }}" type="checkbox">
                                                                <span class="au-checkmark"></span>
                                                            </label>
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $kelas->NIS }}
                                                        </td>
                                                        <td>
                                                            <div class="table-data__info">
                                                                <h6>{{ $kelas->Nama_Siswa }}</h6>
                                                                <span>
                                                                    <a href="#">{{ $kelas->NISN }}</a>
                                                                </span>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            @if($kelas->Id_Kelas == 0)
                                                                <span class="role admin">Belum Ada Kelas</span>
                                                            @elseif($kelas->Jurusan == 'IPA')
                                                                <span class="role user">
                                                                    {{ $kelas->Tingkat_Kelas }}
                                                                    {{ $kelas->Jurusan }}
                                                                    {{ $kelas->Nomor_Kelas }}
                                                                </span>
                                                            @elseif($kelas->Jurusan == 'IPS')
                                                                <span class="role member">
                                                                    {{ $kelas->Tingkat_Kelas }}
                                                                    {{ $kelas->Jurusan }}
                                                                    {{ $kelas->Nomor_Kelas }}
                                                                </span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- END USER DATA-->
                                </div>
                            </div>                          
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-dot-circle-o"></i> {{ __('Simpan') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection