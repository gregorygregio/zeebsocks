<?php

return [
    /* DEFINE SE SERÁ UTILIZADO O AMBIENTE DE TESTES */
    'use-sandbox' => env('PAGSEGURO_SENDBOX'),

    /*
     * Coloque abaixo as informações do seu cadastro no PagSeguro
     */
    'credentials' => [//INFORME AS CREDENCIAIS PADRÕES DE SUA LOJA, MAS PORDERÁ SER ALTERADA EM RUNTIME
        'email' => env('EMAIL_PAGSEGURO'),
        'token' => env('PAGSEGURO_SENDBOX') ? env('TOKEN_PAGSEGURO_SENDBOX') : env('TOKEN_PAGSEGURO'),
    ],

    /*
     * Informe abaixo o nome / url das rotas de aplicação para notificações
     * e redirecionamento após pagamento
     * Parâmetro: "route-name" para nome de rota laravel ou "fixed" para url fixa (URL completa)
     * Ex. 01: "route-name" => "tela-de-obrigado" (Nome de Rota)
     * Ex. 02: "fixed" => "http://minhaloja.com.br/pagamento/tela-de-obrigado" (URL Fixa)
     *
     * PARA MAIS INFORMAÇÕES VIDE:
     * https://sandbox.pagseguro.uol.com.br/vendedor/configuracoes.html
     */
    'routes' => [
        'redirect' => [
            'route-name' => 'pagseguro.redirect', // Criar uma rota com este nome
        ],
        'notification' => [
            'callback' => function ($information) { // Callable
                \Log::debug(print_r("MNHA NOTIFICACAO DE pagamento", 1));
                \Log::debug(print_r($information, 1));
              },
              'credential' => 'default',
              'route-name' => 'pagseguro.notification', // Nome da rota
        ],
    ],

    /*
     * MOEDA QUE SERÁ UTILIZADA COMO MEIO DE PAGAMENTO
     * Somente BRL é aceito no momento (Real do Brasil)
     * */
    'currency' => [
        'type' => 'BRL'
    ],

    /**
     * Adaptador de Requisições
     */
    'http' => [
        'adapter' => [
            'type' => 'curl',
            'options' => [
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_0,
                //CURLOPT_PROXY => 'http://user:pass@host:port', // PROXY OPTION
            ]
        ],
    ],

    /*
     * ATENÇÃO: Não altere as configurações abaixo
     * */
    'host' => [
        'production' => 'https://ws.pagseguro.uol.com.br',
        'sandbox' => 'https://ws.sandbox.pagseguro.uol.com.br'
    ],
    'url' => [
        'checkout' => '/v2/checkout',
        'transactions' => '/v3/transactions',
        'transactions-notifications' => '/v3/transactions/notifications',
        'transactions-history' => '/v2/transactions',
        'transactions-abandoned' => '/v2/transactions/abandoned',
    ],
];
