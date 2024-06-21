package main

import "fmt"

// Concreate Elements implementation
type Car interface {
	getPrice() int
	getMaxLoadWeigth() int
	calculateOutcome() int
}

type BMWCar struct {
}

func (c *BMWCar) getPrice() int {
	return 0
}
func (c *BMWCar) getMaxLoadWeigth() int {
	return 0
}
func (c *BMWCar) calculateOutcome() int {
	return 0
}

type MercCar struct {
}

func (c *MercCar) getPrice() int {
	return 0
}
func (c *MercCar) getMaxLoadWeigth() int {
	return 0
}
func (c *MercCar) calculateOutcome() int {
	return 0
}

type Boat interface {
	getPrice() int
	getMaxLoadWeigth() int
	calculateOutcome() int
	getSizeOfBoat() []float64
}

type BMWBoat struct {
}

func (c *BMWBoat) getPrice() int {
	return 0
}
func (c *BMWBoat) getMaxLoadWeigth() int {
	return 0
}
func (c *BMWBoat) calculateOutcome() int {
	return 0
}
func (c *BMWBoat) getSizeOfBoat() []float64 {
	return []float64{}
}

type MercBoat struct {
}

func (c *MercBoat) getPrice() int {
	return 0
}
func (c *MercBoat) getMaxLoadWeigth() int {
	return 0
}
func (c *MercBoat) calculateOutcome() int {
	return 0
}
func (c *MercBoat) getSizeOfBoat() []float64 {
	return []float64{}
}

// / abstraction implementation
type TransportFactory interface {
	createCar() Car
	createBoat() Boat
}

type MercFactory struct {
}

func (f *MercFactory) createCar() Car {
	return &MercCar{}
}
func (f *MercFactory) createBoat() Boat {
	return &MercBoat{}
}

type BMWFactory struct {
}

func (f *BMWFactory) createCar() Car {
	return &BMWCar{}
}
func (f *BMWFactory) createBoat() Boat {
	return &BMWBoat{}
}

// / client implementation
type Transports struct {
	car  Car
	boat Boat
}

func CreateTransport(f TransportFactory) *Transports {
	return &Transports{
		car:  f.createCar(),
		boat: f.createBoat(),
	}
}

func main() {
	t := CreateTransport(&BMWFactory{})

	totalOutcome := t.car.calculateOutcome() + t.boat.calculateOutcome()

	fmt.Println(totalOutcome)
}
