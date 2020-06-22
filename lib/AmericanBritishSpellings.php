<?php
				
				/* AmericanBritishSpellings
					
					Class for converting text from US/UK spellings to US/UK spellings.
					
				*/
								
	class AmericanBritishSpellings {
			/* __construct($args)
			
				Constructor.
				
				Load the words into the converter class for ready use.
			
			*/
		
		public function __construct($args) {
			require(__DIR__ . '/Words/AmericanBritish/AmericanBritishSpellings_Words.php');
			$this->words = new AmericanBritishSpellings_Words([]);
			return TRUE;
		}
		
			/* SwapBritishSpellingsForAmericanSpellings($args)
			
				Convert text with British spellings to text with American spellings.
			
			*/
		
		public function SwapBritishSpellingsForAmericanSpellings($args) {
			$text = $args['text'];
			
			$spelling_alternatives = $this->GetSpellingsAndReplacements(['language'=>'american']);
			
			$american_spellings = $spelling_alternatives['american'];
			$british_spellings = $spelling_alternatives['british'];

			$text = preg_replace($british_spellings, $american_spellings, $text);

			return $text;
		}
		
			/* SwapAmericanSpellingsForBritishSpellings($args)
			
				Convert text with American spellings to text with British spellings.
			
			*/
		
		public function SwapAmericanSpellingsForBritishSpellings($args) {
			$text = $args['text'];
			
			$spelling_alternatives = $this->GetSpellingsAndReplacements(['language'=>'british']);
			
			$american_spellings = $spelling_alternatives['american'];
			$british_spellings = $spelling_alternatives['british'];

			$text = preg_replace($american_spellings, $british_spellings, $text);
			
			return $text;
		}
		
			/* GetSpellingsAndReplacements($args)
			
				Get spellings and replacements based on the desired end language.
			
			*/
		
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
		
			/* BuildSpellingAlternates($args)
			
				Building spelling alternatives for British and American dialects.
			
			*/
		
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
		
			/* BuildSpellingAlternatesForLanguage($args)
			
				Building spelling alternates for a single particular dialect of a language (either British or American, in our case).
			
			*/
		
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
		
			/* function BuildSearchRegex($args)
			
				Build an array of search regexes when given an array of search terms.
			
			*/
		
		public function BuildSearchRegex($args) {
			$spellings = $args['spellings'];
			
			$spellings_count = count($spellings);
			
			$spellings = array_map([$this, 'BuildSearchRegexForWord'], $spellings);

			return $spellings;
		}
		
			/* function BuildSearchRegex($args)
			
				Build a single search regex for a single search term.
			
			*/
		
		public function BuildSearchRegexForWord($args) {
			$text = $args;
			
			return '/\b' . $text . '\b/';
		}
		
			/* BuildSpellingReplacements()
			
				Build the replacements to be used for the search terms.
			
			*/
		
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
