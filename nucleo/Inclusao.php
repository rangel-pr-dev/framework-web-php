<?php
class Inclusao
{
    private array $caminhoLista = [

        "App\\Nucleo\\" => "nucleo/",
        "App\\Base_Dado\\Entidade\\" => "base_dado/entidade/",
        "App\\Base_Dado\\" => "base_dado/",
        "App\\Modelo\\" => "modelo/",
        "App\\Servico\\" => "servico/",
        "App\\Controle\\Dado\\" => "controle/dado/",
        "App\\Controle\\" => "controle/",
        "App\\Visao_Apresentacao\\" => "visao_apresentacao/",
        "App\\Visao_Modelo\\" => "visao_modelo/",
    ];

    public function __construct()
    {
        spl_autoload_register([$this, "arquivoClasseCaregamentoAutomatico"]);
    }

    private function arquivoClasseCaregamentoAutomatico(string $classe): void
    {
        $classe = str_replace("\\", "/", $classe);

        foreach ($this->caminhoLista as $i => $caminho) {

            $prefixo = str_replace("\\", "/", $i);

            if (str_starts_with($classe, $prefixo)) {

                $caminhoRelativo = substr($classe, strlen($prefixo));
                $arquivo = dirname(__DIR__) . "/" . $caminho . $caminhoRelativo . ".php";

                if (is_file($arquivo)) {

                    require_once $arquivo;
                }
                //
                else {

                    throw new \RuntimeException("Arquivo nao encontrado: $arquivo");
                }

                return;
            }
        }
    }
}

new Inclusao();