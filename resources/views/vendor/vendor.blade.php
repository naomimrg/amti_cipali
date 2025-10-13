@extends('layouts.admin')

@section('title', 'Vendor')

@section('style')
<style>
    .form-group {
        margin-bottom: 10px;
    }
</style>
@endsection

@section('content')
<div class="col-12">
    <div class="row">
        <div class="col-6">
            <h4 class="black-color">{{ $vendor->nama_vendor }}</h4>
        </div>
        <div class="col-6 text-end">
            <button type="button" class="action btn btn-primary me-3" id="btn-add-span">
                Tambah Span (Kedua)
            </button>
            <button type="button" data-action="add" class="action btn btn-primary">
                Tambah Lokasi
            </button>
        </div>
    </div>

    <div class="row mt-3" id="list-lokasi"></div>
</div>

<!-- =================== MODAL TAMBAH =================== -->
<form id="form-field" enctype="multipart/form-data" autocomplete="off">
    <div class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Lokasi</h5>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="id" id="id_lokasi">
                    <input type="hidden" name="id_vendor" id="id_vendor" value="{{ $vendor->id }}">

                    <div class="form-group">
                        <label><b>Nama Lokasi</b></label>
                        <input type="text" class="form-control" name="nama_lokasi" id="nama_lokasi"
                            placeholder="Masukkan Nama Lokasi">
                    </div>

                    <div class="form-group">
                        <label><b>Foto</b></label>
                        <span class="text-danger d-block" style="font-size: 12px;">*Harap masukkan gambar dengan rasio
                            3:1 (1920x640)</span>
                        <input type="file" class="form-control" name="image">
                    </div>

                    <div class="form-group">
                        <label><b>Longitude</b></label>
                        <input type="text" class="form-control" name="longitude" id="longitude"
                            placeholder="Longitude Lokasi">
                    </div>

                    <div class="form-group">
                        <label><b>Latitude</b></label>
                        <input type="text" class="form-control" name="latitude" id="latitude"
                            placeholder="Latitude Lokasi">
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

<!-- =================== MODAL EDIT =================== -->
<form id="form-field-edit" enctype="multipart/form-data" autocomplete="off">
    <div class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Lokasi</h5>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="id_lokasis" id="id_lokasis">

                    <div class="form-group">
                        <label><b>Nama Lokasi</b></label>
                        <input type="text" class="form-control" name="nama_lokasis" id="nama_lokasis"
                            placeholder="Masukkan Nama Lokasi">
                    </div>

                    <div class="form-group">
                        <label><b>Foto</b> <span class="text-danger" style="font-size: 12px;">Rasio 3:1
                                (1920x640)</span></label>
                        <input type="file" class="form-control" name="foto">
                    </div>

                    <div class="form-group">
                        <label><b>Longitude</b></label>
                        <input type="text" class="form-control" name="longitudes" id="longitudes"
                            placeholder="Longitude Lokasi">
                    </div>

                    <div class="form-group">
                        <label><b>Latitude</b></label>
                        <input type="text" class="form-control" name="latitudes" id="latitudes"
                            placeholder="Latitude Lokasi">
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

<!-- =================== MODAL HAPUS =================== -->
<form id="form-field-hapus">
    <div class="modal fade" id="modal_hapus" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <input type="hidden" name="id_lokasi" id="konfirmasiId">
                    <h4>Anda yakin akan menghapus lokasi ini?</h4>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" data-action="delete" class="action btn btn-danger">Hapus</button>
                    <button type="button" class="btn btn-secondary closemodal">Batal</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- =================== MODAL TAMBAH SPAN =================== -->
<form id="form-span" enctype="multipart/form-data" autocomplete="off">
    <div class="modal fade" id="modal-add-span" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Span</h5>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label><b>Nama Span</b></label>
                        <input type="text" class="form-control" name="nama_span" id="nama_span"
                            placeholder="Masukkan Nama Span" required>
                    </div>

                    <div class="form-group">
                        <label><b>Station ID</b></label>
                        <input type="text" class="form-control" name="station_id" id="station_id"
                            placeholder="Masukkan Station ID" required>
                    </div>

                    <div class="form-group">
                        <label><b>Lokasi</b></label>
                        <select class="form-control" name="id_lokasi" id="lokasi_id" required>
                            <option value="">Pilih Lokasi</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default closemodal" data-dismiss="modal">Batal</button>
                    <input type="submit" class="btn btn-primary" value="Simpan">
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('script')
<script>
    $(document).ready(function() {

        // ======================= AJAX SETUP =======================
        $.ajaxSetup({
            headers: {
                'csrftoken': '{{ csrf_token() }}'
            }
        });

        // ======================= LOAD DATA =======================
        function showData() {
            let id = window.location.href.split('/')[4];
            $.ajax({
                url: "{{ url('/listLokasi/') }}/" + id,
                dataType: "json",
                type: "GET",
                success: function(data) {
                    console.log(data);
                    $('#list-lokasi').empty();
                    $.each(data.items, function(_, item) {
                        console.log("ini data", item);
                        $('#list-lokasi').append(`
                        <div class="col-4">
                            <div class="loc-list position-relative">
                                <a href="{{ url('/vendor') }}/${id}/${item.slug}/live_sensor">
                                    <img src="{{ url('/assets/img/lokasi') }}/${item.image}" alt="${item.nama_lokasi}">
                                </a>
                                <div class="btn-group position-absolute" style="top: -16px; right: -16px;">
                                    <button class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" type="button" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><button data-id="${item.id}" data-action="edit" class="action btn btn-sm w-100 text-start"><i class="bx bxs-edit"></i> Ubah</button></li>
                                        <li><button data-id="${item.id}" data-action="hapus" class="action btn btn-sm w-100 text-start"><i class="bx bxs-trash"></i> Hapus</button></li>
                                    </ul>
                                </div>
                                <center><h4 class="black-color mt-3 mb-0">${item.nama_lokasi}</h4></center>
                            </div>
                        </div>
                    `);
                    });
                }
            });
        }
        showData();

        // ======================= TAMBAH SPAN =======================
        $('#btn-add-span').on('click', function() {
            populateLokasiOptions();
            $('#modal-add-span').modal('show');
        });

        function populateLokasiOptions() {
            let id = window.location.href.split('/')[4];
            $.getJSON("{{ url('/listLokasi') }}/" + id, function(data) {
                let $select = $('#lokasi_id').empty().append('<option value="">Pilih Lokasi</option>');
                $.each(data.items, function(_, item) {
                    $select.append(`<option value="${item.id}">${item.nama_lokasi}</option>`);
                });
            });
        }

        $('#form-span').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $.ajax({
                url: "{{ url('/insertSpan') }}",
                method: "POST",
                data: formData,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    swal({
                        title: $.isEmptyObject(data.error) ? "Success!" : "Error!",
                        text: data.error || data.success,
                        type: $.isEmptyObject(data.error) ? "success" : "error"
                    });
                    $('#modal-add-span').modal('hide');
                    $('#form-span')[0].reset();
                }
            });
        });

        // ======================= ACTION HANDLER =======================
        let mode;

        function show_modal(data) {
            if (mode === "add") {
                $('#form-field').trigger('reset').children('.modal').modal('show');
            } else if (mode === "edit") {
                $.getJSON("{{ url('/editLokasi') }}/" + data, function(res) {
                    $('#form-field-edit').find('#nama_lokasis').val(res.nama_lokasi);
                    $('#form-field-edit').find('#longitudes').val(res.long);
                    $('#form-field-edit').find('#latitudes').val(res.lat);
                    $('#form-field-edit').find('#id_lokasis').val(res.id);
                    $('#form-field-edit').children('.modal').modal('show');
                });
            } else if (mode === "hapus") {
                $('#konfirmasiId').val(data);
                $('#modal_hapus').modal('show');
            }
        }

        function refreshAfterAction() {
            $('.modal').modal('hide');
            showData();
        }

        $(document).on('click', '.action', function() {
            const action = $(this).data('action');
            const id = $(this).data('id');
            $('.closemodal').click(() => $('.modal').modal('hide'));

            if (action === "delete") {
                const id = $("input[name='id_lokasi']").val();
                $.ajax({
                    url: "{{ url('/deleteLokasi') }}/" + id,
                    type: "DELETE",
                    dataType: "json",
                    data: {
                        _token: '{!! csrf_token() !!}'
                    },
                    success: function(data) {
                        swal({
                            title: $.isEmptyObject(data.error) ? "Success!" : "Error!",
                            text: data.error || data.success,
                            type: $.isEmptyObject(data.error) ? "success" : "error"
                        });
                        refreshAfterAction();
                    }
                });
            } else {
                mode = action;
                show_modal(id);
            }
        });

        // ======================= FORM SUBMIT =======================
        $('#form-field').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ url('/insertLokasi') }}",
                method: "POST",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    swal({
                        title: $.isEmptyObject(data.error) ? "Success!" : "Error!",
                        text: data.error || data.success,
                        type: $.isEmptyObject(data.error) ? "success" : "error"
                    });
                    refreshAfterAction();
                }
            });
        });

        $('#form-field-edit').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ url('/updateLokasi') }}",
                method: "POST",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    swal({
                        title: $.isEmptyObject(data.error) ? "Success!" : "Error!",
                        text: data.error || data.success,
                        type: $.isEmptyObject(data.error) ? "success" : "error"
                    });
                    refreshAfterAction();
                }
            });
        });

        // ======================= PREVENT ENTER =======================
        $('form').on("keypress", function(e) {
            if (e.keyCode === 13) e.preventDefault();
        });
    });
</script>
@endsection