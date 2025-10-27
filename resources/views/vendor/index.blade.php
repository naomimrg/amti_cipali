@extends('layouts.admin')
@section('title', 'Client')
@section('style')
<style>
    .form-group {
        margin-bottom: 10px;
    }
</style>
@endsection

@section('content')
<div class="col-12">
    <div class="row mb-3">
        <div class="col-6">
            <h4 class="black-color">Daftar Client</h4>
        </div>
        <div class="col-6 text-end">
            <button type="button" data-action="add" class="action btn btn-primary">Tambah Client</button>
        </div>
    </div>

    <div class="row" id="list-vendor"></div>
</div>

<!-- Modal Tambah -->
<form id="form-field" enctype="multipart/form-data" autocomplete="off">
    <div class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Client</h5>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="id" id="id_vendor">
                    <div class="form-group">
                        <label><b>Nama Client</b></label>
                        <input type="text" class="form-control" name="nama_vendor" id="nama_vendor"
                            placeholder="Masukkan Nama Client">
                    </div>
                    <div class="form-group">
                        <label><b>Foto Client</b></label>
                        <input type="file" name="image" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default closemodal">Batal</button>
                    <input type="submit" class="btn btn-primary" value="Simpan">
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Modal Edit -->
<form id="form-field-edit" enctype="multipart/form-data" autocomplete="off">
    <div class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Client</h5>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="id_vendors" id="id_vendors">
                    <div class="form-group">
                        <label><b>Nama Client</b></label>
                        <input type="text" class="form-control" name="nama_vendors" id="nama_vendors"
                            placeholder="Masukkan Nama Client">
                    </div>
                    <div class="form-group">
                        <label><b>Foto Client</b></label>
                        <input type="file" name="foto" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default closemodal">Batal</button>
                    <input type="submit" class="btn btn-primary" value="Simpan">
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Modal Hapus -->
<form id="form-field-hapus">
    <div class="modal fade" id="modal_hapus" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <input type="hidden" name="id_vendor" id="konfirmasiId">
                    <h4>Anda yakin akan menghapus Client ini?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" data-action="delete" class="action btn btn-primary">Delete</button>
                    <button type="button" class="btn btn-default closemodal">Batal</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('script')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });

    // === Load Data Client ===
    function showData() {
        $('#list-vendor').html('');
        $.ajax({
            url: "{{ url('/vendor/listVendor') }}",
            dataType: "json",
            type: "GET",
            success: function(data) {
                console.log(data);
                $.each(data.items, function(index, item) {
                    console.log("Data Client", item);
                    console.log("Rendering vendor:", item);
                    $('#list-vendor').append(`
                        <div class="col-4">
                            <div class="loc-list position-relative">
                                <a href="{{ url('/vendor') }}/${item.slug}/">
                                    <img src="{{ url('/assets/img/vendor') }}/${item.image}">
                                </a>
                                <div class="btn-group position-absolute" style="top: -16px; right: -16px;">
                                    <button class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow"
                                            type="button" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><button data-id="${item.id}" data-action="edit" class="action btn btn-sm w-100 text-start"><i class="bx bxs-edit"></i> Ubah</button></li>
                                        <li><button data-id="${item.id}" data-action="hapus" class="action btn btn-sm w-100 text-start"><i class="bx bxs-trash"></i> Hapus</button></li>
                                    </ul>
                                </div>
                                <center><h4 class="black-color mt-3 mb-0"><b>${item.nama_vendor}</b></h4></center>
                            </div>
                        </div>
                    `);
                });
            }
        });
    }
    showData();

    // === Variabel global mode ===
    let mode;

    // === Modal Control ===
    function show_modal(data) {
        if (mode === "add") {
            $('#form-field').trigger('reset');
            $('#form-field').children('.modal').find('.modal-title').text("Tambah Client").end().modal('show');
        } else if (mode === "edit") {
            $.getJSON(`{{ url('/editVendor') }}/${data}`, function(res) {
                $('#form-field-edit').find('#nama_vendors').val(res.nama_vendor);
                $('#form-field-edit').find('#id_vendors').val(res.id);
                $('#form-field-edit').children('.modal').modal('show');
            });
        } else if (mode === "hapus") {
            $('#konfirmasiId').val(data);
            $('#modal_hapus').modal('show');
        }
    }

    // === Reset Function ===
    function reset_all() {
        $('#form-field, #form-field-edit, #form-field-hapus').each(function() {
            this.reset();
        });
        mode = undefined;
        showData();
        $('.modal').modal('hide');
    }

    // === Action Handler ===
    $(document).on('click', ".action", function() {
        const action = $(this).data('action');
        const id = $(this).data('id');

        $('.closemodal').click(() => $('.modal').modal('hide'));

        if (action === "delete") {
            const vendorId = $("input[name='id_vendor']").val();
            $.ajax({
                url: `{{ url('/vendor') }}/${vendorId}`,
                type: "DELETE",
                dataType: "json",
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    swal({
                        title: res.error ? "Error!" : "Success!",
                        text: res.error || res.success,
                        type: res.error ? "error" : "success"
                    });
                    reset_all();
                }
            });
        } else {
            mode = action;
            show_modal(id);
        }
    });

    // === Submit Add ===
    $('#form-field').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ url('/vendor') }}",
            method: "POST",
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(res) {
                swal({
                    title: res.error ? "Error!" : "Success!",
                    text: res.error || res.success,
                    type: res.error ? "error" : "success"
                });
                reset_all();
            }
        });
    });

    // === Submit Edit ===
    $('#form-field-edit').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ url('/updateVendor') }}",
            method: "POST",
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(res) {
                swal({
                    title: res.error ? "Error!" : "Success!",
                    text: res.error || res.success,
                    type: res.error ? "error" : "success"
                });
                reset_all();
            }
        });
    });

    // === Prevent Enter Submit Form ===
    $('form').on("keypress", function(e) {
        if (e.keyCode === 13) {
            e.preventDefault();
        }
    });
</script>
@endsection