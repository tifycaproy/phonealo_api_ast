<?php

function showASR($total, $contestadas) {
    return number_format($contestadas/$total * 100, 2);
}

function showACD($segundos, $contestadas) {
    return number_format(showMinutos($segundos) / $contestadas ,2);
}