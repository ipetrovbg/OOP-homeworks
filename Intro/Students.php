<?php 

class Students {

	private $motivation; // Коеф. 0-1
	private $name; // Име
	private $class; // Клас
	private $gpa; // Среден успех	

	public function __construct($m = 0.5, $n = "Petar", $c = "1a", $g = 0){

		$this->name = $n;
		$this->class = $c;
		if ($m > 1) {
			$m = 1;
		}
		$this->gpa = $g;
		$this->motivation = $m;
		$this->show_info();

	}

	public function show_info(){
		echo "<hr/>";

		if($this->gpa > 5){

			if ($this->motivation < 1) {

				$this->motivation += 0.1;
			}
			
		}
		if($this->gpa >= 6){
			$this->gpa = 6;
		}
		echo "<b>Name:</b> <i>$this->name</i><br />";
		echo "<b>Class:</b> <i>$this->class</i><br />";
		echo "<b>GPA:</b> <i>$this->gpa</i><br />";
		echo "<b>Motivation for learning:</b> <i>$this->motivation</i><br />";
		echo "<hr/>";
	}

	public function go_to_school(){

		echo "<b>$this->name</b> is going to School<br />";

	}

	private function study($hours){

		
		if ($this->motivation > 0) {
			echo "<b>$this->name</b> study $hours hours<br />";
		}else{
			echo "<b>$this->name</b> does not have Motivation to study<br />";
		}

	}

	private function do_homework(){

		echo "<b>$this->name</b> is doing homework<br />";

	}

	public function do_test($subject, $grade){ // предмет, оценка

		$grade = ($grade*$this->motivation) + $grade;

		if ($grade >= 6) {

			$grade = 6;
			
		}

		echo "<b>$this->name</b> is having <b>$grade</b> of <b>$subject</b> test<br />";

		$this->gpa += $grade;

	}




	public function get_study($var){
		return $this->study($var);
	}
	public function get_do_homework(){
		return $this->do_homework();
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

$student1 = new Students(0.5);

$student1->go_to_school();
$student1->get_study(8);

$tests = array(
	"Math_test" => $student1->do_test("Maths", 4),
	"BEL_test" => $student1->do_test("BEL", 5),
	"Chemistry_test" => $student1->do_test("Chemistry", 6),
	"New_test" => $student1->do_test("New", 2),
	"New_test" => $student1->do_test("New", 7)
	);


$student1->gpa = $student1->gpa/count($tests);
$student1->get_do_homework();


$student1->show_info();
$student2 = new Students(1, "Vladi", "12b");

$tests2 = array(
	"Math_test" => $student2->do_test("Maths", 6),
	"BEL_test" => $student2->do_test("BEL", 6),
	"Chemistry_test" => $student2->do_test("Chemistry", 6),
	"New_test" => $student2->do_test("New", 3),
	"New_test" => $student2->do_test("New", 3)
	);
$student2->gpa = $student2->gpa/count($tests2);
$student2->show_info();

