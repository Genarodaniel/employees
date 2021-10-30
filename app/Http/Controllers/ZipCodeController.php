<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ZipCodeController extends Controller
{

    public function getAddress(Request $request)
    {

        if(!empty($request->input('zipCode')) && strlen($request->input('zipCode')) == 8){
            $response = $this->callApiViaCep($request->input('zipCode'));
            if($response['http_code'] == 200){

                if(!empty($response['info']['erro'])){
                    return response()->json(['success' => false, 'data' => ['message' => 'ZipCode not found!']]);

                }

                return response()->json(['success' => true, 'data' => $response['info']]);
            }else{
                return response()->json(['success' => false, 'data' => ['message' => 'ZipCode not found!']]);
            }
        }

        return response()->json(['success' => false]);

    }

    public function callApiViaCep($zipCode) {

        $url = "https://viacep.com.br/ws/". $zipCode . "/json/";

        $options = [
            'headers' => [
                'Content-type' => 'application/json'
            ]
        ];

        $options['connect_timeout'] = $options['timeout'] = 10;
        $response = [];

        try {
            $client = new Client();
            $response = $client->request('GET', $url, $options);
            $resp['info'] = json_decode($response->getBody()->getContents(),true);
            $resp['http_code'] = $response->getStatusCode();
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $resp['info'] = $e->getResponse()->getBody()->getContents();
            $resp['http_code'] = $e->getCode();
        } catch (\GuzzleHttp\Exception\ServerException $e) {
            $resp['info'] = $e->getMessage();
            $resp['http_code'] = $e->getCode();
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            $resp['info'] = $e->getMessage();
            $resp['http_code'] = $e->getCode();
        }
        return $resp;
    }
}
