<?php

namespace App\Http\Controllers;

use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagamentoController extends Controller
{
    // Função para autenticar o Mercado Pago
    protected function authenticate()
    {
        // Obtém o access token do arquivo .env
        $mpAccessToken = env('MERCADO_PAGO_ACCESS_TOKEN');

        // Configura o token no SDK do Mercado Pago
        MercadoPagoConfig::setAccessToken($mpAccessToken);

        // Opcional: Configura o ambiente para testes locais
        MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);
    }

    // Função para criar uma nova preferência de pagamento
    public function createPaymentPreference(Request $request)
    {
        // Chama a função para autenticar o SDK do Mercado Pago
        $this->authenticate();

        // Obtém o total do pedido a partir do request
        $total = $request->input('total');

        // Define o item (produto)
        $product1 = [
            "id" => Auth::id(),
            "title" => "Produtos Trailher da Karen",
            "description" => "Comida Comprada em Trailher da Karen",
            "currency_id" => "BRL",
            "quantity" => 1,
            "unit_price" => (float) $total  // Usa o valor total do carrinho
        ];

        // Definir os itens da compra
        $items = [$product1];

        // Definir o pagador (cliente)
        $payer = [
            "name" => Auth::user()->usu_nome, // Você pode obter o nome do usuário logado
            "surname" => " ", // Certifique-se de que isso esteja disponível
            "email" => Auth::user()->usu_email // E-mail do usuário logado
        ];

        // Chama a função para montar a requisição
        $request = $this->createPreferenceRequest($items, $payer);

        // Inicializa o cliente de preferências
        $client = new PreferenceClient();

        try {
            // Cria a preferência e obtém o link de pagamento
            $preference = $client->create($request);

            // Redireciona o usuário para o Checkout do Mercado Pago
            return redirect($preference->init_point);
        } catch (MPApiException $error) {
            // Retorna uma mensagem de erro em caso de falha
            return response()->json(['error' => $error->getMessage()], 500);
        }
    }


    // Função para criar o array de requisição para a preferência
    private function createPreferenceRequest($items, $payer): array
    {
        $paymentMethods = [
            "excluded_payment_methods" => [],
            "installments" => 12,
            "default_installments" => 1
        ];

        $backUrls = [
            'success' => route('carrinho'),
            'failure' => route('carrinho'),
        ];

        return [
            "items" => $items,
            "payer" => $payer,
            "payment_methods" => $paymentMethods,
            "back_urls" => $backUrls,
            "statement_descriptor" => "MINHA LOJA",
            "external_reference" => "1234567890",
            "expires" => false,
            "auto_return" => 'approved',
        ];
    }

    // Função para recuperar uma preferência pelo ID
    public function getPreferenceById($preferenceId)
    {
        // Autentica o SDK
        $this->authenticate();

        $client = new PreferenceClient();

        try {
            // Recupera a preferência pelo ID
            $preference = $client->get($preferenceId);

            // Retorna os detalhes da preferência
            return response()->json($preference);
        } catch (MPApiException $error) {
            return response()->json(['error' => $error->getMessage()], 500);
        }
    }

    public function paymentSuccess(Request $request)
    {
        // Aqui você pode adicionar lógica para verificar se o pagamento foi realmente bem-sucedido
        // e se os dados do pagamento estão corretos.

        // Limpa o carrinho da sessão
        session()->forget('carrinho');

        // Você pode redirecionar o usuário para uma página de confirmação
        return view('mercadopago.success'); // ou redirecionar para onde desejar
    }
}
