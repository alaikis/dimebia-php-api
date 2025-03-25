# Dimebia API client for PHP
1,install the package via composer
```shell
composer require alaikis/dimebia-php
```

2,you can use this client to create a payment as simple with a few lines of code
```php
$key = "";
$secret = "";
$client = new Dimebia($key, $secret);
$payment = $client->createPayment([
    "amount" => [
        "value" => 100,
        "currency" => "EUR",
    ],
    'channel_id' => 1000,
    "description"' => "make a payment by api",
])
```
## create a payment
3, Of course,you can also generate a payment with full information about the order,which is useful for e-commerce, then you can track the transform with the information easy.
```php
$key = "";
$secret = "";
$client = new Dimebia($key, $secret);
$payment = $client->createPayment([
    "amount" => [
        "value" => 100,
        "currency" => "EUR",
    ],
    "billing_address" => [
        "streetAndNumber" => "Keizersgracht 313",
        "postalCode" => "1016 EE",
        "city" => "Amsterdam",
        "country" => "nl",
        "givenName" => "Luke",
        "familyName" => "Skywalker",
        "email" => "luke@skywalker.com",
    ],
    "shipping_address" => [
        "streetAndNumber" => "Keizersgracht 313",
        "postalCode" => "1016 EE",
        "city" => "Amsterdam",
        "country" => "nl",
        "givenName" => "Luke",
        "familyName" => "Skywalker",
        "email" => "luke@skywalker.com",
    ],
    "locale" => "en_US",
    "orderNumber" => "1234",
    'channel_id' => 1000,
    "description"' => "make a payment by api",
    "redirect_url" => "https://example.com/payment-success",
    "cancel_url" => "https://example.com/payment-failed",
    "webhookUrl" => "https://example.com/webhook",
    "lines" => [
        [
            "sku" => "5702016116977",
            "name" => "LEGO 42083 Bugatti Chiron",
            "productUrl" => "https://shop.lego.com/nl-NL/Bugatti-Chiron-42083",
            "imageUrl" => 'https://sh-s7-live-s.legocdn.com/is/image//LEGO/42083_alt1?$main$',
            "quantity" => 2,
            "vatRate" => "21.00",
            "unitPrice" => [
                "currency" => "EUR",
                "value" => "399.00",
            ],
            "totalAmount" => [
                "currency" => "EUR",
                "value" => "698.00",
            ],
            "discountAmount" => [
                "currency" => "EUR",
                "value" => "100.00",
            ],
            "vatAmount" => [
                "currency" => "EUR",
                "value" => "121.14",
            ],
        ],
        // more order line items
    ],
])
```