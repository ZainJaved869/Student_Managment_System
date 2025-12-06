<?php

namespace App\Console\Commands;

use App\Models\Leave;
use Illuminate\Console\Command;

class CleanOrphanedLeaves extends Command
{
    protected $signature = 'leaves:clean-orphaned';
    protected $description = 'Clean up leave records without applicants';

    public function handle()
    {
        $orphanedLeaves = Leave::whereDoesntHave('applicant')->get();
        
        if ($orphanedLeaves->isEmpty()) {
            $this->info('No orphaned leave records found.');
            return;
        }

        $this->info('Found ' . $orphanedLeaves->count() . ' orphaned leave records.');
        
        if ($this->confirm('Do you want to delete these orphaned leave records?')) {
            $deleted = Leave::whereDoesntHave('applicant')->delete();
            $this->info('Deleted ' . $deleted . ' orphaned leave records.');
        }
    }
}