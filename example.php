<?php
/*
 * A simple example of how to use this library
 */
include(__DIR__ . '/src/AmericanBritishSpellings.php');
header('Content-Type: text/html');
echo '<!doctype html><html><head></head><body>';
$american_british_spellings = new AmericanBritishSpellings();
$text1 = "Axiomatically ax that door, would you, my neighbor?";     // American input text source
$text2 = "The neighbour walked to the theatre's centre, manoeuvred about the sabre, and proceeded to reconnoitre the sepulchre in ochre.";
$text3 = "The rumour spread that splendour and flavour were affected by our behaviour, so walk a metre in my mitre while carrying a litre of nitre.";
$text4 = "The connexion with industrialisation remains with the municipalisation of the calibre of the fibre of the spectre, not with the meagre and sombre saltpetre with all its colour and honour.";
$text5 = "labour, as a Labourer, in the laborite's labourine cavern with my fellow LABOURERS, which is an AFTER-EFFECT, *as-matter-of-factly-as-after-effects-go";

$britishized1 = $american_british_spellings->swapAmericanSpellingsForBritishSpellings(['text' => $text1]);
$britishized2 = $american_british_spellings->swapAmericanSpellingsForBritishSpellings(['text' => $text2]);
$britishized3 = $american_british_spellings->swapAmericanSpellingsForBritishSpellings(['text' => $text3]);
$britishized4 = $american_british_spellings->swapAmericanSpellingsForBritishSpellings(['text' => $text4]);
$britishized5 = $american_british_spellings->swapAmericanSpellingsForBritishSpellings(['text' => $text5]);

echo '<h1>Example texts</h1>';
echo '<p>The first line is British English, the second is American English';
echo '<h2>Text 1</h2><p>';
echo $britishized1 . '<br />';
echo $american_british_spellings->swapBritishSpellingsForAmericanSpellings(['text' => $britishized1]); // and back again
echo '</p>';

echo '<h2>Text 2</h2><p>';
echo $britishized2 . '<br />';
echo $american_british_spellings->swapBritishSpellingsForAmericanSpellings(['text' => $britishized2]); // and back again
echo '</p>';

echo '<h2>Text 3</h2><p>';
echo $britishized3 . '<br />';
echo $american_british_spellings->swapBritishSpellingsForAmericanSpellings(['text' => $britishized3]); // and back again
echo '</p>';

echo '<h2>Text 4</h2><p>';
echo $britishized4 . '<br />';
echo $american_british_spellings->swapBritishSpellingsForAmericanSpellings(['text' => $britishized4]); // and back again
echo '</p>';

echo '<h2>Text 5</h2><p>';
echo $britishized5 . '<br />';
echo $american_british_spellings->swapBritishSpellingsForAmericanSpellings(['text' => $britishized5]); // and back again
echo '</p>';

echo '</body></html>';
