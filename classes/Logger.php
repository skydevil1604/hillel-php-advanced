<?php

// Interface for formatting string
interface FormatterInterface
{
    public function format(string $string): string;
}

// Class for formatting raw string
class RawFormatter implements FormatterInterface
{
    public function format(string $string): string
    {
        return $string;
    }
}

// Class for formatting date string
class DateFormatter implements FormatterInterface
{
    public function format(string $string): string
    {
        return date('Y-m-d H:i:s') . ' ' . $string;
    }
}

// Class for formatting date with details string
class DateWithDetailsFormatter implements FormatterInterface
{
    public function format(string $string): string
    {
        return date('Y-m-d H:i:s') . ' ' . $string . ' - With some details';
    }
}

// Interface for message delivery
interface DeliveryInterface
{
    public function deliver(string $format): void;
}

// Class for sending message via email
class EmailDelivery implements DeliveryInterface
{
    public function deliver(string $format): void
    {
        echo "Вывод формата ({$format}) по имейл";
    }
}

// Class for sending message via sms
class SmsDelivery implements DeliveryInterface
{
    public function deliver(string $format): void
    {
        echo "Вывод формата ({$format}) в смс";
    }
}

// Class for sending message vie console
class ConsoleDelivery implements DeliveryInterface
{
    public function deliver(string $format): void
    {
        echo "Вывод формата ({$format}) в консоль";
    }
}

// Class that uses instances of formatter and delivery classes as arguments
class Logger
{
    private FormatterInterface $formatter;
    private DeliveryInterface $delivery;

    public function __construct(FormatterInterface $formatter, DeliveryInterface $delivery)
    {
        $this->formatter = $formatter;
        $this->delivery = $delivery;
    }

    public function log(string $string): void
    {
        $formattedMessage = $this->formatter->format($string);
        $this->delivery->deliver($formattedMessage);
    }
}

$formatter = new RawFormatter(); // Create instance of formatter class (any of RawFormatter, DateFormatter, DateWithDetailsFormatter)
$delivery = new SmsDelivery(); // Create instance of delivery class (any of EmailDelivery, SmsDelivery, ConsoleDelivery)
$logger = new Logger($formatter, $delivery); // Create instance of Logger class
$logger->log('Emergency error! Please fix me!'); // Use Logger method