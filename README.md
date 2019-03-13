# An Access Control List for Laravel

> With this ACL is it possible to protect routes as well as single methods / functions
> It's possible to give Single authorizations to users or to divide into roles which can also get single authorizations.


### Install the ACL

* Composer
    ```php
    composer require cyrixbiz/acl
    ```

* Edit config\app and add the following lines
    
    ```php
      'providers' => [
        // ...
        cyrixbiz\acl\AclServiceProvider::class,
        // ...
      ];
    ```

* Edit App\Http\Kernel and add the following lines

    ```php
        protected $middlewareGroups = [
          //
        'acl' => [\cyrixbiz\acl\Middleware\Acl::class,
                ],
    ```

*  Got to your User Model - Default Value: App\User.php and set this
    
    ```php
        //after namespace .....
        use cyrixbiz\acl\traits\hasRelation;
        
        //after Notifiable
        //for Example: use Notifiable, hasRelation;
        
        , hasRelation;
    ```

* Migrate the Database

    ```php
    php artisan migrate
    ```

* Set the Default Values

    ```php
    php artisan db:seed --class=\cyrixbiz\acl\seeds\AclRoleSeeder
    ```

* Optional 
    - App\Providers into Boot-Method
    ```php
    php artisan db:seed --class=\cyrixbiz\acl\seeds\AclRoleSeeder
    ```

    - Publish Config
    ```php
    php artisan vendor:publish
    ```

### Config - File

* ACL

    *  Enable / Disable the Routeprotection
    
        ###### 'enable' => true | false
        
    * Method to check the Routes
    
        ###### 'method' => getActionName | getName
        > Description: If i use the method 'getActionName', the controller will be used and dissolved for the determination
         of the resources.
         Out of the rolecontroller@index it will create role.index.
         If u use the method 'getName', the alias of the controller will be used  for the determination.
    
        ###### 'fallback' => getActionName | getName
        > Description: Set a Fallback to Check the Method    
    
    * Set a Secure User
        ###### 'superAdmin' => 1 - UserID
        > Description: This User has Full Rights and can't be deleted
        
    * Set a Blocked Role
        ###### 'blockedRole' => 5 - RoleID
        > Description: This Role has zero Rights and can't be deleted. 
        Set a User to this Role and all other Roles and Resources will be deleted.       
        
* Cache

    * Set Cache Time in Seconds
        ###### 'time' => '60'
        > Description: This Method set the Time to Cache the User-Resources
        

### Usage

###### Middleware
> For Example: Set this to your Route-File and all routes in this group are checked
>  - routes/web

```php
Route::middleware(['web' , 'acl'])
    ->group(function () {
        Route::get('user', 'cyrixbiz\acl\controller\UserController@index')
            ->name('user.index');
});
```

###### Blade
> For Example: Single Check @perm @endperm

```html
@perm($action.'.show')
    <a class="btn btn-xs btn-warning" href="{{ route($action.'.show' , $value->id) }}"> <i class="fa fa-btn fa-edit"></i>Anzeigen</a>
@endperm
```

> For Example: Multi Check @perms @endperms

```html
@perm($action.'.show')
    <a class="btn btn-xs btn-warning" href="{{ route($action.'.show' , $value->id) }}"> <i class="fa fa-btn fa-edit"></i>Anzeigen</a>
@endperm
```

###### Requirements

- <a href="http://laravel.com/docs/5.7">Laravel 5</a>