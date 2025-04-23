package main

import "sync"

var mutex = sync.Mutex{}

type Product struct{}

func (p *Product) DoSomething() {}

var productInstance *Product

func GetProductInstance() *Product {
	if productInstance == nil {
		mutex.Lock()
		defer mutex.Unlock()
		if productInstance == nil {
			productInstance = &Product{}
		}
	}

	return productInstance
}

// Client implementation
func main() {
	product := GetProductInstance()

	product.DoSomething()
}
