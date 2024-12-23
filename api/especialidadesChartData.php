<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/EspecialidadeDAO.php';

$result = EspecialidadeDAO::getInstance()->listTopEspecialidades();
header("Content-type: application/json");
echo json_encode([
    "labels" => $result->labels,
    "data" => $result->data
], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);