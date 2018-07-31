/*
    1600 - 2399 年の秋分を正しく計算できるかテスト
    正確な日付は以下のアドレスから得た
    https://ja.wikipedia.org/wiki/%E7%A7%8B%E5%88%86
*/

const data = [
// from   to    +0      +1      +2      +3    (at the boundary)
[1600,	1635,	23,	23,	23,	23],
[1636,	1667,	22,	23,	23,	23],
[1668,	1695,	22,	22,	23,	23],
[1696,	1699,	22,	22,	22,	23,	1698,	22],
[1700,	1727,	23,	23,	23,	24],
[1728,	1763,	23,	23,	23,	23,	1760,	22],
[1764,	1791,	22,	23,	23,	23],
[1792,	1799,	22,	22,	23,	23,	1793,	22],
[1800,	1823,	23,	23,	24,	24,	1822,	23],
[1824,	1851,	23,	23,	23,	24],
[1852,	1887,	23,	23,	23,	23,	1855,	23],
[1888,	1899,	22,	23,	23,	23,	1888,	22],
[1900,	1919,	23,	24,	24,	24,	1917,	23],
[1920,	1947,	23,	23,	24,	24],
[1948,	1979,	23,	23,	23,	24],
[1980,	2011,	23,	23,	23,	23],
[2012,	2043,	22,	23,	23,	23],
[2044,	2075,	22,	22,	23,	23,	2074,	22],
[2076,	2099,	22,	22,	22,	23],
[2100,	2103,	23,	23,	23,	24],
[2104,	2139,	23,	23,	23,	23],
[2140,	2167,	22,	23,	23,	23],
[2168,	2199,	22,	22,	23,	23,	2198,	22],
[2200,	2227,	23,	23,	23,	24],
[2228,	2263,	23,	23,	23,	23,	2260,	22],
[2264,	2291,	22,	23,	23,	23],
[2292,	2299,	22,	22,	23,	23],
[2300,	2323,	23,	23,	24,	24,	2322,	23],
[2324,	2351,	23,	23,	23,	24],
[2352,	2383,	23,	23,	23,	23],
[2384,	2399,	22,	23,	23,	23],
];

const assert = require('assert');
const Holidays = require('../lib/japanese-holidays.js');

const shubun = Holidays.__forTest.shubunWithTime;

data.forEach(function(entry){
  //           from           to
  for (var y = entry[0]; y <= entry[1]; y += 4){
    for (var i = 0; i < 4; i++){
      var s = shubun(y+i);

      if (Holidays.getJDate(s) !== entry[2+i])
        console.log(y+i, entry[2+i], Holidays.getJDate(s), 
                    Holidays.getJHours(s), Holidays.getJMinutes(s));

      assert( Holidays.getJDate(s) === entry[2+i],
        "Shubun on " + (y+i) + " should be " + entry[2+i] + 
                                " but was " + Holidays.getJDate(s));
    }
  }
});

