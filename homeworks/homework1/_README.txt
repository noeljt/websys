===========================================================================================================
Name
===========================================================================================================

Joseph Noel

===========================================================================================================
1. Why did you select the doctype you used?
===========================================================================================================

I adapted this assignment from the Intro to IT resume assignment, which already used XHTML 1.0 Strict.

===========================================================================================================
2. How does your doctype compare to other commonly seen (strict) doctypes?
===========================================================================================================

Since HTML, namely HTML 4.01 strict is the only other commonly seen strict doctype,
I found this comparison at http://www.w3schools.com/html/html_xhtml.asp:

XHTML DOCTYPE is mandatory
The xmlns attribute in <html> is mandatory
<html>, <head>, <title>, and <body> are mandatory
XHTML elements must be properly nested
XHTML elements must always be closed
XHTML elements must be in lowercase
XHTML documents must have one root element
Attribute names must be in lower case
Attribute values must be quoted
Attribute minimization is forbidden

===========================================================================================================
3. How is the markup for your document semantically correct? Are there any non-semantic elements that you needed for styling purposes? If you used divs and /or spans, be sure to account for them in your explanation.
===========================================================================================================

The semantic markup for my submissions is split into a "page", with my name and contact information in the hcard microformat. The rest of the resume is split into "section" divs to manage the floated elements contained within.  These section divs contain headers describing the contents, and then "content" divs. The headers are used to stylize and format, while the content divs help maintain consistent padding between sections and other content.  For some content sections, there are "date" divs, which are in divs to display the dates as floats and float them right.  There are also "list" unordered lists, which while semantically vague, allows more reuse within the resume.  Another unordered list class is "compact" which is similar to list but allows more content in a smaller area assuming the bullets are short.  Finally, there are line 1 and 2 items for formatting and stylizing, although they give little semantic meaning.

===========================================================================================================
4. In your own words, how is the hCard information you added useful to both humans and automated user agents trying to access your content?
===========================================================================================================

It is useful to humans as it provides a decent template for contact information and helps humans to remember the associated content and structure, while providing a standardized format.
For automated agents, the standard form and structure makes pulling contact information from documents simpler, potentially speeding up information gathering or evaluation.

===========================================================================================================
Works Referenced
===========================================================================================================

1. Intro to IT Resume assignment and material - R. Plotka
2. HTML and XHTML - http://www.w3schools.com/html/html_xhtml.asp