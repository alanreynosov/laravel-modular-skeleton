# laravel-modular-skeleton
Based in http://kamranahmed.info/blog/2015/12/03/creating-a-modular-application-in-laravel/ adapted to laravel 5.2 
____

* ModuleServiceProvider is now located at providers directory

## Usage

### Install
git clone https://github.com/paradojo/laravel-modular-skeleton.git

### Add a module
1. In config/module.php add a new module name
* return  [
    'modules' => [
        'Test',
        'MyNewModule'
    ]
];

2. In your Modules directory (App\Modules), create your new Module
* Create MyNewModule directoy
* Insider your MyNewModule directoy, create, Models, Controllers and Views Directories
* Create you routes.php file 
* 
Done

The quick and easy  way is copy the Test Module and rename by you new Modules Name.
