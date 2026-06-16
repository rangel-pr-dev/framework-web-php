<?php
namespace App\Nucleo;

use App\Visao_Modelo\VMBase;

class Renderizacao
{
    //
    private static function arquivo(string $visaoArquivo): string
    {
        $visaoArquivo = dirname(__DIR__) . "/visao/{$visaoArquivo}.php";

        if (!is_readable($visaoArquivo)) {

            throw new Erro("Arquivo de visao nao encontrado: " . $visaoArquivo);
        }

        return $visaoArquivo;
    }

    //
    private static function visaoSemLayout(
        string $visaoArquivo,
        VMBase $visaoModelo
    ): void {

        include self::arquivo($visaoArquivo);
    }

    private static function visaoComLayout(
        string $visaoArquivoPrincipal,
        string $visaoArquivoConteudo,
        VMBase $visaoModelo,
    ): void {

        $visaoPrincipal = self::arquivo($visaoArquivoPrincipal);
        $visaoConteudo = self::arquivo($visaoArquivoConteudo);

        include $visaoPrincipal;
    }

    //
    private static function visaoConteudo(
        string $visaoArquivo,
        VMBase $visaoModelo
    ): string {

        $visaoConteudo = self::arquivo($visaoArquivo);
        $visaoModeloFragmento = $visaoModelo;

        ob_start();
        include $visaoConteudo;
        return ob_get_clean();
    }

    //
    public static function paginaComLayout(
        string $pagina,
        VMBase $visaoModelo
    ): void {

        self::visaoComLayout(
            Pagina::paginaVisao(Pagina::APP),
            Pagina::paginaVisao($pagina),
            $visaoModelo,
        );
    }

    public static function paginaSemLayout(
        string $pagina,
        VMBase $visaoModelo
    ): void {

        self::visaoSemLayout(
            Pagina::paginaVisao($pagina),
            $visaoModelo
        );
    }

    //
    public static function fragmento(
        string $fragmento,
        VMBase $visaoModeloFragmento
    ): string {

        return self::visaoConteudo(
            Fragmento::fragmentoVisao($fragmento),
            $visaoModeloFragmento
        );
    }
}