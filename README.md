# Dynosend API Client

PHP client for Dynosend api

This is just an example, for the rest of the methods please check the [API Documentation](https://developers.dynosend.com/)



The API client can be installed via [Composer](https://github.com/composer/composer).

Run this command:

```
composer require rolocost/dynosendphp
```

## Basic Usage

You can include the Composer autoloader in your application:

```php
<?php
require_once 'vendor/autoload.php';

// Application code...
?>
```
Or use a backslash to load the library when needed.

Configure your access credentials when creating a client:

```php
<?php

$client = new \DynosendSDK\Client('API_TOKEN');
// API token can be found in your account's API settings

?>
```


### Examples

#### Audiences (contact lists)

```php
<?php

// Get an audience
try {
    $client->audience()->find('5fc9e55410e10'); 
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
    // Handle the error
}

// Create custom field
try {
    $client->audience()->addCustomField('5fc9e55410e10', [
        'type' => 'text',
        'label' => 'Plan name',
        'tag' => 'PLAN',
        'default_value' => 'Free trial'
    ]);
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
    // Handle the error   
}

```

#### Contacts

```php
<?php
// Get all contacts in a given audience
try {
    $client->contact()->all([
        'list_uid' => '5fc9e55410e10',
        'per_page' => 20,
        'page' => 1
    ]); 
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
    // Handle the error
}

// Create a contact
try {
    $client->contact()->create([
        'EMAIL' => 'john@example.com',
        'list_uid' => '5fc9e55410e10',
        'tag' => 'tag, another tag';
        'OTHER_FIELD' => ...
    ]); 
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
    // Handle the error
}

// Update contact's data fields
try{
    $client->contact()->update('john@example.com',[
        'EMAIL' => 'john@example.com',
        'list_uid' => '5fc9e55410e10',
        'tag' => 'new tags',
        'OTHER_FIELDS' => ...
    ]); 
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
    // Handle the error
}

// Tag contact
try{
    $client->contact()->addtag([
        'email' => 'john@example.com',
        'list_uid' => '5fc9e55410e10',
        'tag' => 'your added tags'
    ]); 
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
    // Handle the error
}
```

#### Events
```php
<?php
// Send an event
try {
    $client->event()->sendevent([
        'event_name' => 'account_created',
        'email' => 'john@example.com',
        'list_uid' => '5fc9e55410e10'
    ]); 
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
    // Handle the error
}
```


#### Check the [API Documentation](https://developers.dynosend.com/) for the rest of the methods.

