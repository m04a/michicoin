<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Artisan;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class FnxInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fnx7:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Firsts steps to install';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    private function setEnv($k,$v, $str){
        $oldValue = env($k);
        return str_replace("{$k}={$oldValue}", "{$k}={$v}", $str);

    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        if ($this->confirm('Vols configurar el fitxer .env? (Només en cas de no tenir-lo) ')) {

            $oldLocales = implode(',',array_keys(\Config::get('backpack.crud.locales')));

            $locales = $this->ask('Separat per comes, els idiomes actuals del projecte (primer el per defecte)?',$oldLocales);


            $crudConfigFile = config_path('backpack/crud.php');
            $str = file_get_contents($crudConfigFile);

            foreach(explode(',',$oldLocales) as $loc){
                $str = str_replace('"'.$loc.'"','// "'.$loc.'"',$str);
            }

            $arrLocales = explode(',',$locales);

            foreach($arrLocales as $loc){
                $str = str_replace('// "'.$loc.'"',' "'.$loc.'"',$str);
            }

            $fp = fopen($crudConfigFile, 'w');
            fwrite($fp, $str);
            fclose($fp);

            $currentLocale = config('app.locale');

            $appConfigFile = config_path('app.php');
            $str = file_get_contents($appConfigFile);
            $str = str_replace("'locale' => '$currentLocale'","'locale' => '$arrLocales[0]'",$str);
            $fp = fopen($appConfigFile, 'w');
            fwrite($fp, $str);
            fclose($fp);

            $envFile = app()->environmentFilePath();
            $str = file_get_contents($envFile);

            $dbhost = $this->ask('Host de la base de dades?',env('DB_HOST'));
            $dbport = $this->ask('Port de la base de dades?',env('DB_PORT'));
            $dbname = $this->ask('Nom de la base de dades?',env('DB_DATABASE'));
            $dbuser = $this->ask('Usuari de la base de dades?',env('DB_USERNAME'));
            $dbpwd = $this->ask('Password de la base de dades?',env('DB_PASSWORD'));

            if ($this->confirm('Estas treballant amb MAMP? (descomentarem el socket)')) {
                $str = str_replace('MAMP_DB_SOCKET',"DB_SOCKET",$str);
            }
            else{
                $str = str_replace('DB_SOCKET',"MAMP_DB_SOCKET",$str);
            }


            if ($this->confirm('Vols activar les entrades?',TRUE)) {
                $str = str_replace('FNX_ENTRIES=FALSE',"FNX_ENTRIES=TRUE",$str);
            }
            else{
                $str = str_replace('FNX_ENTRIES=TRUE',"FNX_ENTRIES=FALSE",$str);
            }

            if ($this->confirm('Vols activar guardar enviaments de formularis?',TRUE)) {
                $str = str_replace('FNX_SAVE_SENDFORMS=FALSE',"FNX_SAVE_SENDFORMS=TRUE",$str);
            }
            else{
                $str = str_replace('FNX_SAVE_SENDFORMS=TRUE',"FNX_SAVE_SENDFORMS=FALSE",$str);
            }
    
            $str = $this->setEnv("DB_HOST",$dbhost, $str);
            $str = $this->setEnv("DB_PORT",$dbport, $str);
            $str = $this->setEnv("DB_DATABASE",$dbname, $str);
            $str = $this->setEnv("DB_USERNAME",$dbuser, $str);
            $str = $this->setEnv("DB_PASSWORD",$dbpwd, $str);

            $fp = fopen($envFile, 'w');
            fwrite($fp, $str);
            fclose($fp);

            $this->info('Actualitzant configuració al .env. Torna a executar la instalació per continuar.');
         }
        else{
            Artisan::call('migrate');
            echo Artisan::output();
    
            $rootmail = 'michicoin@michicoin.com';
    
            $user = User::where('email', $rootmail)->first();
            if($user){
                if ($this->confirm('Vols modificar el pwd de root?',FALSE)) {
                    $pwd = 'Fnx'.Str::random(6);
                    $user->password = Hash::make($pwd);
                    $user->save();
                    $this->info('Usuari creat amb el pwd '.$pwd);
                }
            }
            else{
                if ($this->confirm('Vols generar un usuari root amb el email michicoin@michicoin.com?',TRUE)) {
                    $pwd = 'Fnx'.Str::random(6);
                    $user = new User();
                    $user->name = 'Michicoin';
                    $user->email = $rootmail;
                    $user->password = Hash::make($pwd);
                    $user->save();
                    $this->info('Usuari creat amb el pwd '.$pwd);
    
        
                }
            }
    
            return '';
        }

     

    
    }
}
