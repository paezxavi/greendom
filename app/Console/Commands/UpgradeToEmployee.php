<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class UpgradeToEmployee extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'employe:upgrade {user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Permet de upgrade un utilisateur en employé';


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
        $user = User::where('email', $this->argument('user'))->get()->first();
        $user->employee = true;
        $user->save();
    }
}
