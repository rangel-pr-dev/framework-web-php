<?php
namespace App\Controle;

use App\Nucleo\Rota;

class BFFContratoItem
{
    // Chaves de Entrada (Request)
    public const ENTRADA_ITEM_NOME = Rota::PARAMETRO_ITEM_NOME;
    public const ENTRADA_ITEM_TIPO_LISTA = Rota::PARAMETRO_ITEM_TIPO;
    public const ENTRADA_ITEM_QUALIDADE_LISTA = Rota::PARAMETRO_ITEM_QUALIDADE;
    public const ENTRADA_ITEM_LISTA_DESLOCAMENTO = "entradaItemListaDeslocamento";

    /**
     * Retorna o mapa de chaves para o JavaScript
     */
    public static function dado(): array
    {
        return [
            "entradaItemNome" => self::ENTRADA_ITEM_NOME,
            "entradaItemTipoLista" => self::ENTRADA_ITEM_TIPO_LISTA,
            "entradaItemQualidadeLista" => self::ENTRADA_ITEM_QUALIDADE_LISTA,
            "entradaItemListaDeslocamento" => self::ENTRADA_ITEM_LISTA_DESLOCAMENTO,
        ];
    }
}