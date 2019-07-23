<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Scanner;
use App\Repositories\ScannerRepository;

class ApplyStrategiesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'strategies:apply';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute the scanners and apply all the strategies';

    
    private $scannerRepository;


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ScannerRepository $scannerRepo)
    {
        parent::__construct();
        $this->scannerRepository = $scannerRepo;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /*1 Verificamos el status general del scanner */
        $this->warn('1) Scanner status:');

        $status = getSetting('status');

        $this->info('The scanner is "'.$status.'"');

        if ($status == 'on') 
        {
            /*2 Buscamos los scanners que esten encendidos */
            $this->warn('2) Finding active scanners:');

            $scanners = Scanner::where('status', 'on')->get();

            $this->info($scanners->count().' scanners found');

            /*3 Aplicamos las estrategias correspondientes a cada scanner */
            $this->warn('3) Applying strategies:');

            foreach ($scanners as $scanner) 
            {
                if (!empty($scanner->strategies->first())) 
                {
                    $this->info($scanner->strategies->first()->title.' - '.$scanner->asset->symbol);

                    $response = $this->scannerRepository->applyStrategy($scanner);

                    if ($response['success']) 
                    {
                        $this->info('success!');
                    }else{
                       $this->info('fail!');
                    }
                    
                    $this->warn('----------------------------------------------');
                }
            }
        }

        $this->warn('Good Bye');

    }
}
