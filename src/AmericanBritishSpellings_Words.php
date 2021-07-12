<?php
require_once('Words/AmericanBritish/AmericanBritishWords_A.php');
require_once('Words/AmericanBritish/AmericanBritishWords_B.php');
require_once('Words/AmericanBritish/AmericanBritishWords_C.php');
require_once('Words/AmericanBritish/AmericanBritishWords_D.php');
require_once('Words/AmericanBritish/AmericanBritishWords_E.php');
require_once('Words/AmericanBritish/AmericanBritishWords_F.php');
require_once('Words/AmericanBritish/AmericanBritishWords_G.php');
require_once('Words/AmericanBritish/AmericanBritishWords_H.php');
require_once('Words/AmericanBritish/AmericanBritishWords_I.php');
require_once('Words/AmericanBritish/AmericanBritishWords_J.php');
require_once('Words/AmericanBritish/AmericanBritishWords_K.php');
require_once('Words/AmericanBritish/AmericanBritishWords_L.php');
require_once('Words/AmericanBritish/AmericanBritishWords_M.php');
require_once('Words/AmericanBritish/AmericanBritishWords_N.php');
require_once('Words/AmericanBritish/AmericanBritishWords_O.php');
require_once('Words/AmericanBritish/AmericanBritishWords_P.php');
require_once('Words/AmericanBritish/AmericanBritishWords_Q.php');
require_once('Words/AmericanBritish/AmericanBritishWords_R.php');
require_once('Words/AmericanBritish/AmericanBritishWords_S.php');
require_once('Words/AmericanBritish/AmericanBritishWords_T.php');
require_once('Words/AmericanBritish/AmericanBritishWords_U.php');
require_once('Words/AmericanBritish/AmericanBritishWords_V.php');
require_once('Words/AmericanBritish/AmericanBritishWords_W.php');
require_once('Words/AmericanBritish/AmericanBritishWords_X.php');
require_once('Words/AmericanBritish/AmericanBritishWords_Y.php');
require_once('Words/AmericanBritish/AmericanBritishWords_Z.php');

/**
 * AmericanBritishSpellings_Words
 * Class for building word lists for converting UK/US english dialects.
 */
class AmericanBritishSpellings_Words
{
    /**
     * @var array
     */
    protected static $british_to_american_spellings;
    /**
     * @var array
     */
    protected static $american_to_british_spellings;

    /**
     * GetBritishToAmericanSpellings()
     * Build a mapping of British to American spellings.
     * @return array
     */
    public function getBritishToAmericanSpellings(): array
    {
        if (self::$british_to_american_spellings) {
            return self::$british_to_american_spellings;
        }

        $spellingAlternatives = $this->getAmericanToBritishSpellings();
        $britishToAmericanSpellings = [];

        foreach ($spellingAlternatives as $americanSpelling => $britishSpelling) {
            $britishSpelling = (array)$britishSpelling;
            foreach ($britishSpelling as $britSpelling) {
                $britishToAmericanSpellings[$britSpelling] = $americanSpelling;
            }
        }

        self::$british_to_american_spellings = $britishToAmericanSpellings;

        return self::$british_to_american_spellings;
    }

    /**
     * GetAmericanToBritishSpellings()
     * Build a mapping of American to British spellings from the /Language/Words/AmericanBritish/ classes.
     * @return array
     */
    public function getAmericanToBritishSpellings(): array
    {
        if (self::$american_to_british_spellings) {
            return self::$american_to_british_spellings;
        }

        $wordHash = [];

        foreach (range('A', 'Z') as $letter) {
            $wordClass = sprintf('AmericanBritishWords_%s', $letter);
            $words = $wordClass::$american_british_words;

            $wordHash = array_merge($wordHash, $words);
        }

        self::$american_to_british_spellings = $wordHash;

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
        $values = array_values($this->getForLetter($letter));
        $result = [];
        foreach ($values as $value) {
            $result = array_merge($result, (array)$value);
        }

        $result = array_unique($result);
        sort($result);

        return $result;
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

        $values = array_unique($words);
        sort($values);

        return $values;
    }

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
