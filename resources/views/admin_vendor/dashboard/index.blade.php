@extends('layouts.admin')
@section('title', 'Home')
@section('style')
<style>
.form-group{
    margin-bottom: 10px;
}
</style>

@endsection
@section('content')
    <div class="col-12">
        <!-- card atas -->
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4" style="border-radius: 20px; height: 200px;">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start"> <!-- Ubah align-items-center menjadi align-items-start -->
                            <div class="text-center"> <!-- Tambahkan text-center untuk meratakan gambar dan teks -->
                                <div class="gauge-container">
                                    <canvas id="gaugeCanvas1" width="130" height="130"></canvas>
                                </div>
                                <p class="mb-0 nunito-font font-weight-bold" style="font-size: 14px; color:#A3A3A3;">Current Value</p>
                                <p class="mb-0 nunito-font" id="value_natfreq" style="font-size: 14px; color:#161313;">? Hz</p>
                            </div>
                            <div class="flex-grow-1 d-flex flex-column justify-content-center"> <!-- Tambahkan d-flex dan flex-column -->
                                <a href="{{url()->current()}}/live_sensor/17" class="text-decoration-none">
                                    <h2 class="card-title ms-3 mb-0 nunito-font text-dark">Natural Frequency</h2>
                                </a>
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
                                <div class="gauge-container">
                                    <canvas id="gaugeCanvas2" width="130" height="130"></canvas>
                                </div>
                                <p class="mb-0 nunito-font font-weight-bold" style="font-size: 14px; color:#A3A3A3;">Current Value</p>
                                <p id="strain-value" class="mb-0 nunito-font" style="font-size: 14px; color:#161313;">? Microstain</p>
                            </div>
                            <div class="flex-grow-1 d-flex flex-column justify-content-center"> <!-- Tambahkan d-flex dan flex-column -->
                                <a href="{{url()->current()}}/live_sensor/17" class="text-decoration-none">
                                    <h2 class="card-title ms-3 mb-0 nunito-font text-dark">Strain Gauge</h2>
                                </a>
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
                                <div class="gauge-container">
                                    <canvas id="gaugeCanvas3" width="130" height="130"></canvas>
                                </div>
                                <p class="mb-0 nunito-font font-weight-bold" style="font-size: 14px; color:#A3A3A3;">Current Value</p>
                                <p class="mb-0 nunito-font" id="static-deflection" style="font-size: 14px; color:#161313;">? mm</p>
                            </div>
                            <div class="flex-grow-1 d-flex flex-column justify-content-center"> <!-- Tambahkan d-flex dan flex-column -->
                                <a href="{{url()->current()}}/live_sensor/17" class="text-decoration-none">
                                    <h2 class="card-title ms-3 mb-0 nunito-font text-dark">Static Deflection</h2>
                                </a>
                                <img src="/assets/img/Shade-static.png" alt="Shade Strain" class="img-fluid ms-5" style="width: 100%; height: auto; max-width: 300px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end card atas -->
         <!-- canvas -->
        <div class="row">
            <div id="open-edit">
                <i class='bx bx-lock-alt'></i>
            </div> 
            <div class="col-12">
                <div class="card">
                    <div class="card-body card-body-canvas"> 
                        <canvas id="myCanvas" class="w-100"></canvas>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                        <div class="d-flex justify-content-center w-100 ">
                            <div class="d-flex mx-auto">
                                <div class="sensor-indicator" style="background-color: #37B401;" title="Normal"></div>
                                <p class="font-indicator me-3">Normal</p>

                                <div class="sensor-indicator" style="background-color: #FECD08;" title="Warning"></div>
                                <p class="font-indicator me-3">Warning</p>

                                <div class="sensor-indicator" style="background-color: #FB0707;" title="Critical"></div>
                                <p class="font-indicator me-3">Critical</p>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>                        
        </div>
        <!-- end canvas -->
        <!-- card bawah -->
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
                                <div class="gauge-container">
                                    <canvas id="gaugeCanvas4" width="130" height="130"></canvas>
                                </div>
                                <p class="mb-0 nunito-font font-weight-bold" style="font-size: 14px; color:#A3A3A3;">Current Value</p>
                                <p class="mb-0 nunito-font" id="dynamic-deflection" style="font-size: 14px; color:#161313;">? mm</p>
                            </div>
                            <div class="flex-grow-1 d-flex flex-column justify-content-center"> <!-- Tambahkan d-flex dan flex-column -->
                                <a href="{{url()->current()}}/live_sensor/17" class="text-decoration-none">
                                    <h2 class="card-title ms-3 mb-0 nunito-font text-dark">Dynamic Deflection</h2>
                                </a>
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
                                <div class="gauge-container">
                                    <canvas id="gaugeCanvas5" width="130" height="130"></canvas>
                                </div>
                                <p class="mb-0 nunito-font font-weight-bold" style="font-size: 14px; color:#A3A3A3;">Current Value</p>
                                <p class="mb-0 nunito-font" id="vehicle-load" style="font-size: 14px; color:#161313;">3 Ton</p>
                            </div>
                            <div class="flex-grow-1 d-flex flex-column justify-content-center"> <!-- Tambahkan d-flex dan flex-column -->
                                <a href="{{url()->current()}}/live_sensor/17" class="text-decoration-none">
                                    <h2 class="card-title ms-3 mb-0 nunito-font text-dark">Vehicle load</h2>
                                </a>
                                <img src="/assets/img/Shade-vehicle.png" alt="Shade Strain" class="img-fluid ms-5" style="width: 100%; height: auto; max-width: 300px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <!-- endcard bawah -->
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
    
        // Pasang event listener sebelum menetapkan src
        img.onload = function() {
            canvas.width = img.width;
            canvas.height = img.height; // Sesuaikan ukuran
    
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
                            x: Number(item.x_position),
                            y: Number(item.y_position), 
                            radius: 10,
                            color:"black",
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
                    // Update nilai sensor berdasarkan nama sensor
                    updateSensorValue(data.data, "Full_Bridge", "strain-value", 'gaugeCanvas2');
                    updateSensorValue(data.data, "Tiltmeter", "static-deflection", 'gaugeCanvas3');
                    updateSensorValue(data.data, "Displacement", "dynamic-deflection", 'gaugeCanvas4');

                    drawAll(); // Redraw canvas setelah update warna
                }
            } catch (error) {
                console.error("Error fetching sensor status:", error);
            }
        }
        // Fungsi untuk memperbarui nilai dan menggambar gauge
        function updateSensorValue(sensors, sensorNamePart, elementId, canvasId) {
            const sensor = sensors.find(s => s.sensor_name.includes(sensorNamePart));
            const element = document.getElementById(elementId);

            if (sensor.max_value !== null) {
                const sensorValue = parseFloat(sensor.max_value);
                element.innerText = `${sensorValue.toFixed(2)} ${sensorNamePart === 'Full_Bridge' ? 'Microstrain' : 'mm'}`;
                drawGauge(canvasId, sensorValue.toFixed(2), parseInt(sensor.batas_atas), parseInt(sensor.batas_bawah));
            } else {
                element.innerText = `0 ${sensorNamePart === 'Full_Bridge' ? 'Microstrain' : 'mm'}`;
                drawGauge(canvasId, 0, parseInt(sensor.batas_atas), parseInt(sensor.batas_bawah));
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

        async function natFreqCurrentValue() {
            try {
                const response = await fetch("/live_sensor/currentnatfreq?lokasi={{ $lokasi->id }}");
                const data = await response.json();
                //console.log(data);
                
                if (data.status === "success") {
                    const value = parseInt(data.max_value); // Nilai sensor yang didapat
                    const maxValue = 55; // Nilai maksimum (misalnya, 55 Hz)
                    const warningValue = 45; // Nilai ambang batas peringatan (misalnya, 45 Hz)

                    // Menampilkan nilai natfreq dalam format Hz
                    document.getElementById("value_natfreq").innerText = `${value} Hz`;
                    
                    // Menggambar gauge berdasarkan nilai, maxValue, dan warningValue
                    drawGauge('gaugeCanvas1', value, maxValue, warningValue);
                }
            } catch (error) {
                console.error("Error fetching sensor natfreq status:", error);
            }
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
        //gauge handler
        function drawGauge(canvasId, value, maxValue, warningValue) {
            const canvas = document.getElementById(canvasId);
            const ctx = canvas.getContext('2d');
            const centerX = canvas.width / 2;
            const centerY = canvas.height / 2;
            const radius = Math.min(centerX, centerY) - 20;

            ctx.clearRect(0, 0, canvas.width, canvas.height); // Bersihkan canvas

            // Menentukan warna dan persentase berdasarkan nilai
            let color;
            let percentage;

            // Hitung persentase terlebih dahulu
            percentage = ((value / maxValue) * 100).toFixed(0);

            // Tentukan warna dan persentase berdasarkan kondisi
            if (value == 0) {
                color = '#000000'; // Hitam untuk nilai 0
                percentage = 100;  // Persentase 100% karena gauge full
            } else if (value < 0) {
                color = '#16A799'; // Hijau untuk nilai negatif
                percentage = ((value / maxValue) * 100).toFixed(0); // Persentase untuk nilai negatif
            } else if (value >= maxValue) {
                color = '#FF0E0E'; // Merah untuk nilai lebih dari atau sama dengan maxValue
                percentage = 100;  // Persentase 100%
            } else if (value >= warningValue) {
                color = '#E9E225'; // Kuning (Warning)
            } else {
                color = '#16A799'; // Hijau untuk nilai yang lebih rendah dari warningValue
            }

            // Menggambar lingkaran latar belakang
            ctx.beginPath();
            ctx.arc(centerX, centerY, radius, 0, 2 * Math.PI);
            ctx.lineWidth = 15;
            ctx.strokeStyle = '#e0e0e0';
            ctx.stroke();

            // Menggambar nilai gauge berdasarkan persentase yang dihitung
            const endAngle = (percentage / 100) * 2 * Math.PI; // Menghitung end angle dari persentase
            ctx.beginPath();
            ctx.arc(centerX, centerY, radius, -Math.PI / 2, endAngle - Math.PI / 2);
            ctx.lineWidth = 15;
            ctx.strokeStyle = color; // Warna gauge sesuai dengan kondisi
            ctx.stroke();

            // Menambahkan garis pembatas setiap 10%
            for (let i = 0; i <= 10; i++) {
                const angle = (i / 10) * 2 * Math.PI - Math.PI / 2;
                ctx.beginPath();
                ctx.moveTo(centerX + Math.cos(angle) * (radius - 12), centerY + Math.sin(angle) * (radius - 12));
                ctx.lineTo(centerX + Math.cos(angle) * (radius + 12), centerY + Math.sin(angle) * (radius + 12));
                ctx.lineWidth = 3;
                ctx.strokeStyle = '#fff'; // Warna garis pembatas
                ctx.stroke();
            }

            // Menambahkan teks nilai
            ctx.fillStyle = '#333';
            ctx.font = 'bold 20px Arial';
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            
            // Tampilkan "%" jika bukan 0, atau "!" jika value == 0
            if (value === 0) {
                ctx.fillText('--', centerX, centerY); // Teks "--" jika value = 0
            } else {
                ctx.fillText(percentage + '%', centerX, centerY); // Teks persen jika value != 0
            }
        }
        drawGauge('gaugeCanvas1', 0, 50, 30);
        drawGauge('gaugeCanvas2', 0, 50, 30);
        drawGauge('gaugeCanvas3', 0, 50, 30);
        drawGauge('gaugeCanvas4', 0, 50, 30);
        drawGauge('gaugeCanvas5', 0, 50, 30);


        // Panggil fetchSensorData setelah gambar mulai dimuat
        fetchSensorData();
        fetchSensorStatus();
        natFreqCurrentValue();

        // 🔹 Jalankan Fetch Data API Setiap 5 Detik
        setInterval(fetchSensorStatus, 5000);
        setInterval(natFreqCurrentValue, 5000);
        

    });



</script>
@endsection