<?php

namespace MailboxValidatorBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

// We will use MailboxValidator PHP library to do our validation
use MailboxValidator\EmailValidation;

class MBVSingleValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint): void
    {
		/* @var $constraint \App\Validator\MBVSingle */
		
		$apikey = $_ENV['MBV_API_KEY'];

		$mbv = new EmailValidation($apikey);

		if($apikey == ''){

		}
		else {
			$results = $mbv->validateEmail($value);
		
			if ($results === false) {
				return; //return "Error connecting to API."
			} else if (! isset($results->error_code)) {
				if ($results->status) {
					return;
				}
			} else if ((isset($results->error_code)) && (trim($results->error_code) != ''))
				return;
			}

        	// TODO: implement the validation here
        	$this->context->buildViolation($constraint->message)
            	->setParameter('{{ value }}', $value)
            	->addViolation();
		}
    }
}
