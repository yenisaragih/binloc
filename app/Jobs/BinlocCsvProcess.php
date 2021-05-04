<?php

namespace App\Jobs;

use App\Models\Binloc;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Throwable;

class BinlocCsvProcess implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;
    public $header;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $header)
    {
        $this->data     = $data;
        $this->header   = $header;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->data as $item) {
            try {
                // $binloc = Binloc::create([
                //     "part_number"       => $item[0],
                //     "description"       => $item[1],
                //     "stock_oh_s79"      => $item[2],
                //     "stock_code_s79"    => $item[3],
                //     "ip_prestocking"    => $item[4],
                //     "stock_oh_s38"      => $item[5],
                //     "stock_code_s38"    => $item[6]
                // ]);

                $binloc = array_combine($this->header, $item);

                Binloc::create($binloc);

            } catch (Throwable $e) {
                file_put_contents(public_path() . "/error.txt", $e);
            }
        }
    }

    public function failed(Throwable $exception)
    {
        return $exception;
    }
}
