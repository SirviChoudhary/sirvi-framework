<?php 
namespace App\Http\Controllers\Admin;
use App\Models\Product;

class ProductController{

    public function add(){
     $product = new Product();
     $product->create([]);
    }

    public function show(){

    }

    public function delete(){

    }

    public function update(){

    }

}
?>

