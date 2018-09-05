<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Bot\Bot;
use App\Exceptions\LinkInvalido;
use Storage;


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
            print_r($links_novos);
            $links_obtidos[] = $links_novos;
          } catch (LinkInvalido $e) {
            $this->log[] = $e->getMessage();
          }
          $bar->advance();
        }
      
        $bar->finish();
        $this->info(' ');
        foreach ($links_obtidos as &$linha) {
          $linha = implode(" ", $linha);
        }
        $links_string = implode(" ", $links_obtidos);
      
        Storage::disk('local')->put('log.txt', implode(PHP_EOL, $links_string));
      
        if ($this->confirm('Gostaria de exibir o log de erros?')) {
          foreach ($this->log as $erro) {
            $this->error($erro);
          }            
        }
//         print_r($links_obtidos);
    }
}
