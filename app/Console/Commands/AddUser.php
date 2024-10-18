<?php

namespace App\Console\Commands;

use App\Models\User;
use Exception;
use Illuminate\Console\Command;

class AddUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $message = 'User was created';
        try {
            $name = $this->argument('name');
            $email = $this->argument('email');
            $password = $this->argument('password');

            $createArr = [
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password)
            ];

            User::create($createArr);
        } catch (Exception $exception) {
            $message = 'Something went wrong: '. $exception->getMessage();
        }

        echo $message;
        return 0;
    }
}
