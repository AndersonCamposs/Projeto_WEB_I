// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

fetch("http://localhost/ac_clinic/api/especialidadesChartData.php")
        .then(res => res.json())
        .then(json => {
            var myLineChart = new Chart(ctx, json);
        });

// Bar Chart Example
var ctx = document.getElementById("myBarChart");

