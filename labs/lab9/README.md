========================================================
Joseph Noel
========================================================
DB Structure File: noelj-websyslab9.txt
========================================================
Part 1:

Straightforward enough, used the in-class exercise for reference.
========================================================
Part 2:

For courses, everything has the same course and year (CS and IT have different years).
For crn and number, they increment by 1 every iteration (therefore number > 9999 is the limiting factor).
For title, a number is added to the end after the first button press. Ie. Intro to IT -> Intro to IT 2 -> Intro to IT 3.
The base course names are hard coded into two arrays (one for CS and one for IT classes), but this could easily be made to use external data with a few modifications.

For students, the last name, alias, state, and city remain the same.
For the rin, phone, zip, and street # it increments by 1 starting from zero.
For the rcisID, it adds a digit after the first iteration, resulting in a limiting factor when the rcisID exceeds 7 characters (ie. noelj100, which is after 1000 entries as written).
The first name also gets a number added to the end just so there isn't two people with the exact same first/last name (for error checking in my case).

For grades, I had the crn and rin randomly generated from within the 10 just added students/courses. These pairs are unique, and the loop will step back if it gets an already used pair.
The grade for these unique pairs is then randomly generated from 0 to 100, but I added another 30 because the grades were super depressing (rounds down to 100 if it goes over).
========================================================
Style:

Nothing too spectacular, mainly organized everything into divs and colored it a bit. Plus round buttons look much sexier.
Was an accident but ended up with a red white and blue theme in the end, excluding output coloring which I decided by their purpose (yellow while still running, green when done).
Error messages look ugly as I didn't style them, but errors aren't good to start with soooooo... (plus I wanted to make errors red but the background is red, that wouldn't work very well).
========================================================