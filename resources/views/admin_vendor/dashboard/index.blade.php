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
    
    function showData(){
        var pathArray = window.location.href.split('/');
        var id = pathArray[4];
        $.ajax({
            url: "{{ url('/listLokasiSpan') }}/"+id,
            dataType: "json",
            async: false,
            type: "GET",
            success: function(data) {	
                $('#list-span').html('');	
                $.each(data.items, function(index, item) {
                    $('#list-span').append('<div class="col-lg"><a href="{{ url("/home")}}/'+id+'/live_sensor "><div class="loc-sensor"><div class="list-sensor spanDrag" id="span_'+item.id+'" style="inset:'+item.y+'px auto auto '+item.x+'px;""><img src="{{ url("/assets") }}/img/'+item.status+'.png"><h5>'+item.no+'</h5></div></div></a></div>');
                });	
            }
        });
    }
    showData();
    $(document).ready(function() {
        realtime();
    });

    function realtime() {
        setTimeout(function() {
            statusUpdate();
            realtime();
        }, 15000);
    }

    function statusUpdate(){
        var pathArray = window.location.href.split('/');
        var id = pathArray[4];

        $.ajax({
            url: "{{ url('/listLokasiSpan') }}/"+id,
            dataType: "json",
            async: false,
            type: "GET",
            success: function(data) {		
                $.each(data.items, function(index, item) {
                    $("#span_"+item.id).html('<img src="{{ url("/assets") }}/img/'+item.status+'.png"><h5>'+item.no+'</h5>');
                });	
            }
        });
    }


    
    
    const canvas = document.getElementById('myCanvas');
    const ctx = canvas.getContext('2d');

    // Load the background image
    const img = new Image();
    img.src = "{{ url('/assets') }}/img/lokasi/{{$lokasi->foto}}";

    let shapes = [
        { id: 1, type: "rectangle", x: 900, y: 250, width: 50, height: 25, color: "black" },
        { id: 2, type: "circle", x: 925, y: 262, radius: 10, color: "red" },
        { id: 3, type: "triangle", x: 725, y: 252, size: 20, color: "yellow" },
        { id: 4, type: "rectangle", x: 516, y: 255, width: 15, height: 15, color: "green" }
    ];


    let selectedShape = null;
    let offsetX = 0, offsetY = 0;

    img.onload = function() {
        // Set canvas size to match the image
        canvas.width = img.width;
        canvas.height = img.height;

        // Draw the backg   round image
        ctx.drawImage(img, 0, 0);

        drawAll();

    };

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


    function drawGroupWithCircle(baseX, baseY,status) {
        drawRoundedRect(baseX, baseY, 50, 25, 15, 'white'); // Rectangle utama
        drawCircle(baseX + 25, baseY + 12, 10, status); // Circle (posisi relatif)
    }

    function drawGroupWithTriangle(baseX, baseY,status) {
        drawRoundedRect(baseX, baseY, 50, 25, 15, 'white'); // Rectangle utama
        drawTriangle(baseX + 25, baseY + 2, 20, status); // Triangle (posisi relatif)
    }

    function drawGroupWithRectangle(baseX, baseY,status) {
        drawRoundedRect(baseX, baseY, 50, 25, 15, 'white'); // Rectangle utama
        drawRoundedRect(baseX + 16, baseY + 5, 15, 15, 1, status); // Rectangle kecil (posisi relatif)
    }

    function drawGroupWithHexagon(baseX, baseY,status) {
        drawRoundedRect(baseX, baseY, 50, 25, 15, 'white'); // Rectangle utama
        drawHexagon(baseX + 24, baseY + 13, 10, status); // Hexagon (posisi relatif)
    }

    function drawAll() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.drawImage(img, 0, 0); // Gambar background

        shapes.forEach(shape => {
            drawRoundedRect(shape.x, shape.y, 50, 25, 15, 'white');
            
            if (shape.type === 'circle') {
                drawCircle(shape.x + 25, shape.y + 12, 10, shape.color);
            } else if (shape.type === 'triangle') {
                drawTriangle(shape.x + 25, shape.y + 2, 20, shape.color);
            } else if (shape.type === 'rectangle') {
                drawRoundedRect(shape.x + 16, shape.y + 5, 15, 15, 1, shape.color);
            } else if (shape.type === 'hexagon') {
                drawHexagon(shape.x + 24, shape.y + 13, 10, shape.color);
            }
            text_label(shape.x + 40, shape.y + 13, shape.id);
        });
    }

    // Function to draw a rounded rectangle
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

    // Function to draw a circle
    function drawCircle(x, y, radius, color) {
        ctx.fillStyle = color;
        ctx.beginPath();
        ctx.arc(x, y, radius, 0, 2 * Math.PI);
        ctx.fill();
    }

    // Function to draw a triangle
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
        ctx.fillStyle = 'black'; // Warna teks
        ctx.font = '14px Arial'; // Ukuran dan jenis font (sesuaikan sesuai kebutuhan)
        ctx.textAlign = 'center'; // Rata tengah secara horizontal (opsional)
        ctx.textBaseline = 'middle'; // Rata tengah secara vertikal (opsional)
        ctx.fillText(text, x, y);
    }
        
    
    



</script>
@endsection