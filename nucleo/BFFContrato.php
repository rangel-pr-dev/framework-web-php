<?php
namespace App\Nucleo;

class BFFContrato
{
    //
    public const ENTRADA_APP_CODIGO_SOLICITACAO = "entradaAppCodigoSolicitacao";

    //
    public const ENTRADA_ITEM_NOME = Rota::PARAMETRO_ITEM_NOME;
    public const ENTRADA_ITEM_TIPO_LISTA = Rota::PARAMETRO_ITEM_TIPO;
    public const ENTRADA_ITEM_QUALIDADE_LISTA = Rota::PARAMETRO_ITEM_QUALIDADE;
    public const ENTRADA_ITEM_LISTA_DESLOCAMENTO = "entradaItemListaDeslocamento";

    //
    public static function dado(): array
    {
        return [

            //
            "entradaAppCodigoSolicitacao" => self::ENTRADA_APP_CODIGO_SOLICITACAO,

            //
            "entradaItemNome" => self::ENTRADA_ITEM_NOME,
            "entradaItemTipoLista" => self::ENTRADA_ITEM_TIPO_LISTA,
            "entradaItemQualidadeLista" => self::ENTRADA_ITEM_QUALIDADE_LISTA,
            "entradaItemListaDeslocamento" => self::ENTRADA_ITEM_LISTA_DESLOCAMENTO,
        ];
    }
}