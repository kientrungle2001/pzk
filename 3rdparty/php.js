function array_change_key_case (array, cs) { // eslint-disable-line camelcase
  //  discuss at: http://locutus.io/php/array_change_key_case/
  // original by: Ates Goral (http://magnetiq.com)
  // improved by: marrtins
  // improved by: Brett Zamir (http://brett-zamir.me)
  //   example 1: array_change_key_case(42)
  //   returns 1: false
  //   example 2: array_change_key_case([ 3, 5 ])
  //   returns 2: [3, 5]
  //   example 3: array_change_key_case({ FuBaR: 42 })
  //   returns 3: {"fubar": 42}
  //   example 4: array_change_key_case({ FuBaR: 42 }, 'CASE_LOWER')
  //   returns 4: {"fubar": 42}
  //   example 5: array_change_key_case({ FuBaR: 42 }, 'CASE_UPPER')
  //   returns 5: {"FUBAR": 42}
  //   example 6: array_change_key_case({ FuBaR: 42 }, 2)
  //   returns 6: {"FUBAR": 42}

  var caseFnc;
  var key;
  var tmpArr = {};

  if (Object.prototype.toString.call(array) === '[object Array]') {
    return array;
  }

  if (array && typeof array === 'object') {
    caseFnc = (!cs || cs === 'CASE_LOWER') ? 'toLowerCase' : 'toUpperCase';
    for (key in array) {
      tmpArr[key[caseFnc]()] = array[key];
    }
    return tmpArr;
  }

  return false;
}

function array_chunk (input, size, preserveKeys) { // eslint-disable-line camelcase
  //  discuss at: http://locutus.io/php/array_chunk/
  // original by: Carlos R. L. Rodrigues (http://www.jsfromhell.com)
  // improved by: Brett Zamir (http://brett-zamir.me)
  //      note 1: Important note: Per the ECMAScript specification,
  //      note 1: objects may not always iterate in a predictable order
  //   example 1: array_chunk(['Kevin', 'van', 'Zonneveld'], 2)
  //   returns 1: [['Kevin', 'van'], ['Zonneveld']]
  //   example 2: array_chunk(['Kevin', 'van', 'Zonneveld'], 2, true)
  //   returns 2: [{0:'Kevin', 1:'van'}, {2: 'Zonneveld'}]
  //   example 3: array_chunk({1:'Kevin', 2:'van', 3:'Zonneveld'}, 2)
  //   returns 3: [['Kevin', 'van'], ['Zonneveld']]
  //   example 4: array_chunk({1:'Kevin', 2:'van', 3:'Zonneveld'}, 2, true)
  //   returns 4: [{1: 'Kevin', 2: 'van'}, {3: 'Zonneveld'}]

  var x;
  var p = '';
  var i = 0;
  var c = -1;
  var l = input.length || 0;
  var n = [];

  if (size < 1) {
    return null
  }

  if (Object.prototype.toString.call(input) === '[object Array]') {
    if (preserveKeys) {
      while (i < l) {
        (x = i % size)
          ? n[c][i] = input[i]
          : n[++c] = {}; n[c][i] = input[i];
        i++;
      }
    } else {
      while (i < l) {
        (x = i % size)
          ? n[c][x] = input[i]
          : n[++c] = [input[i]];
        i++;
      }
    }
  } else {
    if (preserveKeys) {
      for (p in input) {
        if (input.hasOwnProperty(p)) {
          (x = i % size)
            ? n[c][p] = input[p];
            : n[++c] = {}; n[c][p] = input[p];
          i++;
        }
      }
    } else {
      for (p in input) {
        if (input.hasOwnProperty(p)) {
          (x = i % size)
            ? n[c][x] = input[p]
            : n[++c] = [input[p]];
          i++;
        }
      }
    }
  }

  return n;
}

function array_combine (keys, values) { // eslint-disable-line camelcase
  //  discuss at: http://locutus.io/php/array_combine/
  // original by: Kevin van Zonneveld (http://kvz.io)
  // improved by: Brett Zamir (http://brett-zamir.me)
  //   example 1: array_combine([0,1,2], ['kevin','van','zonneveld'])
  //   returns 1: {0: 'kevin', 1: 'van', 2: 'zonneveld'}

  var newArray = {};
  var i = 0;

  // input sanitation
  // Only accept arrays or array-like objects
  // Require arrays to have a count
  if (typeof keys !== 'object') {
    return false;
  }
  if (typeof values !== 'object') {
    return false;
  }
  if (typeof keys.length !== 'number') {
    return false;
  }
  if (typeof values.length !== 'number') {
    return false;
  }
  if (!keys.length) {
    return false;
  }

  // number of elements does not match
  if (keys.length !== values.length) {
    return false;
  }

  for (i = 0; i < keys.length; i++) {
    newArray[keys[i]] = values[i];
  }

  return newArray;
}

function array_count_values (array) { // eslint-disable-line camelcase
  //  discuss at: http://locutus.io/php/array_count_values/
  // original by: Ates Goral (http://magnetiq.com)
  // improved by: Michael White (http://getsprink.com)
  // improved by: Kevin van Zonneveld (http://kvz.io)
  //    input by: sankai
  //    input by: Shingo
  // bugfixed by: Brett Zamir (http://brett-zamir.me)
  //   example 1: array_count_values([ 3, 5, 3, "foo", "bar", "foo" ])
  //   returns 1: {3:2, 5:1, "foo":2, "bar":1}
  //   example 2: array_count_values({ p1: 3, p2: 5, p3: 3, p4: "foo", p5: "bar", p6: "foo" })
  //   returns 2: {3:2, 5:1, "foo":2, "bar":1}
  //   example 3: array_count_values([ true, 4.2, 42, "fubar" ])
  //   returns 3: {42:1, "fubar":1}

  var tmpArr = {};
  var key = '';
  var t = '';

  var _getType = function (obj) {
    // Objects are php associative arrays.
    var t = typeof obj;
    t = t.toLowerCase();
    if (t === 'object') {
      t = 'array';
    }
    return t;
  }

  var _countValue = function (tmpArr, value) {
    if (typeof value === 'number') {
      if (Math.floor(value) !== value) {
        return ;
      }
    } else if (typeof value !== 'string') {
      return ;
    }

    if (value in tmpArr && tmpArr.hasOwnProperty(value)) {
      ++tmpArr[value];
    } else {
      tmpArr[value] = 1;
    }
  }

  t = _getType(array);
  if (t === 'array') {
    for (key in array) {
      if (array.hasOwnProperty(key)) {
        _countValue.call(this, tmpArr, array[key]);
      }
    }
  }

  return tmpArr;
}

function array_diff (arr1) { // eslint-disable-line camelcase
  //  discuss at: http://locutus.io/php/array_diff/
  // original by: Kevin van Zonneveld (http://kvz.io)
  // improved by: Sanjoy Roy
  //  revised by: Brett Zamir (http://brett-zamir.me)
  //   example 1: array_diff(['Kevin', 'van', 'Zonneveld'], ['van', 'Zonneveld'])
  //   returns 1: {0:'Kevin'}

  var retArr = {};
  var argl = arguments.length;
  var k1 = '';
  var i = 1;
  var k = '';
  var arr = {};

  arr1keys: for (k1 in arr1) { // eslint-disable-line no-labels
    for (i = 1; i < argl; i++) {
      arr = arguments[i];
      for (k in arr) {
        if (arr[k] === arr1[k1]) {
          // If it reaches here, it was found in at least one array, so try next value
          continue arr1keys; // eslint-disable-line no-labels
        }
      }
      retArr[k1] = arr1[k1];
    }
  }

  return retArr;
}

function count (mixedVar, mode) {
  var key;
  var cnt = 0;

  if (mixedVar === null || typeof mixedVar === 'undefined') {
    return 0;
  } else if (mixedVar.constructor !== Array && mixedVar.constructor !== Object) {
    return 1;
  }

  if (mode === 'COUNT_RECURSIVE') {
    mode = 1;
  }
  if (mode !== 1) {
    mode = 0;
  }

  for (key in mixedVar) {
    if (mixedVar.hasOwnProperty(key)) {
      cnt++;
      if (mode === 1 && mixedVar[key] &&
        (mixedVar[key].constructor === Array ||
          mixedVar[key].constructor === Object)) {
        cnt += count(mixedVar[key], 1);
      }
    }
  }

  return cnt;
}

