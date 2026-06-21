<?php
namespace App\Visao_Apresentacao;

use App\Nucleo\Rota;
use App\Nucleo\Apresentacao;
use App\Base_Dado\Entidade\BDItem;

class VPItemLista
{
    //
    public int $id;
    public string $idItemTipo;
    public int $qualidade;
    public string $idRelacionamento;
    public string $nome;

    //
    public ?VPItemTipo $itemTipo;

    //
    public string $imagemFundo;
    public string $qualidadeHtml;
    public string $imagem;

    //
    public string $rotaItem;

    //
    /**
     * @param int $id
     * @param string $idItemTipo
     * @param int $qualidade
     * @param string $idRelacionamento
     * @param string $nome
     * @param ?VPItemTipo $itemTipo
     * @param string $imagemFundo
     * @param string $qualidadeHtml
     * @param string $imagem
     * @param string $rotaItem
     */
    public function __construct(

        //
        int $id,
        string $idItemTipo,
        int $qualidade,
        string $idRelacionamento,
        string $nome,

        //
        ?VPItemTipo $itemTipo,

        //
        string $imagemFundo,
        string $qualidadeHtml,
        string $imagem,

        //
        string $rotaItem,
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
            "item_tipo" => $this->itemTipo ? $this->itemTipo->dado() : null,

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
            $bdItem->itemTipo ? VPitemTipo::vpItemFabrica($bdItem->itemTipo) : null,

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