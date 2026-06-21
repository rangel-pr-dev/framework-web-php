<?php
namespace App\Controle;

class CValidacao
{
    /**
     * Valida e normaliza string de entrada.
     * Retorna string sanitizada ou nulo/vazio conforme opção.
     * Se informada lista de valores permitidos, valida contra ela.
     *
     * @param ?string $valor
     * @param bool $nulo
     * @param string[] $valorPermitidoLista
     * @return ?string
     */
    public static function str(
        ?string $valor,
        $nulo = true,
        array $valorPermitidoLista = []
    ): ?string {

        if ($valor === null || $valor === "" || !isset($valor)) {

            return $nulo ? null : "";
        }

        $valorSanitizado = trim(htmlspecialchars($valor));

        if (!empty($valorPermitidoLista) && !in_array($valorSanitizado, $valorPermitidoLista, true)) {

            return $nulo ? null : "";
        }

        return $valorSanitizado;
    }

    /**
     * Valida e normaliza inteiro de entrada.
     * Retorna inteiro sanitizado ou nulo/zero conforme opção.
     * Se informada lista de valores permitidos, valida contra ela.
     *
     * @param ?int $valor
     * @param bool $nulo
     * @param int[] $valorPermitidoLista
     * @return ?int
     */
    public static function int(
        ?int $valor,
        $nulo = true,
        array $valorPermitidoLista = []
    ): ?int {

        if ($valor === null || $valor === "" || !isset($valor)) {

            return $nulo ? null : 0;
        }

        $valorSanitizado = intval($valor);

        if (!empty($valorPermitidoLista) && !in_array($valorSanitizado, $valorPermitidoLista, true)) {

            return $nulo ? null : 0;
        }

        return $valorSanitizado;
    }

    /**
     * Valida e normaliza array de inteiros.
     * Retorna apenas os inteiros que estão na lista de valores permitidos.
     *
     * @param ?array $valorLista
     * @param int[] $valorPermitidoLista
     * @return int[]
     */
    public static function arrayInt(
        ?array $valorLista,
        array $valorPermitidoLista
    ): array {

        if (!is_array($valorLista))
            return [];

        return array_filter(
            array_map("intval", $valorLista),
            fn($x) => in_array($x, $valorPermitidoLista, true)
        );
    }

    /**
     * Valida e normaliza array de strings.
     * Retorna apenas as strings sanitizadas que estão na lista de valores permitidos.
     *
     * @param ?array $valorLista
     * @param string[] $valorPermitidoLista
     * @return string[]
     */
    public static function arrayStr(
        ?array $valorLista,
        array $valorPermitidoLista
    ): array {

        if (!is_array($valorLista))
            return [];

        return array_filter(
            array_map(fn($x) => trim(htmlspecialchars($x)), $valorLista),
            fn($x) => in_array($x, $valorPermitidoLista, true)
        );
    }

    /**
     * Converte string (com valores separados por vírgula) ou array em array.
     * Útil para processar entrada de filtros que podem vir como string ou array.
     *
     * @param string|array|null $valor
     * @return string[]
     */
    public static function valorLista($valor): array
    {
        if (is_string($valor)) {

            return $valor !== "" ? explode(",", $valor) : [];
        }

        return is_array($valor) ? $valor : [];
    }
}