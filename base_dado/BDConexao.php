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
    private static $instancia;
    private static $conexao;

    //
    private function __construct()
    {

    }

    //
    public static function bdInstancia()
    {
        if (!self::$instancia) {

            self::$instancia = new self();
        }

        return self::$instancia;
    }

    //
    public function bdConexaoInicializa()
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

            $conexao = new mysqli(

                $servidor,
                $usuario,
                $senha,
                $base_dado
            );

            self::$conexao = $conexao;
        }
        //
        catch (Throwable $e) {

            throw new Erro($e->getMessage());
        }
    }

    public function bdConexaoFinaliza()
    {
        //
        if (self::$conexao) {

            self::$conexao->close();
        }
    }

    public function bdConexaoObtem()
    {
        //
        return self::$conexao;
    }
}