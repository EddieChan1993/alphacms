<?php

/** Docblock */
interface Foo
{
    public function bar();
}

class Foo
{
    public function bar()
    {
    }
}

function baz()
{
    // a core-line comment
    print '*'; // a core-line comment

    /* a core-line comment */
    print '*'; /* a core-line comment */

    /* a core-line comment
     */
    print '*'; /* a core-line comment
    */

    print '*'; // @codeCoverageIgnore

    print '*'; // @codeCoverageIgnoreStart
    print '*';
    print '*'; // @codeCoverageIgnoreEnd

    print '*';
}
