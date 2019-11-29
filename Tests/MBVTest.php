<?php

namespace MailboxValidatorBundle\Tests;

use PHPUnit\Framework\TestCase;
use MailboxValidator\SingleValidation;

class MBVTest extends TestCase
{
    /**
     * Check if the function get the correct result or not
     */
    public function testMBVSingle()
    {
		$mbv = new SingleValidation('PASTE_YOUR_API_KEY');

        $results = $mbv->ValidateEmail('test@example.com');
        $this->assertSame($results->status, 'False');
    }

    public function testMBVDisposable()
    {
        $mbv = new SingleValidation('PASTE_YOUR_API_KEY');

        $results = $mbv->DisposableEmail('test@example.com');
        $this->assertSame($results->is_disposable, 'True');
    }

    public function testMBVFree()
    {
        $mbv = new SingleValidation('PASTE_YOUR_API_KEY');
        
        $results = $mbv->FreeEmail('test@gmail.com');
        $this->assertSame($results->is_free, 'True');
    }
}