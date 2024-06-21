<?php

// Concreate Elements implementation
interface Car
{
    public function getPrice(): int;
    public function getMaxLoadWeigth(): int;
    public function calculateOutcome(): int;
}

class BMWCar implements Car
{
    public function getPrice(): int
    {
        return 0;
    }
    public function getMaxLoadWeigth(): int
    {
        return 0;
    }
    public function calculateOutcome(): int
    {
        return 0;
    }
}

class MercCar implements Car
{
    public function getPrice(): int
    {
        return 1;
    }
    public function getMaxLoadWeigth(): int
    {
        return 1;
    }
    public function calculateOutcome(): int
    {
        return 1;
    }
}


interface Boat
{
    public function getPrice(): int;
    public function getMaxLoadWeigth(): int;
    public function calculateOutcome(): int;
    public function getSizeOfBoat(): array;
}

class BMWBoat implements Boat
{
    public function getPrice(): int
    {
        return 0;
    }
    public function getMaxLoadWeigth(): int
    {
        return 0;
    }
    public function calculateOutcome(): int
    {
        return 0;
    }
    public function getSizeOfBoat(): array
    {
        return  [];
    }
}

class MercBoat implements Boat
{
    public function getPrice(): int
    {
        return 1;
    }
    public function getMaxLoadWeigth(): int
    {
        return 1;
    }
    public function calculateOutcome(): int
    {
        return 1;
    }
    public function getSizeOfBoat(): array
    {
        return  [];
    }
}


/// abstraction implementation

interface TransportFactory
{
    public function createCar(): Car;
    public function createBoat(): Boat;
}

class BMWFactory implements TransportFactory
{

    public function createCar(): Car
    {
        return new BMWCar;
    }

    public function createBoat(): Boat
    {
        return new BMWBoat;
    }
}

class MercFactory implements TransportFactory
{

    public function createCar(): Car
    {
        return new MercCar;
    }

    public function createBoat(): Boat
    {
        return new MercBoat;
    }
}

/// Client implementation

class ClientService
{

    protected Car $car;
    protected Boat $boat;

    public function __construct(TransportFactory $factory)
    {
        $this->car = $factory->createCar();
        $this->boat = $factory->createBoat();
    }

    public function calculateAllOutcome(): int
    {
        return $this->car->calculateOutcome() + $this->boat->calculateOutcome();
    }
}

class ClientConstructor
{
    protected ClientService $service;

    // And also you can inject ClientService there
    public function __construct()
    {
        $this->service = new ClientService(new MercFactory);
    }

    public function printAllOutcome(): void
    {
        print($this->service->calculateAllOutcome());
    }
}
