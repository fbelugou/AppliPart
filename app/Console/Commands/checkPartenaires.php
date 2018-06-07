<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\EntrepriseRepository;

class checkPartenaires extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'entreprises:checkPartenaires';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Vérifie la date du dernier contact/de la dernière action effectuée avec un partenaire et si cette date est supérieure à trois ans retire cette entreprise des partenaires réguliers';

    protected $entrepriseRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(EntrepriseRepository $entRep)
    {
        parent::__construct();
        $this->entrepriseRepository= $entRep;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->entrepriseRepository->checkPartenaires();
    }
}
