===================================================
Joseph Noel - Lab 6
===================================================

------------Subtraction--------------
Inherits: 
- Operation constructor 
- Operation protected variables
Functions:
- Operate returns the sum of operand_1 and operand_2.
- getEquation returns a formatted equation string with the + sign
Throws:
- If operand_1 or operand_2 are not numbers

------------Multiplication------------
Inherits: 
- Operation constructor 
- Operation protected variables
Functions:
- Operate returns the product of operand_1 and operand_2.
- getEquation returns a formatted equation string with the * sign
Throws:
- If operand_1 or operand_2 are not numbers

------------Division------------------
Inherits:
- Operation constructor
- Operation protected variables
Functions:
- Contructor calls Operation consutrctor unless zero is the denominator
- Operate returns the quotient of operand_1 and operand_2
- getEquation returns a formatted equation string with the / sign
Throws:
- If operand_1 or operand_2 are not numbers
- If operand_2 is zero

------------Cube----------------------
Inherits:
- Operation constructor
- Operation protected variables
Functions:
- Operate returns the cube of operand_1
- getEquation returns a formatted equation string with a ^3 sign
Throws:
- If operand_1 or operand_2 are not numbers

------------Factorial-----------------
Inherits:
- Operation constructor
- Operation protected variables
Functions:
- Contructor calls Operation consutrctor unless operand_1 is negative
- Operate returns the factorial of operand_1
- getEquation returns a formatted equation string with the ! sign
Throws:
- If operand_1 or operand_2 are not numbers
- If operand_2 is negative

===================================================

Methods are invoked in the following order:
1) constructor is called
2) getEquation is called 
3) getEquation calls operate

===================================================

Flow of execution is as follows:

(line 187-202) 	Button clicked ->
(line 185)		Form posts ->
(line 110-113)	Assign $o1 and $o2 if possible ->
(line 114)		Initialize errror array ->
(line 125-149)	Check which operation was requested ->
(line 125-149)	Assign the correct Class to $op,
					If Cube or Factorial was posted,
					check for $o1 then $o2 if there is no $o1, 
					call the correct class with either $o1 or $o2 as the first argument and 0 as the second argument. ->
(line 169-177)	Check for $op and call getEquation ->
(line 179-181)	If there were any errors print them with newlines

===================================================

To use GET, you would first have to change the form method from "post" to "get".
Next, the if statement on line 110 would need to check for 'GET' instead of 'POST'.
Finally, replace all $_POST with $_GET.

GET would actually be better in this scenario because the information being handled isn't sensitive, and GET is more reusable since it can be cahced, shared, bookmarked, etc.

===================================================

A possible way to determine which button has been pressed and to take appropoiate action in this case would be to use javascript and jQuery.
Instead of a form one could use click events and have them call javascript functions to calculate and return equations.
Running simple calculations with non-sensitive data would be quicker without server-side scripting such as PHP.

===================================================
