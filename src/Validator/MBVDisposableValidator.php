<?php

namespace MailboxValidatorBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

// We will use MailboxValidator PHP library to do our validation
use MailboxValidator\EmailValidation;

class MBVDisposableValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint): void
    {
		/* @var $constraint \App\Validator\MBVDisposable */

		$apikey = $_ENV['MBV_API_KEY'];

		$mbv = new EmailValidation($apikey);

		if($apikey == ''){

		}
		else {
			$results = $mbv->isDisposableEmail($value);
			
			if ($results === false) {
				return; //return "Error connecting to API."
			} else if ((! isset($results->error_code)) && (isset($results->is_disposable))) {
				if (! $results->is_disposable) {
					return;
				}
			} else if ((isset($results->error_code)) && (trim($results->error_code) != '')){
				return;
			}
		
			// TODO: implement the validation here
			$this->context->buildViolation($constraint->message)
				->setParameter('{{ value }}', $value)
				->addViolation();
		}
	}
}
