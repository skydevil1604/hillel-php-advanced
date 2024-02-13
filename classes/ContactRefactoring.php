<?php

class Contact
{
    private string $name;
    private string $surname;
    private string $email;
    private string $phone;
    private string $address;

    public function phone($phone): Contact
    {
        $this->phone = $phone;
        return $this;
    }

    public function name($name): Contact
    {
        $this->name = $name;
        return $this;
    }

    public function surname($surname): Contact
    {
        $this->surname = $surname;
        return $this;
    }

    public function email($email): Contact
    {
        $this->email = $email;
        return $this;
    }

    public function address($address): Contact
    {
        $this->address = $address;
        return $this;
    }

    public function build(): Contact
    {
        return $this;
    }
}

$contact = new Contact();
$newContact = $contact->phone('000-555-000')
    ->name("John")
    ->surname("Surname")
    ->email("john@email.com")
    ->address("Some address")
    ->build();

var_dump($newContact);

//Output: object(Contact)#1 (5) {
// ["name":"Contact":private]=> string(4) "John"
// ["surname":"Contact":private]=> string(7) "Surname"
// ["email":"Contact":private]=> string(14) "john@email.com"
// ["phone":"Contact":private]=> string(11) "000-555-000"
// ["address":"Contact":private]=> string(12) "Some address" }