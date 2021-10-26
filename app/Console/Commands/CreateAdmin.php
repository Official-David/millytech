<?php

namespace App\Console\Commands;

use Throwable;
use App\Models\Admin;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CreateAdmin extends Command
{
    protected $retries = 3, $pass, $confirm_pass,$email,$tries=0;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an admin user from the command line';

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
        $admin = new Admin();
        $admin->firstname = $this->ask('What is your firstname');
        $this->info("firstname set as {$admin->firstname}");

        $admin->lastname = $this->ask('What is your lastname');
        $this->info("lastname set as {$admin->lastname}");

        $this->email();
        for($i = 1; $i < $this->retries; $i++)
        {
            if($this->emailExists()){
                $this->error('Hmmmm an admin user with that email address already exists... Try another one!');
                $this->email();
            }
            if(!$this->validateEmail()){
                $this->error('Not a valid email address. Try again..');
                $this->email();
            }
            $this->tries++;
        }
        $this->retryable();
        $admin->email = $this->email;
        $this->info("email address set to {$admin->email}");
        $this->password();
        $this->confirm_password();
        for($i = 1; $i < $this->retries; $i++)
        {

            if($this->pass !== $this->confirm_pass){
                $this->error('that didn\'t work... Try again.');
                $this->password();
                $this->confirm_password();
            }else{
                $this->info('password matched!');
                break;
            }
            $this->tries++;
        }
        $this->retryable();
        $admin->password = $this->pass;

        $admin->super = $this->choice('A super Admin?',['yes' => 1,'no' => 0],'no') == 'no' ? 0:1;
        $this->newLine(3);
        $this->line("------ All Set. Creating Admin-----");

        try{
            $admin->save();
            $this->info('Admin Created Successfully');
            $this->info("open http://".admin_domain()." to start your administrative work 😄");
        }catch(Throwable $e){
            Log::error($e);
            $this->error('Oops! An error occured while creating Admin');
        }
        $this->newLine(3);
        return 0;
    }

    private function password(){
        $this->pass = $this->secret('please enter your password');
        $this->info('password set.');
    }
    private function confirm_password()
    {
        $this->confirm_pass = $this->secret('Please confirm your password');
        $this->info('confirm password set.');
        $this->line('validating password match...');
        return;
    }

    private function email()
    {
        $this->email = $this->ask('What is your email address');
    }
    private function validateEmail()
    {
        return filter_var($this->email, FILTER_VALIDATE_EMAIL);
    }
    private function emailExists()
    {
        return Admin::where('email',$this->email)->exists();
    }

    private function retryable()
    {
        if($this->tries > $this->retries)
        {
            $this->newLine(3);
            $this->error("Retries finished... Ending program");
            die();
        }else{
            $this->tries = 1;
        }
    }

}
