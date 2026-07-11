@extends('layouts.admincoreui-app')

@section('title', 'Data Dokter - VitaGuard')

@section('page-title', 'Kelola Data Dokter')

@section('content-admin')
<div class="container-fluid">
    
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-3 text-right">
        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#btnFormModal">
            <i class="fas fa-plus"></i> New Doctor (with Modals)
        </button>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Doctor Name</th>
                    <th>Specialization</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody>
                @forelse($doctors as $doctor)
                <tr id="tr_{{$doctor->id}}">
                    <td>{{ $doctor->id }}</td>
                    <td id="td_name_{{ $doctor->id }}">{{ $doctor->name }}</td>
                    <td id="td_spec_{{ $doctor->id }}">{{ $doctor->specialization }}</td>
                    <td id="td_phone_{{ $doctor->id }}">{{ $doctor->phone_number }}</td>
                    <td id="td_email_{{ $doctor->id }}">{{ $doctor->email }}</td>
                    <td>
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditA" onclick="getEditForm({{ $doctor->id }})">
                            Edit
                        </button>

                        <button type="button" class="btn btn-danger btn-sm" 
                            onclick="if(confirm('Are you sure to delete {{ $doctor->id }} - {{ $doctor->name }} ?')) deleteDataRemove({{ $doctor->id }})">
                            Delete
                        </button>

                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center p-4">
                        <span class="text-muted">Data dokter belum tersedia / database kosong.</span>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<div class="modal fade" id="btnFormModal" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title">Add New Doctor</h4>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <form method="POST" action="{{ route('doctors.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="name">Doctor Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter doctor name" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="specialization">Specialization</label>
                        <input type="text" name="specialization" class="form-control" id="specialization" placeholder="Enter specialization" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="experience_years">Experience (Years)</label>
                        <input type="number" name="experience_years" class="form-control" id="experience_years" placeholder="Enter years of experience" min="0" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="phone_number">Phone</label>
                        <input type="text" name="phone_number" class="form-control" id="phone_number" placeholder="Enter phone number" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter email address" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
             </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditA" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-lg">
       <div class="modal-content">
          <div class="modal-body" id="modalContent">
              <p class="text-center p-3">Memuat form edit...</p>
          </div>
       </div>
   </div>
</div> 

<script>
    // Fungsi Ambil Data Edit via AJAX
    function getEditForm(id) {
        $.ajax({
            type: 'POST',
            url: '{{ route("admin.doctors.getEditForm") }}',
            data: {
                '_token': '{{ csrf_token() }}',
                'id': id
            },
            success: function(data) {
                $('#modalContent').html(data.msg);
            },
            error: function() {
                $('#modalContent').html('<p class="text-danger p-3">Gagal memuat data.</p>');
            }
        });
    }

    // Fungsi Hapus baris tanpa reload
    function deleteDataRemove(id) {
        $.ajax({
            type: 'POST',
            url: '{{ route("doctors.deleteData") }}',
            data: {
                '_token': '{{ csrf_token() }}',
                'id': id
            },
            success: function(data) {
                if (data.status === "oke") {
                    $('#tr_' + id).remove();
                    alert(data.msg);
                } else {
                    alert(data.msg);
                }
            },
            // Tambahkan 'xhr' di dalam kurung parameter fungsi di bawah ini
            error: function(xhr) { 
                console.error(xhr.responseText);
                alert('Terjadi kesalahan pada server (Error 500).');
            }
        });
    }
</script>
@endpush