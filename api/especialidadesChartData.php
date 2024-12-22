<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/EspecialidadeDAO.php';

$result = EspecialidadeDAO::getInstance()->listTopEspecialidades();
header("Content-type: application/json");
echo json_encode([
    "type" => "bar",
    "data" => [
        "labels" => $result->labels,
        "datasets" => [[
            "label" => "Consultas",
            "backgroundColor" => "rgba(2,117,216,1)",
            "borderColor" => "rgba(2,117,216,1)",
            "data" => $result->data
        ]]
    ],
    "options" => [
        "scales" => [
            "xAxes" => [[
                "time" => ["unit" => "month"],
                "gridLines" => ["display" => false],
                "ticks" => ["maxTicksLimit" => 12]
            ]],
            "yAxes" => [[
                "ticks" => [
                    "min" => 0,
                    "max" => max($result->data) + 5,
                    "maxTicksLimit" => 5
                ],
                "gridLines" => ["display" => true]
            ]]
        ],
        "legend" => ["display" => false]
    ]
], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);