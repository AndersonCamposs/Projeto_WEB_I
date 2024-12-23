<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/ConsultaDAO.php';

$result = ConsultaDAO::getInstance()->listFaturamentoMensal(date("Y"));
$months = array(1 => "Janeiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 5 => "Maio",
6 => "Junho", 7 => "Julho",  8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro",
12 => "Dezembro");

$labels = array();
foreach($result->months as $month) {
    $labels[] = $months[$month];
}
header("Content-type: application/json");
echo json_encode([
    "type" => "line",
    "data" => [
        "labels" => $labels,
        "datasets" => [
            [
                "label" => "Sessions",
                "lineTension" => 0.3,
                "backgroundColor" => "rgba(2,117,216,0.2)",
                "borderColor" => "rgba(2,117,216,1)",
                "pointRadius" => 5,
                "pointBackgroundColor" => "rgba(2,117,216,1)",
                "pointBorderColor" => "rgba(255,255,255,0.8)",
                "pointHoverRadius" => 5,
                "pointHoverBackgroundColor" => "rgba(2,117,216,1)",
                "pointHitRadius" => 50,
                "pointBorderWidth" => 2,
                "data" => $result->values
            ]
        ]
    ],
    "options" => [
        "scales" => [
            "xAxes" => [
                [
                    "time" => ["unit" => "date"],
                    "gridLines" => ["display" => false],
                    "ticks" => ["maxTicksLimit" => 7]
                ]
            ],
            "yAxes" => [
                [
                    "ticks" => [
                        "min" => 0,
                        "max" => 40000,
                        "maxTicksLimit" => 5
                    ],
                    "gridLines" => ["color" => "rgba(0, 0, 0, .125)"]
                ]
            ]
        ],
        "legend" => ["display" => false]
    ]
] , JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

