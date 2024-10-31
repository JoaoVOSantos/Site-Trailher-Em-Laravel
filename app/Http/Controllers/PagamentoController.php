<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\Client\Common\RequestOptions;

class PagamentoController extends Controller
{
    public function criarPagamento(Request $request)
    {
    

        // Configurar o token de acesso
        MercadoPagoConfig::setAccessToken('TEST-8942872842328021-102620-e62457317f12ed0fdaaecb4cd1db24c3-454323216');
        MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);

        $client = new PaymentClient(); // Instanciar o cliente de pagamento

        // Definindo os detalhes do pagamento
        $item = [
            "transaction_amount" => 100,
            "token" => $request->input('token'),
            "description" => "Descrição do Produto",
            "installments" => 1,
            "payment_method_id" => "visa",
            "payer" => [
                "email" => $request->input('payerEmail'),
            ]
        ];
        

        // Criar as opções de requisição
        $request_options = new RequestOptions();
        $request_options->setCustomHeaders(["X-Idempotency-Key: " . uniqid()]); // Chave única para evitar duplicação

        try {
            // Realizar a requisição para criar o pagamento
            $respostaPagamento = $client->create($item, $request_options);
            return redirect($respostaPagamento); // Redirecionar para a URL de pagamento
        } catch (MPApiException $e) {
            // Capturar exceções específicas do Mercado Pago
            echo "Código de Status: " . $e->getApiResponse()->getStatusCode() . "\n";
            echo "Conteúdo: ";
            var_dump($e->getApiResponse()->getContent());
            echo "\n";
        } catch (\Exception $e) {
            // Capturar outras exceções
            echo $e->getMessage();
        }
    }
}
