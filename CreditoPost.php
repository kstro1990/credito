<?php
class CreditoPost
{

  public function sendPost($log,$key,$car,$total)
  {

    $auth = new stdClass();
    $auth->login = $log;
    $auth->nonce = 'abc123toma';
    $auth->seed = date('c');
    $auth->tranKey = base64_encode(hash('sha256', $auth->nonce . $auth->seed . $key , true));
    $auth->nonce = base64_encode($auth->nonce);

    $card = new stdClass();
    $card->number = $car;
    $instrument = new stdClass();
    $instrument->card = $card;

    $amount = new stdClass();
    $amount->currency = "USD";
    $amount->total = $total;

    $payment = new stdClass();
    $payment->reference = uniqid();
    $payment->description = 'A payment collect example';
    $payment->amount = $amount;

    $request = new stdClass();
    $request->auth = $auth;
    $request->instrument = $instrument;
    $request->payment = $payment;

$denco= json_encode($request);

    $url = 'https://secure.placetopay.ec/x_rest/gateway/information';
    //Se inicia. el objeto CUrl
    $ch = curl_init($url);
    //creamos el json a partir del arreglo
    $jsonDataEncoded = json_encode($request);
    //Indicamos que nuestra petición sera Post
    curl_setopt($ch, CURLOPT_POST, 1);
    //para que la peticion no imprima el resultado como un echo comun, y podamos manipularlo
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //Adjuntamos el json a nuestra petición  $jsonDataEncoded
    curl_setopt($ch, CURLOPT_POSTFIELDS, $denco);
      //Agregar los encabezados del contenido
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'User-Agent: cUrl Testing'));
    //Ejecutamos la petición
    $result = curl_exec($ch);
    //$R = ((string) json_encode($request));
    return  $result;
  }
}

$LoginGet = $_POST["login"];
$trankeyGet = $_POST["trankey"];
$cardGet = $_POST["card"];
$valorGet = $_POST["valor"];
//
$new = new CreditoPost();
$resultado = $new ->sendPost($LoginGet,$trankeyGet,$cardGet,$valorGet);

$rrrrrr = $resultado;
echo  $rrrrrr;



?>
