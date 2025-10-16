@extends('layouts.admin')
@section('title', 'Vendor')
@section('style')
    <style>
        .form-group {
            margin-bottom: 10px;
        }

        :root {
            --card-radius: 20px;
            --card-height: 200px;
            --txt-muted: #A3A3A3;
            --txt-dark: #161313;
        }

        .metric-card {
            border-radius: var(--card-radius);
            min-height: var(--card-height);
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(0, 0, 0, .06);
        }

        .metric-card .card-body {
            padding: 16px 18px;
        }

        .metric-stack {
            display: grid;
            grid-template-columns: 100px 1fr;
            column-gap: 12px;
            align-items: start;
        }

        .gauge-wrap {
            text-align: center;
        }

        .gauge-wrap canvas {
            width: 100px;
            height: 100px;
        }

        .gauge-wrap .label {
            margin: 2px 0 0;
            font-size: 12px;
            color: var(--txt-muted);
            font-weight: 700;
        }

        .gauge-wrap .value {
            margin: 0;
            font-size: 14px;
            color: var(--txt-dark);
        }

        .metric-title {
            margin: 2px 0 0;
            font-weight: 800;
            line-height: 1.15;
            font-size: 18px;
            padding-right: 56px;
        }

        .text-truncate-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .metric-illus {
            position: absolute;
            right: 8px;
            bottom: 8px;
            width: 160px;
            max-width: 38%;
            opacity: .85;
            pointer-events: none;
            user-select: none;
        }

        .metric-card.h-100 {
            display: flex;
        }

        .metric-card .card-body {
            display: block;
            width: 100%;
        }

        <style>#myCanvas {
            max-width: 600px;
            width: 100%;
            height: auto;
            aspect-ratio: 16/9;
        }
    </style>
@endsection
@section('content')
    <div class="col-12">
        <!-- card -->
        <div class="col-12">
            <div class="row g-3 row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-5">

                <!-- Natural Frequency -->
                <div class="col">
                    <div class="card metric-card h-100">
                        <div class="card-body">
                            <div class="metric-stack">
                                <div class="gauge-wrap">
                                    <canvas id="gaugeCanvas1" width="130" height="130"></canvas>
                                    <p class="label nunito-font">Current Value</p>
                                    <p class="value nunito-font" id="value_natfreq">? Hz</p>
                                </div>
                                <div>
                                    <a href="{{ route('live_sensor', [$vendor->slug, $lokasi->slug]) }}"
                                        class="stretched-link text-decoration-none">
                                        <h2 class="metric-title nunito-font text-dark text-truncate-2">Natural Frequency
                                        </h2>
                                    </a>
                                </div>
                            </div>
                            <img src="/assets/img/Shade-natural.png" alt="" class="metric-illus">
                        </div>
                    </div>
                </div>

                <!-- Strain Gauge -->
                <div class="col">
                    <div class="card metric-card h-100">
                        <div class="card-body">
                            <div class="metric-stack">
                                <div class="gauge-wrap">
                                    <canvas id="gaugeCanvas2" width="130" height="130"></canvas>
                                    <p class="label nunito-font">Current Value</p>
                                    <p class="value nunito-font" id="strain-value">? Microstrain</p>
                                </div>
                                <div>
                                    <a href="{{ route('live_sensor', [$vendor->slug, $lokasi->slug]) }}"
                                        class="stretched-link text-decoration-none">
                                        <h2 class="metric-title nunito-font text-dark text-truncate-2">Strain Gauge</h2>
                                    </a>
                                </div>
                            </div>
                            <img src="/assets/img/Shade-strain.png" alt="" class="metric-illus">
                        </div>
                    </div>
                </div>

                <!-- Static Deflection -->
                <div class="col">
                    <div class="card metric-card h-100">
                        <div class="card-body">
                            <div class="metric-stack">
                                <div class="gauge-wrap">
                                    <canvas id="gaugeCanvas3" width="130" height="130"></canvas>
                                    <p class="label nunito-font">Current Value</p>
                                    <p class="value nunito-font" id="static-deflection">? mm</p>
                                </div>
                                <div>
                                    <a href="{{ route('live_sensor', [$vendor->slug, $lokasi->slug]) }}"
                                        class="stretched-link text-decoration-none">
                                        <h2 class="metric-title nunito-font text-dark text-truncate-2">Static Deflection
                                        </h2>
                                    </a>
                                </div>
                            </div>
                            <img src="/assets/img/Shade-static.png" alt="" class="metric-illus">
                        </div>
                    </div>
                </div>

                <!-- Dynamic Deflection -->
                <div class="col">
                    <div class="card metric-card h-100">
                        <div class="card-body">
                            <div class="metric-stack">
                                <div class="gauge-wrap">
                                    <canvas id="gaugeCanvas4" width="130" height="130"></canvas>
                                    <p class="label nunito-font">Current Value</p>
                                    <p class="value nunito-font" id="dynamic-deflection">? mm</p>
                                </div>
                                <div>
                                    <a href="{{ route('live_sensor', [$vendor->slug, $lokasi->slug]) }}"
                                        class="stretched-link text-decoration-none">
                                        <h2 class="metric-title nunito-font text-dark text-truncate-2">Dynamic Deflection
                                        </h2>
                                    </a>
                                </div>
                            </div>
                            <img src="/assets/img/Shade-dynamic.png" alt="" class="metric-illus">
                        </div>
                    </div>
                </div>

                <!-- Vehicle Load -->
                <div class="col">
                    <div class="card metric-card h-100">
                        <div class="card-body">
                            <div class="metric-stack">
                                <div class="gauge-wrap">
                                    <canvas id="gaugeCanvas5" width="130" height="130"></canvas>
                                    <p class="label nunito-font">Current Value</p>
                                    <p class="value nunito-font" id="vehicle-load">3 Ton</p>
                                </div>
                                <div>
                                    <a href="{{ route('live_sensor', [$vendor->slug, $lokasi->slug]) }}"
                                        class="stretched-link text-decoration-none">
                                        <h2 class="metric-title nunito-font text-dark text-truncate-2">Vehicle Load</h2>
                                    </a>
                                </div>
                            </div>
                            <img src="/assets/img/Shade-vehicle.png" alt="" class="metric-illus">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end card -->
        <!-- canvas -->
        <div class="row">
            <div id="open-edit">
                <i class='bx bx-lock-alt'></i>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body card-body-canvas">
                        <canvas id="myCanvas" class="w-100"></canvas>
                        <div class="d-flex justify-content-center align-items-center mt-3 gap-4">
                            <!-- Normal -->
                            <div class="d-flex align-items-center">
                                <div class="sensor-indicator"
                                    style="background-color: #37B401; width:40px; height:8px; border-radius:4px; margin-right:6px;">
                                </div>
                                <span class="font-indicator">Normal</span>
                            </div>
                            <!-- Warning -->
                            <div class="d-flex align-items-center">
                                <div class="sensor-indicator"
                                    style="background-color: #FECD08; width:40px; height:8px; border-radius:4px; margin-right:6px;">
                                </div>
                                <span class="font-indicator">Warning</span>
                            </div>
                            <!-- Critical -->
                            <div class="d-flex align-items-center">
                                <div class="sensor-indicator"
                                    style="background-color: #FB0707; width:40px; height:8px; border-radius:4px; margin-right:6px;">
                                </div>
                                <span class="font-indicator">Critical</span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-start align-items-center mt-3 flex-wrap">
                            <div class="d-flex align-items-center me-4">
                                <img src="/assets/img/square-line.png" alt="Accelerometer"
                                    style="width: 20px; margin-right: 8px;">
                                <p class="mb-0 nunito-font" style="color: black;">Accelerometer</p>
                            </div>
                            <div class="d-flex align-items-center me-4">
                                <img src="/assets/img/triangle-line.png" alt="Tiltmeter"
                                    style="width: 20px; margin-right: 8px;">
                                <p class="mb-0 nunito-font" style="color: black;">Tiltmeter</p>
                            </div>
                            <div class="d-flex align-items-center me-4">
                                <img src="/assets/img/hexagon-line.png" alt="Strain Gauge"
                                    style="width: 20px; margin-right: 8px;">
                                <p class="mb-0 nunito-font" style="color: black;">Strain Gauge</p>
                            </div>
                            <div class="d-flex align-items-center">
                                <img src="/assets/img/circle-line.png" alt="Displacement"
                                    style="width: 20px; margin-right: 8px;">
                                <p class="mb-0 nunito-font" style="color: black;">Displacement</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end canvas -->
    </div>
@endsection
@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            const canvas = document.getElementById('myCanvas');
            const ctx = canvas.getContext('2d');

            const img = new Image();
            let shapes = [];
            let isImageLoaded = false;
            let isDataLoaded = false;
            let selectedShape = null;
            let offsetX = 0,
                offsetY = 0;

            $("#open-edit").click(function() {
                $("#myCanvas").toggleClass("w-100");
                let icon = $(this).find("i");
                if (icon.hasClass("bx-lock-alt")) {
                    icon.removeClass("bx-lock-alt").addClass("bx-lock-open-alt bx-tada");
                } else {
                    icon.removeClass("bx-lock-open-alt bx-tada").addClass("bx-lock-alt");
                }
            });

            img.onload = function() {
                canvas.width = img.width;
                canvas.height = img.height;

                isImageLoaded = true;
                checkAndDraw();
            };

            img.src = "{{ url('/assets') }}/img/lokasi/{{ $lokasi->foto }}";

            function fetchSensorData() {
                $.ajax({
                    url: "/client_sensor/listSensorClient/{{ $lokasi->id }}",
                    method: "GET",
                    success: function(response) {
                        console.log(response);
                        if (response && response.data && response.data.length > 0) {
                            shapes = response.data.map((item, index) => ({
                                id: item.id,
                                id_span: item.id_span,
                                number: item.sensor_name.split('_').pop(),
                                sensor_name: item.sensor_name,
                                x: Number(item.x_position),
                                y: Number(item.y_position),
                                radius: 10,
                                color: "black",
                            }));
                            isDataLoaded = true;
                            checkAndDraw();
                        } else {
                            console.log("Tidak ada data sensor ditemukan.");

                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error);
                    }
                });
            }

            const apiUrl = "/client_sensor/status/{{ $lokasi->slug }}";
            async function fetchSensorStatus() {
                try {
                    const response = await fetch(apiUrl);
                    const data = await response.json();

                    console.log(data.status);

                    if (data.status === "success") {
                        data.data.forEach(sensor => {
                            let shape = shapes.find(s => s.sensor_name === sensor.sensor_name);
                            if (shape) {
                                shape.color = getStatusColor(sensor.status);
                            }
                        });

                        updateSensorValue(data.data, "Full_Bridge", "strain-value", 'gaugeCanvas2');
                        updateSensorValue(data.data, "Tiltmeter", "static-deflection", 'gaugeCanvas3');
                        updateSensorValue(data.data, "Displacement", "dynamic-deflection", 'gaugeCanvas4');

                        drawAll();
                    } else {
                        console.error("Error fetching sensor status:", data.status, "message:", data.message);
                    }
                } catch (error) {
                    console.error("Error fetching sensor status:", error);
                }
            }

            function updateSensorValue(sensors, sensorNamePart, elementId, canvasId) {
                const sensor = sensors.find(s => s && s.sensor_name && s.sensor_name.includes(sensorNamePart));
                const element = document.getElementById(elementId);

                if (!sensor) {
                    element.innerText = `0 ${sensorNamePart === 'Full_Bridge' ? 'Microstrain' : 'mm'}`;
                    drawGauge(canvasId, 0, 100, 0);
                    return;
                }

                const value = sensor.max_value !== null ? parseFloat(sensor.max_value) : 0;
                const satuan = sensorNamePart === 'Full_Bridge' ? 'Microstrain' : 'mm';

                element.innerText = `${value.toFixed(2)} ${satuan}`;

                drawGauge(
                    canvasId,
                    value.toFixed(2),
                    parseInt(sensor.batas_atas ?? 100),
                    parseInt(sensor.batas_bawah ?? 0)
                );
            }

            function getStatusColor(status) {
                switch (status) {
                    case "black":
                        return "black";
                    case "green":
                        return "green";
                    case "orange":
                        return "orange";
                    case "red":
                        return "red";
                    default:
                        return "green";
                }
            }

            async function natFreqCurrentValue() {
                try {
                    const response = await fetch("/live_sensor/currentnatfreq?lokasi={{ $lokasi->id }}");
                    const data = await response.json();

                    if (data.status === "success") {
                        const value = parseInt(data.z);
                        console.log('ini dari z: ' + value);
                        console.log('ini dari max_value: ' + data.max_value);
                        console.log(data.max_value);
                        const maxValue = 55;
                        const warningValue = 45;

                        document.getElementById("value_natfreq").innerText = `${value} Hz`;

                        drawGauge('gaugeCanvas1', value, maxValue, warningValue);
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
                const currentUrl = "{{ url()->current() }}";

                shapes.forEach(shape => {
                    if (
                        mouseX > shape.x && mouseX < shape.x + 50 &&
                        mouseY > shape.y && mouseY < shape.y + 25
                    ) {
                        window.location.href = currentUrl + "/live_sensor/" + shape.id_span +
                            "?id=" + shape.id;
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
                    const data = {
                        x_position: selectedShape.x,
                        y_position: selectedShape.y
                    };

                    fetch(`/client_sensor/updateKordinat/${selectedShape.id}`, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content')
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

                    selectedShape = null;
                }
            });

            function checkAndDraw() {
                if (isImageLoaded) {
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
                    } else if (shape.sensor_name.toLowerCase().includes("straingauge")) {
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
                const height = (Math.sqrt(3) / 2) * size;
                const x1 = x;
                const y1 = y;
                const x2 = x - size / 2;
                const y2 = y + height;
                const x3 = x + size / 2;
                const y3 = y + height;

                ctx.fillStyle = color;
                ctx.beginPath();
                ctx.moveTo(x1, y1);
                ctx.lineTo(x2, y2);
                ctx.lineTo(x3, y3);
                ctx.closePath();
                ctx.fill();
            }

            function drawHexagon(x, y, size, color) {
                ctx.fillStyle = color;
                ctx.beginPath();
                for (let i = 0; i < 6; i++) {
                    const angle = (Math.PI / 3) * i;
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

            function drawGauge(canvasId, value, maxValue, warningValue) {
                const canvas = document.getElementById(canvasId);
                const ctx = canvas.getContext('2d');
                const centerX = canvas.width / 2;
                const centerY = canvas.height / 2;
                const radius = Math.min(centerX, centerY) - 20;

                ctx.clearRect(0, 0, canvas.width, canvas.height);

                let color;
                let percentage;

                percentage = ((value / maxValue) * 100).toFixed(0);

                if (value == 0) {
                    color = '#000000';
                    percentage = 100;
                } else if (value < 0) {
                    color = '#16A799';
                    percentage = ((value / maxValue) * 100).toFixed(0);
                } else if (value >= maxValue) {
                    color = '#FF0E0E';
                    percentage = 100;
                } else if (value >= warningValue) {
                    color = '#E9E225';
                } else {
                    color = '#16A799';
                }

                ctx.beginPath();
                ctx.arc(centerX, centerY, radius, 0, 2 * Math.PI);
                ctx.lineWidth = 15;
                ctx.strokeStyle = '#e0e0e0';
                ctx.stroke();

                const endAngle = (percentage / 100) * 2 * Math.PI;
                ctx.beginPath();
                ctx.arc(centerX, centerY, radius, -Math.PI / 2, endAngle - Math.PI / 2);
                ctx.lineWidth = 15;
                ctx.strokeStyle = color;
                ctx.stroke();

                for (let i = 0; i <= 10; i++) {
                    const angle = (i / 10) * 2 * Math.PI - Math.PI / 2;
                    ctx.beginPath();
                    ctx.moveTo(centerX + Math.cos(angle) * (radius - 12), centerY + Math.sin(angle) * (radius -
                        12));
                    ctx.lineTo(centerX + Math.cos(angle) * (radius + 12), centerY + Math.sin(angle) * (radius +
                        12));
                    ctx.lineWidth = 3;
                    ctx.strokeStyle = '#fff';
                    ctx.stroke();
                }

                ctx.fillStyle = '#333';
                ctx.font = 'bold 20px Arial';
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';

                if (value === 0) {
                    ctx.fillText('--', centerX, centerY);
                } else {
                    ctx.fillText(percentage + '%', centerX, centerY);
                }
            }
            drawGauge('gaugeCanvas1', 0, 50, 30);
            drawGauge('gaugeCanvas2', 0, 50, 30);
            drawGauge('gaugeCanvas3', 0, 50, 30);
            drawGauge('gaugeCanvas4', 0, 50, 30);
            drawGauge('gaugeCanvas5', 0, 50, 30);

            fetchSensorData();
            fetchSensorStatus();
            natFreqCurrentValue();

            setInterval(fetchSensorStatus, 5000);
            setInterval(natFreqCurrentValue, 5000);

        });
    </script>
@endsection