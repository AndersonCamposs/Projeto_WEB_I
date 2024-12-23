// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

document.addEventListener("DOMContentLoaded", async () => {
    let res = await fetch("http://localhost/ac_clinic/api/especialidadesChartData.php");
    let json = await res.json();
    var ctx = document.getElementById("myBarChart");
    var myLineChart = new Chart(ctx, {
      "type": "bar",
      "data": {
        "labels": json.labels,
        "datasets": [
          {
            "label": "Consultas",
            "backgroundColor": "rgba(2,117,216,1)",
            "borderColor": "rgba(2,117,216,1)",
            "data": json.data
          }
        ]
      },
      "options": {
        "scales": {
          "xAxes": [
            {
              "time": {
                "unit": "month"
              },
              "gridLines": {
                "display": false
              },
              "ticks": {
                "maxTicksLimit": 12
              }
            }
          ],
          "yAxes": [
            {
              "ticks": {
                "min": 0,
                "max": Math.max(...json.data) + 5,
                "maxTicksLimit": 5
              },
              "gridLines": {
                "display": true
              }
            }
          ]
        },
        "legend": {
          "display": false
        }
      }
    });

    
});

