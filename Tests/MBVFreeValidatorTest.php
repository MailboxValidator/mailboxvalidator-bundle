<?php
 
namespace MailboxValidatorBundle\Tests;

use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Context\ExecutionContext;
use Symfony\Component\Validator\Violation\ConstraintViolationBuilder;
use MailboxValidatorBundle\Validator\MBVFreeValidator;
use MailboxValidatorBundle\Validator\MBVFree;
 
class MBVFreeValidatorTest extends TestCase
{
    /**
     * Configure a MBVFreeValidator.
     * @param string $message The message on a validation violation.
     * @return MailboxValidatorBundle\Validator\MBVFreeValidator
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
        $validator = new MBVFreeValidator();
        $validator->initialize($context);

        //return the MBVFreeValidator
        return $validator;
    }

    /**
     * Verify no constraint message is triggered when value is not free.
     */
    public function testNotFree()
    {
        $constraint = new MBVFree();
        $validator = $this->configureValidator();

        $validator->validate('test@example.com', $constraint);
    }

    /**
     * Verify a constraint message is triggered when value is free.
     */
    public function testFree()
    {
        $constraint = new MBVFree();
        $validator = $this->configureValidator($constraint->message);

        $validator->validate('test@gmail.com', $constraint);
    }
}