<?php
// com la funció array_filter però retornant el primer element que trobi
function array_some(array $array, callable $callback) {

    $i = 0;
    $n = count($array);

    while($i<$n && !$callback($array[$i])) {
        $i++;
    }

    return $array[$i] ?? null;
}