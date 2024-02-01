<?php

class User
{
    private string $name;
    private int $age;
    private string $email;

    /**
     * @param $method
     * @param $arguments
     * @return mixed
     * @throws CustomException
     */
    public function __call($method, $arguments)
    {
        if (method_exists($this, $method)) {
            return $this->$method(...$arguments);
        } else {
            throw new CustomException("Method $method does not exist in class");
        }
    }

    public function setName($name): User
    {
        $this->name = $name;
        return $this;
    }

    public function setAge($age): User
    {
        $this->age = $age;
        return $this;
    }

    public function setEmail($email): User
    {
        $this->email = $email;
        return $this;
    }

    public function getAll(): array
    {
        return [
            'name' => $this->name,
            'age' => $this->age,
            'email' => $this->email,
        ];
    }
}

class CustomException extends Exception {}

// Examples

try {
    $user = new User();

    $user->setName('John')->setAge(25)->setEmail('test@gmail.com');

    $userInfo = $user->getAll();
    print_r($userInfo);

    $user->setUsername('john_doe'); // call not exists method
} catch (CustomException $e) {
    echo "Caught exception: " . $e->getMessage();
}

// Result

// Array ( [name] => John [age] => 25 [email] => test@gmail.com ) Caught exception: Method setUsername does not exist in class
