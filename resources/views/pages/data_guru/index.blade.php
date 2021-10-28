@extends('layouts.app', [
    'class' => '',
    'title' => 'Lihat Data Guru - SIAB SMAN 2 BALIKPAPAN',
    'titlepage' => 'Lihat Data Guru',
    'elementActive' => 'ldg'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- DATA TABLE-->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Tabel Data Guru') }}</h4>
                        <a href="{{ route('create.guru') }}">
                            <button class="btn btn-success">
                                TAMBAH MANUAL
                            </button>
                        </a>

                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#importExcel">
			                IMPORT EXCEL
		                </button>

                        <a role="button" href="{{ route('export.guru') }}" class="btn btn-info" target="_blank">
			                EXPORT EXCEL
                        </a>

		                <!-- Import Excel -->
		                <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			                <div class="modal-dialog" role="document">
				                <form method="post" action="{{ route('import.guru') }}" enctype="multipart/form-data">
					                <div class="modal-content">
						                <div class="modal-header">
							                <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
						                </div>
						                <div class="modal-body">
 
							                {{ csrf_field() }}
 
							                <label>Pilih file excel</label>
							                <div class="form">
                                                <input type="file" class="form-control" name="dataGuru" required>
							                </div>
 
						                </div>
						                <div class="modal-footer">
							                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
							                <button type="submit" class="btn btn-primary">Import</button>
						                </div>
					                </div>
				                </form>
			                </div>
		                </div>
                    </div>
                    <div class="card-body">
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
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <th class="text-center">Id</th>
                                    <th class="text-center">NIP / NIPH</th>
                                    <th class="text-center">Nama Lengkap</th>
                                    <th class="text-center">JK</th>
                                    <th class="text-center">Aksi</th>
                                </thead>
                                <tbody>
                                @foreach($index as $guru)
                                    <tr>
                                        <td class="text-center">GU - {{ $guru->Id_Guru }}</td>
                                        @if($guru->NIP != 0)
                                            <td class="text-center">{{ $guru->NIP }}</td>
                                        @elseif($guru->NIPH != 0)
                                            <td class="text-center">{{ $guru->NIPH }}</td>
                                        @endif
                                        <td>{{ $guru->Nama_Lengkap }}</td>
                                        <td class="text-center">{{ $guru->Jenis_Kelamin }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-primary btn-link btn-sm" href="{{ route('edit.guru', ['id'=> $guru->Id_Guru]) }}" role="button">
                                                <i class="fa fa-edit"></i>&nbsp; Ubah</a>
                                            <a class="btn btn-danger btn-link btn-sm" href="{{ route('destroy.guru', ['id'=> $guru->Id_Guru]) }}" onclick="return confirm('Anda yakin ingin menghapus data ini?')" role="button">
                                                <i class="fa fa-eraser"></i>&nbsp; Hapus</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $index->links() }}
                        </div>
                    </div>
                </div>
                <!-- END DATA TABLE-->
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