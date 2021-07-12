<?php
// Include all letters of the alphabet
foreach (glob(__DIR__ . "/Words/AmericanBritish/*") as $filename) {
    require_once($filename);
}
/**
 * AmericanBritishSpellings_Words
 * Class for building word lists for converting UK/US english dialects.
 */
class AmericanBritishSpellings_Words
{
    /**
     * All British to American English spellings
     * @var array
     */
    protected static $british_to_american_spellings;
    /**
     * All American to British English spellings
     * @var array
     */
    protected static $american_to_british_spellings;

    /**
     * Build a mapping of British to American spellings.
     * @return array
     */
    public function getBritishToAmericanSpellings(): array
    {
        if (!self::$british_to_american_spellings) {
            $spellingAlternatives = $this->getAmericanToBritishSpellings();
            $britishToAmericanSpellings = [];

            foreach ($spellingAlternatives as $americanSpelling => $britishSpelling) {
                $britishSpelling = (array)$britishSpelling;
                foreach ($britishSpelling as $britSpelling) {
                    $britishToAmericanSpellings[$britSpelling] = $americanSpelling;
                }
            }

            self::$british_to_american_spellings = $britishToAmericanSpellings;
        }

        return self::$british_to_american_spellings;
    }

    /**
     * Build a mapping of American to British spellings from the /Language/Words/AmericanBritish/ classes.
     * @return array
     */
    public function getAmericanToBritishSpellings(): array
    {
        if (!self::$american_to_british_spellings) {
            $wordHash = [];

            foreach (range('A', 'Z') as $letter) {
                $words = $this->getForLetter($letter);
                $wordHash = array_merge($wordHash, $words);
            }

            self::$american_to_british_spellings = $wordHash;
        }

        return self::$american_to_british_spellings;
    }

    /**
     * Get all British spellings, starting with a given letter.
     *
     * @param string $letter
     * @return array
     */
    public function getBritishSpellingsForLetter(string $letter): array
    {
        $words = array_values($this->getForLetter($letter));
        $result = [];
        foreach ($words as $word) {
            // If the value is an array, it merges, if it isn't, casting it to array will make it merge.
            $result = array_merge($result, (array)$word);
        }

        // No need for duplicates
        $values = array_unique($result);
        // Sort ABCabc
        sort($values);

        return $values;
    }

    /**
     * Get all American spellings starting with the given letter.
     *
     * @param string $letter
     * @return array
     */
    public function getAmericanSpellingsForLetter(string $letter): array
    {
        $words = array_keys($this->getForLetter($letter));

        // No need for duplicates
        $values = array_unique($words);
        // Sort ABCabc
        sort($values);

        return $values;
    }

    /**
     * Get the amount of American to British words for a specific first letter.
     * @param $letter
     * @return int|void
     */
    public function getCountForLetter($letter)
    {
        return count($this->getForLetter($letter));
    }

    /**
     * Get the entire spelling list for a letter.
     *
     * @param string $letter
     * @return array
     */
    private function getForLetter(string $letter): array
    {
        $class = sprintf('AmericanBritishWords_%s', strtoupper($letter));

        return $class::$american_british_words;
    }
}
