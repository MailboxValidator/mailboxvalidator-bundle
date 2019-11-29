# MailboxValidator Symfony Email Validation Bundle

MailboxValidator Symfony Email Validation Bundle provides user an easy and simple way to perform email validation, if it's a valid email, by leveraging the MailboxValidator API. If you do not own a MailboxValidator API, you can sign up for a free one at [https://www.mailboxvalidator.com](https://www.mailboxvalidator.com/plans#api).

Note: This bundle only support Symfony 4.3 and onwards.

## Installation

We recommend the installation via Composer. Open the terminal, navigate to your project root and run the following commands:

```console
$ composer require mailboxvalidator/mailboxvalidator-bundle
```

## Dependencies

An API key is required for this module to function.

1. Go to [https://www.mailboxvalidator.com](https://www.mailboxvalidator.com/plans#api) to sign up for FREE API plan if you do not have an API key.

2. After obtained your API key, load a ``.env`` file in your PHP application via ``Dotenv::load()``.

```php
use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/.env'); //Your .env file path
```

3. Open your ``.env`` file and add the following line:

```
MBV_API_KEY=PASTE_YOUR_API_KEY_HERE
```

Notes: You need to install the MailboxValidator PHP Module in order to use this bundle. You can visit https://github.com/MailboxValidator/mailboxvalidator-php for the source codes.

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

Copyright (C) 2019 by MailboxValidator.com
