<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Andreani\Andreani;
use Andreani\Requests\CotizarEnvio;
use NuSoapClient;

class SoapTestController extends Controller
{
    function index(){
        echo '<h1>Soap con andreani </h1>';
    }
    function cotizarEnvio(){
        $datos = request();

        $request = new CotizarEnvio();
        $request->setCodigoDeCliente('CL0003750');
        $request->setNumeroDeContrato('400006709');
        $request->setCodigoPostal('5533');
        $request->setPeso(800);
        $request->setVolumen(100);
        $request->setValorDeclarado(100);
        $andreani = new Andreani('eCommerce_Integra','passw0rd','test');
        $response = $andreani->call($request);
        if($response->isValid()){
            $tarifa = $response->getMessage()->CotizarEnvioResult->Tarifa;
            echo "La cotización funcionó bien y la tarifa es $tarifa";
        } else {
            echo "La cotización falló, el mensaje de error es el siguiente";
            var_dump($response->getMessage());
        }

    }

}
