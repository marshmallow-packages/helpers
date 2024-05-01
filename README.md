![alt text](https://marshmallow.dev/cdn/media/logo-red-237x46.png "marshmallow.")

# Marshmallow Deployer

We have build a package with some helpers that are usefull in almost every project. We use this package in all our projects. For ourself and for our customers. If you miss anything, create an issue and will will add it as soon as possible.

[![Version](https://img.shields.io/packagist/v/marshmallow/helpers)](https://github.com/marshmallow-packages/helpers)
[![Issues](https://img.shields.io/github/issues/marshmallow-packages/helpers)](https://github.com/marshmallow-packages/helpers)
[![Code Coverage](https://img.shields.io/badge/coverage-100%25-success)](https://github.com/marshmallow-packages/helpers)
[![Licence](https://img.shields.io/github/license/marshmallow-packages/helpers)](https://github.com/marshmallow-packages/helpers)

## Installation

You can install the package via composer:

```bash
composer require marshmallow/helpers
```

# Table of contents
1. [CSV Helper](#csv-helper)
2. [Helper functions](#helper-functions)
3. [String helper](#string-helper)
3. [Migrations](#migrations)
3. [URL](#url)
3. [Array](#array)
3. [Reviews](#reviews)
3. [Grouper](#grouper)

## CSV Helper

This helper will make generating .csv files extremly ease. Please check the examples below. You can use the store method to store it in a location of your choosing. You can use the download method if you just want to download the file. If you wish to store and download the generated .csv file you can use the storeAndDownload method.

### Usage example

```php
$headers = ['Column 1', 'Column 2', 'Column 3'];
$data = [
	[1, 2, 3],
	[4, 5, 6],
];

return CSV::headers($headers)
	->data($data)
	->delimiter(';')
	->setFilename('generated-csv-1234')
	->storeAndDownload();
```

### **Use a collection as data attribute**

You can use a collection as your data attribute. By default it will map all the data in the collection sequence. If you wish to edit the collection data, you can add a callback method to the data method. Please note that this will give you every row as an `array` value.

```php
use Marshmallow\HelperFunctions\Facades\CSV;

CSV::headers($headers)
        ->data($data, function (array $row) {
            return [
                $row['name'],
                $row['slug'],
                $row['created_at'],
            ];
        })
        ->storeAndDownload();
```

### **Store and download calls**

The following methods are available for storing and downloading the generated csv file.

```php
$csv->download();
$csv->store();
$csv->storeAndDownload();
$csv->stream();
```

## Helper functions

### Percentage helper

This is a public helper function that is available within your Laravel application. This function can be used in all your PHP and Blade files.

```php
percentage(47, App\Post::get()); // 63.829787234043
```

## String Helper

The Str helper extends the helper from Laravel. So you have all the methods available in the Laravel helper available as well. Check the **[Laravel documentation](https://laravel.com/docs/helpers)** for all the available methods.

### **Str::join()**

This method is super handy for concatenating strings separated by a comma, but use another value for the last item. Checkout the example below.

```php
Str::join([
  'Marshmallow',
  'Stef van Esch',
  'Mr Mallow'
]);

// Marshmallow, Stef van Esch and Mr Mallow
```

### **Str::random()**

We have added on the default `Str::random()` of Laravel. We've added a second parameter which is an array of characters that should be ignored. We also have build in a couple of presets like `lowercase` which will make sure the random string won't contain any lowercase characters.

```php
Str::random($limit = 16, $ignore = [
    /**
     * Custom items
     */
    'A','B', 'C', 'D',

    /**
     * Presets
     */
    'lowercase', 	// Will ignore all lowercase characters.
    'uppercase',	// Will ignore all uppercase characters.
    'letters',		// Will ignore all letters.
    'numbers',		// Will ignore all numbers.
    'similar',		// Will ignore all numbers and letters that have been marked as similar.
]);
```

### **Str::cleanPhoneNumber()**

```php
Str::cleanPhoneNumber()
```

### **Str::phonenumberWithCountryCode()**

Return a cleaned phonenumber with the country code. You can choose to return the phonenumber with a `+` or `00` at the start of the phonenumber.

```php
Str::phonenumberWithCountryCode('0628998954')
// response: +31628998954

Str::phonenumberWithCountryCode(
    '0031628998954',
    $country_code = '31',
    $use_plus_instead_of_zeros = false
);
// response: 0031628998954
```

### **Str::numbersOnly()**

```php
Str::numbersOnly()
```

### **Str::numbersAndLettersOnly()**

```php
Str::numbersAndLettersOnly()
```

### **Str::readmore()**

```php
Str::readmore(
    $string,
    $lenght_first_part,
    $return_this_part = null
);
```

### **Str::paragraphsAsArray()**

```php
Str::paragraphsAsArray($string);
```

### **Str::getFirstParagraph()**

```php
Str::getFirstParagraph(
    $string,
    $number_of_paragraphs = 1,
    $return_array = false
);
```

### **Str::getAllButFirstParagraph()**

```php
Str::getAllButFirstParagraph(
    $string,
    $number_of_paragraphs_to_skip = 1,
    $return_array = false
);
```

## Migrations

We have a trait available that gives you some extra options when creating migrations. Add the `MigrationHelper` trait to you migration to make use of these options.

### Implementation

```php
use Marshmallow\HelperFunctions\Traits\MigrationHelper;

class CreateProductTable extends Migration
{
    use MigrationHelper;
```

### **Create a column only if it doesn't exist.**

This method was added because when a database that already has a products table and later will use our `Product` package, the migrations will through error's.

```php
$this->createColumnIfDoesntExist(
    'products', 'deleted_at', function (Blueprint $table) {
        $table->softDeletes();
    }
);
```

## URL

### **URL::isInternal()**

```php
URL::isInternal($url)
```

### **URL::isCurrent()**

```php
URL::isCurrent($url)
```

### **URL::buildFromArray()**

```php
URL::buildFromArray($array)
```

### **URL::isNova()**

```php
URL::isNova($request)
```

### **URL::isNotNova()**

```php
URL::isNotNova($request)
```

## Array

### **Arrayable::storeInFile();**

This method will store a pretty array in a file. With this method is possible to generate config files.

```php
Arrayable::storeInFile(array $array, string $file_location);
```

## Builder

### **Builder::published()**

`BuilderHelper::published` will filter on database columns if something is published.

```php
public function scopePublished (Builder $builder)
{
    BuilderHelper::published(
        $builder,
        $valid_from_column,
        $valid_till_column
    );
}
```

## Reviews

For the review stars you can call `ReviewHelper::ratingToStars(4.5)`. By default the ReviewHelper will think you are using a max rating of 5, support half star rating and return a string of FontAwesome icons. You can overule this behaviour by;

### **Customise**

Create the config file `config/review.php` and specify your needs:

```php
return [
    'max_rating' => 10,
    'full_star' => '+ ',
    'half_star' => '* ',
    'empty_star' => '- ',
];
```

Or you can provide the same config array as a second parameter to the `ratingToStars` method like so;

```php
ReviewHelper::ratingToStars(4.5, [
    'max_rating' => 10,
    'full_star' => '+ ',
    'half_star' => '* ',
    'empty_star' => '- ',
])
```

## Grouper

Grouper is a super handy helper when you need to split your queries results in to groups. We use this with blogs a lot. The first row might have 3 results, the second row will have 1 result, en the third row will have 3 items again. Please see the example below.

```php
use Marshmallow\HelperFunctions\Facades\Collection;

$grouper = Collection::createGrouper(Blog::get(), $structure_array = [
    'first' => 3,
    'second' => 1,
    'third' => 2,
]);
```

As you can see in the example, the `structure_array` has a name as the key. This is done so when you are looping through your groups, you are able the test which group you are currently looping.

```php
foreach ($grouper as $group) {
    if ($group->is('first')) {
        // Add your template for 3 items
    }

    if ($group->is('second')) {
        // Add your template for 1 item
    }
}
```

Looping through the group items works just like you expect when working with collections.

```php
foreach ($grouper as $group) {
    foreach ($group as $blog) {
        //
    }
}
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

```bash
composer test
```

## Security

If you discover any security related issues, please email stef@marshmallow.dev instead of using the issue tracker.

## Credits

-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
