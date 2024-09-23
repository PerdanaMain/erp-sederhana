@extends('layouts.app')

@section('page.title')
    Pembelian
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row mb-3">
            <div class="d-block">
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addModal">
                    <i class="mdi mdi-plus"></i> Pembelian
                </button>
                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#exportModal">
                    <i class="mdi mdi-plus"></i> Export
                </button>
            </div>

            {{-- Tambah --}}
            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="{{ route('purchase.create') }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="addModalLabel">Modal Tambah</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="mb-3">
                                            <label for="materialId" class="form-label">Nama barang</label>
                                            <select name="materialId" id="materialId" class="form-select">
                                                @foreach ($materials as $m)
                                                    <option value="{{ $m->materialId }}">
                                                        {{ $m->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="mb-3">
                                            <label for="quantity" class="form-label">Jumlah barang</label>
                                            <input type="number" class="form-control" placeholder="jumlah" id="quantity"
                                                name="quantity" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="mb-3">
                                            <label for="price" class="form-label">Harga barang</label>
                                            <input type="text" class="form-control" placeholder="Harga barang"
                                                id="price" name="price" />
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="mb-3">
                                            <label for="supplierId" class="form-label">Nama supplier</label>
                                            <select name="supplierId" id="supplierId" class="form-select">
                                                @foreach ($suppliers as $s)
                                                    <option value="{{ $s->supplierId }}">
                                                        {{ $s->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="mb-3">
                                            <label for="supplierId" class="form-label">Status Pembelian</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="radio" name="statusId" id="statusId" checked
                                                        value="4"> Draft
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="radio" name="statusId" id="statusId" checked
                                                        value="1"> Pending
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <!-- Export -->
            <div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="{{ url('/purchase/export') }}" method="GET">
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
                                                            value="1" id="customRadioTemp2" name="format"
                                                            checked />
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
                                    <th class="text-truncate">Kode</th>
                                    <th class="text-truncate">Nama Material</th>
                                    <th class="text-truncate">Jumlah</th>
                                    <th class="text-truncate">Harga</th>
                                    <th class="text-truncate">Total Harga</th>
                                    <th class="text-truncate">Nama Supplier</th>
                                    <th class="text-truncate">Status</th>
                                    <th class="text-truncate">Tgl Pengajuan</th>
                                    <th class="text-truncate">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($purchases as $p)
                                    <tr>
                                        <td>
                                            {{ $p->code }}
                                        </td>
                                        <td class="text-truncate">
                                            {{ $p->material->name }}
                                        </td>
                                        <td class="text-truncate">
                                            {{ $p->quantity }}
                                        </td>
                                        <td class="text-truncate">
                                            {{ 'Rp ' . number_format($p->price, 0, ',', '.') }}

                                        </td>
                                        <td class="text-truncate">
                                            {{ 'Rp ' . number_format($p->total, 0, ',', '.') }}

                                        </td>
                                        <td class="text-truncate">
                                            {{ $p->supplier->name }}
                                        </td>
                                        <td>
                                            @if ($p->statusId == 1)
                                                <span class="badge bg-label-warning rounded-pill">
                                                    {{ $p->status->name }}
                                                </span>
                                            @elseif ($p->statusId == 2)
                                                <span class="badge bg-label-success rounded-pill">
                                                    {{ $p->status->name }}

                                                </span>
                                            @elseif ($p->statusId == 3)
                                                <span class="badge bg-label-danger rounded-pill">
                                                    {{ $p->status->name }}
                                                </span>
                                            @elseif ($p->statusId == 4)
                                                <span class="badge bg-label-info rounded-pill">
                                                    {{ $p->status->name }}
                                                </span>
                                            @endif
                                        </td>
                                        <td><span class="text-truncate">
                                                {{ $p->created_at->format('F j, Y') }}

                                            </span>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown"><i
                                                        class="mdi mdi-dots-vertical"></i></button>
                                                <div class="dropdown-menu">
                                                    @if ($p->statusId == 4)
                                                        <button class="dropdown-item" data-bs-toggle="modal"
                                                            data-bs-target="#editModal{{ $p->purchaseId }}"><i
                                                                class="mdi mdi-pencil-outline me-2"></i>Edit</button>
                                                        <button class="dropdown-item" id="delete-purchase"
                                                            data-id="{{ $p->purchaseId }}"><i
                                                                class="mdi mdi-trash-can-outline me-2"></i>Delete</button>
                                                    @else
                                                        <button class="dropdown-item" data-id="{{ $p->purchaseId }}"
                                                            id="approve-purchase"><i
                                                                class="mdi
                                                            mdi-check me-2"></i>Approve</button>
                                                        <button class="dropdown-item" id="reject-purchase"
                                                            data-id="{{ $p->purchaseId }}"><i
                                                                class="mdi mdi-exclamation me-2"></i>Reject</button>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    {{-- Edit --}}
                                    <div class="modal fade" id="editModal{{ $p->purchaseId }}" tabindex="-1"
                                        aria-labelledby="editModal{{ $p->purchaseId }}Label" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form action="{{ route('purchase.update', ['id' => $p->purchaseId]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModal{{ $p->purchaseId }}Label">
                                                            Modal Edit</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-12 col-sm-12">
                                                                <div class="mb-3">
                                                                    <label for="materialId" class="form-label">Nama
                                                                        barang</label>
                                                                    <select name="materialId" id="materialId"
                                                                        class="form-select">
                                                                        <option value="{{ $p->material->materialId }}"
                                                                            selected hidden>
                                                                            {{ $p->material->name }}
                                                                        </option>
                                                                        @foreach ($materials as $m)
                                                                            <option value="{{ $m->materialId }}">
                                                                                {{ $m->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-sm-12">
                                                                <div class="mb-3">
                                                                    <label for="quantity" class="form-label">Jumlah
                                                                        barang</label>
                                                                    <input type="number" class="form-control"
                                                                        placeholder="jumlah" id="quantity"
                                                                        name="quantity" value="{{ $p->quantity }}" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-sm-12">
                                                                <div class="mb-3">
                                                                    <label for="price" class="form-label">Harga
                                                                        barang</label>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Harga barang" id="price"
                                                                        name="price" value="{{ $p->price }}" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 col-sm-12">
                                                                <div class="mb-3">
                                                                    <label for="supplierId" class="form-label">Nama
                                                                        supplier</label>
                                                                    <select name="supplierId" id="supplierId"
                                                                        class="form-select">
                                                                        <option value="{{ $p->supplier->supplierId }}"
                                                                            selected hidden>
                                                                            {{ $p->supplier->name }}
                                                                        </option>
                                                                        @foreach ($suppliers as $s)
                                                                            <option value="{{ $s->supplierId }}">
                                                                                {{ $s->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 col-sm-12">
                                                                <div class="mb-3">
                                                                    <label for="supplierId" class="form-label">Status
                                                                        Pembelian</label>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <input type="radio" name="statusId"
                                                                                id="statusId" value="4"
                                                                                {{ $p->status->statusId == 4 ? 'checked' : '' }}>
                                                                            Draft
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <input type="radio" name="statusId"
                                                                                id="statusId" value="1"
                                                                                {{ $p->status->statusId == 1 ? 'checked' : '' }}>
                                                                            Pending
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
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

        $(document).on('click', '#approve-purchase', function() {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data yang diapprove tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, approve!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'PUT',
                        url: '/purchase/approve/' + id,
                        data: {
                            _token: $("input[name=_token]").val(),
                        },
                        success: function(data) {
                            Swal.fire(
                                'Approved!',
                                'Data berhasil diapprove.',
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

        $(document).on('click', '#reject-purchase', function() {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data yang direject tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, reject!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'PUT',
                        url: '/purchase/reject/' + id,
                        data: {
                            _token: $("input[name=_token]").val(),
                        },
                        success: function(data) {
                            Swal.fire(
                                'Rejected!',
                                'Data berhasil direject.',
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
