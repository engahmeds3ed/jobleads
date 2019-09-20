# jobleads Refactoring Task
The file **stringtouls.php** contains some code that has potential for optimisation. 

Refactor it in any way you think will make it better and you will want to use it!

------------------
**app/stringtools.php** : refactored class

------------------
#### How to use:
You can get the class file Stringtools.php and put it into Utils folder 
if you have or at any other place into your project then use any function on it 
(I made all of them static as they are Utils functions that can called directly) Like:
`Stringtools::concat("a","b");`  
#### How to test:
1- Run `composer install` command.

2- Run `vendor/bin/phpunit -c tests` command.

#### Notes: 
1- Some functions in file "stringtouls.php" is repeated like concat and concatenate so I used one of them only. 

#### Todo:
1- Apply Single Responsibility principal: split class into two classes one for StringUtils and the other for hashing.

2- For Hashing: we can use interface with two functions (hash and compare) and pass this interface to the main hash class so that any class implement this interface can be passed here to use the two functions from it.

3- Also for testing split it into multiple files.