<?php
namespace App\Base_Dado;

use App\Nucleo\Erro;

use App\Nucleo\Configuracao;
use App\Nucleo\Idioma;
use App\Nucleo\Contexto;

use \mysqli;

use \Throwable;

class BDConexao
{
    //
    private static ?self $instancia = null;
    private ?mysqli $conexao = null;

    public function __serialize(): array
    {
        throw new Erro('BDConexao não pode ser serializada.');
    }

    public function __unserialize(array $dado): void
    {
        throw new Erro('BDConexao não pode ser desserializada.');
    }

    private function __clone()
    {
    }

    //
    private function __construct()
    {
    }

    //
    public static function bdInstancia(): self
    {
        if (!self::$instancia) {

            self::$instancia = new self();
        }

        return self::$instancia;
    }

    //
    private function bdConexaoInicializa(): void
    {
        //
        $idioma = Contexto::idiomaSeleciona();

        //
        $servidor = Configuracao::bdServidor();
        $usuario = match ($idioma) {

            Idioma::idiomaPTBR() => Configuracao::bdUsuarioPTBR(),
            Idioma::idiomaENUS() => Configuracao::bdUsuarioENUS(),
            default => Configuracao::bdUsuarioPTBR(),
        };

        $senha = Configuracao::bdSenha();

        $base_dado = match ($idioma) {

            Idioma::idiomaPTBR() => Configuracao::bdNomePTBR(),
            Idioma::idiomaENUS() => Configuracao::bdNomeENUS(),
            default => Configuracao::bdNomePTBR(),
        };

        //
        try {

            $this->conexao = new mysqli(

                $servidor,
                $usuario,
                $senha,
                $base_dado
            );
        }
        //
        catch (Throwable $e) {

            throw new Erro(
                message: $e->getMessage(),
                previous: $e
            );
        }
    }

    private function bdConexaoFinaliza(): void
    {
        //
        if ($this->conexao) {

            $this->conexao->close();
            $this->conexao = null;
        }
    }

    private function bdConexaoObtem(): mysqli
    {
        //
        if ($this->conexao === null) {

            throw new Erro(
                'A conexão com o banco de dados não foi inicializada.'
            );
        }

        return $this->conexao;
    }

    //
    public function conexaoInicia(): void
    {
        if ($this->conexao !== null) {

            throw new Erro(
                'A conexão com o banco de dados já foi inicializada.'
            );
        }

        $this->bdConexaoInicializa();
    }

    public function conexaoFinaliza(): void
    {
        $this->bdConexaoFinaliza();
    }

    //
    public function executar(
        callable $procedimento
    ): mixed {

        //
        if ($this->conexao !== null) {

            return $procedimento(
                $this->bdConexaoObtem()
            );
        }

        //
        $this->bdConexaoInicializa();

        try {

            return $procedimento(
                $this->bdConexaoObtem()
            );
        }
        //
        finally {

            $this->bdConexaoFinaliza();
        }
    }

    public function executarTransacao(
        callable $procedimento
    ): mixed {

        //
        $conexaoExterna = $this->conexao !== null;

        //
        if (!$conexaoExterna) {

            $this->bdConexaoInicializa();
        }

        $transacaoIniciada = false;

        $conexao = $this->bdConexaoObtem();

        try {

            $conexao->begin_transaction();

            $transacaoIniciada = true;

            $resultado = $procedimento($conexao);

            $conexao->commit();

            return $resultado;
        }
        //
        catch (Throwable $e) {

            if ($transacaoIniciada) {

                $conexao->rollback();
            }

            throw $e;
        }
        //
        finally {

            if (!$conexaoExterna) {

                $this->bdConexaoFinaliza();
            }
        }
    }
}