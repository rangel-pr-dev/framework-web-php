<?php
namespace App\Controle\Dado;

use App\Nucleo\Rota;
use App\Nucleo\BFFContrato;

use App\Controle\CValidacao;

use App\Modelo\MItem;

use App\Base_Dado\Entidade\BDItemTipo;

class DTOItemFiltro
{
    //
    /** @var string[] */
    public array $itemNomeLista;

    /** @var BDItemTipo[] */
    public array $itemTipoLista;

    /** @var int[] */
    public array $itemQualidadeLista;

    /** @var string[] */
    public array $itemTipoIdLista;

    //
    public ?string $entradaItemNome;

    /** @var string[] */
    public array $entradaItemTipoLista;

    /** @var int[] */
    public array $entradaItemQualidadeLista;

    //
    public ?int $entradaItemListaDeslocamento;

    /**
     * @param array $entradaDado
     * @return static
     */
    public static function dtoItemFiltro(
        array $entradaDado,
    ): static {

        //
        $filtro = new static();

        //
        $itemModelo = new MItem();

        //
        $filtro->itemNomeLista = $itemModelo->itemNomeLista();
        $filtro->itemTipoLista = $itemModelo->itemTipoLista();
        $filtro->itemQualidadeLista = [1, 2, 3, 4, 5];

        // Garante que os IDs permitidos sejam strings para comparação estrita com a entrada da URL
        $filtro->itemTipoIdLista = array_map(fn(BDItemTipo $itemTipo) => (string)$itemTipo->id, $filtro->itemTipoLista);

        //
        $filtro->entradaItemNome = CValidacao::str($entradaDado[Rota::PARAMETRO_ITEM_NOME] ?? $entradaDado[BFFContrato::ENTRADA_ITEM_NOME] ?? null);
        $filtro->entradaItemTipoLista = CValidacao::arrayStr(self::valorLista($entradaDado[Rota::PARAMETRO_ITEM_TIPO] ?? $entradaDado[BFFContrato::ENTRADA_ITEM_TIPO_LISTA] ?? []), $filtro->itemTipoIdLista);
        $filtro->entradaItemQualidadeLista = CValidacao::arrayInt(self::valorLista($entradaDado[Rota::PARAMETRO_ITEM_QUALIDADE] ?? $entradaDado[BFFContrato::ENTRADA_ITEM_QUALIDADE_LISTA] ?? []), $filtro->itemQualidadeLista);

        //
        $filtro->entradaItemListaDeslocamento = CValidacao::int($entradaDado[BFFContrato::ENTRADA_ITEM_LISTA_DESLOCAMENTO] ?? 0, 0);

        return $filtro;
    }

    /**
     * @param string|array $valor
     * @return array
     */
    private static function valorLista($valor): array
    {
        if (is_string($valor)) {

            return $valor !== "" ? explode(",", $valor) : [];
        }

        return is_array($valor) ? $valor : [];
    }
}