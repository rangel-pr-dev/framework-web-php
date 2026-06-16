<?php
namespace App\Controle;

class CValidacao
{
    public static function str(
        $valor,
        $nulo = true
    ) {

        if ($valor === null || $valor === "" || !isset($valor)) {

            return $nulo ? null : "";
        }

        return trim(htmlspecialchars($valor));
    }

    public static function int(
        $valor,
        $nulo = true
    ) {

        if ($valor === null || $valor === "" || !isset($valor)) {

            return $nulo ? null : 0;
        }

        return intval($valor);
    }

    /**
     * @param array $valorLista
     * @param int[] $valorPermitidoLista
     * @return int[]
     */
    public static function arrayInt(
        $valorLista,
        $valorPermitidoLista
    ) {

        if (!is_array($valorLista))
            return [];

        return array_filter(
            array_map("intval", $valorLista),
            fn($x) => in_array($x, $valorPermitidoLista, true)
        );
    }

    /**
     * @param array $valorLista
     * @param string[] $valorPermitidoLista
     * @return string[]
     */
    public static function arrayStr(
        $valorLista,
        $valorPermitidoLista
    ) {

        if (!is_array($valorLista))
            return [];

        return array_filter(
            array_map(fn($x) => trim(htmlspecialchars($x)), $valorLista),
            fn($x) => in_array($x, $valorPermitidoLista, true)
        );
    }
}