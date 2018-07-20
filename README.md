### Euphme Laravel SDK

Eupheme laravel sdk is laravel package for integrate [Eupheme](https://github.com/sanmark/eupheme-core) to laravle project.


#### Installation 

`composer require sanmark/eupheme-laravel-sdk`


#### publish configurations

`php artisan vendor:publish --provider="Sanmark\EuphemeLaravelSdk\EuphemeLaravelSdkServiceProvider"`
 
 
#### Configurations

configurations located in `config/eupheme-laravel-sdk.php`

##### Add details of eupheme instances
```
'instances' => [
    'ads' => [
        'base_url' => '{name of eupheme instance}',
        'app_key' => '{app key of eupheme instance}',
        'app_hash' => '{app hash of euphme instance}'
    ]
 ],
 ```
 
 ##### Auto approve comments
 
 To auto approve comments change `auto_approve` to `1`. Default value is `0`
 
 ##### customize user details
 
 To customize user details create class implementing interface `Sanmark\EuphemeLaravelSdk\iUserHelper`
 
 implement both `getAuthUserID` and `getUserNameFromID` and add class name to configuration file under `user_helper` 
 
 
 #### Usage
 
 include view anywhere you want to include eupheme comments section 
 `@include('eupheme-laravel-sdk::comments', ['eupheme_ext_ref' => {reference_number_for_comments}, 'eupheme_instance' => '{name_o_the_instance}'])`
 
