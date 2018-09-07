<?php

namespace App\Http\Controllers\Bot;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Exceptions\LinkInvalido;

class HttpRequest extends Controller {

  public function fazerRequisicao($link) {

    $response = "";

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $link,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_TIMEOUT => 30000,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
          // Set Here Your Requesred Headers
            'Content-Type: text/html',
        ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        $response = null;
        throw new LinkInvalido('sem_conteudo', $link. " - Erro: ".$err);
    }

    $this->content = $response;

    return $this->content;
  }

  public function getLinks() {
    $origem = DB::table('url_pendente')
                ->select('ID', 'URL', 'ID_ORIGEM')
                ->get();
    return $origem;

  }

}
