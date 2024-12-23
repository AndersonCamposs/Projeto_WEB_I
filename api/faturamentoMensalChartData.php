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
        "labels" => $labels,
        "data" => $result->values
] , JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

