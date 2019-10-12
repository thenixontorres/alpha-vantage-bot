<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\CarbonImmutable;
use App\Models\Scanner;
use App\Models\Schedule;
use App\Models\Group;
use App\Models\Signal;
use App\Repositories\ScannerRepository;
use Illuminate\Support\Facades\Log;

class ApplySchedulesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedules:apply';

    protected $time;
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
        //date_default_timezone_set('America/Mexico_City');
        $this->scannerRepository = $scannerRepo;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $now = now();
        $time = now()->format('H:i');
        /*0 Validacion de tiempo repetido */
        $this->warn('0) Previus signals for this Year/Month/Day/minute:');
        
        $startRank = $now->format('Y-m-d H:i').':00';

        $endRank = $now->format('Y-m-d H:i').':59';

        /*alertas ejecutadas desde el cron con fecha exacta de este minuto*/
        $previous = Signal::where('exec_type', 'system')->whereBetween('exec_time', [$startRank, $endRank])->count();

        $this->warn('Previous signals in :'.$startRank.' - '.$endRank.' : '.$previous);

        if ($previous>0) 
        {
            $this->warn('Scan duplicated. Abort.');
            exit;
        }

        /*1 Verificamos el status general del scanner */
        $this->warn('1) Scanner status:');

        $status = getSetting('status');

        $this->info('The scanner is "'.$status.'"');

        if ($status == 'on') 
        {
            /*2 Buscamos los scanners que esten encendidos */
            $this->warn('2) Finding active schedules to: '.$time.' time:');

            $schedule = Schedule::where('time', $time)->first();

            /*3 Aplicamos las estrategias correspondientes a cada scanner */
            $this->warn('3) Applying strategies:');

            foreach ($schedule->groups as $group) 
            {
                foreach ($group->scanners as $scanner) 
                {
                    if ($scanner->status != 'on') 
                    {
                        $this->info('Scanner '.$scanner->id.' is inactive. SKIP');

                        break;
                    }

                    $this->info('Scanner '.$scanner->id.' is active. START');

                    if (!empty($scanner->strategies->first())) 
                    {
                        $this->info($scanner->strategies->first()->title.' - '.$scanner->merged_symbols);

                        $response = $this->scannerRepository->applyStrategy($scanner, 'system', $now);

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
        }
        
        $this->warn('Good Bye');

    }
}
