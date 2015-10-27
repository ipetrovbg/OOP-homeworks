<?php

class Cafe {

    public $cafe_name;
    public $cafe_adress;
    public $cafe_capascity;
    public $cafe_style;
    public $ID;
    private $barmans = 0;

    private static $cafe_count = 0;

    public function __construct($name, $adress, $capascity, $style) {

        self::$cafe_count++;

        $this->cafe_name = $name;
        $this->cafe_adress = $adress;
        $this->cafe_capascity = $capascity;
        $this->cafe_style = new MusicStyle($style);

        $this->ID += self::$cafe_count;
    }

    public function show_info() {


        echo '<h3>#' . $this->ID . ' Showing Cofe <small>"' . $this->cafe_name . '"</small></h3>';
        echo "<b>Name:</b> $this->cafe_name<br />";
        echo "<b>Address:</b> $this->cafe_adress<br />";
        echo "<b>Capacity:</b> $this->cafe_capascity People<br />";
        echo "<b>Music Style: </b> " . $this->cafe_style->name . "<br />";
        echo "<b>Barman's: </b> " . $this->barmans . "<hr />";
    }

    public function add_barman(){
    	$this->barmans += 1;
    }

}

class CafeStaying {

    public $name;
    public $gender;
    public $music_style;
    public $cafe_obj;

    public function __construct($name, $gender, $music_style, $cafe_obj) {

        $this->name = $name;
        $this->gender = $gender;
        $this->music_style = new MusicStyle($music_style);

        /*Object of Cafe*/
        $this->cafe_obj = $cafe_obj;
    }

    public function show_info() {
        echo "<h3>Register basic person whit music style :)</h3>";
        echo "<b>Name:</b> $this->name <br />";
        echo "<b>Gender:</b> $this->gender <br />";
        if ($this->cafe_obj->cafe_style->name === $this->music_style->name) {
        	echo "Music style of Cafe and Barman is equal";
        	echo "<b>Music Style: </b>" . $this->music_style->name . "<hr />";
        }else{
        	echo "Music style of Cafe and Barman is NOT equal";
        	echo "<b>Music Style: </b>" . $this->music_style->name . "<hr />";
        }
        
    }

}

class Barman extends CafeStaying {

    public $phone_number;
    public $salery;
    public $ID;

    private static $count_barman=0;

    public function __construct($name, $gender, $music_style, $phone, $salery, $cafe_obj) {
    	self::$count_barman++;
        parent::__construct($name, $gender, $music_style, $cafe_obj);

        $this->phone_number = $phone;
        $this->salery = $salery;
        $this->ID += self::$count_barman;
        $cafe_obj->add_barman();
    }

    public function show_info() {
        echo '<h3>#'. $this->ID .' Showing Barman "'.$this->name.'"</h3>';
        echo "<b>Name:</b> $this->name<br />";
        echo "<b>Gender:</b> $this->gender<br />";
        if ($this->cafe_obj->cafe_style->name === $this->music_style->name) {
        	echo "<br />Music style of Cafe <b>".$this->cafe_obj->cafe_style->name."</b> and Barman's Music Style <b>".$this->music_style->name."</b> is equal<br />";
        	echo "<b>Music Style: </b>" . $this->music_style->name . "<br />";
        	//echo $this->cafe_obj->name;
        }else{
        	echo "<br />Music style of Cafe <b>".$this->cafe_obj->cafe_style->name."</b> and Barman's Music Style <b>".$this->music_style->name."</b> is NOT equal<br />";
        	echo "<b>Music Style: </b>" . $this->music_style->name . "<br />";
        	//echo $this->music_style->name;
        }
        //echo $this->music_style->name;
        echo "<b>Phone Number:</b> $this->phone_number<br />";
        echo "<b>Salery:</b> $this->salery<hr />";
    }

}

class Client extends CafeStaying {

    public $bill;

    public function __construct($name, $gender, $music_style, $bill) {

        parent::__construct($name, $gender, $music_style);

        $this->bill = $bill;
    }

}

class MusicStyle {

    public $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public function show_info() {
        echo "<h4>$this->name</h4>";
    }

}


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Cafe</title>
        <style type="text/css">
            html, body{
                margin: 0px;
                background-color: #F0F0F0;
            }
            body{
                margin: 20px;
                padding: 20px;
                border: 1px solid #D8D8D8;
                background-color: #fff;
                color: #585858;
                font-size: 14px;
            }
            .content{
                border-bottom: 1px solid #888;
            }
        </style>
    </head>
    <body>
        <?php

        function add_cafe_action($obj, $func) {
             
            if (is_object($obj)) {
                
                return $obj->$func();
                
            
            }else{
                
                echo "This is NOT Object";
            }
        }


        $cafe[0] = new Cafe("Ralph’s Coffee", "2nd Floor, 711 5th Ave, New York, NY 10022", 50, "Jazz");
        
        $cafe[1] = new Cafe("Gucci", "Tokyo, Chuo, Ginza, 4−４−10", 30, "Pop music");
        $cafe[2] = new Cafe("Thracian Princess", "Bulgaria, Vratsa, Vratsa, 50 Hr. Botev Bul", 100, "Classical music");
        
        $cafe[0]->show_info();
        
        $barman[0] = new Barman("Peter", "Man", "Pop music","+359 85 845646", "700", $cafe[0]);
        $barman[1] = new Barman("Peter", "Man", "Pop music","+359 85 845646", "700", $cafe[0]);
        $barman[2] = new Barman("Peter", "Man", "Pop music","+359 85 845646", "700", $cafe[0]);
        $barman[0]->show_info();
        $barman[1]->show_info();
         $cafe[0]->show_info();
        
        ?>
    </body>
</html>
