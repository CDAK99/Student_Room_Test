<?php 

//Given an array of size n, finds the first repeating element. Returns the element that repeats, and the index of its first occurrence.
function find_repeat_element($arrInput){
    //validate that the input given is an array
    if(!is_array($arrInput)){
        return "ERROR: Please input an array!";
    }

    //loop through input array
    for ($x = 0; $x < count($arrInput); $x++) {
        //store current element in variable
        $element = $arrInput[$x];

        //loop through input array again to compare current element to other elements in the array
        for($y = 0; $y < count($arrInput); $y++){
            //if the current element in 2nd loop is the same as the 1st, skip
            if($x == $y){
                continue;
            }

            $repeatElement = $arrInput[$y];

            //compare elements, if the same return message with the element and index
            if($repeatElement == $element){
                return "Repeat element found! \"" . $repeatElement . "\" found at index " . $y; 
            }
        }
    } 

    return "No repeating elements found!";
}

//Returns the number of vowels and consonants in a string.
function vowel_consonant_count($strInput){
    //validate that the input given is a string
    if(!is_string($strInput)){
        return "ERROR: Please input a string!";
    }

    //convert input to lower case to avoid characters being missed
    $strInput = strtolower($strInput);

    //create array of vowels and initalise count variables
    $arrVowels = array('a','e','i','o','u');
    $vowelCount = 0;
    $consonantCount = 0;

    //remove all non letters from the input string
    $strInput = preg_replace("/[^A-Za-z]/", '', $strInput);

    //split the input string so each character is a element in array
    $strInput = str_split($strInput);

    //loop through the characters in input string and count vowels & consonants
    foreach ($strInput as $strLetter){
        if(in_array($strLetter, $arrVowels)){
            $vowelCount++;
        } else {
            $consonantCount++;
        }
    }

    return "\n" . $vowelCount . " vowels & " . $consonantCount . " consonants found!";
}

//takes a string containing a sentence or (body of text) and a second string containing a word and returns the number of times the word appears in the string.
function word_search($strText, $strSearchWord){
    //validate that the inputs given are strings
    if(!is_string($strText)){
        return "ERROR: Please input a string!";
    } elseif(!is_string($strSearchWord)){
        return "ERROR: Please input a string!";
    }

    //convert inputs to lower case to avoid words being missed due to case sensitivity
    $strText = strtolower($strText);
    $strSearchWord = strtolower($strSearchWord);

    //search for all occurances of search word using regular expression. \b specifies a word boundary 
    preg_match_all("/\b".$strSearchWord."\b/i", $strText, $arrResult);

    //return number of times search word is found
    return(count($arrResult[0]));
}

//takes a number and returns the volume of a sphere with that diameter.
function calculate_sphere_volume($intDiameter){
    //validate that given diameter is a int
    if(!is_int($intDiameter)){
        return "ERROR: Please input a integer!";
    }
    
    //formula to calculate volume is 4/3πr3

    //get radius by halving the diameter
    $intRadius = $intDiameter/2;

    return 4/3 * pi() * pow($intRadius, 3);
}

//accepts an integer, and returns the next 20 prime numbers.
function get_prime_numbers($intNum){
    //validate that given value is a int
    if(!is_int($intNum)){
        return "ERROR: Please input a integer!";
    }

    //initalise array containing next 20 prime numbers
    $arrPrimeNumbers = array();
    
    //loop through till 20 prime numbers are found
    while(count($arrPrimeNumbers) < 20){
        //if current number is prime add it to results array
        if(is_prime_number($intNum)){
            array_push($arrPrimeNumbers, $intNum);
        }
        $intNum++;
    }

    return $arrPrimeNumbers;
}

//accepts an integer. returns true if number is prime, false if not
function is_prime_number($intNum)
{
    //if number is 1 or less it can't be prime
    if ($intNum < 2) {
        return false;
    }

    //loop through numbers from 2 up to n/2
    for ($i = 2; $i <= $intNum / 2; $i++) {
        //if input number divided returns whole number, it can't be prime
        if ($intNum % $i == 0) {
            return false;
        }
    }

    return true;
}

?>