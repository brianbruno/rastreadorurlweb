<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Bot\Bot;
use App\Exceptions\LinkInvalido;
use Storage;
use Exception;


class ProcessarLinks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'processar:links';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Processar links pendentes de consulta.';
  
    private $bot;
    private $log;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->bot = new Bot();
        $this->log = array();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {      
        $links = $this->bot->getLinks();
      
        $bar = $this->output->createProgressBar(sizeof($links));
        // the finished part of the bar
        $bar->setBarCharacter('<comment>=</comment>');        
        // the unfinished part of the bar
        $bar->setEmptyBarCharacter(' ');
        // the progress character
        $bar->setProgressCharacter('>');
        $bar->start();
        $links_obtidos = array();        
      
        foreach($links as $link) { 
          try {            
            $links_novos = array_unique($this->bot->run($link));
            $links_obtidos = array_merge($links_obtidos, $links_novos[0]);
          } catch (LinkInvalido $e) {
            $this->log[] = $e->getMessage();
          } catch (Exception $err) {
            $this->log[] = $err->getMessage()." - ".$err->getTraceAsString();
          }
          $bar->advance();
        }
      
        foreach ($links_obtidos as &$linha) {
          $linha = print_r($linha, true);
        }
      
        $links_obtidos = $this->bot->refinarLinks($links_obtidos);
      
        var_dump($links_obtidos);die;
        Storage::disk('local')->put('log.txt', implode(PHP_EOL, $links_obtidos));
        $bar->finish();
        $this->info(' ');
      
      
        if ($this->confirm('Gostaria de exibir o log de erros?')) {
          foreach ($this->log as $erro) {
            $this->error($erro);
          }            
        }
//         print_r($links_obtidos);
    }
}
