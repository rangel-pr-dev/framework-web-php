<?php
namespace App\Base_Dado\Entidade;

class BDItem
{
    //
    public $id;
    public $idItemTipo;
    public $qualidade;
    public $idRelacionamento;
    public $nome;

    //
    public ?BDItemTipo $itemTipo;

    //
    public function __construct(

        //
        $id,
        $idItemTipo,
        $qualidade,
        $idRelacionamento,
        $nome,

        //
        ?BDItemTipo $itemTipo = null,

    ) {

        //
        $this->id = $id;
        $this->idItemTipo = $idItemTipo;
        $this->qualidade = $qualidade;
        $this->idRelacionamento = $idRelacionamento;
        $this->nome = $nome;

        //
        $this->itemTipo = $itemTipo;
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
            "item_tipo" => $this->itemTipo?->dado(),

        ];
    }

    /**
     * @param BDItem[] $lista
     * @return array
     */
    public static function dadoLista(array $lista): array
    {
        return array_map(

            function (BDItem $item): array {

                return $item->dado();
            },
            $lista
        );
    }
}