<?php
// Configura o fuso horário oficial para o horário de Brasília
date_default_timezone_set('America/Sao_Paulo');

/**
 * Escapa caracteres especiais para evitar código malicioso (XSS) ao exibir texto no HTML.
 */
function e($texto) {
    return htmlspecialchars($texto ?? '', ENT_QUOTES, 'UTF-8');
}

/**
 * Converte um valor numérico para o formato de moeda brasileira (ex: 1899.9 -> R$ 1.899,90).
 */
function dinheiro($valor) {
    return 'R$ ' . number_format((float)$valor, 2, ',', '.');
}

/**
 * Converte uma data no formato do banco (AAAA-MM-DD) para o formato brasileiro (DD/MM/AAAA).
 */
function data_br($data) {
    if (!$data) return '';
    $partes = explode('-', $data);
    if (count($partes) == 3) {
        return $partes[2] . '/' . $partes[1] . '/' . $partes[0];
    }
    return $data;
}