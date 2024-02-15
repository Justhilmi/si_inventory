@extends('v_barang.layouts') <!-- Gantilah 'layouts.app' sesuai dengan layout yang Anda miliki -->

@section('content')
<div class="container">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('siswa.create') }}" class="btn btn-success mb-3"><i class="bi bi-plus"></i> Tambah Siswa</a>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>NIS</th>
                    <th>Gender</th>
                    <th>Kelas</th>
                    <th>Rombel</th>
                    <th>Foto</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $counter = ($siswa->currentPage() - 1) * $siswa->perPage() + 1;
                @endphp
                @foreach ($siswa as $student)
                    <tr>
                        <td>{{ $counter++ }}</td>
                        <td>{{ $student->nama }}</td>
                        <td>{{ $student->nis }}</td>
                        <td>{{ $student->gender }}</td>
                        <td>{{ $student->kelas }}</td>
                        <td>{{ $student->rombel }}</td>
                        <td>
                            @if ($student->foto)
                                <img src="{{ asset('storage/foto_siswa/' . $student->foto) }}" alt="{{ $student->nama }}" class="img-thumbnail" width="100">
                            @else
                                No Photo
                            @endif
                        </td>
                        <td class="action-cell text-center">
                            <a href="{{ route('siswa.show', $student->id) }}" class="btn btn-info"><i class="bi bi-eye"></i> Show</a>
                            <a href="{{ route('siswa.edit', $student->id) }}" class="btn btn-primary"><i class="bi bi-pencil"></i> Edit</a>
                            <form action="{{ route('siswa.destroy', $student->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?')"><i class="bi bi-trash"></i> Delete</button>  
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{ $siswa->links() }} <!-- Pagination links -->
    </div>

</div>
@endsection
