<?php

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\JsonResponse;

class SmsService
{

   public function notify(string $message, $indicatif, $telephone)
   {
      // Envoie du message
      $testnumber = '+242 06 965 2292';

      /*$twiolio->sendSms(
          $testnumber,
         // $indicatif . $telephone,
          $message
      );*/

      //dd($messageBird->sendSms(['+31612345678'], $message));

      $clientHttp = HttpClient::create();
      $headers = [
         'Content-Type' => 'application/json'
      ];

      $body = array(
         "from" => "C +",
         "text" => $message,
         "to" => $indicatif . $telephone,
         "api_key" => "f181e209",
         "api_secret" => "gDg9AWrkC8hjwpcn"
      );

      $body = json_encode(($body));

      try {
         $response = $clientHttp->request('POST', 'https://rest.nexmo.com/sms/json', [
            'headers' => $headers,
            'body' => $body
         ]);

         $content = $response->toArray();
      } catch (\Exception $e) {
         return new JsonResponse(['content' => $e->getMessage(), 'error' => $e->getMessage()], 500);
      }
   }
}
