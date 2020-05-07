<p align="center">
    <img src="https://cdn.marshmallow-office.com/media/images/logo/marshmallow.transparent.red.png">
</p>
<p align="center">
    <a href="https://github.com/Marshmallow-Development">
        <img src="https://img.shields.io/github/issues/Marshmallow-Development/package-helper-functions.svg" alt="Issues">
    </a>
    <a href="https://github.com/Marshmallow-Development">
        <img src="https://img.shields.io/github/forks/Marshmallow-Development/package-helpers-functions.svg" alt="Forks">
    </a>
    <a href="https://github.com/Marshmallow-Development">
        <img src="https://img.shields.io/github/stars/Marshmallow-Development/package-helpers-functions.svg" alt="Stars">
    </a>
    <a href="https://github.com/Marshmallow-Development">
        <img src="https://img.shields.io/github/license/Marshmallow-Development/package-helpers-functions.svg" alt="License">
    </a>
</p>

# Marshmallow Helpers
With the marshmallow helper package, you will get a lot of helper functions to use through your marshmallow applications.

### Installing
```
composer require marshmallow/laravel-helpers
```

Next, you will have access to al the marshmallow helper functions. You can override these functions in your own project if you're not happy with what the function is doing. Please remember, update the function in de package is best practice.

### Available facades
Below you will find a list of function in the helper package

## URL
- URL::isInternal('url')
- URL::buildFromArray($array)
- URL::isNova($request)

## Str
- Str::cleanPhoneNumber()
- Str::numbersOnly()
- Str::numbersAndLettersOnly()
- Str::paragraphsAsArray($string)
- Str::getFirstParagraph($string, $number_of_paragraphs = 1, $return_array = false)
- Str::getAllButFirstParagraph($string, $number_of_paragraphs_to_skip = 1, $return_array = false)

### Available helper functions
- percentage(47, App\Post::get()); // 63.829787234043

## ReviewStars
For the review stars you can call `ReviewHelper::ratingToStars(4.5)`. By default the ReviewHelper will think you are using a max rating of 5, support half star rating and return a string of FontAwesome icons. You can overule this behaviour by;

### Customise
Create the config file `config/review.php` and specify your needs:
```
<?php

return [
    'max_rating' => 10,
    'full_star' => '+ ',
    'half_star' => '* ',
    'empty_star' => '- ',
];
```

Or you can provide the same config array as a second parameter to the `ratingToStars` method like so;
```
ReviewHelper::ratingToStars(4.5, [
    'max_rating' => 10,
    'full_star' => '+ ',
    'half_star' => '* ',
    'empty_star' => '- ',
])
```

## Tests during development
`php artisan test packages/marshmallow/helpers`