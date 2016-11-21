Fussball Elo Ranking &ndash;
[![Build Status](https://travis-ci.org/lsv/fossball-elo.svg?branch=master)](https://travis-ci.org/lsv/fossball-elo)
[![codecov](https://codecov.io/gh/lsv/fossball-elo/branch/master/graph/badge.svg)](https://codecov.io/gh/lsv/fossball-elo)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/7493345a-c084-4ff4-989b-822860ae3122/mini.png)](https://insight.sensiolabs.com/projects/7493345a-c084-4ff4-989b-822860ae3122)
[![StyleCI](https://styleci.io/repos/74364167/shield)](https://styleci.io/repos/74364167)

=================

Elo ranking calculator, with goal differences

### Install

`composer require lsv/fossball-elo`

or add it to your `composer.json` file

```json
"require": {
    "lsv/fossball-elo": "^1.0"
}
```

### Usage

```php

$playerA_oldRating = 200;
$playerB_oldRating = 280;

$playerA_score = 3;
$playerB_score = 2;

$factor = 20; // Tournament factor
// Normally these are used
// 60 - World Cup
// 50 - Continental Championship and Intercontinental Tournaments
// 40 - World Cup and Continental qualifiers and major tournaments
// 30 - All other tournaments
// 20 - Friendly Matches

use Lsv\FussballElo\Calculator;

$calculator = new Calculator();
$ratings = $calculator->getRatings(
    $playerA_oldRating,
    $playerB_oldRating,
    $playerA_score,
    $playerB_score,
    $factor
);
// $ratings is now a instance of Lsv\FussballElo\Model\Result

$playerA = $ratings->getPlayerA();
$playerB = $ratings->getPlayerB();

$playerA->getPointChange(); // Point change in this match for player A
$playerA->getRating(); // New rating for player A

$playerB->getPointChange(); // Point change in this match for player B
$playerB->getRating(); // New rating for player B
```

### License

The MIT License (MIT)

Copyright (c) 2016 Martin Aarhof martin.aarhof@gmail.com

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
