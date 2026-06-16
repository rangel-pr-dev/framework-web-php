//
$(document).ready(function () {
    AOS.init();
});

//
window.App = window.App || {};
window.App.bff = window.App.bff || {};

//
window.App.log = function () {

    if (!window.App.logExibe) {

        return;
    }

    console.log.apply(console, arguments);
};

// Funções prontas para tratamento de tipos de dados
window.App.bff.processadores = {
    "string": function (v) {
        if (v == null) return null;
        v = String(v).trim();
        return v === "" ? null : v;
    },
    "inteiro": function (v) {
        if (v === "" || v == null) return null;
        var n = Number(String(v).trim());
        // Aceita 0 como valor válido, mas valida se é um número
        return isNaN(n) ? null : n;
    },
    "lista-string": function (v) {
        if (!v) return null;
        var arr = Array.isArray(v) ? v : String(v).split(",");
        var resultado = arr.map(function (i) { return String(i).trim(); }).filter(function (i) { return i.length > 0; });
        return resultado.length > 0 ? resultado : null;
    },
    "lista-inteiro": function (v) {
        if (!v) return null;
        var arr = Array.isArray(v) ? v : String(v).split(",");
        var resultado = arr.map(function (i) { return Number(String(i).trim()); }).filter(function (i) { return !isNaN(i); });
        return resultado.length > 0 ? resultado : null;
    }
};

// Mapeamento explícito de campos para seus tipos de processamento
// IDs ou Names definidos aqui serão tratados pelo processador correspondente
window.App.bff.mapeamentoTipo = {
    "entrada-item-tipo-lista": "lista-string",
    "entrada-item-qualidade-lista": "lista-inteiro",
    "entrada-item-lista-deslocamento": "inteiro",
    "entrada-item-nome": "string"
};

//
window.App.bff.chaveContrato = function (chave) {
    return String(chave).replace(/-([a-z])/g, function (_, letra) {
        return letra.toUpperCase();
    });
};

//
window.App.bff.valorCampo = function (chave, valor) {
    var tipo = window.App.bff.mapeamentoTipo[chave] || "string";
    var processador = window.App.bff.processadores[tipo] || window.App.bff.processadores["string"];
    return processador(valor);
};

//
window.App.bff.formularioDado = function (formulario) {

    var contrato = window.App.bff.contrato || {};
    var dado = {};
    var checkboxLista = {};

    formulario.find("input, select, textarea").each(function () {

        var campo = $(this);
        var chave = campo.attr("name") || campo.attr("id");
        var tipo = String(campo.attr("type") || "").toLowerCase();

        if (!chave || tipo === "submit" || tipo === "button" || tipo === "reset" || tipo === "file") {

            return;
        }

        if (tipo === "checkbox") {

            checkboxLista[chave] = checkboxLista[chave] || [];

            if (campo.is(":checked")) {

                checkboxLista[chave].push(campo.val());
            }

            return;
        }

        if (tipo === "radio" && !campo.is(":checked")) {

            return;
        }

        dado[chave] = window.App.bff.valorCampo(chave, campo.val());
    });

    Object.keys(checkboxLista).forEach(function (chave) {

        dado[chave] = window.App.bff.valorCampo(chave, checkboxLista[chave]);
    });

    return Object.keys(dado).reduce(function (acumulador, chave) {

        var chaveContrato = window.App.bff.chaveContrato(chave);
        var chaveResposta = contrato[chaveContrato] || chave;

        acumulador[chaveResposta] = dado[chave];

        return acumulador;
    }, {});
};

//
window.App.bff.postJson = function (url, dado) {

    return $.ajax({

        url: url,
        type: "POST",
        contentType: "application/json",
        headers: {

            "Accept-Language": window.App.idioma
        },
        data: JSON.stringify(dado),
    });
};

//
window.App.bff.trataResposta = function (resposta) {

    window.App.log(resposta);

    return resposta != null && resposta.estado !== false;
};

//
window.App.bff.trataFalha = function (requisicao, estado, erro) {

    window.App.log(erro);

    if (requisicao != null && requisicao.responseJSON != null && requisicao.responseJSON.mensagem != null) {

        window.App.log(requisicao.responseJSON.mensagem);
    }
};

//
window.App.bff.inicializaFormulario = function (formulario) {

    var requisicao;
    var tipo = formulario.data("bffForm");
    var rota = formulario.data("bffRoute");

    if (!tipo || !rota) {

        return;
    }

    formulario.submit(function (e) {

        e.preventDefault();
        e.stopPropagation();

        if (requisicao) requisicao.abort();

        formulario.addClass("was-validated");

        if (!formulario.get(0).checkValidity()) {

            return;
        }

        var campoLista = formulario.find("input, select, button, textarea");
        var estado = true;
        var deslocamentoAnterior = null;

        if (tipo === "paginacao") {

            deslocamentoAnterior = Number($(formulario.data("bffOffset")).val());
        }

        campoLista.prop("disabled", true);

        requisicao = window.App.bff.postJson(
            rota,
            window.App.bff.formularioDado(formulario)
        );

        requisicao.done(function (resposta) {

            if (!window.App.bff.trataResposta(resposta)) {

                return;
            }

            if (tipo === "filtro") {

                if (resposta.localizacao != null) {

                    window.location.href = resposta.localizacao;
                }

                return;
            }

            if (tipo === "paginacao" && resposta.estado) {

                $(formulario.data("bffTarget")).append(resposta.visao);
                $(formulario.data("bffOffset")).val(resposta.deslocamento);

                estado = (resposta.deslocamento == deslocamentoAnterior);
            }
        });
        requisicao.fail(function (requisicaoFalha, estadoFalha, erro) {

            window.App.bff.trataFalha(requisicaoFalha, estadoFalha, erro);
        });
        requisicao.always(function () {

            campoLista.prop("disabled", false);

            if (tipo === "paginacao") {

                $(formulario.data("bffButton")).prop("disabled", estado);
            }
        });
    });
};

//
$(document).ready(function () {

    $("[data-bff-form]").each(function () {

        window.App.bff.inicializaFormulario($(this));
    });
});
