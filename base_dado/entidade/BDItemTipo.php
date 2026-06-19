<?php
namespace App\Base_Dado\Entidade;

class BDItemTipo
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

            "id" => $this->id,
            "ordem" => $this->ordem,
            "nome" => $this->nome,
        ];
    }

    /**
     * @param BDItemTipo[] $lista
     * @return array
     */
    public static function dadoLista(array $lista): array
    {
        return array_map(

            function (BDItemTipo $item): array {

                return $item->dado();
            },
            $lista
        );
    }
}