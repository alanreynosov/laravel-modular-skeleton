<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;

class CreateModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'modules:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a Module directory skeleton';
    /**
     * @var Filesystem
     */
    private $filesystem;

    private $module_structure = ['Models','Views','Controllers'];
    private $module_routes_file = 'routes.php';

    private $modulesDirectoy = 'Modules';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $filesystem)
    {
        parent::__construct();
        $this->filesystem = $filesystem;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        array_map(function($module){
            $this->createModule($module);
        },$modules = config("module.modules"));

    }

    private function routesTemplate($module){

        return "<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/$module', function () {
    return '$module';
});
";
    }

    /**
     * @return bool
     */
    private function createModule($module)
    {
        $module_dir = app_path($this->modulesDirectoy) . DIRECTORY_SEPARATOR . $module;

        if ($this->filesystem->exists($module_dir)) {
            
        }else{
            if ($this->filesystem->makeDirectory($module_dir)) {
                array_map(function ($directory) use ($module_dir) {
                    $this->filesystem->makeDirectory($module_dir . DIRECTORY_SEPARATOR . $directory);
                }, $this->module_structure);
                File::put($module_dir . DIRECTORY_SEPARATOR . $this->module_routes_file, $this->routesTemplate($module));
                $this->info("Module $module Created");
            }
        }
    }
}
