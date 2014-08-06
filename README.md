# Pakistan Census Data (1998)

This is re-structured census data, collected from [census.gov.pk](http://census.gov.pk). Data that resided on census website as HTML pages, is collected using web page scrapping method. It is then converted to rough JSON format using [Simple HTML DOM](http://sourceforge.net/projects/simplehtmldom/) library. At this stage, data is [cleaned and re-structured](https://github.com/pkgeography/pk-census/blob/master/src/re-structure.php) to a clean, reusable and machine-readable format but type of data format remains intact to JSON.

# Case Study

[https://speakerdeck.com/jabranr/pakistan-census-data](https://speakerdeck.com/jabranr/pakistan-census-data)

# Contribution

Since (even this) data is not complete as official data source of [census.gov.pk](http://census.gov.pk) returned "Page not found" errors to some of the data, your findings and contributions are always welcome. Please refer to [issues](https://github.com/pkgeography/pk-census/issues) for existing issues or [create a new one](https://github.com/pkgeography/pk-census/issues/new) to start a new discussion.

# License

The MIT License (MIT)

Copyright (c) 2014 Geography of Pakistan

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
