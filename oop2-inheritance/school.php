<?php

class People {

	public $name;

	public static $count_name = 2;

	public function __construct($name){

		if (self::valid_name($name) === true) {

			$this->name = $name;

		}else{

			echo "$name is too short to create valid Person!  We append after your Name some digins";
			echo "<br />";
			$this->name  = $name.date('d');

		}




	}

	public function show_info(){
		echo "<h5>$this->name</h5>";
	}

	public static function valid_name($name){

		if (strlen($name) >= self::$count_name) {

			return TRUE;

		}else{

			return FALSE;

		}
	}

}

class Student extends People {

	public $id;
	public $phone;
	public $number;
	public $subject;

	public function __construct($id, $name, $phone, $number, $subject){

		parent::__construct($name);

		if (self::valid_name($name) === true) {

			$this->name 			= $name;

		}else{

			echo "$name is too short to create valid Student! We append after your Name some digins";
			echo "<br />";
			$this->name 			= $name.date('d');

		}

		$this->id 				= $id;

		$this->phone			= $phone;
		$this->subject			= $subject;
		$this->number 			= $number;



	}

	public function show_info(){

		echo '<div class="content">';
		echo "<h5><b>Student Name:</b> $this->name</h5>";
		echo "<h5><b>Student ID:</b> $this->id</h5>";
		echo "<h5><b>Phone:</b> $this->phone</h5>";
		$this->number->show_info();

		/*
		if (is_array( $this->subject) ) {
			foreach ($this->subject as $key => $value) {
				echo $value->show_info() . ' ';
			}
		}else{
			$this->subject->show_info();
		}
		*/

		$this->get_count_subject();

		echo '</div>';

	}

	public function get_count_subject(){

		if (is_array( $this->subject) ) {

			echo "<h5>";

			echo $this->name . " has " . count($this->subject) . " subjects. ";
			foreach ($this->subject as $key => $value) {
				echo $value->name . ", ";
			}
			echo "</h5>";
		}else{

			echo "<h5>";

			echo $this->name . " has 1 subject. " . $this->subject->name . " ";

			echo "</h5>";
		}

	}

}

class Teacher extends People {

	public $subjects;

	public $phone;
	public $specialty;

	public function __construct($name, $phone, $specialty, $subjects){

		parent::__construct($name);

		if (self::valid_name($name) === true) {

			$this->name 			= $name;

		}else{

			echo "$name is too short to create valid Teacher! We append after your Name some digins";
			echo "<br />";
			$this->name 			= $name.date('d');

		}

		$this->phone		= $phone;
		$this->specialty 	= $specialty;
		$this->subjects 	= $subjects;

	}

	public function show_info(){

		echo '<div class="content">';

		echo "<h5><b>Teacher Name:</b> $this->name</h5>";
		echo "<h5><b>Phone:</b> $this->phone</h5>";
		echo "<h5><b>Specialty:</b> $this->specialty</h5>";
		$this->get_count_subject();

		echo "</h5>";

		echo '</div>';

	}

	public function get_count_subject(){

		if (is_array( $this->subjects) ) {

			echo "<h5>";

			echo $this->name . " has " . count($this->subjects) . " subjects. ";
			foreach ($this->subjects as $key => $value) {
				echo $value->name . ", ";
			}
			echo "</h5>";
		}else{

			echo "<h5>";

			echo $this->name . " has 1 subject. " . $this->subjects->name . " ";

			echo "</h5>";
		}

	}

}

class Grade {

	public $name;
	public $teacher;

	public function __construct($name, $teacher){

		$this->name 	= $name;
		$this->teacher 	= $teacher;

	}

	public function show_info(){

		echo "<h5><b>Class:</b> $this->name</h5>";
		//$this->get_count_teachers();
	}

	public function get_count_teachers(){

			echo '<div class="content">';

		if (is_array( $this->teacher) ) {

			echo "<h5>";

			echo "<b>Grade:</b> " . $this->name . " has " . count($this->teacher) . " Teachers. ";
			foreach ($this->teacher as $key => $value) {
				echo $value->name . ", ";
			}
			echo "</h5>";
		}else{

			echo "<h5>";

			echo "<b>Grade:</b>" . $this->name . " has 1 Teacher. " . $this->teacher->name . " ";

			echo "</h5>";

		}
		echo '</div>';

	}

}

class Subject {

	public $name;
	public $count_hour;
	public $count_rating;

	public function __construct($name, $count_hour, $count_rating){

		$this->name 		= $name;
		$this->count_hour	= $count_hour;
		$this->count_rating	= $count_rating;

	}

	public function show_info(){

		

		echo "<h5>Subject: $this->name</h5>";
		echo "<h5>Count Hours: $this->count_hour";
		echo "<h5>Count Rating: $this->count_rating";

	}

}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>School Software</title>
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
	}
	.content{
		border-bottom: 1px solid #888;
	}
	</style>
</head>
<body>
<?php
//
//		CREATING SUBJECT
//	$subject[next number] = new Subject("string subject name", (int) sum of hours for 1 semestar, assessment for 1 semestar)
//
$subject[1] = new Subject("Math", 180, 6);
$subject[2] = new Subject("PHP", 180, 6);


$teacher[1] = new Teacher("Emo", "+359 4587 745", "PHP Developer and Teacher", array($subject[1]));
$teacher[2] = new Teacher("Milena", "+359 50 745", "PHP Teacher", array($subject[2]));
$teacher[1]->show_info();


$grade[2] = new Grade("5a", array($teacher[1], $teacher[2]));
$grade[1] = new Grade("1a", array($teacher[1]));
$grade[3] = new Grade("10a", array($teacher[1]));
$grade[4] = new Grade("12a", array($teacher[1]));

foreach ($grade as $key => $value) {
	echo $value->get_count_teachers();
}

$student[1] = new Student(1, "Petar", "+359 8908562", $grade[1], array($subject[1]));
$student[2] = new Student(2, "Milena", "+359 sdf64562", $grade[1], $subject[1]);
$student[1]->show_info();
$student[2]->show_info();


?>
</body>
</html>
