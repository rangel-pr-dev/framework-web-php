<?php
namespace App\Visao_Apresentacao;

use App\Nucleo\Rota;
use App\Nucleo\Apresentacao;
use App\Base_Dado\Entidade\BDItem;

class VPItemSelecao
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
    public $rotaItemTipo;
    public $rotaItemRelacionado;

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
        $rotaItemTipo,
        $rotaItemRelacionado,
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
        $this->rotaItemTipo = $rotaItemTipo;
        $this->rotaItemRelacionado = $rotaItemRelacionado;
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

            "item_tipo" => $this->itemTipo,

            //
            "imagem_fundo" => $this->imagemFundo,
            "qualidade_html" => $this->qualidadeHtml,
            "imagem" => $this->imagem,

            //
            "rota_item" => $this->rotaItem,
            "rota_item_tipo" => $this->rotaItemTipo,
            "rota_item_relacionado" => $this->rotaItemRelacionado,
        ];
    }

    /**
     * @param VPItemSelecao[] $lista
     * @return array
     */
    public static function dadoLista(array $lista): array
    {
        return array_map(

            function (VPItemSelecao $item): array {

                return $item->dado();
            },
            $lista
        );
    }

    /**
     * @param BDItem $bdItem
     * @return VPItemSelecao
     */
    public static function vpItemFabrica(
        BDItem $bdItem
    ): VPItemSelecao {

        return new VPItemSelecao(

            //
            $bdItem->id,
            $bdItem->idItemTipo,
            $bdItem->qualidade,
            $bdItem->idRelacionamento,
            $bdItem->nome,

            //
            $bdItem->itemTipo->dado(),

            //
            Apresentacao::imagemFundo($bdItem->qualidade),
            Apresentacao::perfilQualidade($bdItem->qualidade),
            //Apresentacao::imagemUri("recurso/imagem/item/{$bdItem->id}.png"),
            Apresentacao::imagemUri("recurso/imagem/item/check.svg"),

            //
            Rota::rotaItem($bdItem->id),
            Rota::rotaItensFiltro(null, [$bdItem->idItemTipo], null),
            Rota::rotaItemRelacionados($bdItem->id),
        );
    }

    /**
     * @param BDItem[] $bdItemLista
     * @return VPItemSelecao[]
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