<?php

namespace App\Jobs;

use App\Diary;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class DiaryLog implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $diary;

    /**
     * Create a new job instance.
     *
     * @param Diary $diary
     */
    public function __construct(Diary $diary)
    {
        $this->diary = $diary;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \Log::info('whose diary has written: ');
    }
}
