<?php

namespace Test;

class Test
{
    public string $value;

    public function anotherTest($a, $b)
    {
        return 123;
    }
}

$teste = new Test();

$teste->value = 'Teste 123';