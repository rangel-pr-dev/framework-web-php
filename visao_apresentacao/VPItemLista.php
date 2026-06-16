<?php
namespace App\Visao_Apresentacao;

use App\Nucleo\Rota;
use App\Nucleo\Apresentacao;
use App\Base_Dado\Entidade\BDItem;

class VPItemLista
{
    //
    public $id;
    public $idItemTipo;
    public $qualidade;
    public $idRelacionamento;
    public $nome;

    //
    public $itemTipo;

    //
    public $imagemFundo;
    public $qualidadeHtml;
    public $imagem;

    //
    public $rotaItem;

    //
    public function __construct(

        //
        $id,
        $idItemTipo,
        $qualidade,
        $idRelacionamento,
        $nome,

        //
        $itemTipo,

        //
        $imagemFundo,
        $qualidadeHtml,
        $imagem,

        //
        $rotaItem,
    ) {

        //
        $this->id = $id;
        $this->idItemTipo = $idItemTipo;
        $this->qualidade = $qualidade;
        $this->idRelacionamento = $idRelacionamento;
        $this->nome = $nome;

        //
        $this->itemTipo = $itemTipo;

        //
        $this->imagemFundo = $imagemFundo;
        $this->qualidadeHtml = $qualidadeHtml;
        $this->imagem = $imagem;

        //
        $this->rotaItem = $rotaItem;
    }

    public function dado()
    {
        //
        return [

            //
            "id" => $this->id,
            "id_item_tipo" => $this->idItemTipo,
            "qualidade" => $this->qualidade,
            "id_relacionamento" => $this->idRelacionamento,
            "nome" => $this->nome,

            //
            "item_tipo" => $this->itemTipo,

            //
            "imagem_fundo" => $this->imagemFundo,
            "qualidade_html" => $this->qualidadeHtml,
            "imagem" => $this->imagem,

            //
            "rota_item" => $this->rotaItem,
        ];
    }

    /**
     * @param VPItemLista[] $lista
     * @return array
     */
    public static function dadoLista(array $lista): array
    {
        return array_map(

            function (VPItemLista $item): array {

                return $item->dado();
            },
            $lista
        );
    }

    /**
     * @param BDItem $bdItem
     * @return VPItemLista
     */
    public static function vpItemFabrica(
        BDItem $bdItem
    ): VPItemLista {

        return new VPItemLista(

            //
            $bdItem->id,
            $bdItem->idItemTipo,
            $bdItem->qualidade,
            $bdItem->idRelacionamento,
            $bdItem->nome,

            //
            ["id" => $bdItem->idItemTipo],

            //
            Apresentacao::imagemFundo($bdItem->qualidade),
            Apresentacao::perfilQualidade($bdItem->qualidade),
            //Apresentacao::imagemUri("recurso/imagem/item/{$bdItem->id}.png"),
            Apresentacao::imagemUri("recurso/imagem/item/check.svg"),

            //
            Rota::rotaItem($bdItem->id),
        );
    }

    /**
     * @param BDItem[] $bdItemLista
     * @return VPItemLista[]
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