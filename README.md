# An Access Control List for Laravel

> With this ACL is it possible to protect routes as well as single methods / functions
> It's possible to give Single authorizations to users or to divide into roles which can also get single authorizations.


### Install the ACL

* Composer
    ```php
    composer require cyrixbiz/acl dev-master
    ```
    

* Edit config\app and add the following lines
    
    ```php
  'providers' => [
    // ...
    cyrixbiz\acl\AclServiceProvider::class,
    // ...
  ];
    ```

*  Got to your User Model - Default Value: App\Models\User.php and set this
    
    ```php
    //after namespace .....
    use cyrixbiz\acl\traits\hasRelation;
    
    //after Notifiable in Class
    //for Example: use Notifiable, hasRelation;
    
    , hasRelation;
    ```
    
* Install all

    ```php
    php artisan make:acl
    ```
    
* Install a Single Method
    
    * Allow Arguments: 
       - setAuth ( Laravel Auth )
       - setRoutes ( ACL Routes to web.php )
       - setResourceFiles ( Lang and View Files)
       - setTables ( Set Database Tables )
       - setSeeds ( Insert Database Seeds)
       - setAdmin ( Set an Admin )
       
   * Allow Options
       - setAdmin --admin=Adminname --admin=AdminMail --admin=AdminPassword
       
         > Rules = Name 5 Letters
                   Email Valid-Email and Unique
                   Password = Min. 8 Signs and 3 of 4 Rules 1 Low- and 1 Upper- Case / 1 Number / Special Chars  

    ```php
    php artisan make:acl argument
    ```    

* Edit App\Http\Kernel and add the following lines

    ```php
    protected $middlewareGroups = [
      //
    'acl' => [\cyrixbiz\acl\Http\Middleware\Acl::class,
            ],
    ```    

* Error - Handling 
    
    > Exception: 
    PDOException::("SQLSTATE[42000]: Syntax error or access violation: 1071 
    Specified key was too long; max key length is 767 bytes")
    
    Fix this Issue:
    - App\Providers
    ```php
    // after namespace
    use Illuminate\Support\Facades\Schema;
    // Inside Boot-Method
    Schema::defaultStringLength(191);
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
		
    * Set a newMemberRole
        ###### 'newMemberRole' => 3 - UserID
        > Description: Members receive this Role after an active registration
        
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
@perm('user.index')
    <a class="btn btn-xs btn-warning" href="#">Anzeigen</a>
@endperm
```

> For Example: Multi Check @perms @endperms

```html
@perms(['acl.getPermissions' , 'role.user'])
<a class="btn btn-xs btn-success" href="#">Anker</a>
@endperms
```

> For Example: Multi Check, One must true @orPerms @endorPerms

```html
@orPerms(['acl.getPermissions' , 'role.user'])
<a class="btn btn-xs btn-success" href="#">Anker</a>
@endorPerms
```

###### Requirements

- <a href="https://laravel.com/docs/8.x/">Laravel 8.x</a>
- <a href="https://laravel.com/docs/8.x/authentication">Auth</a>