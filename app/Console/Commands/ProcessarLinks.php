<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Bot\Bot;
use App\Exceptions\LinkInvalido;
use App\Url;
use Storage;
use Exception;


class ProcessarLinks extends Command {
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
    public function handle() {
        $links = $this->bot->getLinks();

        $links_obtidos = $this->consultarLinks($links);

        Url::insert($links_obtidos);

        $this->info(' ');

        $this->info('Links processados! Total: '.sizeof($links));


//        if ($this->confirm('Gostaria de exibir o log de erros?')) {
            foreach ($this->log as $erro) {
                $this->error($erro);
            }
//        }



    }

    public function consultarLinks($links) {
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

                $links_novos = $this->bot->run($link);
                $links_obtidos = array_merge($links_obtidos, $links_novos);
                $this->log[] = "Links obtidos de ".$link->URL.": ".sizeof($links_novos);
            } catch (LinkInvalido $e) {
                $this->log[] = $e->getMessage();
            } catch (Exception $err) {
                $this->log[] = $err->getMessage()." - ".$err->getTraceAsString();
            }
            $bar->advance();
        }

        $bar->finish();
        return $links_obtidos;
    }
}
