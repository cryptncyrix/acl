# acl
An Access Control List for Laravel

> Give user individual rights and roles

###### Install

> Edit config/app and add the following lines

```php
  'providers' => [
    // ...
    cyrixbiz\acl\AclServiceProvider::class,
    // ...
  ];
```

> Edit App\Http\Kernel and add the following lines

```php
    protected $middlewareGroups = [
	  //
    'acl' => [\cyrixbiz\acl\Middleware\Acl::class,
            ],
```

>  Got to your User Model - Default Value: app\User.php and set this

```php
    //after namespace .....
    use cyrixbiz\acl\traits\hasRelation;
    
    //after Notifiable
    //for Example: use Notifiable, hasRelation;
    
    , hasRelation;
    
```

Migrate the Database
```php
php artisan migrate
```

Set the Default Values
```php
php artisan db:seed --class=\cyrixbiz\acl\seeds\AclRoleSeeder
```

Optional - Publish Config
```php
php artisan vendor:publish
```

The User with the ID 1 is a SuperAdmin and Open all Routes, you can change this in the Config-File.

###### Usage

Create a Resource for Example
Controller Comment has the action index, then set comment.index to Database

###### Requirements

- <a href="http://laravel.com/docs/5.7">Laravel 5</a>

## Todo
- [ ] Admin Area
- [ ] Cache
