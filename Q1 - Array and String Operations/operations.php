<?php


# ------------------------  Array Operations ------------------------  

$arr = array();

$num_elements = (int)readline("Enter the number of elements in the Array :\t");


for ($i = 0; $i < $num_elements; ++$i)
    array_push($arr, (int)readline("Enter element [" . $i . "] :\t"));
# `array_push` is used to Push an Element at the end of an Array 


for ($i = 0; $i < count($arr); ++$i)
    # `count` is used to Count the Number of Elements in the Array
    echo $arr[$i] . "\n";

echo "Array :\t";
print_r($arr);


# Filtering for Odd Elements
$odd_elm_arr = array_filter($arr, function ($num) {
    return ($num & 1) !== 0;
});
# `array_filter` is used to Filter the elements based on a condition provided

echo "Odd Elements of Array :\t";
print_r($odd_elm_arr);


# Filtering for Even Elements
$even_elm_arr = array_filter($arr, function ($num) {
    return ($num & 1) === 0;
});

echo "Even Elements of Array :\t";
print_r($even_elm_arr);

# Mapping to compute Cube of every Odd Element
$odd_elm_cube_arr = array_map(function ($num) {
    return pow($num, 3);
}, $odd_elm_arr);
# `array_map` is used to Map the elements using the transformation function provided

echo "Cube of Odd Elements of Array :\t";
print_r($odd_elm_cube_arr);

# Mapping to compute Square Root of every Even Element
$even_elm_sqrt_arr = array_map(function ($num) {
    return floor(pow($num, 1 / 2));
}, $even_elm_arr);

echo "Square Root of Even Elements of Array :\t";
print_r($even_elm_sqrt_arr);

# Merging both arrays together
$merged_arr  = array_merge($odd_elm_cube_arr, $even_elm_sqrt_arr);
# `array_merge` is used to Merge 2 or more arrays together based on keys ( can overwrite )

echo "Merged Array :\t";
print_r($merged_arr);

$first_elm = array_shift($merged_arr);
# `array_shift` is used to Pop the first Element in the Array

echo "First element shifted :\t" . $first_elm . "\n";
echo "Array after Shifting first element :\t";
print_r($merged_arr);

# Reducing Merged Array into the XOR of its Elements
$arr_xor = array_reduce($merged_arr, function ($sum, $elm) {
    return $sum ^ $elm;
}, 0);
# `array_reduce` is used to Reduce Elements using the cumulative function provided

echo "XOR of Final Merged Array :\t" . $arr_xor . "\n";

# Reducing Merged Array into the Sum of its Elements
$arr_sum = array_sum($merged_arr);
# `array_sum` is used to Sum up all the Elements in the Array

echo "Sum of Final Merged Array :\t" . $arr_sum . "\n";


array_unshift($merged_arr, array(1, 2));
# `array_unshift` is used to append an Element at the front of the Array

array_walk_recursive($merged_arr, function (int $elm) {
    echo "Element :\t" . $elm . "\n";
});
# `array_walk_recursive` is used to Recursively Walk the Array in a For Each Element 
# manner. Recursively means it will visit all Elements of Sub-Arrays as well.




# ------------------------  String Operations ------------------------  

echo "\n\n\n";

$str = rtrim(readline("Enter a String :\t"));
# `rtrim` is used to Trim any Whitespaces or other characters from the right side of the String

echo "First Occurence of `World` is :\t" . stripos($str, "World") . "\n";
# `stripos` is used to Compute the first occurence of the search string in the given string

$token = strtok($str, " ");
# `strtok` is used to Create a Token Stream from a given String
# A Token Stream will return subsequent Substrings on each call

while ($token !== false) {
    echo "$token\n";
    $token = strtok(" ");
    # Calling again to read the next Token
}


$str = $str . implode(" ", $arr);
# `implode` is used to Join an Array into a String using the given spearator

echo "Concatinated Imploded String :\t" . $str . "\n";


echo "SHA-1 of String :\n" . sha1($str) . "\n";
# `sha1` is used to compute the SHA-1 of any String according to the algorithm
