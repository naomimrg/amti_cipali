@extends('layouts.admin')
@section('title', 'Live Sensor')
@section('style')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-annotation/3.0.1/chartjs-plugin-annotation.min.js"></script>
 <style>

.filter-list {
    display: flex;
    margin-bottom: 10px;
}
.btn-filter {
    background: #aeaebd;
    border-radius: 0;
    border:none;
    color: white;
}
.form-group{
    margin-bottom: 10px;
}
</style>
@endsection
@section('content')
      
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                <h4 class="black-color" >
                                    <a href="./" class="btn btn-primary btn-sm">
                                        <span class="d-flex align-items-center justify-content-center text-nowrap"><i class="bx bxs-left-arrow-circle bx-xs me-1"></i>Kembali</span>
                                    </a>
                                    {{$lokasi->nama_lokasi}} - {{$span->nama_span}}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="row" style="height:100%;">
                                    <div class="col-3" style="padding:0;">
                                            <div class="form-group">
                                                <select id="sensor_id" class="form-control select2" name="sensor_id" data-placeholder="sensor_id" required="required" onchange="updateChart()">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <div class="form-group">
                                                <div id="status-sensor" class="form-control box-value" style="background: black;text-align:center;padding: 3px 15px;margin-top: 4px;">
                                                    <div style="margin: auto;color: white;font-weight: bold;" id="current-value">Current Value : 0</div>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="chart" style="border-radius: 0px 0px 20px 20px;">
                                        <canvas id="myChart" style=" width: 100%;height: 300px;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
@endsection
@section('script')
<script>
    function showData(){
        var pathArray = window.location.href.split('/');
        var idVendor = pathArray[4];
        var id = pathArray[6];
        $.ajax({
            type: "get",
            url: "{{ url('/listSensor') }}/"+id,
            cache: false, 
            success: function(data){
                $.each(data.items, function(index, item) {
                    $('#sensor_id').empty(); 
                    $.each(data.items, function(index, item) {
                        $("#sensor_id").append('<option value="'+item.id+'">'+item.sensor_id+'</option>');
                    });  
                });   
            }
        });
        selectTags = document.querySelectorAll('select');

        for(var i = 0; i < selectTags.length; i++) {
            selectTags[i].selectedIndex =0;
        }  
    }
    showData();

    let chart;

    function createChart() {
        const ctx = document.getElementById('myChart').getContext('2d');
        chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'Sensor',
                    data: [],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    tension: 0.2, // Set the tension of the line chart
                },{
                    label: 'Batas Atas',
                    data: [],
                    borderColor: 'rgb(255 0 0)',
                    backgroundColor: 'rgb(255 0 0)',
                    tension: 0.2, // Set the tension of the line chart
                    radius: 0
                },{
                    label: 'Batas Bawah',
                    data: [],
                    borderColor: 'rgb(255 165 0)',
                    backgroundColor: 'rgb(255 165 0)',
                    tension: 0.2, // Set the tension of the line chart
                    radius: 0
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }


    createChart();

    async function updateChart() {


        const selectedOption = document.getElementById('sensor_id').value;
        const response = await fetch("{{ url('/live_sensor/chartList') }}?id_sensor="+selectedOption);        
        const data = await response.json();
        chart.data.labels.push(data.datetime);
        chart.data.datasets[0].data.push(data.value);
		chart.data.datasets[1].data.push(data.batas_atas);
        chart.data.datasets[2].data.push(data.batas_bawah);
        if (chart.data.labels.length > 10) {
            chart.data.labels.shift();
            chart.data.datasets[0].data.shift();
			chart.data.datasets[1].data.shift();
			chart.data.datasets[2].data.shift();
        }
        document.getElementById('status-sensor').style.backgroundColor = data.status;
        $("#current-value").html('Current Value = '+data.value+' '+data.satuan+'');
        
        chart.update();
    }
    setInterval(() => {
        updateChart();
    }, 3000);
</script>
@endsection