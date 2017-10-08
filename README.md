# PHP British/American Spelling Converter

Converts text so that British spellings are swapped with their Americanized form or vice versa.

Features:

* 20,000 word alterations;
* Variants for British words ('unrealisable' and 'unrealiseable');
* Words are defined with simple associative array, making for a quick transfer to Perl, C++, Java, etc..
* Atomicity, American-ize/British-ify will not corrupt meaning ('discus' and 'diskus' have opposite meanings in US/UK, swapping them in/out will cause the text to change each time you "Americanize" or "Britishify" it).

Sample usage:

    require('AmericanBritishSpellings.php');
    $american_british_spellings = new AmericanBritishSpellings();
  
    $text = "Axiomatically ax that door, would you, my neighbour?";
    $text = $american_british_spellings->SwapBritishSpellingsForAmericanSpellings(['text'=>$text]);
    
    print($text);   // output: Axiomatically axe that door, would you, my neighbor?
