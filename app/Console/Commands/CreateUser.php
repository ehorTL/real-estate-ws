<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Hash;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates new system user (admin)';

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
        $name = $this->ask('User name');
        $email = $this->ask('Email');
        $login = $this->ask('User LOGIN');
        $password = $this->secret('Password');

        $this->line('User will be created:');
        $this->newLine();
        $this->line('Name: ' . $name);
        $this->newLine();
        $this->line('LOGIN: ' . $login);
        $this->newLine();
        $this->line('Email: ' . $email);
        $this->newLine();

        if ($this->confirm('Create new user?')) {
            $user = User::create([
                'name' => $name,
                'login' => $login,
                'password' => Hash::make($password),
                'email' => $email,
            ]);
        }

        $this->info('User successfully created');

        return 0;
    }
}
