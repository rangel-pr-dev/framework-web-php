<?php
namespace App\Modelo;

use App\Nucleo\Erro;

use App\Base_Dado\BDConexao;

use App\Base_Dado\Entidade\BDItem;
use App\Base_Dado\Entidade\BDItemTipo;

use \Throwable;

class MItem
{
    //
    private function executar(
        callable $procedimento
    ) {
        $bdInstancia = BDConexao::bdInstancia();
        $bdInstancia->bdConexaoInicializa();

        try {

            return $procedimento($bdInstancia->bdConexaoObtem());
        }
        //
        catch (Throwable $e) {

            throw new Erro($e->getMessage());
        }
        //
        finally {

            $bdInstancia->bdConexaoFinaliza();
        }
    }

    /**
     * @param ?string $nome
     * @param ?string[] $idTipoLista
     * @param ?int[] $qualidadeLista
     * @param ?int $deslocamento
     * @param ?int $limite
     * @return BDItem[]
     */
    public function itemListaFiltro(
        $nome,
        $idTipoLista,
        $qualidadeLista,
        $deslocamento,
        $limite
    ) {
        return $this->executar(function ($bdConexao) use ($nome, $idTipoLista, $qualidadeLista, $deslocamento, $limite) {

            $itemLista = [];

            $sql = "SELECT tb_item.* 
            FROM tb_item 
            INNER JOIN tb_item_tipo 
            ON tb_item_tipo.id = tb_item.id_item_tipo";

            $filtro = [];
            $parametroTipo = "";
            $parametroValor = [];

            if ($nome != null) {
                $filtro[] = "tb_item.nome LIKE ?";
                $parametroTipo .= "s";
                $parametroValor[] = "%$nome%";
            }

            if ($idTipoLista != null) {
                $espacoReservado = implode(",", array_fill(0, count($idTipoLista), "?"));
                $filtro[] = "tb_item.id_item_tipo IN ($espacoReservado)";
                $parametroTipo .= str_repeat("s", count($idTipoLista));
                $parametroValor = array_merge($parametroValor, $idTipoLista);
            }

            if ($qualidadeLista != null) {
                $espacoReservado = implode(",", array_fill(0, count($qualidadeLista), "?"));
                $filtro[] = "tb_item.qualidade IN ($espacoReservado)";
                $parametroTipo .= str_repeat("i", count($qualidadeLista));
                $parametroValor = array_merge($parametroValor, $qualidadeLista);
            }

            if (!empty($filtro)) {
                $sql .= " WHERE " . implode(" AND ", $filtro);
            }

            $sql .= " ORDER BY tb_item_tipo.ordem ASC, tb_item.qualidade ASC, tb_item.nome ASC";

            if ($limite != null)
                $sql .= " LIMIT " . $limite;
            if ($deslocamento != null)
                $sql .= " OFFSET " . $deslocamento;

            $requisicao = $bdConexao->prepare($sql);
            if (!empty($filtro) && !empty($parametroTipo) && !empty($parametroValor)) {
                $requisicao->bind_param($parametroTipo, ...$parametroValor);
            }
            $requisicao->execute();
            $resultado = $requisicao->get_result();

            while ($linha = $resultado->fetch_assoc()) {
                $itemLista[] = new BDItem(
                    $linha["id"],
                    $linha["id_item_tipo"],
                    $linha["qualidade"],
                    $linha["id_relacionamento"],
                    $linha["nome"],
                );
            }

            $resultado->free();
            $requisicao->close();

            return $itemLista;
        });
    }

    /**
     * @return BDItem[]
     */
    public function itemLista()
    {
        return $this->executar(function ($bdConexao) {

            $itemLista = [];
            $requisicao = $bdConexao->prepare(
                "SELECT tb_item.* 
                FROM tb_item 
                INNER JOIN tb_item_tipo 
                ON tb_item_tipo.id = tb_item.id_item_tipo  
                ORDER BY 
                tb_item_tipo.ordem ASC, 
                tb_item.qualidade ASC"
            );
            $requisicao->execute();
            $resultado = $requisicao->get_result();

            while ($linha = $resultado->fetch_assoc()) {
                $itemLista[] = new BDItem(
                    $linha["id"],
                    $linha["id_item_tipo"],
                    $linha["qualidade"],
                    $linha["id_relacionamento"],
                    $linha["nome"],
                );
            }

            $resultado->free();
            $requisicao->close();

            return $itemLista;
        });
    }

    /**
     * @return string[]
     */
    public function itemNomeLista()
    {
        return $this->executar(function ($bdConexao) {

            $itemNomeLista = [];
            $requisicao = $bdConexao->prepare(
                "SELECT tb_item.nome 
                FROM tb_item 
                INNER JOIN tb_item_tipo 
                ON tb_item_tipo.id = tb_item.id_item_tipo 
                ORDER BY 
                tb_item_tipo.ordem ASC, 
                tb_item.qualidade ASC"
            );
            $requisicao->execute();
            $resultado = $requisicao->get_result();

            while ($linha = $resultado->fetch_assoc()) {
                $itemNomeLista[] = $linha["nome"];
            }

            $resultado->free();
            $requisicao->close();

            return $itemNomeLista;
        });
    }

    /**
     * @return BDItemTipo[]
     */
    public function itemTipoLista()
    {
        return $this->executar(function ($bdConexao) {

            $itemTipoLista = [];
            $requisicao = $bdConexao->prepare(
                "SELECT tb_item_tipo.* 
                FROM tb_item_tipo 
                ORDER BY 
                tb_item_tipo.ordem ASC"
            );
            $requisicao->execute();
            $resultado = $requisicao->get_result();

            while ($linha = $resultado->fetch_assoc()) {
                $itemTipoLista[] = new BDItemTipo(
                    $linha["id"],
                    $linha["ordem"],
                    $linha["nome"],
                );
            }

            $resultado->free();
            $requisicao->close();

            return $itemTipoLista;
        });
    }

    /**
     * @param string $idItem
     * @return BDItem
     */
    public function itemSeleciona($idItem)
    {
        return $this->executar(function ($bdConexao) use ($idItem) {
            $item = null;
            $requisicao = $bdConexao->prepare(
                "SELECT 
                tb_item.*, 
                tb_item_tipo.id AS tb_item_tipo_id, 
                tb_item_tipo.ordem AS tb_item_tipo_ordem, 
                tb_item_tipo.nome AS tb_item_tipo_nome 
                FROM tb_item 
                INNER JOIN tb_item_tipo 
                ON tb_item_tipo.id = tb_item.id_item_tipo 
                WHERE tb_item.id = ?"
            );
            $requisicao->bind_param('s', $idItem);
            $requisicao->execute();
            $resultado = $requisicao->get_result();
            $linha = $resultado->fetch_assoc();

            if ($linha) {
                $item = new BDItem(
                    $linha["id"],
                    $linha["id_item_tipo"],
                    $linha["qualidade"],
                    $linha["id_relacionamento"],
                    $linha["nome"],
                    new BDItemTipo(
                        $linha["tb_item_tipo_id"],
                        $linha["tb_item_tipo_ordem"],
                        $linha["tb_item_tipo_nome"],
                    )
                );
            }

            $resultado->free();
            $requisicao->close();

            return $item;
        });
    }


    /**
     * @param string $idRelacionamento
     * @return BDItem[]
     */
    public function itemRelacionamentoLista($idRelacionamento)
    {
        return $this->executar(function ($bdConexao) use ($idRelacionamento) {

            $itemLista = [];
            $requisicao = $bdConexao->prepare(
                "SELECT tb_item.* 
                FROM tb_item 
                WHERE tb_item.id_relacionamento = ? 
                ORDER BY  
                tb_item.qualidade ASC"
            );
            $requisicao->bind_param('s', $idRelacionamento);
            $requisicao->execute();
            $resultado = $requisicao->get_result();

            while ($linha = $resultado->fetch_assoc()) {
                $itemLista[] = new BDItem(
                    $linha["id"],
                    $linha["id_item_tipo"],
                    $linha["qualidade"],
                    $linha["id_relacionamento"],
                    $linha["nome"],
                );
            }

            $resultado->free();
            $requisicao->close();

            return $itemLista;
        });
    }
}