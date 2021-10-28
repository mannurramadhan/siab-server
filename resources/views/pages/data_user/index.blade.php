@extends('layouts.app', [
    'class' => '',
    'title' => 'Lihat Data User - SIAB SMAN 2 BALIKPAPAN',
    'titlepage' => 'Lihat Data User',
    'elementActive' => 'ldu'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- DATA TABLE-->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Tabel Data User') }}</h4>
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
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Aksi</th>
                                </thead>
                                <tbody>
                                @foreach($index as $user)
                                    <tr>
                                        <td class="text-center">US - {{ $user->id }}</td>
                                        <td class="text-center">{{ $user->nip_niph }}</td>
                                        <td>{{ $user->nama }}</td>
                                        <td class="text-center">{{ $user->email }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-primary btn-link btn-sm" href="{{ route('update.user', ['id'=> $user->id]) }}" onclick="return confirm('Anda yakin ingin reset password akun ini?')" role="button">
                                                <i class="fa fa-edit"></i>&nbsp; Reset</a>
                                            <a class="btn btn-danger btn-link btn-sm" href="{{ route('destroy.user', ['id'=> $user->id]) }}" onclick="return confirm('Anda yakin ingin menghapus data ini?')" role="button">
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