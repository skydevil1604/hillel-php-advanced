<?php

interface CanFly
{
    public function fly();
}

interface CanEat
{
    public function eat();
}

class Swallow implements CanFly, CanEat
{
    public function eat() { /* ... */ }
    public function fly() { /* ... */ }
}

class Ostrich implements CanEat
{
    public function eat() { /* ... */ }
}

