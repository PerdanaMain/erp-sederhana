@extends('layouts.app')

@section('page.title')
    Gudang
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row mb-3">
            <div class="d-block">
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exportModal">
                    <i class="mdi mdi-plus"></i> Export
                </button>
            </div>
            <!-- Export -->
            <div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="{{ url('/warehouse/export') }}" method="GET">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="exportModalLabel">Export Data</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Format<span
                                                    style="color:red">*</span></label>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <label class="form-check-label custom-option-content"
                                                        for="customRadioTemp2">
                                                        <input name="format" class="form-check-input" type="radio"
                                                            value="1" id="customRadioTemp2" name="format" checked />
                                                        <span class="custom-option-header">
                                                            <span class="fw-medium">Excel</span>
                                                        </span>
                                                    </label>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <label class="form-check-label custom-option-content"
                                                        for="customRadioTemp2">
                                                        <input name="format" class="form-check-input" type="radio"
                                                            value="2" id="customRadioTemp2" name="format" />
                                                        <span class="custom-option-header">
                                                            <span class="fw-medium">Pdf</span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <div class="row gy-4">
            <!-- Data Tables -->
            <div class="col-12">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-truncate">Nama Material</th>
                                    <th class="text-truncate">Stock</th>
                                    <th class="text-truncate">Tgl Pembelian terbaru</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($materials as $m)
                                    <tr>
                                        <td>{{ $m->name }}</td>
                                        <td>{{ $m->stock }}</td>
                                        <td>{{ $m->updated_at->format('F j, Y') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--/ Data Tables -->
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).on('click', '#delete-purchase', function() {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'DELETE',
                        url: '/purchase/delete/' + id,
                        data: {
                            _token: $("input[name=_token]").val(),
                        },
                        success: function(data) {
                            Swal.fire(
                                'Terhapus!',
                                'Data berhasil dihapus.',
                                data.message
                            ).then((result) => {
                                location.reload();
                            });
                        },
                        error: function(err) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: err.responseJSON.message,
                            })
                        }
                    });
                }
            });
        });
    </script>
@endpush
