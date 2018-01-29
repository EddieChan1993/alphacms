<?php
class Issue433Test extends PHPUnit_Framework_TestCase
{
    public function testOutputWithExpectationBefore()
    {
        $this->expectOutputString('TestService');
        print 'TestService';
    }

    public function testOutputWithExpectationAfter()
    {
        print 'TestService';
        $this->expectOutputString('TestService');
    }

    public function testNotMatchingOutput()
    {
        print 'bar';
        $this->expectOutputString('foo');
    }
}
