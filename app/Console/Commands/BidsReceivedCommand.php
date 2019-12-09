<?php

namespace App\Console\Commands;

use App\Mail\DeadlinePastReminder;
use App\Models\Bid;
use App\Models\Tender;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class BidsReceivedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bids:received';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bidders have been notified of deadline ellapse';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $tenders = Tender::all();
//        dd(Carbon::yesterday());
        foreach ($tenders as $tender) {
            $deadline = $tender->deadline->isoFormat('Y-m-d');
            $yesterday = Carbon::yesterday()->isoFormat('Y-m-d');
            if ($deadline === $yesterday){
//                dump($tender->deadline);
                $bids = Bid::where('tender_id',$tender->id)->get();
                foreach ($bids as $bid) {
//                    dd($bid->user);
                    Mail::to([$bid->user->email, $bid->user->company->first()->email])->send(new DeadlinePastReminder($tender));
                    sleep(5);
                }
            }
        }
    }
}
