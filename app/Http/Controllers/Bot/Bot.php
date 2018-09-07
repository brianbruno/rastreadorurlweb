<?php

namespace App\Http\Controllers\Bot;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Visita;

class Bot extends Controller {

  private $request;
  private $content;
  private $http;
  private $log;

  public function __construct() {
    $this->http = new HttpRequest();
    $this->log = array();
  }

  public function run ($request) {
      $this->request = $request;
      $this->marcarVisitado();
      $this->content = $this->http->fazerRequisicao($this->request->URL);
      $urls = $this->verificarContent();
      $objeto = $this->gerarObjeto($urls);
      return $objeto;
  }

  public function gerarObjeto($urls) {
      $obj = array();
      foreach ($urls as $url) {
          if (gettype($url) == 'string') {
              if (strlen($url) > 0) {
                  $novo = array(
                      "ID_ORIGEM" => $this->request->ID,
                      "URL" => $url
                  );
                  $obj[] = $novo;
              }
          } else if (gettype($url) == 'array') {
              $novos_urls = $this->refinarLinks($url);
              $objGerado = $this->gerarObjeto($novos_urls);
              $obj = array_merge($obj, $objGerado);
          }
      }

      return $obj;
  }

  public function marcarVisitado() {
      $dados = array(
          'ID_URL' => $this->request->ID_URL
      );
      Visita::insert($dados);
  }

  public function verificarContent () {

      $urls = $this->obterArrayUrls();
      $urls = $this->removerLinksIguais($urls);

      return $urls;
  }

  public function removerLinksIguais($urls) {
    foreach ($urls as &$url) {
      foreach ($url as &$item) {
        $index = strrpos($item, '/', 10);
        if ($index > 0)
          $item = substr($item, 0, $index);
      }
      $url = array_unique($url);
    }

    return array_unique($urls);
  }

  public function obterArrayUrls() {
    $result = array();
    preg_match_all('/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i',
                   $this->content, $result);
    return array_unique($result);
  }

  public function refinarLinks($links) {
      $novos_links = array();
      foreach ($links as $link) {
          if (strlen($link) > 5) {
              $http = strpos($link, "://");
              $https = strpos($link, "://");

              if ($http > 0 || $https > 0) {
                  $a = explode('/', substr($link, 6), 2);
                  $novos_links[] = $a[0];
              } else {
                  $novos_links[] = $link;
              }
          }
      }
      return array_unique($novos_links);
  }

  public function getLinks() {
    $origem = DB::table('url_pendente')
                ->select('ID', 'URL', 'ID_ORIGEM', 'ID_URL')
                ->get();
    return $origem;

  }

}
