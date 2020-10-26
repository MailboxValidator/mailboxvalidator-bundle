<?php

namespace MailboxValidatorBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

// We will use MailboxValidator PHP library to do our validation
use MailboxValidator\EmailValidation;

class MBVFreeValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
		/* @var $constraint \App\Validator\MBVFree */

		$apikey = $_ENV['MBV_API_KEY'];

		$mbv = new EmailValidation($apikey);

		if($apikey == ''){

		}
		else{
			$results = $mbv->isFreeEmail($value);
			
			if ($results === false) {
				return; //return "Error connecting to API."
			} else if (trim($results->error_code) == '') {
				if ($results->is_free == 'False') {
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
