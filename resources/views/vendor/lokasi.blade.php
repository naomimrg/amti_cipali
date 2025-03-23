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
        <div class="col-md-4">
            <div class="card mb-4" style="border-radius: 20px; height: 200px;">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-start"> <!-- Ubah align-items-center menjadi align-items-start -->
                        <div class="text-center"> <!-- Tambahkan text-center untuk meratakan gambar dan teks -->
                            <img src="/assets/img/gauge.png" alt="Gauge" class="mb-2" style="width: 100%; max-width: 80px;">
                            <p class="mb-0 nunito-font font-weight-bold" style="font-size: 14px; color:#A3A3A3;">Current Value</p>
                            <p class="mb-0 nunito-font" id="value_natfreq" style="font-size: 14px; color:#161313;">? Hz</p>
                        </div>
                        <div class="flex-grow-1 d-flex flex-column justify-content-center"> <!-- Tambahkan d-flex dan flex-column -->
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
                <div class="d-flex justify-content-between align-items-start"> <!-- Ubah align-items-center menjadi align-items-start -->
                    <div class="text-center"> <!-- Tambahkan text-center untuk meratakan gambar dan teks -->
                            <img src="/assets/img/gauge70.png" alt="Gauge" class="mb-2" style="width: 100%; max-width: 80px;">
                            <p class="mb-0 nunito-font font-weight-bold" style="font-size: 14px; color:#A3A3A3;">Current Value</p>
                            <p id="strain-value" class="mb-0 nunito-font" style="font-size: 14px; color:#161313;">? Microstain</p>
                        </div>
                        <div class="flex-grow-1 d-flex flex-column justify-content-center"> <!-- Tambahkan d-flex dan flex-column -->
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
                    <div class="d-flex justify-content-between align-items-start"> <!-- Ubah align-items-center menjadi align-items-start -->
                        <div class="text-center"> <!-- Tambahkan text-center untuk meratakan gambar dan teks -->
                            <img src="/assets/img/gauge20.png" alt="Gauge" class="mb-2" style="width: 100%; max-width: 80px;">
                            <p class="mb-0 nunito-font font-weight-bold" style="font-size: 14px; color:#A3A3A3;">Current Value</p>
                            <p class="mb-0 nunito-font" id="static-deflection" style="font-size: 14px; color:#161313;">? mm</p>
                        </div>
                        <div class="flex-grow-1 d-flex flex-column justify-content-center"> <!-- Tambahkan d-flex dan flex-column -->
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
                    <div class="d-flex justify-content-between align-items-start"> <!-- Ubah align-items-center menjadi align-items-start -->
                        <div class="text-center"> <!-- Tambahkan text-center untuk meratakan gambar dan teks -->
                            <img src="/assets/img/gauge20.png" alt="Gauge" class="mb-2" style="width: 100%; max-width: 80px;">
                            <p class="mb-0 nunito-font font-weight-bold" style="font-size: 14px; color:#A3A3A3;">Current Value</p>
                            <p class="mb-0 nunito-font" id="dynamic-deflection" style="font-size: 14px; color:#161313;">? mm</p>
                        </div>
                        <div class="flex-grow-1 d-flex flex-column justify-content-center"> <!-- Tambahkan d-flex dan flex-column -->
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
                    <div class="d-flex justify-content-between align-items-start"> <!-- Ubah align-items-center menjadi align-items-start -->
                        <div class="text-center"> <!-- Tambahkan text-center untuk meratakan gambar dan teks -->
                            <img src="/assets/img/gauge20.png" alt="Gauge" class="mb-2" style="width: 100%; max-width: 80px;">
                            <p class="mb-0 nunito-font font-weight-bold" style="font-size: 14px; color:#A3A3A3;">Current Value</p>
                            <p class="mb-0 nunito-font" id="vehicle-load" style="font-size: 14px; color:#161313;">3 Ton</p>
                        </div>
                        <div class="flex-grow-1 d-flex flex-column justify-content-center"> <!-- Tambahkan d-flex dan flex-column -->
                            <h2 class="card-title ms-3 mb-0 nunito-font" style="color:#161313;">Vehicle load</h2>
                            <img src="/assets/img/Shade-vehicle.png" alt="Shade Strain" class="img-fluid ms-5" style="width: 100%; height: auto; max-width: 300px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
<!-- / Content -->
@endsection
@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>
<script type="text/javascript">
    
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
            //console.log("Gambar selesai dimuat");
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
                url: "/client_sensor/listSensorClient",
                method: "GET",
                success: function(response) {
    
                    if (response && response.length > 0) {
                        //console.log(response);
                        shapes = response.map((item, index) => ({
                            id: item.id,
                            id_span: item.id_span,
                            number: item.sensor_name.split('_').pop(),
                            sensor_name: item.sensor_name,
                            x: Number(item.x_position),  // Geser X sedikit ini karena masih default 100 semua
                            y: Number(item.y_position),  // Geser Y sedikit ini karena masih default 100 semua
                            radius: 10,
                            color:"green",
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

        const apiUrl = "/client_sensor/status/{{ $lokasi->slug }}"; // Ganti dengan URL slug yang sesuai
        // 🔹 Fungsi Fetch Data dari API dan Update Shape
        async function fetchSensorStatus() {
            try {
                const response = await fetch(apiUrl);
                const data = await response.json();

                if (data.status === "success") {
                    // Update warna setiap shape berdasarkan status API
                    data.data.forEach(sensor => {
                        let shape = shapes.find(s => s.sensor_name === sensor.sensor_name);
                        if (shape) {
                            shape.color = getStatusColor(sensor.status);
                        }
                    });
                    // 🔹 Update nilai sensor "Full_Bridge_1"
                    const fullBridgeSensor = data.data.find(s => s.sensor_name.includes("Full_Bridge"));

                    if (fullBridgeSensor) {
                        document.getElementById("strain-value").innerText = `${fullBridgeSensor.max_value} Microstrain`;
                    } else {
                        document.getElementById("stain-value").innerText = "No data";
                    }

                    const staticDeflection = data.data.find(s => s.sensor_name.includes("Tiltmeter"));
                    if (staticDeflection) {
                        document.getElementById("static-deflection").innerText = `${staticDeflection.max_value} mm`;
                    }else{
                        document.getElementById("static-deflection").innerText = "No data";
                    }

                    const dynamicDeflection = data.data.find(s => s.sensor_name.includes("Displacement"));
                    if (dynamicDeflection) {
                        document.getElementById("dynamic-deflection").innerText = `${dynamicDeflection.max_value} mm`;
                    }else{
                        document.getElementById("dynamic-deflection").innerText = "No data";
                    }

                    drawAll(); // 🔹 Redraw canvas setelah update warna
                }
            } catch (error) {
                console.error("Error fetching sensor status:", error);
            }
        }
        // 🔹 Mapping Status API ke Warna
        function getStatusColor(status) {
            switch (status) {
                case "black": return "black";
                case "green": return "green";
                case "orange": return "orange";
                case "red": return "red";
                default: return "green";
            }
        }
        // fetch current value natfreq
        async function natFreqCurrentValue() {
            try {
                const response = await fetch("/live_sensor/currentnatfreq?lokasi={{ $lokasi->id }}");
                const data = await response.json();
                
                if (data.status === "success") {
                    document.getElementById("value_natfreq").innerText = `${data.max_value} Hz`;
                }
                } catch (error) {
                    console.error("Error fetching sensor natfreq status:", error);
                }
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
            const currentUrl = "{{ url()->current() }}"; // Mendapatkan URL saat ini
        
            shapes.forEach(shape => {
                if (
                    mouseX > shape.x && mouseX < shape.x + 50 &&
                    mouseY > shape.y && mouseY < shape.y + 25
                ) {
                    window.location.href = currentUrl + "/live_sensor/" + shape.id_span+"?id="+shape.id;
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
                // Buat data yang akan dikirim ke API
                const data = {
                    x_position: selectedShape.x,
                    y_position: selectedShape.y
                };

                // Mengirim permintaan PUT ke API
                fetch(`/client_sensor/updateKordinat/${selectedShape.id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(data)
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Success update coordinate sensor');
                })
                .catch((error) => {
                    console.error('Error:', error);
                });

                selectedShape = null; // Hentikan dragging
            }
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
                
                let color = shape.color;
                
                if (shape.sensor_name.toLowerCase().includes("accelerometer")) {
                    drawRoundedRect(shape.x + 16, shape.y + 5, 15, 15, 1, color);
                } else if (shape.sensor_name.toLowerCase().includes("tiltmeter")) {
                    drawTriangle(shape.x + 25, shape.y + 2, 20, color);
                } else if (shape.sensor_name.toLowerCase().includes("displacement")) {
                    drawCircle(shape.x + 20, shape.y + 12, 10, color);
                } else if (shape.sensor_name.toLowerCase().includes("full_bridge")) {
                    drawHexagon(shape.x + 24, shape.y + 13, 10, color);
                }

                text_label(shape.x + 40, shape.y + 13, shape.number);
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

        // 🔹 Jalankan Fetch Data API Setiap 10 Detik
        setInterval(fetchSensorStatus, 5000);
        setInterval(natFreqCurrentValue, 5000);
        
        // Panggil fetchSensorData setelah gambar mulai dimuat
        fetchSensorData();
    });


</script>
@endsection
