<?php
namespace App\Visao_Apresentacao;

use App\Nucleo\Rota;
use App\Nucleo\Apresentacao;
use App\Base_Dado\Entidade\BDItem;

class VPItemSelecao
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
    public string $rotaItemTipo;
    public string $rotaItemRelacionado;

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
     * @param string $rotaItemTipo
     * @param string $rotaItemRelacionado
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
        string $rotaItemTipo,
        string $rotaItemRelacionado,
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
            VPItemTipo::vpItemFabrica($bdItem->itemTipo),

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