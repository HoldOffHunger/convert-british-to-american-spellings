# PHP British/American Spelling Converter

Converts text so that British spellings are swapped with their Americanized form or vice versa.

Sample usage:

    require('AmericanBritishSpellings.php');
    $american_british_spellings = new AmericanBritishSpellings();
  
    $text = "Axiomatically ax that door, would you, my neighbour?";
    $text = $american_british_spellings->SwapBritishSpellingsForAmericanSpellings(['text'=>$text]);
    
    print($text);   // output: Axiomatically axe that door, would you, my neighbor?
