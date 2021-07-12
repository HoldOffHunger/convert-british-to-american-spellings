<?php
require(__DIR__ . '/AmericanBritishSpellings_Words.php');

/**
 * AmericanBritishSpellings
 * Class for converting text from US/UK spellings to US/UK spellings.
 */
class AmericanBritishSpellings
{
    /**
     * List of all American to British words
     * @var AmericanBritishSpellings_Words
     */
    protected $words;

    /**
     * Constructor.
     * Load the base word class.
     */
    public function __construct()
    {
        $this->words = new AmericanBritishSpellings_Words();
    }

    /**
     * Convert text with British spellings to text with American spellings.
     * @param array $args
     * @return string
     */
    public function swapBritishSpellingsForAmericanSpellings(array $args): string
    {
        $text = $args['text'];

        $spelling_alternatives = $this->getSpellingsAndReplacements(['language' => 'american']);

        $american_spellings = $spelling_alternatives['american'];
        $british_spellings = $spelling_alternatives['british'];

        return preg_replace($british_spellings, $american_spellings, $text);
    }

    /**
     * Convert text with American spellings to text with British spellings.
     * @param array $args
     * @return array
     */
    public function getSpellingsAndReplacements(array $args): array
    {
        $language = $args['language'];

        $replacements = $this->buildSpellingReplacements();

        $american = $replacements['american'];
        $british = $replacements['british'];

        $alternates = $this->buildSpellingAlternates([
            'language' => $language,
            'american' => $american,
            'british'  => $british,
        ]);

        $american = $alternates['american'];
        $british = $alternates['british'];

        return [
            'american' => $american,
            'british'  => $british,
        ];
    }

    /**
     * Get spellings and replacements based on the desired end language.
     * @return array
     */
    public function buildSpellingReplacements(): array
    {
        $spellingAlternatives = $this->words->getAmericanToBritishSpellings();

        $americanSpellings = array_keys($spellingAlternatives);
        $britishSpellings = array_values($spellingAlternatives);

        $britishSpellingCount = count($britishSpellings);

        for ($i = 0; $i < $britishSpellingCount; $i++) {
            $britishSpelling = $britishSpellings[$i];
            if (is_array($britishSpelling)) {
                $americanSpelling = $americanSpellings[$i];

                foreach ($britishSpelling as $britishSpellingItem) {
                    $britishSpellings[] = $britishSpellingItem;
                    $americanSpellings[] = $americanSpelling;
                }

                unset($americanSpellings[$i]);
                unset($britishSpellings[$i]);
            }
        }

        return [
            'american' => $americanSpellings,
            'british'  => $britishSpellings,
        ];
    }

    /**
     * Building spelling alternatives for British and American dialects.
     * @param array $args
     * @return array
     */
    public function buildSpellingAlternates(array $args): array
    {
        $language = $args['language'];
        $spellingsAmerican = $args['american'];
        $spellingsBritish = $args['british'];
        $spellingsBritish = $this->buildSpellingAlternatesForLanguage(['spellings' => $spellingsBritish]);
        $spellingsAmerican = $this->buildSpellingAlternatesForLanguage(['spellings' => $spellingsAmerican]);


        if ($language == 'american') {
            $spellingsBritish = $this->buildSearchRegex(['spellings' => $spellingsBritish]);
        } elseif ($language == 'british') {
            $spellingsAmerican = $this->buildSearchRegex(['spellings' => $spellingsAmerican]);
        }

        return [
            'american' => $spellingsAmerican,
            'british'  => $spellingsBritish,
        ];
    }

    /**
     * Building spelling alternates for a single particular dialect of a language (either British or American, in our case).
     * @param array $args
     * @return array
     */
    public function buildSpellingAlternatesForLanguage(array $args): array
    {
        $spellings = $args['spellings'];

        $uppercase = array_map('strtoupper', $spellings);
        $ucFirst = array_map('ucfirst', $spellings);

        return array_merge($spellings, $ucFirst, $uppercase);
    }

    /**
     * Build an array of search regexes when given an array of search terms.
     * @param array $args
     * @return array
     */
    public function buildSearchRegex(array $args): array
    {
        $spellings = $args['spellings'];

        return array_map([$this, 'buildSearchRegexForWords'], $spellings);
    }

    /**
     * Build a single search regex for a single search term.
     * @param array $args
     * @return string
     */
    public function swapAmericanSpellingsForBritishSpellings(array $args): string
    {
        $text = $args['text'];

        $alternatives = $this->getSpellingsAndReplacements(['language' => 'british']);

        $american = $alternatives['american'];
        $british = $alternatives['british'];

        return preg_replace($american, $british, $text);
    }

    /**
     * Build the replacements to be used for the search terms.
     * @param string $args
     * @return string
     */
    public function buildSearchRegexForWords(string $args): string
    {
        return '/\b' . $args . '\b/';
    }

    /**
     * Get the words list
     * @return AmericanBritishSpellings_Words
     */
    public function getWords(): AmericanBritishSpellings_Words
    {
        return $this->words;
    }

    /**
     * Set the words list
     * @param AmericanBritishSpellings_Words $words
     */
    public function setWords(AmericanBritishSpellings_Words $words): void
    {
        $this->words = $words;
    }
}
