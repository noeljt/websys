===================================
Part 0:
===================================

(all times in ms)
loading: 	87.2
scripting: 	936.1
rendering: 	246.4
painting: 	5.4
other: 		123.5
idle 		139.9
total: 		1540

===================================
Part 1:
===================================

loading: 	98.5
scripting: 	889.4 (down 46.7)
rendering: 	242.2
painting: 	4.1
other: 		110.1
idle 		116.9
total: 		1460

===================================
Part 2:
===================================

Note: All these are additive changes 
	  (so #5 has all 5 optimizations)

1) Css background - no image loading

Loading an image should be slower than css.
	Result: Small improvement

2) Don't use append in a loop (BAM)

Looking at dev tools, most time was spent indexing and appending.
Added to string then appended to #foo instead.
	Result: LARGE improvement

3) Make selectors more specific

ie. "#foo" instead of "div.bar #foo"
	Result: unsure, had done this while writing earlier

4) Removed document ready function/moved javascript to end of file

Slides and google said it would be better
	Result: very small improvement

