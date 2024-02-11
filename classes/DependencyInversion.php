<?php

interface DBAdapterInterface
{
    public function getData();
}

class Mysql implements DBAdapterInterface
{
    public function getData(): string
    {
        return 'some data from MySQL database';
    }
}

class Controller
{
    private DBAdapterInterface $adapter;

    public function __construct(DBAdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    public function getData(): string
    {
        return $this->adapter->getData();
    }
}
