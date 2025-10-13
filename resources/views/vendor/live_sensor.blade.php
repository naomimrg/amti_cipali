@extends('layouts.admin')
@section('title', 'Live Sensor')

@section('style')
<style>
    /* Kosong, bisa dihapus kalau memang tidak digunakan */
</style>
@endsection

@section('content')
<div class="col-12">
    <div class="row">
        <div class="col-6">
            <h4 class="black-color">
                <a style="color:black!important;" href="../">{{ $vendor->nama_vendor }}</a> -
                <a style="color:black!important;" href="./">{{ $lokasi->nama_lokasi }} ini kan yang di hapus</a>
            </h4>
        </div>
    </div>

    <div class="row" id="list-span"></div>
</div>

<!-- Modal Edit Span -->
<form id="form-field-edit" enctype="multipart/form-data" autocomplete="off">
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-edit-span">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Span</h5>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    <input type="hidden" name="id_span" id="id_span" required>

                    <div class="form-group">
                        <label><b>Nama Span</b></label>
                        <input type="text" class="form-control" name="nama_span" id="nama_span"
                            placeholder="Masukkan Nama Span">
                    </div>

                    <div class="form-group">
                        <label><b>Station ID</b></label>
                        <input type="text" class="form-control" name="station_id" id="station_id"
                            placeholder="Masukkan Station ID">
                    </div>

                    <div class="form-group">
                        <label><b>Foto Span</b></label>
                        <input type="file" name="foto" class="form-control">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect closemodal">Batal</button>
                    <input type="submit" name="upload" id="upload" class="btn btn-primary" value="Simpan">
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Modal Hapus Span -->
<form id="form-field-hapus">
    <div class="modal fade" id="modal_hapus" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"></div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="konfirmasiId">
                    <h4 align="center">Anda yakin akan menghapus Span ini ?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" data-action="delete"
                        class="action btn btn-primary waves-effect waves-light">Delete</button>
                    <button type="button" class="btn btn-default waves-effect closemodal">Batal</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('script')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });

    function showData() {
        var pathArray = window.location.href.split('/');
        var idVendor = pathArray[4];
        var id = pathArray[5];

        $.ajax({
            url: "{{ url('/listSpanLokasi') }}/" + id,
            dataType: "json",
            async: true,
            type: "GET",
            success: function(data) {
                $('#list-span').empty(); // ✅ fix: clear existing data

                console.log("Data span:", data);
                $.each(data.items, function(index, item) {
                    console.log("Processing item:", item); // Debug each item
                    $('#list-span').append(`
                        <div class="col-4">
                            <div class="loc-list">
                                <a href="{{ url("/vendor") }}/${idVendor}/${id}/live_sensor/${item.id}">
                                    <img src="{{ url("/assets") }}/img/span/${item.foto}">
                                </a>
                                <div class="btn-group" style="position: absolute;">
                                    <button style="background: #545c58ab; border: none; position: absolute; top: -16px; right: -16px;"
                                        type="button"
                                        class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" style="padding: 2px 4px;">
                                                <button type="button" data-id="${item.id}" data-action="edit"
                                                    class="action btn btn-sm" data-toggle="tooltip" title="Ubah">
                                                    <i class="bx bxs-edit"></i>&nbsp; Ubah
                                                </button>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" style="padding: 2px 4px;">
                                                <button type="button" data-id="${item.id}" data-action="hapus"
                                                    class="action btn btn-sm" data-toggle="tooltip" title="Delete">
                                                    <i class="bx bxs-trash"></i>&nbsp; Hapus
                                                </button>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <center>
                                    <h4 class="black-color mb-0 mt-2"
                                        style="background: #0afeff; padding: 5px 5px; border-radius: 10px;">
                                        ${item.nama_span}
                                    </h4>
                                </center>
                            </div>
                        </div>
                    `);
                });
            }
        });
    }

    showData();

    var mode;

    function show_modal(data) {
        if (mode === "edit") {
            $.ajax({
                url: "{{ url('/editSpan') }}/" + data,
                dataType: "json",
                type: "GET",
                success: function(data) {
                    $('#form-field-edit').find('input[name="nama_span"]').val(data.nama_span);
                    $('#form-field-edit').find('input[name="station_id"]').val(data.stationId);
                    $('#form-field-edit').find('input[name="id_span"]').val(data.id);
                }
            });

            $('#modal-edit-span').find('.modal-title').text("Edit Span").end().modal('show');
        } else if (mode === "hapus") {
            $('#modal_hapus').find('.modal-title').text("Hapus Span");
            $('#form-field-hapus').find('input[name="id"]').val(data);
            $('#modal_hapus').modal('show');
        }
    }

    function reset_default() {
        $('#form-field-edit')[0].reset();
        $('#form-field-edit').find('input[name="id_span"]').val('');
        mode = undefined;
        $('#list-span').html('');
        $('#modal-edit-span').modal('hide');
        showData();
    }

    function reset_default_hapus() {
        $('#form-field-hapus')[0].reset();
        $('#form-field-hapus').find('input[name="id"]').val('');
        mode = undefined;
        $('#list-span').html('');
        $('#modal_hapus').modal('hide');
        showData();
    }

    $(document).on('click', ".action", function() {
        const action = $(this).data('action');
        const id = $(this).data('id');

        // Close modal button event
        $('.closemodal').off('click').on('click', function() {
            $(this).closest('.modal').modal('hide');
        });

        if (action === "delete") {
            const idToDelete = $("input[name='id']").val();
            $.ajax({
                url: "{{ url('/deleteSpan') }}/" + idToDelete,
                dataType: "json",
                data: {
                    _token: '{{ csrf_token() }}'
                },
                type: "DELETE",
                success: function(data) {
                    swal({
                        title: $.isEmptyObject(data.error) ? "Success!" : "Error!",
                        text: data.error || data.success,
                        type: $.isEmptyObject(data.error) ? "success" : "error",
                    });
                    reset_default_hapus();
                }
            });
        } else if (action === "edit") {
            mode = "edit";
            show_modal(id);
        } else if (action === "hapus") {
            mode = "hapus";
            show_modal(id);
        }
    });

    $(document).ready(function() {
        $('#form-field-edit').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: "{{ url('/updateLiveSpan') }}",
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
                        type: $.isEmptyObject(data.error) ? "success" : "error",
                    });
                    reset_default();
                }
            });
        });
    });

    $('form').on("keypress", function(e) {
        if (e.keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });
</script>
@endsection