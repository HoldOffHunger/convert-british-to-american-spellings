# PHP British/American Spelling Converter

Converts text so that British spellings are swapped with their Americanized form or vice versa.

## Online Demo:

* Check out a much shorter list of replacements being demo'd online:
** [IDEOne Demo: British/American Spelling Converter](https://ideone.com/YoWZ9y)

## Features:

* 20,000 words covered;
* Multiple Sources: Words come from VarCon/ISpell (18,000 words) and WordsWorldWide (8,000 words), both lists were used to cross-check each other, correct errors, and remove duplicates.
* Variants for British words ('unrealisable' and 'unrealiseable');
* Words are defined with simple associative array, making for a quick transfer to Perl, C++, Java, etc.;
* Permissively licensed;

## Functionality:

* **Exact** : Does regular expression checking with `/\b$word\b/`, so, it will not corrupt words.  For example, "Ax" becomes "Axe", but "Axiomatic" will remain as "Axiomatic".
* **Efficient** : Every mass-replace is done within a single preg_replace() call, using arrays as arguments, meaning that the script will finish much sooner.
* **Case-Adaptive** : Checks each word in the word list and its ucwords (upper-cased words) formatted version, so no acronyms will be negatively affected ("our group, AX, Avenger Xenophiles," will not be converted to "our group, AXE, Avenger Xenophiles").
* **Atomic / Deterministic** : American-ize/British-ify will not corrupt meaning ('discus' and 'diskus' have reverse meanings in US/UK, swapping them in/out will cause the text to change each time you "Americanize" or "Britishify" it, so we don't do those types of swaps).

## Sample Usage:

    require('AmericanBritishSpellings.php');
    $american_british_spellings = new AmericanBritishSpellings([]);
  
    $text = "Axiomatically ax that door, would you, my neighbour?";
    $text = $american_british_spellings->SwapBritishSpellingsForAmericanSpellings(['text'=>$text]);
    
    print($text);   // output: Axiomatically axe that door, would you, my neighbor?
