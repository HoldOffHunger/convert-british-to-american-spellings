<?php
		
		/* UTF-8 TEST
		
			中文汉字漢字
		
		*/
				
				/* AmericanBritishWords_Y
					
					Class for American/British spelling variants for all words beginning with : Y.
					
				*/

	class AmericanBritishWords_Y {
			/* __construct($args)
			
				Constructor.
				
				Nothing to do here.
			
			*/
			
		public function __construct($args) {
			return TRUE;
		}
		
			/* AmericanBritishWords()
			
				List of US/UK spellings for words starting with : Y.
			
			*/

		public function AmericanBritishWords() {
			return [
				'yak\'s'=>'yack\'s',
				'yak'=>'yack',
				'yakked'=>'yacked',
				'yakking'=>'yacking',
				'yaks'=>'yacks',
				'yellow-gray'=>'yellow-grey',
				'yeshiva\'s'=>'yeshivah\'s',
				'yeshiva'=>'yeshivah',
				'yeshivas'=>['yeshivot', 'yeshivahs',],
				'yodeled'=>'yodelled',
				'yodeler\'s'=>'yodeller\'s',
				'yodeler'=>'yodeller',
				'yodelers'=>'yodellers',
				'yodeling'=>'yodelling',
				'yogi\'s'=>'yogin\'s',
				'yogi'=>'yogin',
				'yogis'=>'yogins',
				'yogurt\'s'=>['yoghurt\'s', 'yoghourt\'s', 'yogourt\'s',],
				'yogurt'=>['yoghurt', 'yoghourt', 'yogourt',],
				'yogurts'=>['yoghurts', 'yoghourts', 'yogourts',],
				'yuck'=>'yuk',
				'yucky'=>['yuky', 'yukky',],
			];
		}
	}
	
?>