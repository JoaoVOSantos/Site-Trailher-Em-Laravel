<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
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
        $total = $request->input('total');
        $produto_ids = $request->input('id');

        // Salva dados na sessão
        session(['produto_ids' => $produto_ids, 'total' => $total]);

        // Autentica o Mercado Pago
        $this->authenticate();

        // Define o item (produto)
        $product1 = [
            "id" => Auth::id(),
            "title" => "Produtos Trailher da Karen",
            "description" => "Comida Comprada em Trailher da Karen",
            "currency_id" => "BRL",
            "quantity" => 1,
            "unit_price" => (float) $total,
        ];

        $items = [$product1];

        $payer = [
            "name" => Auth::user()->usu_nome,
            "email" => Auth::user()->usu_email,
        ];

        $request = $this->createPreferenceRequest($items, $payer);

        $client = new PreferenceClient();

        try {
            $preference = $client->create($request);
            return redirect($preference->init_point);
        } catch (MPApiException $error) {
            return response()->json(['error' => $error->getMessage()], 500);
        }
    }


    // Função para criar o array de requisição para a preferência
    private function createPreferenceRequest($items, $payer): array
    {
        return [
            "items" => $items,
            "payer" => $payer,
            "payment_methods" => [
                "installments" => 12,
            ],
            "back_urls" => [
                'success' => route('mercadopago.success'),
                'failure' => route('carrinho'),
            ],
            "statement_descriptor" => "MINHA LOJA",
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
        $total = session('total');
        $produto_ids = session('produto_ids');

        // Obter a quantidade de compras do usuário atual
        $quantidadeAtual = Pedido::where('usuario_id', Auth::id())->count();

        // Criar um novo pedido e definir os campos
        $pedido = new Pedido();
        $pedido->usuario_id = Auth::id();
        $pedido->ped_data_pago = now();
        $pedido->ped_valor = $total;
        $pedido->ped_status = 1;
        $pedido->ped_quantidade = $quantidadeAtual + 1; // Incrementa a quantidade

        $pedido->save();

        // Sincronizar os produtos no pedido
        $pedido->produto()->attach($produto_ids);

        session()->forget('carrinho');

        return redirect()->route('voltarCarrinho');
    }
}
