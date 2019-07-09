<?php

				// Sources:
				//
				//	8,000 Words; http://www.wordsworldwide.co.uk/docs/Words-Worldwide-Word-list-UK-US-2009.doc
				//	18,000 Words; https://github.com/en-wl/wordlist/blob/master/varcon/varcon.txt
				//
				//  These sources did more than provide the total sum of words.  They cross-checked each other and found errors.
				//
				//  Total After Removing Duplicates: 20,000

	class AmericanBritishSpellings {
		public function __construct($args) {
			require('../classes/Language/AmericanBritishSpellings_Words.php');
			$this->words = new AmericanBritishSpellings_Words([]);
			return TRUE;
		}
		
		public function SwapBritishSpellingsForAmericanSpellings($args) {
			$text = $args['text'];
			
			$spelling_alternatives = $this->GetSpellingsAndReplacements(['language'=>'american']);
			
			$american_spellings = $spelling_alternatives['american'];
			$british_spellings = $spelling_alternatives['british'];

			$text = preg_replace($british_spellings, $american_spellings, $text);

			return $text;
		}
		
		public function SwapAmericanSpellingsForBritishSpellings($args) {
			$text = $args['text'];
			
			$spelling_alternatives = $this->GetSpellingsAndReplacements(['language'=>'british']);
			
			$american_spellings = $spelling_alternatives['american'];
			$british_spellings = $spelling_alternatives['british'];

			$text = preg_replace($american_spellings, $british_spellings, $text);
			
			return $text;
		}
		
		public function GetSpellingsAndReplacements($args) {
			$language = $args['language'];
			
			$replacements = $this->BuildSpellingReplacements();
			
			$american_spellings = $replacements['american'];
			$british_spellings = $replacements['british'];
			
			$alternates = $this->BuildSpellingAlternates([
				'language'=>$language,
				'american'=>$american_spellings,
				'british'=>$british_spellings,
			]);
			
			$american_spellings = $alternates['american'];
			$british_spellings = $alternates['british'];
			
			return [
				'american'=>$american_spellings,
				'british'=>$british_spellings,
			];
		}
		
		public function BuildSpellingAlternates($args) {
			$language = $args['language'];
			$american_spellings = $args['american'];
			$british_spellings = $args['british'];
			
			$american_spellings = $this->BuildSpellingAlternatesForLanguage(['spellings'=>$american_spellings]);
			$british_spellings = $this->BuildSpellingAlternatesForLanguage(['spellings'=>$british_spellings]);
			
			if($language == 'american') {
				$british_spellings = $this->BuildSearchRegex(['spellings'=>$british_spellings]);
			} elseif($language == 'british') {
				$american_spellings = $this->BuildSearchRegex(['spellings'=>$american_spellings]);
			}
			
			return [
				'american'=>$american_spellings,
				'british'=>$british_spellings,
			];
		}
		
		public function BuildSpellingAlternatesForLanguage($args) {
			$spellings = $args['spellings'];
			
			$spellings_uppercase = array_map('strtoupper', $spellings);
			$spellings_ucfirst = array_map('ucfirst', $spellings);
			
			$spellings_and_alternates = [];
			
			foreach([$spellings, $spellings_uppercase, $spellings_ucfirst] as $spelling_group) {
				foreach($spelling_group as $spelling) {
					$spellings_and_alternates[] = $spelling;
				}
			}
			
			return $spellings_and_alternates;
		}
		
		public function BuildSearchRegex($args) {
			$spellings = $args['spellings'];
			
			$spellings_count = count($spellings);
			
			$spellings = array_map([$this, 'BuildSearchRegexForWord'], $spellings);

			return $spellings;
		}
		
		public function BuildSearchRegexForWord($args) {
			$text = $args;
			
			return '/\b' . $text . '\b/';
		}
		
		public function BuildSpellingReplacements() {
			$spelling_alternatives = $this->words->GetAmericanToBritishSpellings();
			
			$american_spellings = array_keys($spelling_alternatives);
			$british_spellings = array_values($spelling_alternatives);
			
			$british_spellings_count = count($british_spellings);
			
			for($i = 0; $i < $british_spellings_count; $i++) {
				$british_spelling = $british_spellings[$i];
				if(is_array($british_spelling)) {
					$american_spelling = $american_spellings[$i];
					
					foreach($british_spelling as $british_spelling_item) {
						$british_spellings[] = $british_spelling_item;
						$american_spellings[] = $american_spelling;
					}
					
					unset($american_spellings[$i]);
					unset($british_spellings[$i]);
				}
			}
			
			return [
				'american'=>$american_spellings,
				'british'=>$british_spellings,
			];
		}
	}
?>
