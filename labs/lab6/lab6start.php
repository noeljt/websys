<?php 
  abstract class Operation {
    protected $operand_1;
    protected $operand_2;
    public function __construct($o1, $o2) {
      // Make sure we're working with numbers...
      if (!is_numeric($o1) || !is_numeric($o2)) {
        throw new Exception('Non-numeric operand.');
      }
      
      $this->operand_1 = $o1;
      $this->operand_2 = $o2;
    }
    public abstract function operate();
    public abstract function getEquation(); 
  }

  class Addition extends Operation {
    public function operate() {
      return $this->operand_1 + $this->operand_2;
    }
    public function getEquation() {
      return $this->operand_1 . ' + ' . $this->operand_2 . ' = ' . $this->operate();
    }
  }

// Part 1 - Add subclasses for Subtraction, Multiplication and Division here

  class Subtraction extends Operation {
    public function operate() {
      return $this->operand_1 - $this->operand_2;
    }
    public function getEquation() {
      return $this->operand_1 . ' - ' . $this->operand_2 . ' = ' . $this->operate();
    }
  }

  class Multiplication extends Operation {
    public function operate() {
      return $this->operand_1 * $this->operand_2;
    }
    public function getEquation() {
      return $this->operand_1 . ' * ' . $this->operand_2 . ' = ' . $this->operate();
    }
  }

  class Division extends Operation {
    public function __construct($o1, $o2) {
      if ( $o2 === 0 ) {
        throw new Exception('Division by zero.');
      } else {
        parent::__construct($o1, $o2);
      }
    }
    public function operate() {
      return $this->operand_1 / $this->operand_2;
    }
    public function getEquation() {
      return $this->operand_1 . ' / ' . $this->operand_2 . ' = ' . $this->operate();
    }
  }

  class Cube extends Operation {
    public function operate() {
      return $this->operand_1 * $this->operand_1 * $this->operand_1;
    }
    public function getEquation() {
      return $this->operand_1 . '^3 = ' . $this->operate();
    }
  }

  class Factorial extends Operation {
    public function __construct($o1, $o2) {
      if ( $o1 <= 0 ) {
        throw new Exception('Negative factorial.');
      } else {
        parent::__construct($o1, $o2);
      }
    }
    public function operate() {
      $fact = 1;
      for ($x=$this->operand_1; $x>=1; $x--) {
        $fact = $fact * $x;
      }
      return $fact;
    }
    public function getEquation() {
      return $this->operand_1 . '! = ' . $this->operate();
    }
  }

// End Part 1




// Some debugs - un comment them to see what is happening...
// echo '$_POST print_r=>',print_r($_POST);
// echo "<br>",'$_POST vardump=>',var_dump($_POST);
// echo '<br/>$_POST is ', (isset($_POST) ? 'set' : 'NOT set'), "<br/>";
// echo "<br/>---";




// Check to make sure that POST was received 
// upon initial load, the page will be sent back via the initial GET at which time
// the $_POST array will not have values - trying to access it will give undefined message

  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $o1 = $_POST['op1'];
    $o2 = $_POST['op2'];
  }
  $err = Array();


// Part 2 - Instantiate an object for each operation based on the values returned on the form
//          For example, check to make sure that $_POST is set and then check its value and 
//          instantiate its object
// 
// The Add is done below.  Go ahead and finish the remiannig functions.  
// Then tell me if there is a way to do this without the ifs

  try {
    if (isset($_POST['add']) && $_POST['add'] == 'Add') {
      $op = new Addition($o1, $o2);
    }
  
// Put the code for Part 2 here  \/

    if (isset($_POST['sub']) && $_POST['sub'] == 'Subtract') {
      $op = new Subtraction($o1, $o2);
    }
    if (isset($_POST['mult']) && $_POST['mult'] == 'Multiply') {
      $op = new Multiplication($o1, $o2);
    }
    if (isset($_POST['div']) && $_POST['div'] == 'Divide') {
      $op = new Division($o1, $o2);
    }
    if (isset($_POST['cube']) && $_POST['cube'] == 'Cube') {
      // Will take second input only if first is missing
      if ( $o1 === "" ) { $op = new Cube($o2, 0); }
      else { $op = new Cube($o1, 0); }
    }
    if (isset($_POST['fact']) && $_POST['fact'] == 'Factorial') {
      // Will take second input only if first is missing
      if ( $o1 === "" ) { $op = new Factorial($o2, 0); }
      else { $op = new Factorial($o1, 0); }
    }

// End of Part 2   /\

  }
  catch (Exception $e) {
    $err[] = $e->getMessage();
  }
?>

<!doctype html>
<html>
<head>
<title>Lab 7</title>
<link rel="stylesheet" href="lab6.css"/>
</head>
<body>
  <div id="calculator">
  <pre id="result">
  <div id="eq">
  <?php 
    if (isset($op)) {
      try {
        echo $op->getEquation();
      }
      catch (Exception $e) { 
        $err[] = $e->getMessage();
      }
    }
      
    foreach($err as $error) {
        echo $error . "\n";
    } 
  ?>
  </div>
  </pre>
  <form method="post" action="lab6start.php">
    <div class="wrapper" id="inputs">
    <input type="text" name="op1" class="left" id="op1" value="" />
    <input type="text" name="op2" class="right" id="op2" value="" />
    </div>
    <br/>
    <!-- Only one of these will be set with their respective value at a time -->
    <div class="wrapper">
    <input type="submit" name="add"  class="left button" value="Add" />  
    <input type="submit" name="sub"  class="right button" value="Subtract" /> 
    </div>
    <div class="wrapper"> 
    <input type="submit" name="mult" class="left button" value="Multiply" />  
    <input type="submit" name="div"  class="right button" value="Divide" />  
    </div>
    <div class="wrapper">
    <input type="submit" name="cube" class="left button" value="Cube" /> 
    <input type="submit" name="fact" class="right button" value="Factorial" /> 
    </div>
  </form>
  </div>
</body>
</html>

