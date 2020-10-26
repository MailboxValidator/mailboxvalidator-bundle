<?php

namespace MailboxValidatorBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

// We will use MailboxValidator PHP library to do our validation
use MailboxValidator\EmailValidation;

class MBVDisposableValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
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
			} else if (trim($results->error_code) == '') {
				if ($results->is_disposable == 'False') {
					return;
				}
			} else if (trim($results->error_code) != ''){			
				return;
			}
		
			// TODO: implement the validation here
			$this->context->buildViolation($constraint->message)
				->setParameter('{{ value }}', $value)
				->addViolation();
		}
	}
}
