@extends('layouts.admin')
@section('title', 'Daftar Sensor')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ url('/assets') }}/css/dataTables.bootstrap4.min.css">
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
            <h5 class="black-color">Daftar Default Sensor</h5>
        </div>
        <div class="col-6" style="text-align:right;">
        </div>
    </div>
    <div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body p-3">
                <div class="table-responsive">
                    <table id="table-parameter" class="table table-bordered table-hover table-sm mb-0" style="font-size: 11px;">
                        <thead class="text-center" style="background-color: #0ec8cf;">
                            <tr>
                                <th>No</th>
                                <th>Sensor</th>
                                <th>Batas Bawah</th>
                                <th>Batas Atas</th>
                                <th>Satuan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be populated here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<form id="form-field" autocomplete="off">
    <div class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Sensor</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id_parameter" value="" required>
                    <div class="form-group">
                        <label><b>Nama</b></label>
                        <input type="text" class="form-control" value="" placeholder="Nama Sensor" name="nama_parameter" id="nama_parameter">
                    </div>
                    <div class="form-group">
                        <label><b>Batas Bawah</b></label>
                        <input type="text" class="form-control" value="" placeholder="Batas Bawah" name="batas_bawah" id="batas_bawah">
                    </div>
                    <div class="form-group">
                        <label><b>Batas Atas</b></label>
                        <input type="text" class="form-control" value="" placeholder="Batas Atas" name="batas_atas" id="batas_atas">
                    </div>
                    <div class="form-group">
                        <label><b>Satuan</b></label>
                        <input type="text" class="form-control" value="" placeholder="Satuan" name="satuan" id="satuan">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect closemodal">Batal</button>
                    <button type="button" data-action="simpan" class="action btn btn-primary waves-effect waves-light">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@section('script')
<script src="{{ url('/assets') }}/js/datatables/jquery.dataTables.min.js"></script>
<script src="{{ url('/assets') }}/js/datatables/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'csrftoken': '{{ csrf_token() }}'
        }
    });
    
    var table1;
    $(function() {
        table1 = $('#table-parameter').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('/parameter/list-parameter') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'nama_parameter', name: 'nama_parameter'},
                {data: 'batas_bawah', name: 'batas_bawah'},
                {data: 'batas_atas', name: 'batas_atas'},
                {data: 'satuan', name: 'satuan'},
                {data: 'action', name: 'action'},
            ]
        });
    });

   var mode;

    function show_modal(data) {

        if (mode == "add") {
            $('#form-field').children('.modal').find('.modal-title').text("Tambah Sensor");
			$('#form-field').find('input[name="nama_parameter"]').val("");
			$('#form-field').find('input[name="batas_bawah"]').val("");
            $('#form-field').find('input[name="batas_atas"]').val("")
            $('#form-field').find('seect[name="satuan"]').val("");
            $('#form-field').find('input[name="id"]').val("");
            $('#form-field').children('.modal').modal('show');
        } else if (mode == "edit") {
            $.ajax({
                url: "{{ url('/parameter') }}/" + data + "/edit",
                dataType: "json",
                type: "GET",
                success: function(data) {
                    $('#form-field').find('input[name="nama_parameter"]').val(data.nama_parameter);
                    $('#form-field').find('input[name="batas_bawah"]').val(data.batas_bawah);
                    $('#form-field').find('input[name="batas_atas"]').val(data.batas_atas);
                    $('#form-field').find('input[name="satuan"]').val(data.satuan);
                    $('#form-field').find('input[name="id"]').val(data.id);
                }
            })
            $('#form-field').children('.modal').find('.modal-title').text("Edit Sensor");
            $('#form-field').children('.modal').modal('show');
           
        }
    }

    function reset_default() {
        $('#form-field')[0].reset();
        $('#form-field').find('input[name="id"]').val('');
        mode = undefined;
        table1.ajax.reload(null, false);
        $('#form-field').children('.modal').modal('hide');
    }

    function clear() {
        $('#form-field')[0].reset();
    }


    $(document).on('click', ".action", function() {
        $('.closemodal').click(function() {
            $('#form-field').children('.modal').modal('hide');
        });
        var self = this;

        var action = $(this).attr('data-action');
		if (action == "add") {
            mode = "add";
            clear();
            show_modal();
        } else if (action == "edit") {
            mode = "edit";
            var data = $(this).attr('data-id');
            show_modal(data);
        } else if (action == "simpan") {
            var ids = "";
            
            var id = $("input[id='id_parameter']").val();
            if (id == "") {
                var tipe = "POST";
            } else {
                var tipe = "PUT";
                var ids = "/"+id;
            }

            $.ajax({
                url: "{{ url('/parameter') }}" + ids,
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
            })
        }
    })
    $('form').bind("keypress", function(e) {
        if (e.keyCode == 13) {               
            e.preventDefault();
            return false;
        }
    });
</script>
@endsection