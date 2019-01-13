<?php

namespace App\Services;

use Cagartner\CorreiosConsulta\CorreiosConsulta;

class  FreteService {
    public static function getLocationByZIPCode($zipcode) {

        $location = (new CorreiosConsulta)->cep($zipcode);

        if(count($location) === 0)
            throw new \Exception("CEP inválido");

        return $location;
    }


    public static function calcularFrete($zipcode){
        $dados = [
            'tipo'              => 'sedex', // Separar opções por vírgula (,) caso queira consultar mais de um (1) serviço. > Opções: `sedex`, `sedex_a_cobrar`, `sedex_10`, `sedex_hoje`, `pac`, 'pac_contrato', 'sedex_contrato' , 'esedex'
            'formato'           => 'caixa', // opções: `caixa`, `rolo`, `envelope`
            'cep_destino'       => $zipcode, // Obrigatório
            'cep_origem'        => env("CEP_ORIGEM"), // Obrigatorio
            //'empresa'         => '', // Código da empresa junto aos correios, não obrigatório.
            //'senha'           => '', // Senha da empresa junto aos correios, não obrigatório.
            'peso'              => '1', // Peso em kilos
            'comprimento'       => '16', // Em centímetros
            'altura'            => '11', // Em centímetros
            'largura'           => '11', // Em centímetros
            'diametro'          => '0', // Em centímetros, no caso de rolo
            // 'mao_propria'       => '1', // Não obrigatórios
            // 'valor_declarado'   => '1', // Não obrigatórios
            // 'aviso_recebimento' => '1', // Não obrigatórios
        ];

        $resposta = (new CorreiosConsulta)->frete($dados);

        return [ "prazo" => $resposta["prazo"] , "valor" => $resposta["valor"] ];
    }
}