<?php

namespace App\Http\Controllers\Bot;

use App\Http\Controllers\Controller;
use App\Exceptions\LinkInvalido;
use Illuminate\Support\Facades\DB;

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
    $this->content = $this->http->fazerRequisicao($this->request->URL);
    return $this->verificarContent();
  }
  
  public function verificarContent() {
    
      if (empty($this->content)) {
        throw new LinkInvalido('sem_conteudo', $this->request->URL);
      }
      
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
        if (sizeof($link) > 6) {
          $a = explode('/',substr($link, 8), 2);
          $novos_links[] = $a[0];
        }
      }
      return array_unique($novos_links);
  }
  
  public function getLinks() {
    $origem = DB::table('url_pendente')
                ->select('ID', 'URL', 'ID_ORIGEM')
                ->get();
    return $origem;
    
  }
    
}
