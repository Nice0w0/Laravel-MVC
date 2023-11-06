<?php

namespace App\Livewire;

use Livewire\Component;

class ProductForm extends Component
{
    public $products;
    protected $listeners = ['refreshProductForm' => 'refreshProducts'];
    public function mount($products)
    {
        $this->products = $products;
    }
    public function refreshProducts($newProducts)
    {
        $this->products = $newProducts;
    }
    public function render()
    {
        return view('livewire.product-form');
    }
}
