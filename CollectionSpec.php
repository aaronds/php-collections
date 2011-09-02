<?php

include "Collection.php";

$describe("Collection construction",function($it){
	$it("should build from an array",function($expect){
		$set = Collection::fromArray(array("One","Two","Three"));
		$expect($set)->toBeTrue();
	});

});

function getDefaultSet(){
	return Collection::fromArray(array(1,2,3,4));
}

$describe("Collection instance",function($it){

	$it("unboxes the value",function($expect){
		$set = getDefaultSet();
		$value = $set->value();

		$expect($value[1])->toEqual(2);
	});

	$it("counts the members",function($expect){
		$set = getDefaultSet();

		$expect($set->count())->toEqual(4);
	});

	$it("applies a function to the element at the start",function($expect){
		$set = getDefaultSet();

		$set->start(function($val) use ($expect) {
			$expect($val)->toEqual(1);
			return 5;
		});

		$values = $set->value();

		$expect($values[0])->toEqual(5);
	});

	$it("applies a function to the element at the end",function($expect){
		$set = getDefaultSet();

		$set->end(function($val) use ($expect){
			$expect($val)->toEqual(4);
			return 5;
		});

		$values = $set->value();

		$expect($values[3])->toEqual(5);
	});

	$it("maps over the members",function($expect){
		$set = getDefaultSet();

		$set->map(function($val){ return $val * 2;});

		$set->start(function($val) use ($expect) {
			$expect($val)->toEqual(2);
		});
	});

	$it("map supports passing multiple maps in one call",function($expect){
		$set = getDefaultSet();
		$set->map(
			function($val){
				return $val * 2;
			},
			function($val){
				return $val * 2;
			}
		);

		$set->start(function($val) use ($expect) {
			$expect($val)->toEqual(4);
		});
	});

	$it("reduces to a value",function($expect){
		$set = getDefaultSet();

		$sum = $set->reduce(function($sum,$val){ return $sum + $val;});

		$expect($sum)->toEqual(10);
	});

	$it("Iterates over the lot",function($expect){
		$set = getDefaultSet();

		$number = 1;

		$set->withEach(function($val) use ($expect,&$number){
			$expect($val)->toEqual($number);
			$number++;
		});
	});

	$it("Sorts the members",function($expect){
		$set = getDefaultSet();
		$set->sort(function($a,$b){
			return $b - $a;
		});

		$set->start(function($val) use ($expect){
			$expect($val)->toEqual(4);
		});
	});

	$it("Can test for emptynes",function($expect){
		$set = getDefaultSet();
		$emptySet = Collection::fromArray(array());

		$expect($set->isEmpty())->toBeFalse();

		$expect($emptySet->isEmpty())->toBeTrue();
	});

	$it("Filters its elements",function($expect){
		$set = getDefaultSet();

		$set->filter(function($el){
			return $el % 2 == 0;
		});

		$expect($set->count())->toEqual(2);
	});

	$it("Calls can be chained together",function($expect){
		$set = getDefaultSet();

		$tmp = $set->filter(function($val){
			return $val % 2 == 0;
		})->map(function($val){
			return $val * 2;
		})->reduce(function($sum,$val){
			return $sum + $val;
		});

		$expect($tmp)->toEqual(12);
	});
});
