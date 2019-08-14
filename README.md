# US/UK Spelling Converter

*You* provide the text, with either US/UK-spelling.

*We* return the same text, converted to either system.

We have you covered -- for about 20,000 words.

<img src="./image/us-uk-spelling-converter-logo.jpg" width="600">

## TOC

1. [TOC](#toc)
2. [Online Demos](#online-demos)
3. [Features](#features)
4. [Functionality](#funtionality)
5. [Example Usage](#example-usage)
6. [Code Structure and Design](#code-structure-and-design)

## Online Demos

_Check out the code in an online demo..._

### Simple Demo Hosted by Us

* [British/American Spelling Converter Script, hosted at EarthFluent.com](http://www.earthfluent.com/convertspelling.php)

### Editable, Online Sandbox Demo (at IDEone.com)

Note: Since there are text limits to online compilers, we reduced the actual list of words covered to make this demo run.

* [IDEOne Demo: British/American Spelling Converter](https://ideone.com/YoWZ9y)

## Features

_How many words are covered?_

* Total of 20,000 words covered, with multiple sources.
    * Source: VarCon/ISpell (18,000 words).
    * Source: WordsWorldWide (8,000 words).
    * Source: Our own personal list.
    * These lists were used to cross-check each other, correct errors, and remove duplicates.
    * Letter-sorted lists for easily updating and checking on words: [A](./classes/Language/Words/AmericanBritish/AmericanBritishWords_A.php) (1,287 words), [B](./classes/Language/Words/AmericanBritish/AmericanBritishWords_B.php) (566 words), [C](./classes/Language/Words/AmericanBritish/AmericanBritishWords_C.php) (1,766 words), [D](./classes/Language/Words/AmericanBritish/AmericanBritishWords_D.php) (1,396 words), [E](./classes/Language/Words/AmericanBritish/AmericanBritishWords_E.php) (943 words), [F](./classes/Language/Words/AmericanBritish/AmericanBritishWords_F.php) (661 words), [G](./classes/Language/Words/AmericanBritish/AmericanBritishWords_G.php) (605 words), [H](./classes/Language/Words/AmericanBritish/AmericanBritishWords_H.php) (1,066 words), [I](./classes/Language/Words/AmericanBritish/AmericanBritishWords_I.php) (578 words), [J](./classes/Language/Words/AmericanBritish/AmericanBritishWords_J.php) (149 words), [K](./classes/Language/Words/AmericanBritish/AmericanBritishWords_K.php) (122 words), [L](./classes/Language/Words/AmericanBritish/AmericanBritishWords_L.php) (586 words), [M](./classes/Language/Words/AmericanBritish/AmericanBritishWords_M.php) (1,250 words), [N](./classes/Language/Words/AmericanBritish/AmericanBritishWords_N.php) (716 words), [O](./classes/Language/Words/AmericanBritish/AmericanBritishWords_O.php) (517 words), [P](./classes/Language/Words/AmericanBritish/AmericanBritishWords_P.php) (2,212 words), [Q](./classes/Language/Words/AmericanBritish/AmericanBritishWords_Q.php) (57 words), [R](./classes/Language/Words/AmericanBritish/AmericanBritishWords_R.php) (1,036 words), [S](./classes/Language/Words/AmericanBritish/AmericanBritishWords_S.php) (1,874 words), [T](./classes/Language/Words/AmericanBritish/AmericanBritishWords_T.php) (746 words), [U](./classes/Language/Words/AmericanBritish/AmericanBritishWords_U.php) (1,241 words), [V](./classes/Language/Words/AmericanBritish/AmericanBritishWords_V.php) (421 words), [W](./classes/Language/Words/AmericanBritish/AmericanBritishWords_W.php) (177 words), [X](./classes/Language/Words/AmericanBritish/AmericanBritishWords_X.php) (0 words), [Y](./classes/Language/Words/AmericanBritish/AmericanBritishWords_Y.php) (22 words), [z](./classes/Language/Words/AmericanBritish/AmericanBritishWords_Z.php) (25 words).
* Variants for British words.
    * For example, "unrealisable" and "unrealiseable".
* Words are defined with simple associative array, making for a quick transfer to Perl, C++, Java, etc..
    * For example, the syntax of `somekey=>"somevalue"` is widely-used throughout many languages, or easily converted to their versions of this syntax.
* Permissively-licensed
    * Do whatever you want with the code!
    * For example, see what others are doing with their personal, commercial, and legal rights as endowed by BSD-3-clause-licensed software.

## Functionality

_How exactly does it work?_

* **Exact / Error-Resistant**
    * British/American Spelling Converter uses regular expression checking with `/\b$word\b/`, so this makes it impossible to corrupt words.
    * For example, "Ax" becomes "Axe", but "Axiomatic" will remain as "Axiomatic", and cannot become "Axeiomatic", which would be incorrect.
* **Fast / Efficient**
    * Every mass-replace is done within a single `preg_replace()` call, using arrays as arguments
    * This means that the script will finish much sooner.
* **Case-Sensitive / Case-Adaptive / Acronym-Safe**
    * Checks each word in the word list and its `ucwords`-formatted version (words with first letter uppercased), so acronyms will not be affected.
    * For example, "our group, AX, Avenger Xenophiles," will *not* be converted to "our group, AXE, Avenger Xenophiles".
* **Reliable / Atomic / Deterministic**
    * American-ize/British-ify will not corrupt meaning.
    * For example, 'discus' and 'diskus' have reverse meanings in US/UK, swapping them in or out will cause the text to change each time you "Americanize" or "Britishify" it.  So, we don't do these types of swaps.

## Example Usage

_How do I use the British/American Spelling Converter?_

### Americanize Text Example

_How do I convert British-spelling text to American-spelling text?_

~~~~
require('AmericanBritishSpellings.php');
$american_british_spellings = new AmericanBritishSpellings([]);

$text = "Axiomatically ax that door, would you, my neighbour?";     // British input text source

$americanized = $american_british_spellings->SwapBritishSpellingsForAmericanSpellings(['text'=>$text]);

print($americanized);   // output: Axiomatically axe that door, would you, my neighbor?
~~~~

### Britishize Text Example

_How do I convert American-spelling text to British-spelling text?_

~~~~
require('AmericanBritishSpellings.php');
$american_british_spellings = new AmericanBritishSpellings([]);

$text = "Axiomatically axe that door, would you, my neighbor?";     // American input text source

$britishized = $american_british_spellings->SwapAmericanSpellingsForBritishSpellings(['text'=>$text]);

print($britishized);   // output: Axiomatically ax that door, would you, my neighbour?
~~~~

## Code Structure and Design

### Coding Languages

_What coding languages are used in the British/American Spelling Converter?_

The entire project is coded in the following...

* *PHP* - For processing the text and storing the US/UK words.

### Exclude List

_How do you avoiding adding words that would break the deterministic / atomistic model of functionality?_

We do this with an exclude list, which also details the conflict in the words themselves.

Check it out: [Exclude List](EXCLUDE_LIST.MD).

### AmericanBritishSpellings.php - Technical Overview

_What are the functions in the sourcecode files for?_

*AmericanBritishSpellings.php*

_Class for converting text from US/UK spellings to US/UK spellings._

*  __construct($args)
    * Constructor.
    * Load the words into the converter class for ready use.
* SwapBritishSpellingsForAmericanSpellings($args)
    * Convert text with British spellings to text with American spellings.
* SwapAmericanSpellingsForBritishSpellings($args)
    * Convert text with American spellings to text with British spellings.
* GetSpellingsAndReplacements($args)
    * Get spellings and replacements based on the desired end language.
* BuildSpellingAlternates($args)
    * Building spelling alternatives for British and American dialects.
* BuildSpellingAlternatesForLanguage($args)
    * Building spelling alternates for a single particular dialect of a language (either British or American, in our case).
* function BuildSearchRegex($args)
    * Build an array of search regexes when given an array of search terms.
* function BuildSearchRegex($args)
    * Build a single search regex for a single search term.
* BuildSpellingReplacements()
    * Build the replacements to be used for the search terms.

*AmericanBritishSpellings_Words.php*

_Class for building word lists for converting UK/US english dialects._

* __construct($args)
    * Constructor.
    * Nothing to do here.
* GetBritishToAmericanSpellings()
    * Build a mapping of British to American spellings.
* GetAmericanToBritishSpellings()
    * Build a mapping of American to British spellings from the /Language/Words/AmericanBritish/ classes.

*AmericanBritishWords_A.php*

* __construct($args)
    * Constructor.
    * Load the words into the converter class for ready use.
* AmericanBritishWords()
    * List of US/UK spellings for words starting with : A.

*AmericanBritishWords_B.php*

* __construct($args)
    * Constructor.
    * Load the words into the converter class for ready use.
* AmericanBritishWords()
    * List of US/UK spellings for words starting with : B.

*AmericanBritishWords_C.php*

* __construct($args)
    * Constructor.
    * Load the words into the converter class for ready use.
* AmericanBritishWords()
    * List of US/UK spellings for words starting with : C.

*AmericanBritishWords_D.php*

* __construct($args)
    * Constructor.
    * Load the words into the converter class for ready use.
* AmericanBritishWords()
    * List of US/UK spellings for words starting with : D.

*AmericanBritishWords_E.php*

* __construct($args)
    * Constructor.
    * Load the words into the converter class for ready use.
* AmericanBritishWords()
    * List of US/UK spellings for words starting with : E.

*AmericanBritishWords_F.php*

* __construct($args)
    * Constructor.
    * Load the words into the converter class for ready use.
* AmericanBritishWords()
    * List of US/UK spellings for words starting with : F.

*AmericanBritishWords_G.php*

* __construct($args)
    * Constructor.
    * Load the words into the converter class for ready use.
* AmericanBritishWords()
    * List of US/UK spellings for words starting with : G.

*AmericanBritishWords_H.php*

* __construct($args)
    * Constructor.
    * Load the words into the converter class for ready use.
* AmericanBritishWords()
    * List of US/UK spellings for words starting with : H.

*AmericanBritishWords_I.php*

* __construct($args)
    * Constructor.
    * Load the words into the converter class for ready use.
* AmericanBritishWords()
    * List of US/UK spellings for words starting with : I.

*AmericanBritishWords_J.php*

* __construct($args)
    * Constructor.
    * Load the words into the converter class for ready use.
* AmericanBritishWords()
    * List of US/UK spellings for words starting with : J.

*AmericanBritishWords_K.php*

* __construct($args)
    * Constructor.
    * Load the words into the converter class for ready use.
* AmericanBritishWords()
    * List of US/UK spellings for words starting with : K.

*AmericanBritishWords_L.php*

* __construct($args)
    * Constructor.
    * Load the words into the converter class for ready use.
* AmericanBritishWords()
    * List of US/UK spellings for words starting with : L.

*AmericanBritishWords_M.php*

* __construct($args)
    * Constructor.
    * Load the words into the converter class for ready use.
* AmericanBritishWords()
    * List of US/UK spellings for words starting with : M.

*AmericanBritishWords_N.php*

* __construct($args)
    * Constructor.
    * Load the words into the converter class for ready use.
* AmericanBritishWords()
    * List of US/UK spellings for words starting with : N.

*AmericanBritishWords_O.php*

* __construct($args)
    * Constructor.
    * Load the words into the converter class for ready use.
* AmericanBritishWords()
    * List of US/UK spellings for words starting with : O.

*AmericanBritishWords_P.php*

* __construct($args)
    * Constructor.
    * Load the words into the converter class for ready use.
* AmericanBritishWords()
    * List of US/UK spellings for words starting with : P.

*AmericanBritishWords_Q.php*

* __construct($args)
    * Constructor.
    * Load the words into the converter class for ready use.
* AmericanBritishWords()
    * List of US/UK spellings for words starting with : Q.

*AmericanBritishWords_R.php*

* __construct($args)
    * Constructor.
    * Load the words into the converter class for ready use.
* AmericanBritishWords()
    * List of US/UK spellings for words starting with : R.

*AmericanBritishWords_S.php*

* __construct($args)
    * Constructor.
    * Load the words into the converter class for ready use.
* AmericanBritishWords()
    * List of US/UK spellings for words starting with : S.

*AmericanBritishWords_T.php*

* __construct($args)
    * Constructor.
    * Load the words into the converter class for ready use.
* AmericanBritishWords()
    * List of US/UK spellings for words starting with : T.

*AmericanBritishWords_U.php*

* __construct($args)
    * Constructor.
    * Load the words into the converter class for ready use.
* AmericanBritishWords()
    * List of US/UK spellings for words starting with : U.

*AmericanBritishWords_V.php*

* __construct($args)
    * Constructor.
    * Load the words into the converter class for ready use.
* AmericanBritishWords()
    * List of US/UK spellings for words starting with : V.

*AmericanBritishWords_W.php*

* __construct($args)
    * Constructor.
    * Load the words into the converter class for ready use.
* AmericanBritishWords()
    * List of US/UK spellings for words starting with : W.

*AmericanBritishWords_X.php*

* __construct($args)
    * Constructor.
    * Load the words into the converter class for ready use.
* AmericanBritishWords()
    * List of US/UK spellings for words starting with : X.

*AmericanBritishWords_Y.php*

* __construct($args)
    * Constructor.
    * Load the words into the converter class for ready use.
* AmericanBritishWords()
    * List of US/UK spellings for words starting with : Y.

*AmericanBritishWords_Z.php*

* __construct($args)
    * Constructor.
    * Load the words into the converter class for ready use.
* AmericanBritishWords()
    * List of US/UK spellings for words starting with : Z.
