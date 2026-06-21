<?php
namespace App\Visao_Apresentacao;

use App\Nucleo\Rota;
use App\Nucleo\Apresentacao;
use App\Base_Dado\Entidade\BDItemTipo;

class VPItemTipo
{
    //
    public int $id;
    public int $ordem;
    public string $nome;

    //
    /**
     * @param int $id
     * @param int $ordem
     * @param string $nome
     */
    public function __construct(

        //
        int $id,
        int $ordem,
        string $nome,
    ) {

        //
        $this->id = $id;
        $this->ordem = $ordem;
        $this->nome = $nome;
    }

    public function dado()
    {
        //
        return [

            //
            "id" => $this->id,
            "id_item_tipo" => $this->ordem,
            "nome" => $this->nome,
        ];
    }

    /**
     * @param VPItemTipo[] $lista
     * @return array
     */
    public static function dadoLista(array $lista): array
    {
        return array_map(

            function (VPItemTipo $item): array {

                return $item->dado();
            },
            $lista
        );
    }

    /**
     * @param BDItemTipo $bdItem
     * @return VPItemTipo
     */
    public static function vpItemFabrica(
        BDItemTipo $bdItem
    ): VPItemTipo {

        return new VPItemTipo(

            //
            $bdItem->id,
            $bdItem->ordem,
            $bdItem->nome,
        );
    }

    /**
     * @param BDItemTipo[] $bdItemLista
     * @return VPItemTipo[]
     */
    public static function vpItemFabricaLista(
        array $bdItemLista
    ): array {

        $itemLista = [];

        foreach ($bdItemLista as $i => $bdItem) {

            $itemLista[] = self::vpItemFabrica($bdItem);
        }

        return $itemLista;
    }
}