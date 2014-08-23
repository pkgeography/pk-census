# Introduction

This is a web based interactive portal build with data from [Geography of Pakistan](https://github.com/pkgeography) repositories. The data is sourced from official channels where it resides in rigid and non-reusable formats. This makes the access, reusibility and understanding of data very difficult for everyone. The sole purpose of this interactive portal is to showcase that how easier it is to reuse the data if it is available in descent digital formats. This example project also demonstrates better ways of showcasing public data for understanding at ease for everyone.

# How it started?

[https://speakerdeck.com/jabranr/pakistan-census-data](https://speakerdeck.com/jabranr/pakistan-census-data)

# Contribution

This example project is open-source and complete code is available in this repository in gh-pages` branch. This project is built with [Yeoman](http://yeoman.io) [webapp generator](https://github.com/yeoman/generator-webapp). If you would like to contribute then follow these steps:

* Fork the repository. [https://github.com/pkgeography/pk-census/fork](https://github.com/pkgeography/pk-census/fork)
* Switch to `gh-pages` branch `$ git checkout gh-pages`
* Create new branch `$ git checkout -b my-awesome-updates`
* Install dependencies and run project in browser 

``` shell
$ cd src/
$ npm install && bower install
$ grunt serve
```

* Add new features or update existing
* Commit with meaningful message 

``` shell
$ git add . && git rm $(git ls-files --deleted) 
$ git status && git commit -m 'here is my new feature'
``` 

* Push the changes to your fork `$ git push origin gh-pages`
* Create a pull request. [https://github.com/pkgeography/pk-census/compare](https://github.com/pkgeography/pk-census/compare)
* Let me review changes and merge
* and finally thank you for your contributions :+1:

If you like to produce production code as well then first delete the `dist/` directory complete and use `$ grunt build`.

Please check the appropriate repositories at [Geography of Pakistan](https://github.com/pkgeography) for data contributions.

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
