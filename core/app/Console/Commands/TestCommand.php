<?php

namespace App\Console\Commands;

use App\Mail\BasicMail;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        dump([
            'url' => env('MAIL_URL'),
            'host' => env('MAIL_HOST', 'smtp.mailgun.org'),
            'port' => env('MAIL_PORT', 587),
            'encryption' => env('MAIL_ENCRYPTION', 'tls'),
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
        ]);
        Mail::to('alfredo.gutierrez.92@hotmail.com')->send(new BasicMail([
            'subject' => 'ASUNTILLO',
            'message' => 'MENSAJILLO',
        ]));
        return;
        try {
            $client = new Client();
            dump(config('app.nowpayment_api_key'));
            $response = $client->post('https://api-sandbox.nowpayments.io/v1/payment', [
                'headers' => [
                    'x-api-key' => config('app.nowpayment_api_key'),
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'price_amount' => 30,
                    'price_currency' => 'usd',
                    'pay_currency' => 'btc',
                    'ipn_callback_url' => 'https://0fd5-2806-2f0-49c1-fd7f-bd03-9bc9-f80c-d0f8.ngrok-free.app/nowpayments-webhook', // Cambia esta URL si es necesario
                    'order_id' => 'RGDBP-21314',
                    'order_description' => 'Apple Macbook Pro 2019 x 1',
                ],
            ]);
        
            $result = json_decode($response->getBody(), true);
            dd($result); // Muestra el resultado
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $responseBody = $e->getResponse()->getBody(true);
            dd(json_decode($responseBody, true)); // Muestra el error para depurar
        } catch (\Exception $e) {
            dd($e->getMessage()); // Muestra otros errores
        }

        // try {
        //     $client = new Client();
        //     $response = $client->post('https://api.nowpayments.io/v1/auth', [
        //         'headers' => [
        //             'Content-Type' => 'application/json',
        //         ],
        //         'json' => [
        //             'email' => $user, // Asegúrate de reemplazar con tu email real
        //             'password' => $password, // Asegúrate de reemplazar con tu contraseña real
        //         ],
        //     ]);
        
        //     $result = json_decode($response->getBody(), true);
        //     dd($result); // Ver el resultado
        
        // } catch (\GuzzleHttp\Exception\ClientException $e) {
        //     $responseBody = $e->getResponse()->getBody(true);
        //     dd(json_decode($responseBody, true)); // Muestra el error para depurar
        // }
        // dd($result);
    }
}
