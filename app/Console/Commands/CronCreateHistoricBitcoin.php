<?php

namespace App\Console\Commands;

use App\Services\Bitcoin\BitcoinService;
use Illuminate\Console\Command;

class CronCreateHistoricBitcoin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:historic-bitcoin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create bitcoin historic';

    /**
     *
     * @var BitcoinService
     */
    private $bitcoinService;

    /**
     * Constructor method.
     *
     * @param BitcoinService $bitcoinService
     */
    public function __construct(
        BitcoinService $bitcoinService
    ) {
        parent::__construct();
        $this->bitcoinService = $bitcoinService;
    }

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        if (!empty($this->bitcoinService->createHistoryBitcoin())) {
            return true;
        }
    }
}
