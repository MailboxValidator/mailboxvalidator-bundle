# MailboxValidator Symfony Email Validation Bundle

MailboxValidator Symfony Email Validation Bundle provides an easy way to call the MailboxValidator API which validates if an email address is valid.

Note: This bundle required at least Symfony 4.3 to work with.

## Installation

Open the terminal, navigate to your project root and run the following commands:

```console
$ composer require mailboxvalidator/mailboxvalidator-bundle
```

## Dependencies

An API key is required for this module to function.

1. Go to https://www.mailboxvalidator.com/plans#api to sign up for FREE API plan and you'll be given an API key.

2. After you get your API key, load a ``.env`` file in your PHP application via ``Dotenv::load()``.

```php
use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/.env'); //Your .env file path
```

3. Open your ``.env`` file and add the following line:

```
MBV_API_KEY=PASTE_YOUR_API_KEY_HERE
```

Note: MailboxValidator PHP Module is required and will be auto installed by Composer. If in case your Composer did not install it for you, you can get it from here:  https://github.com/MailboxValidator/mailboxvalidator-php .

## Usage

The validators available to validate the email are: single, free and disposable. Each validator validate the email by using MailboxValidator API. For more information, you can visit [Single Validation API](https://www.mailboxvalidator.com/api-single-validation), [Disposable Email API](https://www.mailboxvalidator.com/api-email-disposable) and [Free Email API](https://www.mailboxvalidator.com/api-email-free). 

1. To use any one of three validators or use all of the validators, include the following lines in any form controller that handle the validation:

```php
use MailboxValidatorBundle\Validator\MBVSingle;
use MailboxValidatorBundle\Validator\MBVDisposable;
use MailboxValidatorBundle\Validator\MBVFree;
```

2. After that, add a new rule to your form field. For example, if you want to validate the disposable email, your rule will be like this:

```php
->add('email', EmailType::class, [
				'constraints' => [
                    new MBVDisposable([
						//You can also custom a message yourself. For example,
						//'message' => 'This email is disposable. Please enter another email again.',
                    ]),
				],
			])
```



## Copyright

Copyright (C) 2019 by MailboxValidator.com, support@mailboxvalidator.com