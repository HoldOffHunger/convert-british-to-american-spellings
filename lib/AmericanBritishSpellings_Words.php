<?php
				
				/* AmericanBritishSpellings_Words
					
					Class for building word lists for converting UK/US english dialects.
					
				*/

	class AmericanBritishSpellings_Words {

		protected $british_to_american_spellings;
		protected $american_to_british_spellings;

			/* __construct($args)
			
				Constructor.
				
				Nothing to do here.
				
			*/
			
		public function __construct($args) {
			return TRUE;
		}
		
			/* GetBritishToAmericanSpellings()
			
				Build a mapping of British to American spellings.
			
			*/
		
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
		
			/* GetAmericanToBritishSpellings()
			
				Build a mapping of American to British spellings from the /Language/Words/AmericanBritish/ classes.
			
			*/

		public function GetAmericanToBritishSpellings() {
			if($this->american_to_british_spellings) {
				return $this->american_to_british_spellings;
			}
			
			$word_hash = [];
			
			$word_directory = __DIR__ . '/Words/AmericanBritish/';
			
			foreach(range('A', 'Z') as $letter) {
				$word_class = 'AmericanBritishWords_' . $letter;
				$word_file = $word_class . '.php';
				$word_file_location = $word_directory . $word_file;
				
				require_once($word_file_location);
				$word_object = new $word_class([]);
				
				$words = $word_object->AmericanBritishWords();
				
				$word_hash = array_merge($word_hash, $words);
			}
			
			$this->american_to_british_spellings = $word_hash;
			
			return $word_hash;
		}
	}		
?>
