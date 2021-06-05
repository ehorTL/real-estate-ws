<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class ChangePassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:chp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Changes password for user';

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
     * @return int
     */
    public function handle()
    {
        $login = $this->ask('User login');
        $user = User::where('login', $login)->first();
        if (!$user) {
            $this->error('User does not exist!');
            return 0;
        }

        $newPass = $this->ask('New password:');
        $user->password = Hash::make($newPass);
        $user->save();

        $this->info('Password changed');

        return 0;
    }
}
