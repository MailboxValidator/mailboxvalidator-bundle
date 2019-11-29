<?php
 
namespace MailboxValidatorBundle\Tests;

use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Context\ExecutionContext;
use Symfony\Component\Validator\Violation\ConstraintViolationBuilder;
use MailboxValidatorBundle\Validator\MBVSingleValidator;
use MailboxValidatorBundle\Validator\MBVSingle;
 
class MBVSingleValidatorTest extends TestCase
{
    /**
     * Configure a MBVSingleValidator.
     * @param string $message The message on a validation violation.
     * @return MailboxValidatorBundle\Validator\MBVSingleValidator
     */
    public function configureValidator($message = null)
    {
        //mock the violation builder
        $builder = $this->getMockBuilder(ConstraintViolationBuilder::class)
        ->disableOriginalConstructor()
        ->setMethods(array('addViolation'))
        ->getMock();

        //mock the violation context
        $context = $this->getMockBuilder(ExecutionContext::class)
        ->disableOriginalConstructor()
        ->setMethods(array('buildViolation'))
        ->getMock();

        if($message){
            $builder->expects($this->once())
            ->method('addViolation');

            $context->expects($this->once())
            ->method('buildViolation')
            ->with($this->equalTo($message))
            ->will($this->returnValue($builder));
        }
        else {
            $context->expects($this->never())
            ->method('buildViolation');
        }

        //initialize the validator with the mocked context
        $validator = new MBVSingleValidator();
        $validator->initialize($context);

        //return the MBVSingleValidator
        return $validator;
    }

    /**
     * Verify no constraint message is triggered when value is valid.
     */
    public function testValid()
    {
        $constraint = new MBVSingle();
        $validator = $this->configureValidator();

        $validator->validate('aaa@gmail.com', $constraint);
    }

    /**
     * Verify a constraint message is triggered when value is invalid.
     */
    public function testInvalid()
    {
        $constraint = new MBVSingle();
        $validator = $this->configureValidator($constraint->message);

        $validator->validate('test@example.com', $constraint);
    }
}