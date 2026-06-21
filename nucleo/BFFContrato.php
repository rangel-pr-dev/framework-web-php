<?php
namespace App\Nucleo;

class BFFContrato
{
    // Infraestrutura / Global
    public const ENTRADA_APP_CODIGO_SOLICITACAO = "entradaAppCodigoSolicitacao";

    /**
     * Retorna apenas as chaves globais de infraestrutura
     */
    public static function dadoGlobal(): array
    {
        return [
            "entradaAppCodigoSolicitacao" => self::ENTRADA_APP_CODIGO_SOLICITACAO,
        ];
    }
}