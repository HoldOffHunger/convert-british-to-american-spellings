<?php

	class AmericanBritishSpellings_Words {
		public function __construct($args) {
			return TRUE;
		}
		
		public function GetBritishToAmericanSpellings() {
			if($this->british_to_american_spellings) {
				return $this->british_to_american_spellings;
			}
			
			$spelling_alternatives = $this->GetAmericanToBritishSpellings();
			$british_to_american_spellings = [];
			
			foreach($spelling_alternatives as $american_spelling => $british_spelling) {
				if(is_array($british_spelling)) {
					$british_word = $british_spelling[0];
				} else {
					$british_word = $british_spelling;
				}
				$british_to_american_spellings[$british_word] = $american_spelling;
			}
			
			$this->british_to_american_spellings = $british_to_american_spellings;
			
			return $british_to_american_spellings;
		}

		public function GetAmericanToBritishSpellings() {
			$word_hash = [];
			
			$word_directory = '../classes/Language/Words/AmericanBritish/';
			
			foreach(range('A', 'Z') as $letter) {
				$word_class = 'AmericanBritishWords_' . $letter;
				$word_file = $word_class . '.php';
				$word_file_location = $word_directory . $word_file;
				
				require($word_file_location);
				$word_object = new $word_class([]);
				
				$words = $word_object->AmericanBritishWords();
				
				$word_hash = array_merge($word_hash, $words);
			}
			
			return $word_hash;
		}
	}		
?>
