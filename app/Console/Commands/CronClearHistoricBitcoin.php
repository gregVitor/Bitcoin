<?php

namespace App\Console\Commands;

use App\Repositories\HistoricBitcoinRepository;
use Illuminate\Console\Command;

class CronClearHistoricBitcoin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:clear-historic';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear historic bitcoin after 90 days';

    /**
     * @var HistoricBitcoinRepository
     */
    private $historicBitcoinRepository;

    /**
     * Constructor method.
     *
     * @param HistoricBitcoinRepository $historicBitcoinRepository
     */
    public function __construct(
        HistoricBitcoinRepository $historicBitcoinRepository
    ) {
        parent::__construct();
        $this->historicBitcoinRepository = $historicBitcoinRepository;
    }

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        $this->historicBitcoinRepository->deleteHistoricBitcoin();
    }
}
