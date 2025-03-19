@extends('layouts.admin')
@section('title', 'Home')
@section('style')
<style>
.form-group{
    margin-bottom: 10px;
}
.spanDrag {
    position: absolute;
    cursor: move;
    padding: 10px;
    background-size:cover;
    background-repeat: no-repeat;
    width: 75px;
    height: 120px;
}
</style>

@endsection
@section('content')
                <div class="col-12">
                    <div class="row">
                        <div class="col-6">
                            <!-- <h4 class="black-color">{{$vendor->nama_vendor}} - {{$lokasi->nama_lokasi}}</h4> -->
                            <h2 class="nunito-font" style="font-weight: bold; color:#202224">Dashboard</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mb-4" style="border-radius: 20px; height: 200px;">
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="">
                                            <img src="/assets/img/gauge.png" alt="Gauge" class="mb-2" style="width: 100%; max-width: 80px;">
                                            <p class="mb-0 nunito-font font-weight-bold" style="font-size: 14px; color:#A3A3A3;">Current Value</p>
                                            <p class="mb-0 nunito-font" style="font-size: 14px; color:#161313;">24 Hz (Hertz)</p>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h2 class="card-title ms-3 mb-0 nunito-font" style="color:#161313;">Natural Frequency</h2>
                                            <img src="/assets/img/Shade-natural.png" alt="Shade Strain" class="img-fluid ms-5" style="width: 100%; height: auto; max-width: 300px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-4" style="border-radius: 20px; height: 200px;">
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="">
                                            <img src="/assets/img/gauge70.png" alt="Gauge" class="mb-2" style="width: 100%; max-width: 80px;">
                                            <p class="mb-0 nunito-font font-weight-bold" style="font-size: 14px; color:#A3A3A3;">Current Value</p>
                                            <p class="mb-0 nunito-font" style="font-size: 14px; color:#161313;">1,22 Microstrain</p>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h2 class="card-title ms-3 mb-0 nunito-font" style="color:#161313;">Strain Gauge</h2>
                                            <img src="/assets/img/Shade-strain.png" alt="Shade Strain" class="img-fluid ms-5" style="width: 100%; height: auto; max-width: 300px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-4" style="border-radius: 20px; height: 200px;">
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="">
                                            <img src="/assets/img/gauge20.png" alt="Gauge" class="mb-2" style="width: 100%; max-width: 80px;">
                                            <p class="mb-0 nunito-font font-weight-bold" style="font-size: 14px; color:#A3A3A3;">Current Value</p>
                                            <p class="mb-0 nunito-font" style="font-size: 14px; color:#161313;">1,22 mm</p>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h2 class="card-title ms-3 mb-0 nunito-font" style="color:#161313;">Static Deflection</h2>
                                            <img src="/assets/img/Shade-static.png" alt="Shade Strain" class="img-fluid ms-5" style="width: 100%; height: auto; max-width: 300px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body"> 
                                    <canvas id="myCanvas" class="w-100"></canvas>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="card mb-4" style="border-radius: 20px; height: 200px;">
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex align-items-center mb-2">
                                        <img src="/assets/img/square-line.png" alt="Gauge" style="width: 20px; height: auto; margin-right: 10px;">
                                        <div class="flex-grow-1">
                                            <p class="mb-0 nunito-font" style="color: black;">Accelerometer</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <img src="/assets/img/triangle-line.png" alt="Tiltmeter" style="width: 20px; height: auto; margin-right: 10px;">
                                        <div class="flex-grow-1">
                                            <p class="mb-0 nunito-font" style="color: black;">Tiltmeter</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <img src="/assets/img/hexagon-line.png" alt="Strain" style="width: 20px; height: auto; margin-right: 10px;">
                                        <div class="flex-grow-1">
                                            <p class="mb-0 nunito-font" style="color: black;">Strain Gauge</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <img src="/assets/img/circle-line.png" alt="Displacement" style="width: 20px; height: auto; margin-right: 10px;">
                                        <div class="flex-grow-1">
                                            <p class="mb-0 nunito-font" style="color: black;">Displacement</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-4" style="border-radius: 20px; height: 200px;">
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="">
                                            <img src="/assets/img/gauge20.png" alt="Gauge" class="mb-2" style="width: 100%; max-width: 80px;">
                                            <p class="mb-0 nunito-font font-weight-bold" style="font-size: 14px; color:#A3A3A3;">Current Value</p>
                                            <p class="mb-0 nunito-font" style="font-size: 14px; color:#161313;">1,22 mm</p>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h2 class="card-title ms-3 mb-0 nunito-font" style="color:#161313;">Dynamic Deflection</h2>
                                            <img src="/assets/img/Shade-dynamic.png" alt="Shade Strain" class="img-fluid ms-5" style="width: 100%; height: auto; max-width: 300px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-4" style="border-radius: 20px; height: 200px;">
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="">
                                            <img src="/assets/img/gauge20.png" alt="Gauge" class="mb-2" style="width: 100%; max-width: 80px;">
                                            <p class="mb-0 nunito-font font-weight-bold" style="font-size: 14px; color:#A3A3A3;">Current Value</p>
                                            <p class="mb-0 nunito-font" style="font-size: 14px; color:#161313;">3 Ton</p>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h2 class="card-title ms-3 mb-0 nunito-font" style="color:#161313;">Vehicle load</h2>
                                            <img src="/assets/img/Shade-vehicle.png" alt="Shade Strain" class="img-fluid ms-5" style="width: 100%; height: auto; max-width: 300px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
@endsection
@section('script')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'csrftoken': '{{ csrf_token() }}'
        }
    }); 
    

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
            const aspectRatio = img.width / img.height;
            canvas.width = canvas.clientWidth;
            canvas.height = canvas.clientWidth/aspectRatio; // Sesuaikan ukuran
    
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
                            idsensor: item.Idsensor,
                            id_span: item.id_span,
                            x: Number(item.x_position),
                            y: Number(item.y_position), 
                            radius: 10,
                        }));
    
                        isDataLoaded = true;
                        //console.log("Data sensor selesai dimuat");
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

        canvas.addEventListener('dblclick', (e) => {
            const mouseX = e.offsetX;
            const mouseY = e.offsetY;
            const currentUrl = "{{ url()->current() }}"; // Mendapatkan URL saat ini

        // Misalkan Anda memiliki shape yang dipilih
        
            shapes.forEach(shape => {
                if (
                    mouseX > shape.x && mouseX < shape.x + 50 &&
                    mouseY > shape.y && mouseY < shape.y + 25
                ) {
                    window.location.href = currentUrl + "/live_sensor/" + shape.id_span;
                }
            });
        });

    
        function checkAndDraw() {
            //console.log("Cek apakah semua data siap...");
            if (isImageLoaded && isDataLoaded) {
                //console.log("Semua data siap, menggambar canvas...");
                drawAll();
            }
        }
    
        function drawAll() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
    
            shapes.forEach(shape => {
                drawRoundedRect(shape.x, shape.y, 50, 25, 15, 'white');
    
                if (shape.id.toLowerCase().includes("accl")) {
                    drawRoundedRect(shape.x + 16, shape.y + 5, 15, 15, 1, 'red');
                } else if (shape.id.toLowerCase().includes("tiltmeter")) {
                    drawTriangle(shape.x + 25, shape.y + 2, 20, 'orange');
                } else if (shape.id.toLowerCase().includes("disp")) {
                    drawCircle(shape.x + 25, shape.y + 12, 10, 'black');
                } else if (shape.id.toLowerCase().includes("full")) {
                    drawHexagon(shape.x + 24, shape.y + 13, 10,'green');
                }
    
                text_label(shape.x + 40, shape.y + 13, shape.idsensor);
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