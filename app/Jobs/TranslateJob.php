<?php

namespace App\Jobs;

use App\Models\Job;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class TranslateJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Job $jobListing)
    {
        // Al inyectar la dependencia ya la clase sabe que tiene una instancia de joblisting con la que interactuar
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        logger('Tanslating ... ' . $this->jobListing->title . ' to Spanish.');
    }
}
