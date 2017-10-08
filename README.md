# PHP British/American Spelling Converter

Converts text so that British spellings are swapped with their Americanized form or vice versa.

## Features:

* 20,000 words covered;
* Multiple Sources: Words come from varcon (18,000 words) and wordsworldwide (8,000 words), both lists were used to cross-check each other, correct errors, and remove duplicates.
* Variants for British words ('unrealisable' and 'unrealiseable');
* Words are defined with simple associative array, making for a quick transfer to Perl, C++, Java, etc.;

## Functionality:

* Does regular expression checking with /\bWORD\b/, so, it will not corrupt words.  "Ax" becomes "Axe", but "Axiomatic" will remain as "Axiomatic";
* Checks each word in the word list and its ucwords (upper-cased words) formatted version, so no acronyms will be negatively affected ("our group, AX, Avenger Xenophiles," will not be converted to "our group, AXE, Avenger Xenophiles");
* Atomic / Deterministic : American-ize/British-ify will not corrupt meaning ('discus' and 'diskus' have reverse meanings in US/UK, swapping them in/out will cause the text to change each time you "Americanize" or "Britishify" it, so we don't do those types of swaps);

## Sample Usage:

    require('AmericanBritishSpellings.php');
    $american_british_spellings = new AmericanBritishSpellings();
  
    $text = "Axiomatically ax that door, would you, my neighbour?";
    $text = $american_british_spellings->SwapBritishSpellingsForAmericanSpellings(['text'=>$text]);
    
    print($text);   // output: Axiomatically axe that door, would you, my neighbor?
