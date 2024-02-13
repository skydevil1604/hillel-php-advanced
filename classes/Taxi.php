<?php

abstract class TaxiDeliveryType
{
    abstract public function getVehicle(): TaxiVehicle;
    public function getVehicleInfo(): void
    {
        $vehicle = $this->getVehicle();
        $vehicle->printModel();
        $vehicle->printPrice();
    }
}

class EconomyTaxi extends TaxiDeliveryType
{
    public function getVehicle(): TaxiVehicle
    {
        return new EconomyTaxiVehicle();
    }
}

class StandartTaxi extends TaxiDeliveryType
{
    public function getVehicle(): TaxiVehicle
    {
        return new StandartTaxiVehicle();
    }
}

class LuxuryTaxi extends TaxiDeliveryType
{
    public function getVehicle(): TaxiVehicle
    {
        return new LuxuryTaxiVehicle();
    }
}

interface TaxiVehicle
{
    public function printModel(): void;

    public function printPrice(): void;
}

class EconomyTaxiVehicle implements TaxiVehicle
{
    public function printModel(): void
    {
        echo "Model is Ford" . "\n\n";
    }

    public function printPrice(): void
    {
        echo "Price is 3000$";
    }
}

class StandartTaxiVehicle implements TaxiVehicle
{
    public function printModel(): void
    {
        echo "Model is Audi" . "\n\n";
    }

    public function printPrice(): void
    {
        echo "Price is 6000$";
    }
}

class LuxuryTaxiVehicle implements TaxiVehicle
{
    public function printModel(): void
    {
        echo "Model is Mercedes" . "\n\n";
    }

    public function printPrice(): void
    {
        echo "Price is 10000$";
    }
}

function clientCode(TaxiDeliveryType $delivery): void
{
    // ...
    $delivery->getVehicleInfo();
    // ...
}


echo "Testing EconomyTaxi:\n";
clientCode(new EconomyTaxi());
echo "\n\n";

echo "Testing StandartTaxi:\n";
clientCode(new StandartTaxi());
echo "\n\n";

echo "Testing LuxuryTaxi:\n";
clientCode(new LuxuryTaxi());
echo "\n\n";

//Output: Testing EconomyTaxi: Model is Ford Price is 3000$ Testing StandartTaxi: Model is Audi Price is 6000$ Testing LuxuryTaxi: Model is Mercedes Price is 10000$