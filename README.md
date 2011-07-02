# PHP Collections

A simple chainable wrapper around common array functions, map, filter, reduce etc...

```php
$set = Collection::fromArray(array(1,2,3,4));

$tmp = $set->filter(function($val){
	return $val % 2 == 0;
})->map(function($val){
	return $val * 2;
})->reduce(function($sum,$val){
	return $sum + $val;
});

echo $tmp /* 12 */
```

## Documentation

* [fromArray](#fromArray)
* [map](#map)
* [filter](#filter)
* [reduce](#reduce)
* [withEach](#withEach)
* [start](#start) - Apply a function to the first element.
* [end](#end) - Apply a function to the last element.
* [sort](#sort)
* [count](#count)
* [value](#value) - Get the underlying array.
* [isEmpty](#isEmpty)

---------------------------------------

<a name = "fromArray" />
### fromArray($array) - static

Create a new collection from an array.

__Arguments__

* array - The array to use.

__Example__

```php
$set = Collection::fromArray(1,2,3,4);
```

---------------------------------------

<a name = "map" />
### map($fn)

Apply a function to each element replacing the old values with the ones returned.

__Arguments__

* fn($value) - The function to apply.

__Example__

```php
$set->map(function($val){
	return $val * 2;
});
```

---------------------------------------

<a name = "filter" />
### filter($fn)

Remove elements which do not pass the filter.

__Arguments__

* fn($value) - The test function, should return true or false.

__Example__

```php
$set->filter(function($val){
	return $val % 2 == 0;
});
```

---------------------------------------

<a name = "reduce" />
### reduce($fn,$mem)

Reduce the elements to a single value.

NB: Reduce returns the result of the reduction NOT a collection.

__Arguments__

* fn($mem,$val) - The reduction function  
* $mem - The initial state of the reduction

__Example__

```php
$set->reduce(function($sum,$value){
	return $sum + $value;
},0);
```

---------------------------------------

<a name = "withEach" />
### withEach($fn)

Call a function with each element in the collection.

__Arguments__

* fn($val) - The function. 

__Example__

```php
$set->withEach(function($val){
	echo $val;
});
```

---------------------------------------

<a name = "start" />
### start($fn)

Apply a function to the first element replacing the element with the return value.

__Arguments__

* fn($val) - The function. 

__Example__

```php
$set->start(function($val){
	return "Start: " . $val;
});
```

---------------------------------------

<a name = "end" />
### end($fn)

Apply a function to the last element replacing the element with the return value.

__Arguments__

* fn($val) - The function. 

__Example__

```php
$set->end(function($val){
	return $val . " End";
});
```

---------------------------------------

<a name = "sort" />
### sort($fn)

Sort the contents of a collection using a callback function.

__Arguments__

* fn($a,$b) - The function. 

__Example__

```php
$set->sort(function($a,$b){
	return $a - $b;
});
```

---------------------------------------

<a name = "count" />
### count()

Return the number of element in the collection.

__Example__

```php
$set->count();
```

---------------------------------------

<a name = "value" />
### value()

Return the underlying array.

__Example__

```php
$set->value();
```
---------------------------------------

<a name = "isEmpty" />
### isEmpty()

Return true if there are no elements in the collection.

__Example__

$set->isEmpty();

---------------------------------------
