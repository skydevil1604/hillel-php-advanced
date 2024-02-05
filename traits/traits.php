<?php

// Traits init

trait Trait1 {
    public function test(): int
    {
        return 1;
    }
}

trait Trait2 {
    public function test(): int
    {
        return 2;
    }
}

trait Trait3 {
    public function test(): int
    {
        return 3;
    }
}

// use traits in Class

class TestClass {
    use Trait1, Trait2, Trait3 {
        Trait1::test insteadof Trait2, Trait3; // use method from Trait1 as $this->test()
        Trait2::test as testTrait2; // rename methods to avoid conflicts
        Trait3::test as testTrait3;
    }

    public function getSum(): int
    {
        return $this->test() + $this->testTrait2() + $this->testTrait3();
    }
}

// Example

$testObject = new TestClass();
echo $testObject->getSum();