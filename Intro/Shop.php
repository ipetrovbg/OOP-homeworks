<?php

class Products{

	private $name;
	private $price;
	private $quantity;

	public function __construct($n, $p, $q){
		echo "<h4>Register of product [$n]</h4>";
		$this->name = $n;
		$this->price = $p;
		$this->quantity = $q;
		$this->show_info();

	}

	public function show_info(){
		
		echo "Name: <b>$this->name</b> <br />";
		echo "Price: <b>$this->price</b> lv.<br />";
		echo "Quantity: <b>$this->quantity</b> <br />";
		echo "<br />";
	}

	

	public function edit_whole_product($n, $p, $q){
		echo "Editing <b>$this->name</b> to <b>$n</b><br />";
		echo "Editing <b>$this->price</b> to <b>$p</b><br />";
		echo "Editing <b>$this->quantity</b> to <b>$q</b><br />";
		$this->name = $n;
		$this->price = $p;
		$this->quantity = $q;

	}
	public function edit_product_one_param($property_name, $value, $class){
		echo "Editing <b>$property_name</b> parameter of $class->name product <b><br />";
		echo $class->$property_name;
		echo "</b> to <b>$value</b><br /><br />";
		
		$class->$property_name = $value;
	}

	public function __get($name){
		return $this->$name;
	}

	public function __set($name, $value){
		if (property_exists($this, $name)) {
			$this->$name = $value;
		}
	}

}

class Sales{

	public function __construct(){
		echo "Constructor of Sales";
	}

	public function sale_product($name, $quantity, $curent_quantity, $price, $c){
		
		echo "<h4>Selling $name (<i>$quantity <small>items</small></i>)</h4>";

		if($curent_quantity >= $quantity) {

			$curent_quantity -= $quantity;

			
			
			echo "- It was sold <b>$quantity</b> of <b>$name</b><br/>";

			$c->edit_whole_product($name, $price, $curent_quantity);

			if ($curent_quantity == 0) {
				echo "<b>$name</b> is sold out";
			}else{ 
				echo "Remain <b>$curent_quantity</b> of <b>$name</b>";
			}
		}else{
			echo "Sorry, but no such quantity of <b>$name</b>. There is only <b>$curent_quantity</b> of <b>$name</b>";
		}
		echo "<br />";
		echo "<br />";
	}


	

}

$total = 0; // default total products quantity
$total_available = 0; // default total available products quantity
$total_money = 0; // default total available products quantity
$total_available_money = 0; // default total available products quantity
$average = 0; // default average price of product
// before all code outside the classes
$products = array();
// register of product
	echo "<h2>Registration</h2>";
	$products[1] = new Products("Bread", "1.99", 8);
	$products[2] = new Products("Meat", "5", 8);
	$products[3] = new Products("Potatos", "0.69", 20);
	$sales = new Sales();
// register of product


// editing product
	echo "<h2>Edit Product</h2>";
	$products[1]->edit_whole_product("Multy Bread", 3.99, 4);
	echo "<br />";
	$products[2]->edit_whole_product("Meat", 10.99, 8);
	echo "<br />";
	$products[2]->edit_product_one_param("name", "Meat2", $products[2]);
	$products[2]->edit_product_one_param("quantity", 50, $products[2]);
	$products[1]->edit_product_one_param("quantity", 50, $products[1]);
	$products[1]->edit_product_one_param("name", "Bread", $products[1]);
	echo "<br />";
	
// editing product

// counting the total registered products and total money
	for ($i=1; $i <= count($products); $i++) { 

		$total += $products[$i]->quantity;

		for ($j=1; $j <= $products[$i]->quantity; $j++) { 

			$total_money += $products[$i]->price;

		}

	}
// counting the total registered products and total money


// seiling the products
	echo "<h2>Selling</h2>";


	$sales->sale_product($products[3]->name, 10, $products[3]->quantity, $products[3]->price, $products[3]);

	$sales->sale_product($products[2]->name, 1, $products[2]->quantity, $products[2]->price, $products[2]);
	$sales->sale_product($products[1]->name, 2, $products[1]->quantity, $products[1]->price, $products[1]);

	//$products[1]->sale_product(1);
	//$products[1]->sale_product(3);

// seiling the products

// counting the remaining products after seiling
	
	for ($i=1; $i <= count($products); $i++) {

		$total_available += $products[$i]->quantity;

		for ($j=1; $j <= $products[$i]->quantity; $j++) { 

			$total_available_money += $products[$i]->price;

		}

	}
	
// counting the remaining products after seiling


// printing total values
	echo "<hr/><h2>Total Available Quantity Products: $total_available</h2>"; // remaining products after seiling
	echo "<h2>Total Registered Quantity Products: $total</h2>"; 	// total registered products
	echo "<h2>Total Available Money: $total_available_money</h2>"; 	// total registered products
	echo "<h2>Total Money: $total_money</h2>"; 	// total registered products
	$average = round($total_available_money/$total_available, 2);
	echo "<h2>Average Price of One Product: $average lv.</h2>"; 	// total registered products
// printing total values
