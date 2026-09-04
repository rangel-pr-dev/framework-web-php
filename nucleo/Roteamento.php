<?php
namespace App\Nucleo;

use App\Controle\CApp;

class Roteamento
{
    //
    private $rotas = [];

    private function rotaUriPadrao(string $uri): string
    {
        $padrao = preg_replace_callback(

            "/{(\w+)}/",
            fn($m) => "(?P<" . $m[1] . ">[^/]+)",
            trim($uri, "/")
        );

        return str_replace("/", "\/", $padrao);
    }

    private function rotaMetodoPermitido(string $url, string $metodoAtual): array
    {
        $metodoLista = [];

        foreach ($this->rotas as $metodo => $rotaLista) {

            if ($metodo === $metodoAtual) {

                continue;
            }

            foreach ($rotaLista as $rota) {

                $padrao = $this->rotaUriPadrao($rota[Rota::ROTA_URI]);

                if (preg_match("/^$padrao$/", $url)) {

                    $metodoLista[] = $metodo;

                    break;
                }
            }
        }

        return $metodoLista;
    }

    private function rotaMetodoNaoPermitido(array $metodoPermitidoLista): void
    {
        header("Allow: " . implode(", ", $metodoPermitidoLista));

        CApp::appErro405($metodoPermitidoLista);
    }

    private function idiomaExtraiDaUrl(string $url): ?string
    {
        if (preg_match("/^([a-z]{2}-[a-z]{2})(?:\/|$)/", $url, $matches)) {
            return $matches[1];
        }

        return null;
    }

    //
    public function rotaRegistra(
        string $metodo,
        string $uri,
        array $manipulador,
    ): void {

        $this->rotas[$metodo][] = [

            Rota::ROTA_URI => trim($uri, "/"),
            Rota::ROTA_MANIPULADOR => $manipulador,
        ];
    }

    //
    public function rotaExecuta(
        string $url,
        string $metodo
    ): void {

        $url = trim($url, "/");

        $idiomaDaUrl = $this->idiomaExtraiDaUrl($url);

        $idiomaParaContexto = Idioma::idiomaValidoOuPadrao($idiomaDaUrl ?? Sessao::idiomaSeleciona());

        Contexto::idiomaAtualiza($idiomaParaContexto);

        if ($idiomaDaUrl !== null && Idioma::idiomaSuportado($idiomaDaUrl)) {
            Sessao::idiomaAtualiza($idiomaDaUrl);
        }

        foreach ($this->rotas[$metodo] ?? [] as $rota) {

            $padrao = $this->rotaUriPadrao($rota[Rota::ROTA_URI]);

            if (preg_match("/^$padrao$/", $url, $parametros)) {

                //
                // O contexto de idioma já foi definido pela extração inicial.
                // Apenas removemos o parâmetro se ele fez parte da rota correspondente.

                unset($parametros[Rota::PARAMETRO_IDIOMA]);

                //
                [$classe, $acao] = $rota[Rota::ROTA_MANIPULADOR];

                if (!class_exists($classe)) {
                    throw new Erro("Controlador {$classe} não encontrado.");
                }

                $controle = new $classe();
                $controle->$acao($parametros);

                return;
            }
        }

        $metodoPermitidoLista = $this->rotaMetodoPermitido($url, $metodo);

        if ($metodoPermitidoLista) {

            $this->rotaMetodoNaoPermitido($metodoPermitidoLista);

            return;
        }

        CApp::appErro404();
    }
}
