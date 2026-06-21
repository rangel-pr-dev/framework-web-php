<?php
namespace App\Controle\Dado;

use App\Nucleo\Rota;
use App\Nucleo\Idioma;
use App\Nucleo\Tema;

use App\Controle\CValidacao;

class DTOAppConfiguracao
{
    //
    /** @var string[] */
    public array $temaLista;

    /** @var string[] */
    public array $idiomaLista;

    //
    public ?string $entradaTema;

    public ?string $entradaIdioma;

    public ?string $entradaUrl;


    /**
     * @param array $entradaDado
     * @return static
     */
    public static function dtoAppConfiguracao(
        array $entradaDado,
    ): static {

        //
        $configura = new static();

        //
        $configura->temaLista = Tema::temaLista();
        $configura->idiomaLista = Idioma::idiomaLista();

        //
        $configura->entradaTema = CValidacao::str(
            $entradaDado[Rota::PARAMETRO_TEMA] ?? null,
            true,
            $configura->temaLista
        );
        $configura->entradaIdioma = CValidacao::str(
            $entradaDado[Rota::PARAMETRO_IDIOMA] ?? null,
            true,
            $configura->idiomaLista
        );
        $configura->entradaUrl = CValidacao::str(
            $entradaDado['url'] ??
            null,
            false
        );

        return $configura;
    }
}