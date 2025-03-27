@extends('layouts.admin')
@section('title', 'Vendor')
@section('style')
<style>
.form-group{
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
        <div class="col-6" style="text-align:right;">
             <button type="button" class="action btn btn-primary me-3" id="btn-add-span">Tambah Span</button>
            <button type="button" data-action="add" style="float:right;margin-bottom: 10px;" class="action btn btn-primary">Tambah Lokasi</button>
        </div>
    </div>
    <div class="row" id="list-lokasi">
        
    </div>
</div>
<!-- / Content -->
<form id="form-field"  enctype="multipart/form-data" autocomplete="off" >
    <div class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Lokasi</h5>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_lokasi" value="" required>
                    <input type="hidden" name="id_vendor" id="id_vendor" value="{{$vendor->id}}" required>
                    <div class="form-group">
                        <label><b>Nama Lokasi</b></label>
                        <input type="text" class="form-control" value="" placeholder="Masukkan Nama Lokasi" name="nama_lokasi" id="nama_lokasi">
                    </div>
                    <div class="form-group">
                        <label><b>Foto</b></label>
                        <input type="file" class="form-control" name="image">
                    </div>
                    <div class="form-group">
                        <label><b>Longitude</b></label>
                        <input type="text" class="form-control" value="" placeholder="Longitude Lokasi" name="longitude" id="longitude">
                    </div>
                    <div class="form-group">
                        <label><b>Latitude</b></label>
                        <input type="text" class="form-control" value="" placeholder="Latitude Lokasi" name="latitude" id="latitude">
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
<form id="form-field-edit" enctype="multipart/form-data" autocomplete="off" >
    <div class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Lokasi</h5>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    <input type="hidden" name="id_lokasis" id="id_lokasis" value="" required>
                    <div class="form-group">
                        <label><b>Nama Lokasi</b></label>
                        <input type="text" class="form-control" value="" placeholder="Masukkan Nama Lokasi" name="nama_lokasis" id="nama_lokasis">
                    </div>
                    <div class="form-group">
                        <label><b>Foto</b></label>
                        <input type="file" class="form-control" name="foto">
                    </div>
                    <div class="form-group">
                        <label><b>Longitude</b></label>
                        <input type="text" class="form-control" value="" placeholder="Longitude Lokasi" name="longitudes" id="longitudes">
                    </div>
                    <div class="form-group">
                        <label><b>Latitude</b></label>
                        <input type="text" class="form-control" value="" placeholder="Latitude Lokasi" name="latitudes" id="latitudes">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect closemodal">Batal</button>
                    <input type="submit" name="uploads" id="uploads" class="btn btn-primary" value="Simpan">
                </div>
            </div>
        </div>
    </div>
</form>
<form id="form-field-hapus">
    <div class="modal fade" id="modal_hapus" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_lokasi" id="konfirmasiId" value="">
                    <h4 align="center">Anda yakin akan menghapus Lokasi ini ?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" data-action="delete" class="action btn btn-primary waves-effect waves-light">Delete</button>
                    <button type="button" class="btn btn-default waves-effect closemodal">Batal</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Modal add span -->
<!-- Modal Form Add Span -->
<form id="form-span" enctype="multipart/form-data" autocomplete="off">
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-add-span">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Span</h5>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label><b>Nama Span</b></label>
                        <input type="text" class="form-control" placeholder="Masukkan Nama Span" name="nama_span" id="nama_span" required>
                    </div>
                    <div class="form-group">
                        <label><b>Station ID</b></label>
                        <input type="text" class="form-control" placeholder="Masukkan Station ID" name="station_id" id="station_id" required>
                    </div>
                    <div class="form-group">
                        <label><b>Lokasi</b></label>
                        <select class="form-control" name="id_lokasi" id="lokasi_id" required>
                            <option value="">Pilih Lokasi</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect closemodal" data-dismiss="modal">Batal</button>
                    <input type="submit" name="upload" id="simpan-span" class="btn btn-primary" value="Simpan">
                </div>
            </div>
        </div>
    </div>
</form>



@endsection
@section('script')
<script type="text/javascript">
$(document).ready(function(){

    // Setup header CSRF untuk AJAX
    $.ajaxSetup({
        headers: { 'csrftoken': '{{ csrf_token() }}' }
    });

    // Function: Menampilkan data lokasi
    function showData(){
        var pathArray = window.location.href.split('/');
        var id = pathArray[4];
        $.ajax({
            url: "{{ url('/listLokasi') }}/" + id,
            dataType: "json",
            type: "GET",
            success: function(data) {	
                $('#list-lokasi').empty();	
                $.each(data.items, function(index, item) {
                    var html = '<div class="col-4">' +
                                    '<div class="loc-list">' +
                                        '<a href="{{ url("/vendor")}}/' + id + '/' + item.slug + '">' +
                                            '<img src="{{ url("/assets") }}/img/lokasi/' + item.image + '">' +
                                        '</a>' +
                                        '<div class="btn-group" style="position: absolute;">' +
                                            '<button style="background: #545c58ab;border: none;position: absolute;top: -16px;right: -16px;" type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">' +
                                                '<i class="bx bx-dots-vertical-rounded"></i>' +
                                            '</button>' +
                                            '<ul class="dropdown-menu dropdown-menu-end">' +
                                                '<li><a class="dropdown-item" style="padding: 2px 4px;">' +
                                                    '<button type="button" data-id="' + item.id + '" data-action="edit" class="action btn btn-sm" data-toggle="tooltip" title="Ubah">' +
                                                        '<i class="bx bxs-edit"></i>&nbsp; Ubah' +
                                                    '</button>' +
                                                '</a></li>' +
                                                '<li><a class="dropdown-item" style="padding: 2px 4px;">' +
                                                    '<button type="button" data-id="' + item.id + '" data-action="hapus" class="action btn btn-sm" data-toggle="tooltip" title="Delete">' +
                                                        '<i class="bx bxs-trash"></i>&nbsp; Hapus' +
                                                    '</button>' +
                                                '</a></li>' +
                                            '</ul>' +
                                        '</div>' +
                                        '<center><h4 class="black-color mb-0 mt-3">' + item.nama_lokasi + '</h4></center>' +
                                    '</div>' +
                                '</div>';
                    $('#list-lokasi').append(html);
                });	
            }
        });
    }

    // Panggil showData() saat page load
    showData();

    // Event: Tampilkan modal untuk tambah span dengan jQuery
    $('#btn-add-span').on('click', function() {
        populateLokasiOptions(); 
        $('#modal-add-span').modal('show');
    });

    function populateLokasiOptions() {
        // Misal kita ambil ID dari URL, seperti di showData() sebelumnya
        var pathArray = window.location.href.split('/');
        var id = pathArray[4];

        $.ajax({
            url: "{{ url('/listLokasi') }}/" + id,
            dataType: "json",
            type: "GET",
            success: function(data) {
                var $select = $('#lokasi_id');
                $select.empty(); // Kosongkan select terlebih dahulu
                $select.append('<option value="">Pilih Lokasi</option>');
                $.each(data.items, function(index, item) {
                    $select.append('<option value="' + item.id + '">' + item.nama_lokasi + '</option>');
                });
            }
        });
    }

    $('#form-span').on('submit', function(e) {
    e.preventDefault(); // Mencegah submit default form

    var formData = new FormData(this);

    // Log data form ke console (mengiterasi key-value dari FormData)
    for (var pair of formData.entries()) {
        console.log(pair[0]+ ': ' + pair[1]);
    }

    $.ajax({
        url: "{{ url('/insertSpan') }}",
        method: "POST",
        data: formData,
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
            console.log("Response:", data);
            if ($.isEmptyObject(data.error)) {
                swal({
                    title: "Success!",
                    text: data.success,
                    type: "success"
                });
            } else {
                swal({
                    title: "Error!",
                    text: data.error,
                    type: "error"
                });
            }
            // Tutup modal dan reset form
            $('#modal-add-span').modal('hide');
            $('#form-span')[0].reset();
        }
    });
});



    // Variabel mode untuk menentukan aksi (add, edit, hapus)
    var mode;

    // Function: Menampilkan modal berdasarkan mode
    function show_modal(data) {
        if (mode === "add") {
            var $modal = $('#form-field').children('.modal');
            $modal.find('.modal-title').text("Tambah Lokasi");
            $modal.find('input[name="nama_lokasi"]').val("");
            $modal.find('input[name="image"]').val("");
            $modal.find('input[name="longitude"]').val("");
            $modal.find('input[name="latitude"]').val("");
            $modal.find('input[name="id"]').val("");
            $modal.modal('show');
        } else if (mode === "edit") {
            $.ajax({
                url: "{{ url('/editLokasi') }}/" + data,
                dataType: "json",
                type: "GET",
                success: function(data) {
                    $('#form-field-edit').find('input[name="nama_lokasis"]').val(data.nama_lokasi);
                    $('#form-field-edit').find('input[name="longitudes"]').val(data.long);
                    $('#form-field-edit').find('input[name="latitudes"]').val(data.lat);
                    $('#form-field-edit').find('input[name="id_lokasis"]').val(data.id);
                }
            });
            var $modal = $('#form-field-edit').children('.modal');
            $modal.find('.modal-title').text("Edit Lokasi");
            $modal.modal('show');
        } else if (mode === "hapus") {
            var $modal = $('#form-field-hapus').children('.modal');
            $modal.find('.modal-title').text("Hapus Lokasi");
            $('#form-field-hapus').find('input[name="id_lokasi"]').val(data);
            $modal.modal('show');
        }
    }

    // Function: Reset modal form dan muat ulang data lokasi
    function reset_default() {
        $('#form-field')[0].reset();
        $('#form-field').find('input[name="id"]').val('');
        mode = undefined;
        $('#list-lokasi').empty();
        $('#form-field').children('.modal').modal('hide');
        showData();
    }
    function reset_defaults() {
        $('#form-field-edit')[0].reset();
        $('#form-field-edit').find('input[name="id_lokasis"]').val('');
        mode = undefined;
        $('#list-lokasi').empty();
        $('#form-field-edit').children('.modal').modal('hide');
        showData();
    }
    function reset_default_hapus() {
        $('#form-field-hapus')[0].reset();
        $('#form-field-hapus').find('input[name="id_lokasi"]').val('');
        mode = undefined;
        $('#list-lokasi').empty();
        $('#form-field-hapus').children('.modal').modal('hide');
        showData();
    }

    function clearForm() {
        $('#form-field')[0].reset();
    }
    function clearHapus() {
        $('#form-field-hapus')[0].reset();
    }

    // Event Delegation untuk tombol aksi dengan class .action
    $(document).on('click', ".action", function() {
        // Bind event closemodal untuk menutup modal
        $('.closemodal').on('click', function() {
            $(this).closest('.modal').modal('hide');
        });

        var action = $(this).data('action');
        if (action === "delete") {
            var id = $("input[name='id_lokasi']").val();
            $.ajax({
                url: "{{ url('/deleteLokasi') }}/" + id,
                dataType: "json",
                data: { _token: '{!! csrf_token() !!}' },
                type: "DELETE",
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        swal({
                            title: "Success!",
                            text: data.success,
                            type: "success",
                        });
                    } else {
                        swal({
                            title: "Error!",
                            text: data.error,
                            type: "error",
                        });
                    }
                    reset_default_hapus();
                }
            });
        } else if (action === "add") {
            mode = "add";
            clearForm();
            show_modal();
        } else if (action === "edit") {
            mode = "edit";
            var id = $(this).data('id');
            show_modal(id);
        } else if (action === "hapus") {
            mode = "hapus";
            var id = $(this).data('id');
            show_modal(id);
        } else if (action === "simpan") {
            var id = $("input[id='id_lokasi']").val();
            var tipe = id === "" ? "POST" : "PUT";
            var ids = id === "" ? "" : "/" + id;
            $.ajax({
                url: "{{ url('/insertLokasi') }}" + ids,
                dataType: "json",
                data: $('#form-field').serialize() + "&_token={!! csrf_token() !!}",
                type: tipe,
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        swal({
                            title: "Success!",
                            text: data.success,
                            type: "success",
                        });
                    } else {
                        swal({
                            title: "Error!",
                            text: data.error,
                            type: "error",
                        });
                    }
                    reset_default();
                }
            });
        }
    });

    // Handling form submit untuk insert dan update lokasi
    $('#form-field').on('submit', function(event){
        event.preventDefault();
        $.ajax({
            url:"{{ url('/insertLokasi') }}",
            method:"POST",
            data: new FormData(this),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(data) {
                if ($.isEmptyObject(data.error)) {
                    swal({
                        title: "Success!",
                        text: data.success,
                        type: "success",
                    });
                } else {
                    swal({
                        title: "Error!",
                        text: data.error,
                        type: "error",
                    });
                }
                reset_default();
            }
        });
    });
    
    $('#form-field-edit').on('submit', function(event){
        event.preventDefault();
        $.ajax({
            url:"{{ url('/updateLokasi') }}",
            method:"POST",
            data: new FormData(this),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(data) {
                if ($.isEmptyObject(data.error)) {
                    swal({
                        title: "Success!",
                        text: data.success,
                        type: "success",
                    });
                } else {
                    swal({
                        title: "Error!",
                        text: data.error,
                        type: "error",
                    });
                }
                reset_defaults();
            }
        });
    });

    // Mencegah submit form saat tekan Enter
    $('form').on("keypress", function(e) {
        if (e.keyCode === 13) {               
            e.preventDefault();
            return false;
        }
    });
});
</script>

@endsection