<?php

namespace MailboxValidatorBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

// We will use MailboxValidator PHP library to do our validation
use MailboxValidator\EmailValidation;

class MBVSingleValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
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
			} else if (trim($results->error_code) == '') {
				if ($results->status == 'True') {
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
