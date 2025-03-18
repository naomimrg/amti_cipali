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
            <h4 class="black-color"><a style="color:black!important;" href="./">{{$vendor->nama_vendor}}</a> - {{$lokasi->nama_lokasi}}</h4>
        </div>
        <div class="col-6" style="text-align:right;">
            <button type="button" data-action="add" style="float:right;margin-bottom: 10px;" class="action btn btn-primary">Tambah Span</button>
        </div>
    </div>
    <div class="row">
        <div id="open-edit">
            <i class='bx bx-lock-alt'></i>
        </div>        
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <canvas id="myCanvas" class="w-100"></canvas>
                </div>
            </div>
        </div> 
        <div class="col-md-12" style="margin-top:10px;">
            <div class="d-flex">
                <div class="d-flex align-item-center mx-3 my-2">
                    <span class="status-circle status-critical"></span>
                    <div class="status-info">Critical</div>
                </div>
                <div class="d-flex align-item-center mx-3  my-2">
                    <span class="status-circle status-warning"></span>
                    <div class="status-info">Warning</div>
                </div>
                <div class="d-flex align-item-center mx-3  my-2">
                    <span class="status-circle status-good"></span>
                    <div class="status-info">Good</div>
                </div>
                <div class="d-flex align-item-center mx-3  my-2">
                    <span class="status-circle status-off"></span>
                    <div class="status-info">Offline</div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- / Content -->
<form id="form-field" autocomplete="off">
    <div class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Span</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id_span" value="" required>
                    <input type="hidden" name="id_lokasi" id="id_lokasi" value="{{$lokasi->id}}" required>
                    <div class="form-group">
                        <label><b>Nama Span</b></label>
                        <input type="text" class="form-control" value="" placeholder="Masukkan Nama Span" name="nama_span" id="nama_span">
                    </div>
                    <div class="form-group">
                        <label><b>Station ID</b></label>
                        <input type="text" class="form-control" value="" placeholder="Masukkan Station ID" name="station_id" id="station_id">
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
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>
<script type="text/javascript">

    $(document).ready(function() {
        $("#open-edit").click(function(){
            $("#myCanvas").toggleClass("w-100"); // Toggle class di canvas
            // Toggle class icon
            let icon = $(this).find("i");
            if (icon.hasClass("bx-lock-alt")) {
                icon.removeClass("bx-lock-alt").addClass("bx-lock-open-alt bx-tada");
            } else {
                icon.removeClass("bx-lock-open-alt bx-tada").addClass("bx-lock-alt");
            }
        });

    })
    
    $(document).ready(function () {
        const canvas = document.getElementById('myCanvas');
        const ctx = canvas.getContext('2d');
    
        const img = new Image();
        let shapes = [];
        let isImageLoaded = false;
        let isDataLoaded = false;
        let selectedShape = null; // ⬅ Tambahkan deklarasi di awal
        let offsetX = 0, offsetY = 0;
    
        // Pasang event listener sebelum menetapkan src
        img.onload = function() {
            console.log("Gambar selesai dimuat");
            canvas.width = canvas.clientWidth;
            canvas.height = canvas.clientHeight * 2.5; // Sesuaikan ukuran
    
            isImageLoaded = true;
            checkAndDraw(); // Cek apakah bisa langsung menggambar
        };
    
        // Atur src gambar, ini memicu `img.onload`
        img.src = "{{ url('/assets') }}/img/lokasi/{{$lokasi->foto}}";
    
        // Mengambil data sensor dari API
        function fetchSensorData() {
            $.ajax({
                url: "/client_sensor/listParameterClient",
                method: "GET",
                success: function(response) {
                    console.log("Data sensor diterima:", response);
    
                    if (response.data && response.data.length > 0) {
                        shapes = response.data.map((item, index) => ({
                            id: item.sensorId,
                            type: "circle",
                            x: Number(item.x_position) + (index * 10),  // Geser X sedikit ini karena masih default 100 semua
                            y: Number(item.y_position) + (index * 10),  // Geser Y sedikit ini karena masih default 100 semua
                            radius: 10,
                            color: "green"
                        }));
    
                        isDataLoaded = true;
                        console.log("Data sensor selesai dimuat");
                        checkAndDraw();
                    } else {
                        console.log("Tidak ada data sensor ditemukan.");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Terjadi kesalahan saat mengambil data sensor:", error);
                }
            });
        }

        canvas.addEventListener('mousedown', (e) => {
            const mouseX = e.offsetX;
            const mouseY = e.offsetY;
    
            shapes.forEach(shape => {
                if (
                    mouseX > shape.x && mouseX < shape.x + 50 &&
                    mouseY > shape.y && mouseY < shape.y + 25
                ) {
                    selectedShape = shape;
                    offsetX = mouseX - shape.x;
                    offsetY = mouseY - shape.y;
                }
            });
        });

        canvas.addEventListener('dblclick', (e) => {
            const mouseX = e.offsetX;
            const mouseY = e.offsetY;
        
            shapes.forEach(shape => {
                if (
                    mouseX > shape.x && mouseX < shape.x + 50 &&
                    mouseY > shape.y && mouseY < shape.y + 25
                ) {
                    alert(`Aku diklik! ID: ${shape.id}`);
                    //window.location.href = "{{ url('/admin_vendor/lokasi') }}/" + shape.id;
                    //window.location.href = "file:///C:/Users/Pongo/Downloads/hexa.html";
                }
            });
        });
    
        canvas.addEventListener('mousemove', (e) => {
            if (selectedShape) {
                selectedShape.x = e.offsetX - offsetX;
                selectedShape.y = e.offsetY - offsetY;
                drawAll();
            }
        });
    
        canvas.addEventListener('mouseup', () => {
            if (selectedShape) {
                console.log(`ID: ${selectedShape.id} | Final Position -> X: ${selectedShape.x}, Y: ${selectedShape.y}`);
                selectedShape = null; // Hentikan dragging
            }
        });
    
        function checkAndDraw() {
            console.log("Cek apakah semua data siap...");
            if (isImageLoaded && isDataLoaded) {
                console.log("Semua data siap, menggambar canvas...");
                drawAll();
            }
        }
    
        function drawAll() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
    
            shapes.forEach(shape => {
                drawRoundedRect(shape.x, shape.y, 50, 25, 15, 'white');
    
                if (shape.id.toLowerCase().includes("accl")) {
                    //drawRoundedRect(shape.x + 16, shape.y + 5, 15, 15, 1, shape.color);
                    drawRoundedRect(shape.x + 16, shape.y + 5, 15, 15, 1, 'red');
                } else if (shape.id.toLowerCase().includes("tiltmeter")) {
                    drawTriangle(shape.x + 25, shape.y + 2, 20, 'orange');
                } else if (shape.id.toLowerCase().includes("disp")) {
                    drawCircle(shape.x + 25, shape.y + 12, 10, 'black');
                } else if (shape.id.toLowerCase().includes("full")) {
                    drawHexagon(shape.x + 24, shape.y + 13, 10,'green');
                }
    
                text_label(shape.x + 40, shape.y + 13, shape.id);
            });
        }
    
        function drawRoundedRect(x, y, width, height, radius, color) {
            ctx.fillStyle = color;
            ctx.beginPath();
            ctx.moveTo(x + radius, y);
            ctx.lineTo(x + width - radius, y);
            ctx.quadraticCurveTo(x + width, y, x + width, y + radius);
            ctx.lineTo(x + width, y + height - radius);
            ctx.quadraticCurveTo(x + width, y + height, x + width - radius, y + height);
            ctx.lineTo(x + radius, y + height);
            ctx.quadraticCurveTo(x, y + height, x, y + height - radius);
            ctx.lineTo(x, y + radius);
            ctx.quadraticCurveTo(x, y, x + radius, y);
            ctx.closePath();
            ctx.fill();
        }
    
        function drawCircle(x, y, radius, color) {
            ctx.fillStyle = color;
            ctx.beginPath();
            ctx.arc(x, y, radius, 0, 2 * Math.PI);
            ctx.fill();
        }

        function drawTriangle(x, y, size, color) {
            const height = (Math.sqrt(3) / 2) * size; // Height of an equilateral triangle
            const x1 = x; // Top vertex
            const y1 = y;
            const x2 = x - size / 2; // Bottom left vertex
            const y2 = y + height;
            const x3 = x + size / 2; // Bottom right vertex
            const y3 = y + height;
    
            ctx.fillStyle = color;
            ctx.beginPath();
            ctx.moveTo(x1, y1);
            ctx.lineTo(x2, y2);
            ctx.lineTo(x3, y3);
            ctx.closePath();
            ctx.fill();
        }
    
        // Function to draw a hexagon
        function drawHexagon(x, y, size, color) {
            ctx.fillStyle = color;
            ctx.beginPath();
            for (let i = 0; i < 6; i++) {
                const angle = (Math.PI / 3) * i; // 60 degrees in radians
                const xPos = x + size * Math.cos(angle);
                const yPos = y + size * Math.sin(angle);
                ctx.lineTo(xPos, yPos);
            }
            ctx.closePath();
            ctx.fill();
        }
    
        function text_label(x, y, text) {
            ctx.fillStyle = 'black';
            ctx.font = '14px Arial';
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            ctx.fillText(text, x, y);
        }
    
        // Panggil fetchSensorData setelah gambar mulai dimuat
        fetchSensorData();
    });


</script>
@endsection
