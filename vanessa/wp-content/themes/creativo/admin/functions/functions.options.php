<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		//Access the WordPress Categories via an Array
		$of_categories 		= array();  
		$of_categories_obj 	= get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp 	= array_unshift($of_categories, "Select a category:");    
	       
		//Access the WordPress Pages via an Array
		$of_pages 			= array();
		$of_pages_obj 		= get_pages('sort_column=post_parent,menu_order');    
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp 		= array_unshift($of_pages, "Select a page:");       
	
		//Testing 
		$of_options_select 	= array("one","two","three","four","five"); 
		$of_options_radio 	= array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
		
		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		( 
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_one"		=> "Block One",
				"block_two"		=> "Block Two",
				"block_three"	=> "Block Three",
			), 
			"enabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_four"	=> "Block Four",
			),
		);


		//Stylesheets Reader
		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets = array();

		if ( is_dir($alt_stylesheet_path) ) 
		{
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) 
		    { 
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) 
		        {
		            if(stristr($alt_stylesheet_file, ".css") !== false)
		            {
		                $alt_stylesheets[] = $alt_stylesheet_file;
		            }
		        }    
		    }
		}


		//Background Images Reader
		$bg_images_path = get_stylesheet_directory(). '/images/pattern/'; // change this to where you store your bg images
		$bg_images_url = get_template_directory_uri().'/images/pattern/'; // change this to where you store your bg images
		$bg_images = array();

		if ( is_dir($bg_images_path) ) {
		    if ($bg_images_dir = opendir($bg_images_path) ) { 
		        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
		            if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
		            	natsort($bg_images); //Sorts the array into a natural order
		                $bg_images[] = $bg_images_url . $bg_images_file;
		            }
		        }    
		    }
		}

		

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr 		= wp_upload_dir();
		$all_uploads_path 	= $uploads_arr['path'];
		$all_uploads 		= get_option('of_uploads');
		$other_entries 		= array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat 		= array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos 			= array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 
		
		$google_fonts = array(
							"0" => "Select Font",
							"Abel" => "Abel",
							"Abril Fatface" => "Abril Fatface",
							"Aclonica" => "Aclonica",
							"Acme" => "Acme",
							"Actor" => "Actor",
							"Adamina" => "Adamina",
							"Advent Pro" => "Advent Pro",
							"Aguafina Script" => "Aguafina Script",
							"Aladin" => "Aladin",
							"Aldrich" => "Aldrich",
							"Alegreya" => "Alegreya",
							"Alegreya SC" => "Alegreya SC",
							"Alex Brush" => "Alex Brush",
							"Alfa Slab One" => "Alfa Slab One",
							"Alice" => "Alice",
							"Alike" => "Alike",
							"Alike Angular" => "Alike Angular",
							"Allan" => "Allan",
							"Allerta" => "Allerta",
							"Allerta Stencil" => "Allerta Stencil",
							"Allura" => "Allura",
							"Almendra" => "Almendra",
							"Almendra SC" => "Almendra SC",
							"Amaranth" => "Amaranth",
							"Amatic SC" => "Amatic SC",
							"Amethysta" => "Amethysta",
							"Andada" => "Andada",
							"Andika" => "Andika",
							"Angkor" => "Angkor",
							"Annie Use Your Telescope" => "Annie Use Your Telescope",
							"Anonymous Pro" => "Anonymous Pro",
							"Antic" => "Antic",
							"Antic Didone" => "Antic Didone",
							"Antic Slab" => "Antic Slab",
							"Anton" => "Anton",
							"Arapey" => "Arapey",
							"Arbutus" => "Arbutus",
							"Architects Daughter" => "Architects Daughter",
							"Arimo" => "Arimo",
							"Arizonia" => "Arizonia",
							"Armata" => "Armata",
							"Artifika" => "Artifika",
							"Arvo" => "Arvo",
							"Asap" => "Asap",
							"Asset" => "Asset",
							"Astloch" => "Astloch",
							"Asul" => "Asul",
							"Atomic Age" => "Atomic Age",
							"Aubrey" => "Aubrey",
							"Audiowide" => "Audiowide",
							"Average" => "Average",
							"Averia Gruesa Libre" => "Averia Gruesa Libre",
							"Averia Libre" => "Averia Libre",
							"Averia Sans Libre" => "Averia Sans Libre",
							"Averia Serif Libre" => "Averia Serif Libre",
							"Bad Script" => "Bad Script",
							"Balthazar" => "Balthazar",
							"Bangers" => "Bangers",
							"Basic" => "Basic",
							"Battambang" => "Battambang",
							"Baumans" => "Baumans",
							"Bayon" => "Bayon",
							"Belgrano" => "Belgrano",
							"Belleza" => "Belleza",
							"Bentham" => "Bentham",
							"Berkshire Swash" => "Berkshire Swash",
							"Bevan" => "Bevan",
							"Bigshot One" => "Bigshot One",
							"Bilbo" => "Bilbo",
							"Bilbo Swash Caps" => "Bilbo Swash Caps",
							"Bitter" => "Bitter",
							"Black Ops One" => "Black Ops One",
							"Bokor" => "Bokor",
							"Bonbon" => "Bonbon",
							"Boogaloo" => "Boogaloo",
							"Bowlby One" => "Bowlby One",
							"Bowlby One SC" => "Bowlby One SC",
							"Brawler" => "Brawler",
							"Bree Serif" => "Bree Serif",
							"Bubblegum Sans" => "Bubblegum Sans",
							"Buda" => "Buda",
							"Buenard" => "Buenard",
							"Butcherman" => "Butcherman",
							"Butterfly Kids" => "Butterfly Kids",
							"Cabin" => "Cabin",
							"Cabin Condensed" => "Cabin Condensed",
							"Cabin Sketch" => "Cabin Sketch",
							"Caesar Dressing" => "Caesar Dressing",
							"Cagliostro" => "Cagliostro",
							"Calligraffitti" => "Calligraffitti",
							"Cambo" => "Cambo",
							"Candal" => "Candal",
							"Cantarell" => "Cantarell",
							"Cantata One" => "Cantata One",
							"Cardo" => "Cardo",
							"Carme" => "Carme",
							"Carter One" => "Carter One",
							"Caudex" => "Caudex",
							"Cedarville Cursive" => "Cedarville Cursive",
							"Ceviche One" => "Ceviche One",
							"Changa One" => "Changa One",
							"Chango" => "Chango",
							"Chau Philomene One" => "Chau Philomene One",
							"Chelsea Market" => "Chelsea Market",
							"Chenla" => "Chenla",
							"Cherry Cream Soda" => "Cherry Cream Soda",
							"Chewy" => "Chewy",
							"Chicle" => "Chicle",
							"Chivo" => "Chivo",
							"Coda" => "Coda",
							"Coda Caption" => "Coda Caption",
							"Codystar" => "Codystar",
							"Comfortaa" => "Comfortaa",
							"Coming Soon" => "Coming Soon",
							"Concert One" => "Concert One",
							"Condiment" => "Condiment",
							"Content" => "Content",
							"Contrail One" => "Contrail One",
							"Convergence" => "Convergence",
							"Cookie" => "Cookie",
							"Copse" => "Copse",
							"Corben" => "Corben",
							"Cousine" => "Cousine",
							"Coustard" => "Coustard",
							"Covered By Your Grace" => "Covered By Your Grace",
							"Crafty Girls" => "Crafty Girls",
							"Creepster" => "Creepster",
							"Crete Round" => "Crete Round",
							"Crimson Text" => "Crimson Text",
							"Crushed" => "Crushed",
							"Cuprum" => "Cuprum",
							"Cutive" => "Cutive",
							"Damion" => "Damion",
							"Dancing Script" => "Dancing Script",
							"Dangrek" => "Dangrek",
							"Dawning of a New Day" => "Dawning of a New Day",
							"Days One" => "Days One",
							"Delius" => "Delius",
							"Delius Swash Caps" => "Delius Swash Caps",
							"Delius Unicase" => "Delius Unicase",
							"Della Respira" => "Della Respira",
							"Devonshire" => "Devonshire",
							"Didact Gothic" => "Didact Gothic",
							"Diplomata" => "Diplomata",
							"Diplomata SC" => "Diplomata SC",
							"Doppio One" => "Doppio One",
							"Dorsa" => "Dorsa",
							"Dosis" => "Dosis",
							"Dr Sugiyama" => "Dr Sugiyama",
							"Droid Sans" => "Droid Sans",
							"Droid Sans Mono" => "Droid Sans Mono",
							"Droid Serif" => "Droid Serif",
							"Duru Sans" => "Duru Sans",
							"Dynalight" => "Dynalight",
							"EB Garamond" => "EB Garamond",
							"Eater" => "Eater",
							"Economica" => "Economica",
							"Electrolize" => "Electrolize",
							"Emblema One" => "Emblema One",
							"Emilys Candy" => "Emilys Candy",
							"Engagement" => "Engagement",
							"Enriqueta" => "Enriqueta",
							"Erica One" => "Erica One",
							"Esteban" => "Esteban",
							"Euphoria Script" => "Euphoria Script",
							"Ewert" => "Ewert",
							"Exo" => "Exo",
							"Expletus Sans" => "Expletus Sans",
							"Fanwood Text" => "Fanwood Text",
							"Fascinate" => "Fascinate",
							"Fascinate Inline" => "Fascinate Inline",
							"Federant" => "Federant",
							"Federo" => "Federo",
							"Felipa" => "Felipa",
							"Fjord One" => "Fjord One",
							"Flamenco" => "Flamenco",
							"Flavors" => "Flavors",
							"Fondamento" => "Fondamento",
							"Fontdiner Swanky" => "Fontdiner Swanky",
							"Forum" => "Forum",
							"Francois One" => "Francois One",
							"Fredericka the Great" => "Fredericka the Great",
							"Fredoka One" => "Fredoka One",
							"Freehand" => "Freehand",
							"Fresca" => "Fresca",
							"Frijole" => "Frijole",
							"Fugaz One" => "Fugaz One",
							"GFS Didot" => "GFS Didot",
							"GFS Neohellenic" => "GFS Neohellenic",
							"Galdeano" => "Galdeano",
							"Gentium Basic" => "Gentium Basic",
							"Gentium Book Basic" => "Gentium Book Basic",
							"Geo" => "Geo",
							"Geostar" => "Geostar",
							"Geostar Fill" => "Geostar Fill",
							"Germania One" => "Germania One",
							"Give You Glory" => "Give You Glory",
							"Glass Antiqua" => "Glass Antiqua",
							"Glegoo" => "Glegoo",
							"Gloria Hallelujah" => "Gloria Hallelujah",
							"Goblin One" => "Goblin One",
							"Gochi Hand" => "Gochi Hand",
							"Gorditas" => "Gorditas",
							"Goudy Bookletter 1911" => "Goudy Bookletter 1911",
							"Graduate" => "Graduate",
							"Gravitas One" => "Gravitas One",
							"Great Vibes" => "Great Vibes",
							"Gruppo" => "Gruppo",
							"Gudea" => "Gudea",
							"Habibi" => "Habibi",
							"Hammersmith One" => "Hammersmith One",
							"Handlee" => "Handlee",
							"Hanuman" => "Hanuman",
							"Happy Monkey" => "Happy Monkey",
							"Henny Penny" => "Henny Penny",
							"Herr Von Muellerhoff" => "Herr Von Muellerhoff",
							"Holtwood One SC" => "Holtwood One SC",
							"Homemade Apple" => "Homemade Apple",
							"Homenaje" => "Homenaje",
							"IM Fell DW Pica" => "IM Fell DW Pica",
							"IM Fell DW Pica SC" => "IM Fell DW Pica SC",
							"IM Fell Double Pica" => "IM Fell Double Pica",
							"IM Fell Double Pica SC" => "IM Fell Double Pica SC",
							"IM Fell English" => "IM Fell English",
							"IM Fell English SC" => "IM Fell English SC",
							"IM Fell French Canon" => "IM Fell French Canon",
							"IM Fell French Canon SC" => "IM Fell French Canon SC",
							"IM Fell Great Primer" => "IM Fell Great Primer",
							"IM Fell Great Primer SC" => "IM Fell Great Primer SC",
							"Iceberg" => "Iceberg",
							"Iceland" => "Iceland",
							"Imprima" => "Imprima",
							"Inconsolata" => "Inconsolata",
							"Inder" => "Inder",
							"Indie Flower" => "Indie Flower",
							"Inika" => "Inika",
							"Irish Grover" => "Irish Grover",
							"Istok Web" => "Istok Web",
							"Italiana" => "Italiana",
							"Italianno" => "Italianno",
							"Jim Nightshade" => "Jim Nightshade",
							"Jockey One" => "Jockey One",
							"Jolly Lodger" => "Jolly Lodger",
							"Josefin Sans" => "Josefin Sans",
							"Josefin Slab" => "Josefin Slab",
							"Judson" => "Judson",
							"Julee" => "Julee",
							"Junge" => "Junge",
							"Jura" => "Jura",
							"Just Another Hand" => "Just Another Hand",
							"Just Me Again Down Here" => "Just Me Again Down Here",
							"Kameron" => "Kameron",
							"Karla" => "Karla",
							"Kaushan Script" => "Kaushan Script",
							"Kelly Slab" => "Kelly Slab",
							"Kenia" => "Kenia",
							"Khmer" => "Khmer",
							"Knewave" => "Knewave",
							"Kotta One" => "Kotta One",
							"Koulen" => "Koulen",
							"Kranky" => "Kranky",
							"Kreon" => "Kreon",
							"Kristi" => "Kristi",
							"Krona One" => "Krona One",
							"La Belle Aurore" => "La Belle Aurore",
							"Lancelot" => "Lancelot",
							"Lato" => "Lato",
							"League Script" => "League Script",
							"Leckerli One" => "Leckerli One",
							"Ledger" => "Ledger",
							"Lekton" => "Lekton",
							"Lemon" => "Lemon",
							"Lilita One" => "Lilita One",
							"Limelight" => "Limelight",
							"Linden Hill" => "Linden Hill",
							"Lobster" => "Lobster",
							"Lobster Two" => "Lobster Two",
							"Londrina Outline" => "Londrina Outline",
							"Londrina Shadow" => "Londrina Shadow",
							"Londrina Sketch" => "Londrina Sketch",
							"Londrina Solid" => "Londrina Solid",
							"Lora" => "Lora",
							"Love Ya Like A Sister" => "Love Ya Like A Sister",
							"Loved by the King" => "Loved by the King",
							"Lovers Quarrel" => "Lovers Quarrel",
							"Luckiest Guy" => "Luckiest Guy",
							"Lusitana" => "Lusitana",
							"Lustria" => "Lustria",
							"Macondo" => "Macondo",
							"Macondo Swash Caps" => "Macondo Swash Caps",
							"Magra" => "Magra",
							"Maiden Orange" => "Maiden Orange",
							"Mako" => "Mako",
							"Marck Script" => "Marck Script",
							"Marko One" => "Marko One",
							"Marmelad" => "Marmelad",
							"Marvel" => "Marvel",
							"Mate" => "Mate",
							"Mate SC" => "Mate SC",
							"Maven Pro" => "Maven Pro",
							"Meddon" => "Meddon",
							"MedievalSharp" => "MedievalSharp",
							"Medula One" => "Medula One",
							"Megrim" => "Megrim",
							"Merienda One" => "Merienda One",
							"Merriweather" => "Merriweather",
							"Metal" => "Metal",
							"Metamorphous" => "Metamorphous",
							"Metrophobic" => "Metrophobic",
							"Michroma" => "Michroma",
							"Miltonian" => "Miltonian",
							"Miltonian Tattoo" => "Miltonian Tattoo",
							"Miniver" => "Miniver",
							"Miss Fajardose" => "Miss Fajardose",
							"Modern Antiqua" => "Modern Antiqua",
							"Molengo" => "Molengo",
							"Monofett" => "Monofett",
							"Monoton" => "Monoton",
							"Monsieur La Doulaise" => "Monsieur La Doulaise",
							"Montaga" => "Montaga",
							"Montez" => "Montez",
							"Montserrat" => "Montserrat",
							"Moul" => "Moul",
							"Moulpali" => "Moulpali",
							"Mountains of Christmas" => "Mountains of Christmas",
							"Mr Bedfort" => "Mr Bedfort",
							"Mr Dafoe" => "Mr Dafoe",
							"Mr De Haviland" => "Mr De Haviland",
							"Mrs Saint Delafield" => "Mrs Saint Delafield",
							"Mrs Sheppards" => "Mrs Sheppards",
							"Muli" => "Muli",
							"Mystery Quest" => "Mystery Quest",
							"Neucha" => "Neucha",
							"Neuton" => "Neuton",
							"News Cycle" => "News Cycle",
							"Niconne" => "Niconne",
							"Nixie One" => "Nixie One",
							"Nobile" => "Nobile",
							"Nokora" => "Nokora",
							"Norican" => "Norican",
							"Nosifer" => "Nosifer",
							"Nothing You Could Do" => "Nothing You Could Do",
							"Noticia Text" => "Noticia Text",
							"Nova Cut" => "Nova Cut",
							"Nova Flat" => "Nova Flat",
							"Nova Mono" => "Nova Mono",
							"Nova Oval" => "Nova Oval",
							"Nova Round" => "Nova Round",
							"Nova Script" => "Nova Script",
							"Nova Slim" => "Nova Slim",
							"Nova Square" => "Nova Square",
							"Numans" => "Numans",
							"Nunito" => "Nunito",
							"Odor Mean Chey" => "Odor Mean Chey",
							"Old Standard TT" => "Old Standard TT",
							"Oldenburg" => "Oldenburg",
							"Oleo Script" => "Oleo Script",
							"Open Sans" => "Open Sans",
							"Open Sans Condensed" => "Open Sans Condensed",
							"Orbitron" => "Orbitron",
							"Original Surfer" => "Original Surfer",
							"Oswald" => "Oswald",
							"Over the Rainbow" => "Over the Rainbow",
							"Overlock" => "Overlock",
							"Overlock SC" => "Overlock SC",
							"Ovo" => "Ovo",
							"Oxygen" => "Oxygen",
							"PT Mono" => "PT Mono",
							"PT Sans" => "PT Sans",
							"PT Sans Caption" => "PT Sans Caption",
							"PT Sans Narrow" => "PT Sans Narrow",
							"PT Serif" => "PT Serif",
							"PT Serif Caption" => "PT Serif Caption",
							"Pacifico" => "Pacifico",
							"Parisienne" => "Parisienne",
							"Passero One" => "Passero One",
							"Passion One" => "Passion One",
							"Patrick Hand" => "Patrick Hand",
							"Patua One" => "Patua One",
							"Paytone One" => "Paytone One",
							"Permanent Marker" => "Permanent Marker",
							"Petrona" => "Petrona",
							"Philosopher" => "Philosopher",
							"Piedra" => "Piedra",
							"Pinyon Script" => "Pinyon Script",
							"Plaster" => "Plaster",
							"Play" => "Play",
							"Playball" => "Playball",
							"Playfair Display" => "Playfair Display",
							"Podkova" => "Podkova",
							"Poiret One" => "Poiret One",
							"Poller One" => "Poller One",
							"Poly" => "Poly",
							"Pompiere" => "Pompiere",
							"Pontano Sans" => "Pontano Sans",
							"Port Lligat Sans" => "Port Lligat Sans",
							"Port Lligat Slab" => "Port Lligat Slab",
							"Prata" => "Prata",
							"Preahvihear" => "Preahvihear",
							"Press Start 2P" => "Press Start 2P",
							"Princess Sofia" => "Princess Sofia",
							"Prociono" => "Prociono",
							"Prosto One" => "Prosto One",
							"Puritan" => "Puritan",
							"Quantico" => "Quantico",
							"Quattrocento" => "Quattrocento",
							"Quattrocento Sans" => "Quattrocento Sans",
							"Questrial" => "Questrial",
							"Quicksand" => "Quicksand",
							"Qwigley" => "Qwigley",
							"Radley" => "Radley",
							"Raleway" => "Raleway",
							"Rammetto One" => "Rammetto One",
							"Rancho" => "Rancho",
							"Rationale" => "Rationale",
							"Redressed" => "Redressed",
							"Reenie Beanie" => "Reenie Beanie",
							"Revalia" => "Revalia",
							"Ribeye" => "Ribeye",
							"Ribeye Marrow" => "Ribeye Marrow",
							"Righteous" => "Righteous",
							"Rochester" => "Rochester",
							"Rock Salt" => "Rock Salt",
							"Rokkitt" => "Rokkitt",
							"Ropa Sans" => "Ropa Sans",
							"Rosario" => "Rosario",
							"Rosarivo" => "Rosarivo",
							"Rouge Script" => "Rouge Script",
							"Ruda" => "Ruda",
							"Ruge Boogie" => "Ruge Boogie",
							"Ruluko" => "Ruluko",
							"Ruslan Display" => "Ruslan Display",
							"Russo One" => "Russo One",
							"Ruthie" => "Ruthie",
							"Sail" => "Sail",
							"Salsa" => "Salsa",
							"Sancreek" => "Sancreek",
							"Sansita One" => "Sansita One",
							"Sarina" => "Sarina",
							"Satisfy" => "Satisfy",
							"Schoolbell" => "Schoolbell",
							"Seaweed Script" => "Seaweed Script",
							"Sevillana" => "Sevillana",
							"Shadows Into Light" => "Shadows Into Light",
							"Shadows Into Light Two" => "Shadows Into Light Two",
							"Shanti" => "Shanti",
							"Share" => "Share",
							"Shojumaru" => "Shojumaru",
							"Short Stack" => "Short Stack",
							"Siemreap" => "Siemreap",
							"Sigmar One" => "Sigmar One",
							"Signika" => "Signika",
							"Signika Negative" => "Signika Negative",
							"Simonetta" => "Simonetta",
							"Sirin Stencil" => "Sirin Stencil",
							"Six Caps" => "Six Caps",
							"Slackey" => "Slackey",
							"Smokum" => "Smokum",
							"Smythe" => "Smythe",
							"Sniglet" => "Sniglet",
							"Snippet" => "Snippet",
							"Sofia" => "Sofia",
							"Sonsie One" => "Sonsie One",
							"Sorts Mill Goudy" => "Sorts Mill Goudy",
							"Special Elite" => "Special Elite",
							"Spicy Rice" => "Spicy Rice",
							"Spinnaker" => "Spinnaker",
							"Spirax" => "Spirax",
							"Squada One" => "Squada One",
							"Stardos Stencil" => "Stardos Stencil",
							"Stint Ultra Condensed" => "Stint Ultra Condensed",
							"Stint Ultra Expanded" => "Stint Ultra Expanded",
							"Stoke" => "Stoke",
							"Sue Ellen Francisco" => "Sue Ellen Francisco",
							"Sunshiney" => "Sunshiney",
							"Supermercado One" => "Supermercado One",
							"Suwannaphum" => "Suwannaphum",
							"Swanky and Moo Moo" => "Swanky and Moo Moo",
							"Syncopate" => "Syncopate",
							"Tangerine" => "Tangerine",
							"Taprom" => "Taprom",
							"Telex" => "Telex",
							"Tenor Sans" => "Tenor Sans",
							"The Girl Next Door" => "The Girl Next Door",
							"Tienne" => "Tienne",
							"Tinos" => "Tinos",
							"Titan One" => "Titan One",
							"Trade Winds" => "Trade Winds",
							"Trocchi" => "Trocchi",
							"Trochut" => "Trochut",
							"Trykker" => "Trykker",
							"Tulpen One" => "Tulpen One",
							"Ubuntu" => "Ubuntu",
							"Ubuntu Condensed" => "Ubuntu Condensed",
							"Ubuntu Mono" => "Ubuntu Mono",
							"Ultra" => "Ultra",
							"Uncial Antiqua" => "Uncial Antiqua",
							"UnifrakturCook" => "UnifrakturCook",
							"UnifrakturMaguntia" => "UnifrakturMaguntia",
							"Unkempt" => "Unkempt",
							"Unlock" => "Unlock",
							"Unna" => "Unna",
							"VT323" => "VT323",
							"Varela" => "Varela",
							"Varela Round" => "Varela Round",
							"Vast Shadow" => "Vast Shadow",
							"Vibur" => "Vibur",
							"Vidaloka" => "Vidaloka",
							"Viga" => "Viga",
							"Voces" => "Voces",
							"Volkhov" => "Volkhov",
							"Vollkorn" => "Vollkorn",
							"Voltaire" => "Voltaire",
							"Waiting for the Sunrise" => "Waiting for the Sunrise",
							"Wallpoet" => "Wallpoet",
							"Walter Turncoat" => "Walter Turncoat",
							"Wellfleet" => "Wellfleet",
							"Wire One" => "Wire One",
							"Yanone Kaffeesatz" => "Yanone Kaffeesatz",
							"Yellowtail" => "Yellowtail",
							"Yeseva One" => "Yeseva One",
							"Yesteryear" => "Yesteryear",
							"Zeyada" => "Zeyada",
						);


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();

$of_options[] = array( 	"name" 		=> "Logo Favicon",
						"type" 		=> "heading"
				);
$of_options[] = array( 	"name" 		=> "Logo",
						"desc" 		=> "",
						"id" 		=> "logo_fav",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Logo and Favicon Settings.</h3>
						In this section you can upload your own logo and custom favicon!",
						"icon" 		=> true,
						"type" 		=> "info"
				);				
$of_options[] = array( 	"name" 		=> "Logo Upload",
						"desc" 		=> "Upload your website logo.",
						"id" 		=> "logo",						
						"std" 		=> "",
						"type" 		=> "upload"
				);	
				
$of_options[] = array(  "name" => "Logo Resize",
						"desc" => "Force logo resize to a maximum width of 270px.",
						"id" => "logo_resize",
						"std" => 0,
						"type" => "switch");				
			
				
$of_options[] = array( 	"name" 		=> "Favicon Upload",
						"desc" 		=> "Upload your custom favicon. To generate a favicon you can visit <a href=\"http://tools.dynamicdrive.com/favicon/\" target=\"_blank\">Dynamic Drive</a>",
						"id" 		=> "favicon",
						// Use the shortcodes [site_url] or [site_url_secure] for setting default URLs
						"std" 		=> "",
						"type" 		=> "upload"
				);
				
$of_options[] = array( 	"name" 		=> "Text Logo",
						"desc" 		=> "",
						"id" 		=> "text_logos",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Text Logo</h3>
						If no image logo is used, the text logo will be used. The text logo will automatically display your Site Name. To change your Site Name, please go to Settings -> General",
						"icon" 		=> true,
						"type" 		=> "info"
				);	
				
$of_options[] = array( 	"name" 		=> "Text Logo Color",
						"desc" => "",
						"id" => "text_logo_color",
						"std" => "#FFFFFF",
						"type" => "color" 
				);	

$of_options[] = array( 	"name" 		=> "Text Logo Color on Hover",
						"desc" => "",
						"id" => "text_logo_color_hover",
						"std" => "#99d37c",
						"type" => "color" 
				);	
				
$of_options[] = array( 	"name" 		=> "Tagline",
						"desc" 		=> "",
						"id" 		=> "tagline_field",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Tagline</h3>
						Add or remove your site Tagline. To change your Site Tagline, please go to Settings -> General",
						"icon" 		=> true,
						"type" 		=> "info"
				);	
				
$of_options[] = array(  "name" => "Enable Tagline",
						"desc" => "Enable or Disable the Tagline.",
						"id" => "en_tagline",
						"std" => 0,
						"folds" => 1,
						"type" => "switch");
						
$of_options[] = array( 	"name" 		=> "Tagline Color",
						"desc" => "",
						"id" => "tagline_color",
						"std" => "#dddddd",
						"fold" => "en_tagline",
						"type" => "color" 
				);		
				
$of_options[] = array( 	"name" 		=> "Tagline Font Size (px)",
						"desc" => "Default is 13",
						"id" => "tagline_font_size",
						"std" 		=> "13",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "42",
						"fold"		=> "en_tagline",
						"type" 		=> "sliderui" 
				);																	
				
$of_options[] = array( 	"name" 		=> "Responsiveness",
						"type" 		=> "heading"
				);
				
$of_options[] = array( 	"name" 		=> "Site Responsiveness",
						"desc" 		=> "",
						"id" 		=> "resp",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Responsiveness</h3>Choose if you want to enable or disable the responsive layout for the theme.",
						"icon" 		=> true,
						"type" 		=> "info"
				);	
				
$of_options[] = array(  "name" => "",
						"desc" 		=> "Enable/disable site responsiveness.",
						"id" => "responsiveness",
						"std" => "1",
						"type" => "switch");																														

$of_options[] = array( 	"name" 		=> "Basic Design",
						"type" 		=> "heading"
				);
$of_options[] = array( 	"name" 		=> "Fonts",
						"desc" 		=> "",
						"id" 		=> "fonts",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Font Settings</h3>
						Select google fonts for body and headings.",
						"icon" 		=> true,
						"type" 		=> "info"
				);				
$of_options[] = array(  "name" => "Select Body Font Family",
						"desc" => "Select a font family for body text",
						"id" => "body_font",
						"std" => "Open Sans",
						"type" => "select",
						"options" => $google_fonts);
													
$of_options[] = array(  "name" => "Select Headings Font Family",
						"desc" => "Select a font family for headings",
						"id" => "heading_font",
						"std" => "Oswald",
						"type" => "select",
						"options" => $google_fonts);
						
$of_options[] = array( 	"name" 		=> "Body Font Size (px)",
						"desc" => "Default is 13",
						"id" => "font_size",
						"std" 		=> "13",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "42",
						"type" 		=> "sliderui" 
				);	
				
$of_options[] = array( 	"name" 		=> "Body Font Color",
						"desc" => "Default is #666666",
						"id" => "font_color",
						"std" => "#666666",
						"type" => "color" 
				);																							

$of_options[] = array( 	"name" 		=> "Site Layout",
						"desc" 		=> "",
						"id" 		=> "layout",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Site Layout</h3>
						Choose the layout for your website.",
						"icon" 		=> true,
						"type" 		=> "info"
				);
				
$of_options[] = array(  "name" => "Site Layout (px)",
						"id" => "site_width",
						"std" => "wide",
						"type" => "select",
						"options" => array("Wide", "Extra Wide", "Boxed"));	
						
$of_options[] = array( 	"name" 		=> "Boxed Layout Styling",
						"desc" 		=> "",
						"id" 		=> "boxed_style",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Boxed Layout Styling</h3>
						The settings bellow will only affect the Boxed Layout style.",
						"icon" 		=> true,
						"type" 		=> "info"
				);	
				
$of_options[] = array(  "name" => "Outer Shadow",
						"desc" 		=> "Enable/disable outer shadow.",
						"id" => "outer_shadow",
						"std" => "0",
						"type" => "switch");	
						
$of_options[] = array( 	"name" 		=> "Margin Top / Bottom",
						"desc" => "Default is 20",
						"id" => "margin_all",
						"std" 		=> "20",
						"min" 		=> "0",
						"step"		=> "5",
						"max" 		=> "50",
						"type" 		=> "sliderui" 
				);	
				
$of_options[] = array( 	"name" 		=> "Outer Padding",
						"desc" => "Default is 0",
						"id" => "padding_out",
						"std" 		=> "0",
						"min" 		=> "0",
						"step"		=> "5",
						"max" 		=> "50",
						"type" 		=> "sliderui" 
				);																	
				
$of_options[] = array(  "name" => "Outer Border Style",
						"desc" => "Select the outer border style.",
						"id" => "outer_border_type",
						"std" => "solid",
						"type" => "select",
						"options" => array("dotted","dashed","solid","double","groove","inset","outset","ridge"));	
						
$of_options[] = array(  "name" => "Outer Border Width",
						"desc" => "Select the outer border width.",
						"id" => "outer_border",
						"std" 		=> "0",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "8",
						"type" 		=> "sliderui" 
				);						
						
$of_options[] = array( 	"name" 		=> "Outer Border Color",
						"desc" => "Default is #ECECEC",
						"id" => "outer_border_color",
						"std" => "#ECECEC",
						"type" => "color" 
				);	
				
$of_options[] = array( 	"name" 		=> "Outer Background",
						"desc" 		=> "Upload an image or new pattern for the background.",
						"id" 		=> "boxed_bg",						
						"std" 		=> "",
						"type" 		=> "upload"
				);	
				
$of_options[] = array(  "name" => "Outer Background Repeat",
						"id" => "bg_repeat",
						"std" => "no-repeat",
						"type" => "select",
						"options" => array("no-repeat","repeat-x","repeat-y","repeat-all"));
						
$of_options[] = array(  "name" => "Outer Background Attachment",
						"desc" 		=> "Select Fixed to keep the background fixed in place on user scroll.",
						"id" => "bg_attachment",
						"std" => "fixed",
						"type" => "select",
						"options" => array("scroll","fixed"));												
				
$of_options[] = array(  "name" => "Fullscreen Background",
						"desc" 		=> "Enable/disable fullscreen background.",
						"id" => "bg_fullscreen",
						"std" => "0",						
						"type" => "switch");	
						
$of_options[] = array(  "name" => "Use Patterns",
						"desc" 		=> "Enable/disable background patterns (if enabled, the patterns will overide the background image settings.",
						"id" => "enable_pattern",
						"std" => "0",
						"folds" => 1,
						"type" => "switch");
						
$of_options[] = array( 	"name" 		=> "Background Pattern",
						"desc" 		=> "Select a background pattern.",
						"id" 		=> "pattern",
						"std" 		=> $bg_images_url."pattern1.png",
						"type" 		=> "tiles",
						"fold" 		=> "enable_pattern",
						"options" 	=> array(
						"pattern1" => get_bloginfo('template_directory')."/images/pattern/pattern1.png",
						"pattern2" => get_bloginfo('template_directory')."/images/pattern/pattern2.png",
						"pattern3" => get_bloginfo('template_directory')."/images/pattern/pattern3.png",
						"pattern4" => get_bloginfo('template_directory')."/images/pattern/pattern4.png",
						"pattern5" => get_bloginfo('template_directory')."/images/pattern/pattern5.png",
						"pattern6" => get_bloginfo('template_directory')."/images/pattern/pattern6.png",
						"pattern7" => get_bloginfo('template_directory')."/images/pattern/pattern7.png",
						"pattern8" => get_bloginfo('template_directory')."/images/pattern/pattern8.png",
						"pattern9" => get_bloginfo('template_directory')."/images/pattern/pattern9.png",
						"pattern10" => get_bloginfo('template_directory')."/images/pattern/pattern10.png",
						"pattern11" => get_bloginfo('template_directory')."/images/pattern/pattern11.png",
						"pattern12" => get_bloginfo('template_directory')."/images/pattern/pattern12.png",
						"pattern13" => get_bloginfo('template_directory')."/images/pattern/pattern13.png",
						"pattern14" => get_bloginfo('template_directory')."/images/pattern/pattern14.png",
						"pattern15" => get_bloginfo('template_directory')."/images/pattern/pattern15.png",
						"pattern16" => get_bloginfo('template_directory')."/images/pattern/pattern16.png",
						"pattern17" => get_bloginfo('template_directory')."/images/pattern/pattern17.png",
						"pattern18" => get_bloginfo('template_directory')."/images/pattern/pattern18.png",
						"pattern19" => get_bloginfo('template_directory')."/images/pattern/pattern19.png",
						"pattern20" => get_bloginfo('template_directory')."/images/pattern/pattern20.png",
						"pattern21" => get_bloginfo('template_directory')."/images/pattern/pattern21.png",
						"pattern22" => get_bloginfo('template_directory')."/images/pattern/pattern22.png",
						"pattern23" => get_bloginfo('template_directory')."/images/pattern/pattern23.png",
						"pattern24" => get_bloginfo('template_directory')."/images/pattern/pattern24.png",
						"pattern25" => get_bloginfo('template_directory')."/images/pattern/pattern25.png"
				));
				
$of_options[] = array(  "name" =>  "Outer Background Color",
						"desc" => "",
						"id" => "body_bg_color",
						"std" => "#ffffff",
						"type" => "color");		
						
$of_options[] = array(  "name" =>  "Inner Background Color",
						"desc" => "",
						"id" => "body_bg_color_inside",
						"std" => "#ffffff",
						"type" => "color");										
																									
				
$of_options[] = array( 	"name" 		=> "Colors",
						"type" 		=> "heading"
				);

$of_options[] = array(  "name" => "Predefined Color Scheme",
						"desc" => "",
						"id" => "color_scheme",
						"std" => "Light Red",
						"type" => "select",
						"options" => array( 'green' => 'Green',
											'blue' => 'Blue',  
											'red' => 'Red',  
											'yellow' => 'Yellow',
											'purple' => 'Purple',
											'grey' => 'Grey',
											'black' => 'Black'
									 ));
				
$of_options[] = array(  "name" =>  "Primary Link Color",
						"desc" => "",
						"id" => "primary_color",
						"std" => "#58A623",
						"type" => "color");	

/*						
$of_options[] = array(  "name" =>  "Second Link Color",
						"desc" => "",
						"id" => "second_link_color",
						"std" => "#E1F4C6",
						"type" => "color");	
*/						

$of_options[] = array(  "name" =>  "Image Hover Color - Potfolio &amp; Blog Items",
						"desc" => "",
						"id" => "pb_hover_color",
						"std" => "#b4e56b",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Shortcodes Default Color",
						"desc" => "",
						"id" => "shortcode_color",
						"std" => "#a0ce4e",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Button Border Color",
						"desc" => "",
						"id" => "button_border_color",
						"std" => "#95b959",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Button Gradient Color (Top)",
						"desc" => "",
						"id" => "button_gradient_top_color",
						"std" => "#cae387",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Button Gradient Color (Bottom)",
						"desc" => "",
						"id" => "button_gradient_bottom_color",
						"std" => "#a5cb5e",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Button Text Color",
						"desc" => "",
						"id" => "button_text_color",
						"std" => "#5A742D",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Button Text Shadow Color",
						"desc" => "",
						"id" => "button_text_shadow_color",
						"std" => "#DFF4BC",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Footer Widget Link Color",
						"desc" => "",
						"id" => "footer_widget_link_color",
						"std" => "#77b31d",
						"type" => "color");																																																										

$of_options[] = array( 	"name" 		=> "Custom Colors",
						"desc" 		=> "",
						"id" 		=> "layout",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Custom Colors</h3>
						If you modify the colors above and need to keep them saved after you select a new color system use the options bellow to save your values (each field above has a correspondent below).",
						"icon" 		=> true,
						"type" 		=> "info"
				);
				
$of_options[] = array( 	"name" 		=> "Custom Colors",
						"desc" 		=> "Enable custom colors pattern -  this will overide the color system selected above",
						"id" 		=> "use_custom",
						"std" 		=> 0,
						"folds" => 1,
						"type" 		=> "switch"
				);				
				
$of_options[] = array(  "name" =>  "Custom Primary Link Color",
						"desc" => "",
						"id" => "custom_primary_color",
						"fold" => "use_custom",
						"std" => "#58A623",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Custom Second Link Color",
						"desc" => "",
						"id" => "custom_second_link_color",
						"fold" => "use_custom",
						"std" => "#E1F4C6",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Custom Image Hover Color - Potfolio &amp; Blog Items",
						"desc" => "",
						"id" => "custom_pb_hover_color",
						"fold" => "use_custom",
						"std" => "#b4e56b",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Custom Shortcodes Default Color",
						"desc" => "",
						"id" => "custom_shortcode_color",
						"fold" => "use_custom",
						"std" => "#a0ce4e",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Custom Button Border Color",
						"desc" => "",
						"id" => "custom_button_border_color",
						"fold" => "use_custom",
						"std" => "#95b959",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Custom Button Gradient Color (Top)",
						"desc" => "",
						"id" => "custom_button_gradient_top_color",
						"fold" => "use_custom",
						"std" => "#cae387",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Custom Button Gradient Color (Bottom)",
						"desc" => "",
						"id" => "custom_button_gradient_bottom_color",
						"fold" => "use_custom",
						"std" => "#a5cb5e",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Custom Button Text Color",
						"desc" => "",
						"id" => "custom_button_text_color",
						"fold" => "use_custom",
						"std" => "#5A742D",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Custom Button Text Shadow Color",
						"desc" => "",
						"id" => "custom_button_text_shadow_color",
						"fold" => "use_custom",
						"std" => "#DFF4BC",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Custom Footer Widget Link Color",
						"desc" => "",
						"id" => "custom_footer_widget_link_color",
						"fold" => "use_custom",
						"std" => "#77b31d",
						"type" => "color");				

$of_options[] = array( 	"name" 		=> "Top Bar",
						"type" 		=> "heading"
				);
				
$of_options[] = array( 	"name" 		=> " Top Bar",
						"desc" 		=> "",
						"id" 		=> "header_pos",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Header Top Bar</h3>Add a top bar, above the Header section.",
						"icon" 		=> true,
						"type" 		=> "info"
				);
				
$of_options[] = array(  "name" => "Enable Top Bar",
						"desc" 		=> "Enable/disable top bar.",
						"id" => "en_top_bar",
						"std" => "1",
						"folds" => 1,
						"type" => "switch");	
						
$of_options[] = array(  "name" =>  "Top Bar Background Color",
						"desc" => "",
						"id" => "top_bar_bg",
						"std" => "#000",
						"fold" => "en_top_bar",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Top Bar Bottom Border Color",
						"desc" => "",
						"id" => "top_bar_border",
						"std" => "#444",
						"fold" => "en_top_bar",
						"type" => "color");							
						
$of_options[] = array(  "name" => "Top Bar Elements Color Scheme",
						"id" => "top_bar_scheme",
						"std" => "light",
						"type" => "select",
						"fold" => "en_top_bar",
						"options" => array("light","dark"));
						
$of_options[] = array( 	"name" 		=> "Top Bar Icons Opacity - in percents",
						"desc" => "Default opacity: 60%",
						"id" => "social_icons_opacity",
						"std" 		=> "60",
						"min" 		=> "10",
						"step"		=> "5",
						"max" 		=> "100",
						"fold" => "en_top_bar",
						"type" 		=> "sliderui" 
						);	
						
$of_options[] = array( 	"name" 		=> " Top Bar Contact",
						"desc" 		=> "",
						"id" 		=> "header_pos",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Top Bar Contact</h3>",
						"icon" 		=> true,
						"fold"		=> "en_top_bar",
						"type" 		=> "info"
				);		
				
$of_options[] = array( 	"name" 		=> "Contact Email",
						"desc" 		=> "Enter your contact email.",
						"id" 		=> "contact_email",
						"std" 		=> "hello@yoursite.com",
						"fold"		=> "en_top_bar",
						"type" 		=> "text"
				);	
				
$of_options[] = array( 	"name" 		=> "Phone Number",
						"desc" 		=> "Enter your phone number.",
						"id" 		=> "contact_phone",
						"std" 		=> "+1 650-253-0000",
						"fold"		=> "en_top_bar",
						"type" 		=> "text"
				);	
				
$of_options[] = array(  "name" => "Enable Tap to Call Button",
						"desc" 		=> "Enable/disable a tap to call button, on mobile devices with a resolution lower than 767px.",
						"id" => "en_tap_call",
						"std" => "0",
						"fold"		=> "en_top_bar",
						"folds" => 1,
						"type" => "switch");
						
$of_options[] = array( 	"name" 		=> "Tap to Call text on button",
						"desc" 		=> "Enter the text you want to appear on the button.",
						"id" 		=> "tap_call_text",
						"std" 		=> "Give us a Call Now!",
						"fold"		=> "en_tap_call",
						"type" 		=> "text"
				);																							

$of_options[] = array(  "name" =>  "Contact text Color",
						"desc" => "",
						"id" => "contact_text",
						"std" => "#999999",
						"fold" => "en_top_bar",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Contact link Color",
						"desc" => "",
						"id" => "contact_link",
						"std" => "#999999",
						"fold" => "en_top_bar",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Contact link Color on Hover",
						"desc" => "",
						"id" => "contact_link_hover",
						"std" => "#58A623",
						"fold" => "en_top_bar",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Separator Color",
						"desc" => "",
						"id" => "top_bar_separator",
						"std" => "#999999",
						"fold" => "en_top_bar",
						"type" => "color");																					

$of_options[] = array( 	"name" 		=> "Header",
						"type" 		=> "heading"
				);

$of_options[] = array( 	"name" 		=> "Header Style",
						"desc" 		=> "",
						"id" 		=> "header_pos",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Header Style</h3>Select the style you want to use for the header",
						"icon" 		=> true,
						"type" 		=> "info"
				);	
				
$of_options[] = array(  "name" => "",
						"id" => "header_style",
						"std" => "Default",
						"type" => "select",
						"options" => array("style1" => "Default","style2" => "Modern"));																						
				
$of_options[] = array( 	"name" 		=> "Header Pos",
						"desc" 		=> "",
						"id" 		=> "header_pos",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Header Elements Positioning</h3>Select how the header logo and menu will be displayed: normal or centered!",
						"icon" 		=> true,
						"type" 		=> "info"
				);	
				
$of_options[] = array(  "name" => "",
						"id" => "header_el_pos",
						"std" => "normal",
						"type" => "select",
						"options" => array("normal" => "Normal","center" => "Centered"));							
				
$of_options[] = array( 	"name" 		=> "Header Styling",
						"desc" 		=> "",
						"id" 		=> "header_styling",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Header Styling</h3>",
						"icon" 		=> true,
						"type" 		=> "info"
				);					
				
$of_options[] = array(  "name" => "Use Patterns",
						"desc" 		=> "Enable/disable patterns.",
						"id" => "en_header_pattern",
						"std" => "1",
						"folds" => 1,
						"type" => "switch");
						
$of_options[] = array( 	"name" 		=> "Background Pattern",
						"desc" 		=> "Select a background pattern for the header.",
						"id" 		=> "header_patterns",
						"std" 		=> $bg_images_url."pattern10.png",
						"type" 		=> "tiles",
						"fold" 		=> "en_header_pattern",
						"options" 	=> array(
						"pattern1" => get_bloginfo('template_directory')."/images/pattern/pattern1.png",
						"pattern2" => get_bloginfo('template_directory')."/images/pattern/pattern2.png",
						"pattern3" => get_bloginfo('template_directory')."/images/pattern/pattern3.png",
						"pattern4" => get_bloginfo('template_directory')."/images/pattern/pattern4.png",
						"pattern5" => get_bloginfo('template_directory')."/images/pattern/pattern5.png",
						"pattern6" => get_bloginfo('template_directory')."/images/pattern/pattern6.png",
						"pattern7" => get_bloginfo('template_directory')."/images/pattern/pattern7.png",
						"pattern8" => get_bloginfo('template_directory')."/images/pattern/pattern8.png",
						"pattern9" => get_bloginfo('template_directory')."/images/pattern/pattern9.png",
						"pattern10" => get_bloginfo('template_directory')."/images/pattern/pattern10.png",
						"pattern11" => get_bloginfo('template_directory')."/images/pattern/pattern11.png",
						"pattern12" => get_bloginfo('template_directory')."/images/pattern/pattern12.png",
						"pattern13" => get_bloginfo('template_directory')."/images/pattern/pattern13.png",
						"pattern14" => get_bloginfo('template_directory')."/images/pattern/pattern14.png",
						"pattern15" => get_bloginfo('template_directory')."/images/pattern/pattern15.png",
						"pattern16" => get_bloginfo('template_directory')."/images/pattern/pattern16.png",
						"pattern17" => get_bloginfo('template_directory')."/images/pattern/pattern17.png",
						"pattern18" => get_bloginfo('template_directory')."/images/pattern/pattern18.png",
						"pattern19" => get_bloginfo('template_directory')."/images/pattern/pattern19.png",
						"pattern20" => get_bloginfo('template_directory')."/images/pattern/pattern20.png",
						"pattern21" => get_bloginfo('template_directory')."/images/pattern/pattern21.png",
						"pattern22" => get_bloginfo('template_directory')."/images/pattern/pattern22.png",
						"pattern23" => get_bloginfo('template_directory')."/images/pattern/pattern23.png",
						"pattern24" => get_bloginfo('template_directory')."/images/pattern/pattern24.png",
						"pattern25" => get_bloginfo('template_directory')."/images/pattern/pattern25.png",
					));
					
$of_options[] = array( 	"name" 		=> "Header Custom Background",
						"desc" 		=> "Upload an image or new pattern for the background of the header.",
						"id" 		=> "header_bg_image",						
						"std" 		=> "",
						"type" 		=> "upload"
				);	
				
$of_options[] = array(  "name" => "Header Custom Background Repeat",
						"id" => "header_bg_repeat",
						"std" => "no-repeat",
						"type" => "select",
						"options" => array("no-repeat","repeat-x","repeat-y","repeat-all"));					
				
$of_options[] = array(  "name" =>  "Header Background Color",
						"desc" => "",
						"id" => "header_bg_color",
						"std" => "#ECECEC",
						"type" => "color");	

$of_options[] = array( 	"name" 		=> "Header Menu",
						"desc" 		=> "",
						"id" 		=> "header_menu",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Header Menu</h3>",
						"icon" 		=> true,
						"type" 		=> "info"
				);	
				
$of_options[] = array(  "name" => "Header Menu Uppercase",
						"desc" 		=> "Force uppercase text for the Header Menu.",
						"id" => "force_uppercase",
						"std" => "1",
						"folds" => 1,
						"type" => "switch");
						
$of_options[] = array(  "name" => "Header Menu - SubMenu Indicator",
						"desc" 		=> "Enable/disable the SubMenu Indicator (the + sign)",
						"id" => "submenu_indicator",
						"std" => "1",
						"folds" => 1,
						"type" => "switch");										
/*						
$of_options[] = array(  "name" => "Header Menu Position",
						"desc" 		=> "Select the position of the header menu.",
						"id" => "menu_float",
						"std" => "right",
						"type" => "select",
						"options" => array("left","right"));	
*/						
$of_options[] = array(  "name" => "Header Menu Text Color",
						"desc" 		=> "Select the color of the header text menu.",
						"id" => "menu_color",
						"std" => "#ffffff",
						"type" => "color");	
						
$of_options[] = array(  "name" => "Header Menu Text Color on Hover",
						"desc" 		=> "Select the color of the header text menu on hover.",
						"id" => "menu_color_hover",
						"std" => "#ffffff",
						"type" => "color");	
						
$of_options[] = array(  "name" => "Header Menu Background Color on Hover",
						"desc" 		=> "Select the background color of the header text menu, on hover. Also affects the background color of the + sign.",
						"id" => "menu_bg_color",
						"std" => "#58A623",
						"type" => "color");
						
$of_options[] = array(  "name" => "Header SubMenu Items Text Color",
						"desc" 		=> "Select the text color of the submenu items.",
						"id" => "submenu_color",
						"std" => "#666666",
						"type" => "color");	
						
$of_options[] = array(  "name" => "Header SubMenu Items Text Color on Hover",
						"desc" 		=> "Select the text color of the submenu items on hover.",
						"id" => "submenu_color_hover",
						"std" => "#ffffff",
						"type" => "color");
						
$of_options[] = array(  "name" => "Header SubMenu Items Background Color",
						"desc" 		=> "Select the background color of the submenu items text.",
						"id" => "submenu_bg_color",
						"std" => "#ffffff",
						"type" => "color");
																				
$of_options[] = array(  "name" => "Header SubMenu Items Separator Color",
						"desc" 		=> "Select the color of the submenu items separator.",
						"id" => "submenu_separator",
						"std" => "#e2e2e2",
						"type" => "color");	
				
$of_options[] = array(  "name" => "Header Menu Font Family",
						"desc" => "Select a font family for the header menu",
						"id" => "menu_font_family",
						"std" => "Oswald",
						"type" => "select",
						"options" => $google_fonts);								
						
$of_options[] = array(  "name" => "Header Menu Font Size(px)",
						"id" => "menu_font_size",
						"std" 		=> "15",
						"min" 		=> "10",
						"step"		=> "1",
						"max" 		=> "40",
						"type" 		=> "sliderui" 
				);	
				
$of_options[] = array(  "name" => "Header Menu Background Color - Modern Header Style",
						"desc" 		=> "If you selected the Modern Header style you can specify a color for the background of the menu bar. Note that the menu will be placed outside the header area.",
						"id" => "menu_bg_color_full",
						"std" => "#000000",
						"type" => "color");	
						
$of_options[] = array(  "name" => "Header Menu Border Color - Modern Header Style",
						"desc" 		=> "If you selected the Modern Header style you can specify a color for the border of the menu bar. ",
						"id" => "menu_border_color",
						"std" => "#444444",
						"type" => "color");	
						
$of_options[] = array( 	"name" 		=> "Header HTML Code - only works for Modern Header style",
						"desc" 		=> "Paste here your html code for the header area. You can add javascripts codes to output the banners you want or plain html.",
						"id" 		=> "header_banner",
						"std" 		=> "",
						"type" 		=> "textarea"
				);																																					

$of_options[] = array( 	"name" 		=> "Header Padding &amp; Margins",
						"desc" 		=> "",
						"id" 		=> "header_padd_mar",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Header Padding &amp; Margins</h3>",
						"icon" 		=> true,
						"type" 		=> "info"
				);
						
$of_options[] = array(  "name" => "Header Bottom Margin (px)",
						"id" => "header_bottom_margin",
						"std" 		=> "0",
						"min" 		=> "0",
						"step"		=> "5",
						"max" 		=> "50",
						"type" 		=> "sliderui" 
				);	
				
$of_options[] = array(  "name" => "Header Top Margin (px)",
						"id" => "header_top_margin",
						"std" 		=> "0",
						"min" 		=> "0",
						"step"		=> "5",
						"max" 		=> "50",
						"type" 		=> "sliderui" 
				);	
				
$of_options[] = array(  "name" => "Header Top Padding (px)",
						"id" => "header_top_padding",
						"std" 		=> "10",
						"min" 		=> "0",
						"step"		=> "5",
						"max" 		=> "50",
						"type" 		=> "sliderui" 
				);	
				
$of_options[] = array(  "name" => "Header Bottom Padding (px)",
						"id" => "header_bottom_padding",
						"std" 		=> "15",
						"min" 		=> "0",
						"step"		=> "5",
						"max" 		=> "50",
						"type" 		=> "sliderui" 
				);	
				
$of_options[] = array( 	"name" 		=> "Title &amp; Breadcrumb",
						"desc" 		=> "",
						"id" 		=> "title_breadcrumbs",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Title &amp; Breadcrumb</h3>",
						"icon" 		=> true,
						"type" 		=> "info"
				);				
				
$of_options[] = array(  "name" =>  "Title and Breadcrumb Background Color",
						"desc" => "Select the background color for the title & breadcrumb section.",
						"id" => "tb_bg_color",
						"std" => "#f8f8f8",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Title and Breadcrumb Font Color",
						"desc" => "Select the font color for the title & breadcrumb section.",
						"id" => "tb_title_color",
						"std" => "#4d4d4d",
						"type" => "color");																																						
				
$of_options[] = array( 	"name" 		=> "Footer",
						"type" 		=> "heading"
				);

$of_options[] = array( 	"name" 		=> "Back to Top",
						"desc" 		=> "",
						"id" 		=> "back_top",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Back to Top</h3>",
						"icon" 		=> true,
						"type" 		=> "info"
				);				
				
$of_options[] = array(  "name" => "Back to Top button",
						"desc" 		=> "Enable/disable the Back to Top button.",
						"id" => "en_back_top",
						"std" => "1",
						"folds" => "1",
						"type" => "switch");						
						
$of_options[] = array(  "name" =>  "Back to Top Background color",
						"desc" => "Select the background color for the back to top button.",
						"id" => "back_top_bg",
						"std" => "#444",
						"fold" => "en_back_top",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Back to Top Background color on Hover",
						"desc" => "Select the background color on hover, for the back to top button.",
						"id" => "back_top_bg_hover",
						"std" => "#a0ce4e",
						"fold" => "en_back_top",
						"type" => "color");								
						
$of_options[] = array( 	"name" 		=> "Footer Options",
						"desc" 		=> "",
						"id" 		=> "ftr",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Footer</h3>",
						"icon" 		=> true,
						"type" 		=> "info"
				);															
				
$of_options[] = array(  "name" => "Center Footer Content",
						"desc" 		=> "Enable/disable the centering of the footer elements.",
						"id" => "en_footer_center",
						"std" => "0",
						"type" => "switch");
				
$of_options[] = array( 	"name" 		=> "Footer Copyright",
						"desc" 		=> "Paste here your footer copyright text or html!",
						"id" 		=> "footer_copyright",
						"std" 		=> "&copy; Copyright 2014. Powered by <a href=\"http://wordpress.org\">WordPress</a><br> <a href=\"http://rockythemes.com/creativo/\">Creativo 4.0</a> by RockyThemes.",
						"type" 		=> "textarea"
				);	
				
$of_options[] = array( 	"name" 		=> "Google Analytics Code",
						"desc" 		=> "Paste here your google analytics code!",
						"id" 		=> "footer_code",
						"std" 		=> "",
						"type" 		=> "textarea"
				);
				
$of_options[] = array(  "name" => "Footer Widgets Patterns",
						"desc" 		=> "Enable/disable patterns on footer widgets section.",
						"id" => "en_footer_pattern",
						"std" => "0",
						"folds" => 1,
						"type" => "switch");
						
$of_options[] = array( 	"name" 		=> "Footer Widgets Pattern",
						"desc" 		=> "Select a background pattern for the footer.",
						"id" 		=> "footer_patterns",
						"std" 		=> $bg_images_url."pattern10.png",
						"type" 		=> "tiles",
						"fold" 		=> "en_footer_pattern",
						"options" 	=> array(
						"pattern1" => get_bloginfo('template_directory')."/images/pattern/pattern1.png",
						"pattern2" => get_bloginfo('template_directory')."/images/pattern/pattern2.png",
						"pattern3" => get_bloginfo('template_directory')."/images/pattern/pattern3.png",
						"pattern4" => get_bloginfo('template_directory')."/images/pattern/pattern4.png",
						"pattern5" => get_bloginfo('template_directory')."/images/pattern/pattern5.png",
						"pattern6" => get_bloginfo('template_directory')."/images/pattern/pattern6.png",
						"pattern7" => get_bloginfo('template_directory')."/images/pattern/pattern7.png",
						"pattern8" => get_bloginfo('template_directory')."/images/pattern/pattern8.png",
						"pattern9" => get_bloginfo('template_directory')."/images/pattern/pattern9.png",
						"pattern10" => get_bloginfo('template_directory')."/images/pattern/pattern10.png",
						"pattern11" => get_bloginfo('template_directory')."/images/pattern/pattern11.png",
						"pattern12" => get_bloginfo('template_directory')."/images/pattern/pattern12.png",
						"pattern13" => get_bloginfo('template_directory')."/images/pattern/pattern13.png",
						"pattern14" => get_bloginfo('template_directory')."/images/pattern/pattern14.png",
						"pattern15" => get_bloginfo('template_directory')."/images/pattern/pattern15.png",
						"pattern16" => get_bloginfo('template_directory')."/images/pattern/pattern16.png",
						"pattern17" => get_bloginfo('template_directory')."/images/pattern/pattern17.png",
						"pattern18" => get_bloginfo('template_directory')."/images/pattern/pattern18.png",
						"pattern19" => get_bloginfo('template_directory')."/images/pattern/pattern19.png",
						"pattern20" => get_bloginfo('template_directory')."/images/pattern/pattern20.png",
						"pattern21" => get_bloginfo('template_directory')."/images/pattern/pattern21.png",
						"pattern22" => get_bloginfo('template_directory')."/images/pattern/pattern22.png",
						"pattern23" => get_bloginfo('template_directory')."/images/pattern/pattern23.png",
						"pattern24" => get_bloginfo('template_directory')."/images/pattern/pattern24.png",
						"pattern25" => get_bloginfo('template_directory')."/images/pattern/pattern25.png",
					));
				
$of_options[] = array(  "name" =>  "Footer Widgets Background Color",
						"desc" => "Select the background color for the footer widgets section - if patterns are disabled the background color will be used.",
						"id" => "footer_bg_color",
						"std" => "#f8f8f8",
						"type" => "color");	
						
$of_options[] = array(  "name" => "Footer Copyright Patterns",
						"desc" 		=> "Enable/disable patterns on footer copyright section.",
						"id" => "en_footer_copy_pattern",
						"std" => "1",
						"folds" => 1,
						"type" => "switch");
						
$of_options[] = array( 	"name" 		=> "Footer Copyright Pattern",
						"desc" 		=> "Select a background pattern for the footer copyright.",
						"id" 		=> "footer_copy_patterns",
						"std" 		=> $bg_images_url."pattern10.png",
						"type" 		=> "tiles",
						"fold" 		=> "en_footer_copy_pattern",
						"options" 	=> array(
						"pattern1" => get_bloginfo('template_directory')."/images/pattern/pattern1.png",
						"pattern2" => get_bloginfo('template_directory')."/images/pattern/pattern2.png",
						"pattern3" => get_bloginfo('template_directory')."/images/pattern/pattern3.png",
						"pattern4" => get_bloginfo('template_directory')."/images/pattern/pattern4.png",
						"pattern5" => get_bloginfo('template_directory')."/images/pattern/pattern5.png",
						"pattern6" => get_bloginfo('template_directory')."/images/pattern/pattern6.png",
						"pattern7" => get_bloginfo('template_directory')."/images/pattern/pattern7.png",
						"pattern8" => get_bloginfo('template_directory')."/images/pattern/pattern8.png",
						"pattern9" => get_bloginfo('template_directory')."/images/pattern/pattern9.png",
						"pattern10" => get_bloginfo('template_directory')."/images/pattern/pattern10.png",
						"pattern11" => get_bloginfo('template_directory')."/images/pattern/pattern11.png",
						"pattern12" => get_bloginfo('template_directory')."/images/pattern/pattern12.png",
						"pattern13" => get_bloginfo('template_directory')."/images/pattern/pattern13.png",
						"pattern14" => get_bloginfo('template_directory')."/images/pattern/pattern14.png",
						"pattern15" => get_bloginfo('template_directory')."/images/pattern/pattern15.png",
						"pattern16" => get_bloginfo('template_directory')."/images/pattern/pattern16.png",
						"pattern17" => get_bloginfo('template_directory')."/images/pattern/pattern17.png",
						"pattern18" => get_bloginfo('template_directory')."/images/pattern/pattern18.png",
						"pattern19" => get_bloginfo('template_directory')."/images/pattern/pattern19.png",
						"pattern20" => get_bloginfo('template_directory')."/images/pattern/pattern20.png",
						"pattern21" => get_bloginfo('template_directory')."/images/pattern/pattern21.png",
						"pattern22" => get_bloginfo('template_directory')."/images/pattern/pattern22.png",
						"pattern23" => get_bloginfo('template_directory')."/images/pattern/pattern23.png",
						"pattern24" => get_bloginfo('template_directory')."/images/pattern/pattern24.png",
						"pattern25" => get_bloginfo('template_directory')."/images/pattern/pattern25.png",
					));

$of_options[] = array( 	"name" 		=> "Footer Copyright - Custom Background",
						"desc" 		=> "Upload an image or new pattern for the background of the footer copyright section.",
						"id" 		=> "footer_copyright_bg",						
						"std" 		=> "",
						"type" 		=> "upload"
				);	
				
$of_options[] = array(  "name" => "Footer Copyright - Custom Background Repeat",
						"id" => "footer_copyright_bg_repeat",
						"std" => "no-repeat",
						"type" => "select",
						"options" => array("no-repeat","repeat-x","repeat-y","repeat-all"));
				
$of_options[] = array(  "name" =>  "Footer Copyright Background Color",
						"desc" => "Select the background color for the footer copyright section - if patterns are disabled the background color will be used.",
						"id" => "footer_copy_bg_color",
						"std" => "#1E1D1D",
						"type" => "color");	
						
						
						
$of_options[] = array(  "name" =>  "Footer Copyright Text Color",
						"desc" => "Select the text color for the footer copyright section.",
						"id" => "footer_text_color",
						"std" => "#999999",
						"type" => "color");

$of_options[] = array(  "name" =>  "Footer Copyright Link Color",
						"desc" => "Select the link color for the footer copyright section.",
						"id" => "footer_link_color",
						"std" => "#727272",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Footer Copyright Link Color - Hover",
						"desc" => "Select the link color for the footer copyright section, on hover.",
						"id" => "footer_link_color_hover",
						"std" => "#525252",
						"type" => "color");	
	
$of_options[] = array( 	"name" 		=> "Call to Action",
						"type" 		=> "heading"
				);	
				
$of_options[] = array( 	"name" 		=> "cta_bar",
						"desc" 		=> "",
						"id" 		=> "cta_bar",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Call to Action Bar</h3>Call to Action bar will be present on all your pages, above the footer.",
						"icon" 		=> true,
						"type" 		=> "info"
				);				
				
$of_options[] = array(  "name" => "Call to Action Bar",
						"desc" 		=> "Enable/disable the call to action bar - section will be present on all your pages, above the footer area..",
						"id" => "en_cta",
						"std" => "0",
						"folds" => "1",
						"type" => "switch");
						
$of_options[] = array( 	"name" => "Call to Action text ",
						"id" 		=> "cta_text_real",
						"std" 		=> "This can be changed by going to Appearance -> Theme Options -> Call to Action!",
						"type" 		=> "textarea",
						"fold" => "en_cta"
				);							
						
$of_options[] = array(  "name" =>  "Call to Action Text Color",
						"desc" => "",
						"id" => "cta_text",
						"std" => "#666666",
						"fold" => "en_cta",
						"type" => "color");
						
$of_options[] = array(  "name" =>  "Call to Action Text Color on Hover",
						"desc" => "",
						"id" => "cta_text_hover",
						"std" => "#666666",
						"fold" => "en_cta",
						"type" => "color");													
						
$of_options[] = array(  "name" =>  "Call to Action Background Color",
						"desc" => "",
						"id" => "cta_bg",
						"std" => "#e4f2d0",
						"fold" => "en_cta",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Call to Action Background Color on Hover",
						"desc" => "",
						"id" => "cta_bg_hover",
						"std" => "#d4f19d",
						"fold" => "en_cta",
						"type" => "color");	
						
$of_options[] = array( 	"name" 		=> "cta_bar_button",
						"desc" 		=> "",
						"id" 		=> "cta_bar",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Call to Action Button Style</h3>",
						"icon" 		=> true,
						"fold" => "en_cta",
						"type" 		=> "info"
				);		
				
$of_options[] = array( 	"name" 		=> "Call to Action Button Text",
						"desc" 		=> "Enter the text you want to display on your button.",
						"id" 		=> "cta_button_text",
						"std" 		=> "Your Text Here",
						"fold"		=> "en_cta",
						"type" 		=> "text"
				);		
				
$of_options[] = array( 	"name" 		=> "Call to Action Button Link",
						"desc" 		=> "Enter the link for the Call to Action button",
						"id" 		=> "cta_button_link",
						"std" 		=> "",
						"fold"		=> "en_cta",
						"type" 		=> "text"
				);												
						
$of_options[] = array(  "name" =>  "Button Border Color",
						"desc" => "",
						"id" => "button_border_color",
						"std" => "#95b959",
						"fold" => "en_cta",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Button Gradient Color (Top)",
						"desc" => "",
						"id" => "cta_button_gradient_top_color",
						"std" => "#cae387",
						"fold" => "en_cta",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Button Gradient Color (Bottom)",
						"desc" => "",
						"id" => "cta_button_gradient_bottom_color",
						"std" => "#a5cb5e",
						"fold" => "en_cta",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Button Text Color",
						"desc" => "",
						"id" => "cta_button_text_color",
						"std" => "#5A742D",
						"fold" => "en_cta",
						"type" => "color");	
/*						
$of_options[] = array(  "name" =>  "Button Text Shadow Color",
						"desc" => "",
						"id" => "cta_button_text_shadow_color",
						"std" => "#DFF4BC",
						"fold" => "en_cta",
						"type" => "color");																			
/*						
$of_options[] = array(  "name" => "Footer Copyright - Custom Background Repeat",
						"id" => "footer_copyright_bg_repeat",
						"std" => "no-repeat",
						"type" => "select",
						"options" => array("above" => "Above Footer Widgets","below" => "Below Footer Widgets"));															
*/																																									
				
$of_options[] = array( 	"name" 		=> "VC Elements",
						"type" 		=> "heading"
				);
				
$of_options[] = array( 	"name" 		=> "tagline info",
						"desc" 		=> "",
						"id" 		=> "tagline_inf",
						"std" 		=> "<h3 style=\margin: 0 0 10px;\">Call to Action </h3>
						Here you can modify settings for the Call to Action",
						"icon" 		=> true,
						"type" 		=> "info"
				);					
				
$of_options[] = array(  "name" =>  "Call to Action Text Color (Default)",
						"id" => "action_text_color",
						"std" => "#777",
						"type" => "color");
						
$of_options[] = array(  "name" =>  "Call to Action Text Color on Hover",
						"id" => "action_text_color_hover",
						"std" => "#555",
						"type" => "color");						
				
$of_options[] = array(  "name" =>  "Call to Action Border Color (Default)",
						"id" => "action_border",
						"std" => "#d2e5ae",
						"type" => "color");
						
$of_options[] = array(  "name" =>  "Call to Action Border Color on Hover",
						"id" => "action_border_hover",
						"std" => "#A5CB5E",
						"type" => "color");	
						
$of_options[] = array(  "name" =>  "Call to Action Background Color",
						"id" => "action_bg",
						"std" => "#f8f8f8",
						"type" => "color");

$of_options[] = array(  "name" =>  "Call to Action Background Color on Hover",
						"id" => "action_bg_hover",
						"std" => "#ffffff",
						"type" => "color");
						
$of_options[] = array( 	"name" 		=> "featured services",
						"desc" 		=> "",
						"id" 		=> "featured_services",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Featured Services</h3>
						Here you can modify settings for the Featured Services",
						"icon" 		=> true,
						"type" 		=> "info"
				);		
				
$of_options[] = array(  "name" =>  "Featured Services Background Color (Default)",
						"id" => "featured_serv_bg",
						"std" => "#f8f8f8",
						"type" => "color");
						
$of_options[] = array(  "name" =>  "Featured Services Link Color (Default)",
						"id" => "featured_serv_link",
						"std" => "#58a623",
						"type" => "color");						
						
$of_options[] = array(  "name" =>  "Featured Services Background Color on Hover (Default)",
						"id" => "featured_serv_bg_hover",
						"std" => "#a0ce4e",
						"type" => "color");	
						
$of_options[] = array(  "name" => "Enable White Circle",
						"desc" 		=> "Enable/disable the white circle inside the Featured Service box.",
						"id" => "white_circle",
						"std" => "1",
						"type" => "switch");																																												

$of_options[] = array( 	"name" 		=> "testimonial",
						"desc" 		=> "",
						"id" 		=> "testimonial",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Testimonials Slider</h3>
						Here you can modify settings for the Testimonials slider",
						"icon" 		=> true,
						"type" 		=> "info"
				);		
				
$of_options[] = array(  "name" => "Pause on Hover",
						"desc" 		=> "Enable/disable pause on hover event.",
						"id" => "pause_hover",
						"std" => "1",
						"type" => "switch");	
						
$of_options[] = array(  "name" => "Testimonial Pause Time - in seconds",
						"id" => "pause_time",
						"std" 		=> "3",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "15",
						"type" 		=> "sliderui" 
				);											
				
$of_options[] = array( 	"name" 		=> "Blog",
						"type" 		=> "heading"
				);
				
$of_options[] = array(  "name" => "Posts Count",
						"id" => "posts_count",
						"std" 		=> "10",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "30",
						"type" 		=> "sliderui" 
				);
				
$of_options[] = array(  "name" => "Post Content",
						"desc" 		=> "Select what you want to display on archive pages: full content or post excerpt",
						"id" => "post_content",
						"std" => "Post Excerpt",
						"type" => "select",
						"options" => array("Post Excerpt", "Full Content"));				
				
$of_options[] = array(  "name" => "Sidebar Position",
						"desc" 		=> "Select the default position of the sidebar.",
						"id" => "sidebar_pos",
						"std" => "right",
						"type" => "select",
						"options" => array("left","right"));	
						
$of_options[] = array(  "name" => "Archives Pages Style",
						"desc" 		=> "Select the blogposts style on search result pages, category pages, archives pages and tag pages.",
						"id" => "blog_images",
						"std" => "right",
						"type" => "select",
						"options" => array("Big Style","Small Style"));	
			
$of_options[] = array(  "name" => "Blog Posts Navigation",
						"desc" 		=> "Enable/disable blog posts navigation.",
						"id" => "show_post_navi",
						"std" => "1",
						"type" => "switch");	
						
$of_options[] = array(  "name" => "Related Posts",
						"desc" 		=> "Enable/disable related posts.",
						"id" => "related_posts",
						"std" => "1",
						"folds" => "1",
						"type" => "switch");
						
$of_options[] = array(  "name" => "Related Posts Count",
						"id" => "related_items",
						"std" 		=> "5",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "10",
						"fold" => "related_posts",
						"type" 		=> "sliderui" 
				);								
						
$of_options[] = array(  "name" => "Social Sharing Icons",
						"desc" 		=> "Enable/disable social sharing icons on single post pages.",
						"id" => "social_icons",
						"std" => "1",
						"type" => "switch");
						
$of_options[] = array(  "name" => "Show Date",
						"desc" 		=> "Show date on archives pages and single post pages.",
						"id" => "show_date",
						"std" => "1",
						"type" => "switch");

$of_options[] = array(  "name" => "Show View More",
						"desc" 		=> "Show view more link text on archives pages.",
						"id" => "show_view_more",
						"std" => "1",
						"type" => "switch");						
						
$of_options[] = array(  "name" => "Show Author",
						"desc" 		=> "Show author meta on archives pages and single post pages.",
						"id" => "show_author",
						"std" => "1",
						"type" => "switch");
						
$of_options[] = array(  "name" => "Show Categories",
						"desc" 		=> "Show categories meta on archives pages and single post pages.",
						"id" => "show_categories",
						"std" => "1",
						"type" => "switch");	
						
$of_options[] = array(  "name" => "Show Tags",
						"desc" 		=> "Show post tags on archives pages and single post pages.",
						"id" => "show_tags",
						"std" => "1",
						"type" => "switch");	
						
$of_options[] = array(  "name" => "Show Comments",
						"desc" 		=> "Show comments meta on archives pages and single post pages.",
						"id" => "show_comments",
						"std" => "1",
						"type" => "switch");																																																							
				
$of_options[] = array( 	"name" 		=> "Portfolio",
						"type" 		=> "heading"
				);
				
$of_options[] = array( 	"name" 		=> "Project Details Text",
						"desc" 		=> "Enter the text you want to use for Project Details. Default is: Project Details.<br />Leave empty if you don't want to show anything.",
						"id" 		=> "project_details_text",
						"std" 		=> "Project Details",
						"type" 		=> "text"
				);
				
$of_options[] = array( 	"name" 		=> "Project Description Text",
						"desc" 		=> "Enter the text you want to use for Project Description. Default is: Project Description.<br />Leave empty if you don't want to show anything.",
						"id" 		=> "project_description_text",
						"std" 		=> "Project Description",
						"type" 		=> "text"
				);										
				
$of_options[] = array(  "name" => "Portfolio Item Count",
						"id" => "portfolio_items",
						"std" 		=> "10",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"type" 		=> "sliderui" 
				);

$of_options[] = array(  "name" => "Portfolio Navigation",
						"desc" 		=> "Enable/disable portfolio navigation.",
						"id" => "show_port_navi",
						"std" => "1",
						"type" => "switch");				
				
$of_options[] = array(  "name" => "Show Project Details",
						"desc" 		=> "Enable/Disable project details on single portfolio pages.",
						"id" => "project_details",
						"std" => "1",
						"type" => "switch");

$of_options[] = array(  "name" => "Show Social Sharing Icons",
						"desc" 		=> "Enable/Disable social sharing icons on single portfolio pages.",
						"id" => "port_social_icons",
						"std" => "1",
						"type" => "switch");							
						
$of_options[] = array(  "name" => "Show Related Projects",
						"desc" 		=> "Enable/Disable related projects on single portfolio pages.",
						"id" => "related_projects",
						"std" => "1",
						"type" => "switch");	
						
$of_options[] = array(  "name" => "Related Projects Count",
						"id" => "portfolio_related_items",
						"std" 		=> "5",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "10",
						"type" 		=> "sliderui" 
				);
				
$of_options[] = array( 	"name" 		=> "Featured Images",
						"type" 		=> "heading"
				);		
				
$of_options[] = array(  "name" => "Featured Images",
						"name" => "How many Featured Images to use",
						"id" => "featured_images_count",
						"std" 		=> "5",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "10",
						"type" 		=> "sliderui" 
				);																					
				
$of_options[] = array( 	"name" 		=> "Social Media",
						"type" 		=> "heading"
				);
				
$of_options[] = array(  "name" => "Show Social Icons ",
						"desc" 		=> "Enable/Disable social icons above header section.",
						"id" => "en_social_icons_header",
						"std" => "1",
						"type" => "switch");	
											
$of_options[] = array(  "name" => "",
						"desc" 		=> "Enable/Disable social icons on footer section.",
						"id" => "en_social_icons",
						"std" => "1",
						"type" => "switch");	
				
$of_options[] = array( 	"name" 		=> "Rss",
						"desc" 		=> "Enter your Rss feed link.",
						"id" 		=> "rss",
						"std" 		=> "My rss link",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "Twitter",
						"desc" 		=> "Enter your Twitter profile link.",
						"id" 		=> "twitter",
						"std" 		=> "My twitter link",
						"type" 		=> "text"
				);	
				
$of_options[] = array( 	"name" 		=> "Facebook",
						"desc" 		=> "Enter your Facebook profile link.",
						"id" 		=> "facebook",
						"std" 		=> "My facebook link",
						"type" 		=> "text"
				);	
				
$of_options[] = array( 	"name" 		=> "Instagram",
						"desc" 		=> "Enter your Instagram profile link.",
						"id" 		=> "instagram",
						"std" 		=> "",
						"type" 		=> "text"
				);				
				
$of_options[] = array( 	"name" 		=> "Google+",
						"desc" 		=> "Enter your Google+ profile link.",
						"id" 		=> "google",
						"std" 		=> "My google+ link",
						"type" 		=> "text"
				);	
				
$of_options[] = array( 	"name" 		=> "LinkedIn",
						"desc" 		=> "Enter your LinkedIn profile link.",
						"id" 		=> "linkedin",
						"std" 		=> "",
						"type" 		=> "text"
				);	
/*				
$of_options[] = array( 	"name" 		=> "Reddit",
						"desc" 		=> "Enter your reddit profile link.",
						"id" 		=> "reddit",
						"std" 		=> "",
						"type" 		=> "text"
				);	
				
$of_options[] = array( 	"name" 		=> "Digg",
						"desc" 		=> "Enter your digg profile link.",
						"id" 		=> "digg",
						"std" 		=> "",
						"type" 		=> "text"
				);	
*/

$of_options[] = array( 	"name" 		=> "Pinterest",
						"desc" 		=> "Enter your Pinterest profile link.",
						"id" 		=> "pinterest",
						"std" 		=> "",
						"type" 		=> "text"
				);
				
$of_options[] = array( 	"name" 		=> "Tumblr",
						"desc" 		=> "Enter your Tumblr profile link.",
						"id" 		=> "tumblr",
						"std" 		=> "",
						"type" 		=> "text"
				);	
				
$of_options[] = array( 	"name" 		=> "Flickr",
						"desc" 		=> "Enter your Flickr profile link.",
						"id" 		=> "flickr",
						"std" 		=> "",
						"type" 		=> "text"
				);
				
$of_options[] = array( 	"name" 		=> "Youtube",
						"desc" 		=> "Enter your Youtube profile link.",
						"id" 		=> "youtube",
						"std" 		=> "",
						"type" 		=> "text"
				);	
				
$of_options[] = array( 	"name" 		=> "Behance",
						"desc" 		=> "Enter your Behance profile link.",
						"id" 		=> "behance",
						"std" 		=> "",
						"type" 		=> "text"
				);
				
$of_options[] = array( 	"name" 		=> "Dribbble",
						"desc" 		=> "Enter your Dribbble profile link.",
						"id" 		=> "dribbble",
						"std" 		=> "",
						"type" 		=> "text"
				);																																													

$of_options[] = array( 	"name" 		=> "Demo Data",
						"type" 		=> "heading"
				);	
				
$of_options[] = array( 	"name" 		=> "Demo Data",
						"desc" 		=> "",
						"id" 		=> "demodata",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Demo Data</h3>
						Please go to the following link and download the latest demo data file. 
						<p><strong><a href='http://rockythemes.com/creativo/doc/creativo-demo-data.gz' target='_blank'>http://rockythemes.com/creativo/doc/creativo-demo-data.gz</a></strong></p>
						<p>You can use then use the downloaded file to import the demo data into your own WordPress theme.<br>We have also created a nice Video Tutorial on how to properly import the demo data. You can see it bellow:</p>".do_shortcode('[youtube id="vTfkZ3Yq644" width="550"]'),
						"icon" 		=> true,
						"type" 		=> "info"
				);
				
$of_options[] = array( 	"name" 		=> "Documentation",
						"type" 		=> "heading"
				);			
				
$of_options[] = array( 	"name" 		=> "Documentation",
						"desc" 		=> "",
						"id" 		=> "docs",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Documentation</h3>
						Please go to the following link to get the latest updated documentation. 
						<p><strong><a href='http://rockythemes.com/creativo/doc/' target='_blank'>http://rockythemes.com/creativo/doc/</a></strong></p>",
						"icon" 		=> true,
						"type" 		=> "info"
				);
				
$of_options[] = array( 	"name" 		=> "Video Training",
						"type" 		=> "heading"
				);	
				
$of_options[] = array( 	"name" 		=> "Video Training",
						"desc" 		=> "",
						"id" 		=> "vt",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Video Training</h3>
						Watch and learn how to use Creativo efficiently. <br />View all the video tutorials here: <a href=\"http://www.youtube.com/playlist?list=PLw5gDyOINzEwXxl8ivWRdqH3uxuQACsQg\" target=\"_blank\">RockyThemes YouTube Channel</a>",
						"icon" 		=> true,
						"type" 		=> "info"
				);
				
$of_options[] = array( 	"name" 		=> "Installing Creativo",
						"desc" 		=> "",
						"id" 		=> "ic",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Installing Creativo</h3>".do_shortcode('[youtube id="tdiEj2CKv6g" width="550"]'),
						"icon" 		=> true,
						"type" 		=> "info"
				);	
				
$of_options[] = array( 	"name" 		=> "Importing Demo Data",
						"desc" 		=> "",
						"id" 		=> "idd",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Importing Demo Data in Creativo</h3>".do_shortcode('[youtube id="vTfkZ3Yq644" width="550"]'),
						"icon" 		=> true,
						"type" 		=> "info"
				);
				
$of_options[] = array( 	"name" 		=> "Creating Home Page in Creativo",
						"desc" 		=> "",
						"id" 		=> "chp",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Creating Home Page in Creativo</h3>".do_shortcode('[youtube id="Z408pYYdSWM" width="550"]'),
						"icon" 		=> true,
						"type" 		=> "info"
				);	
				
$of_options[] = array( 	"name" 		=> "Importing Sliders in Creativo",
						"desc" 		=> "",
						"id" 		=> "is",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Importing Sliders in Creativo</h3>".do_shortcode('[youtube id="ZXXGyC7PnIo" width="550"]'),
						"icon" 		=> true,
						"type" 		=> "info"
				);	
				
$of_options[] = array( 	"name" 		=> "Creating a Post in Creativo",
						"desc" 		=> "",
						"id" 		=> "cp",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Creating a Post in Creativo</h3>".do_shortcode('[youtube id="Vh4PxsSdcr8" width="550"]'),
						"icon" 		=> true,
						"type" 		=> "info"
				);	
				
$of_options[] = array( 	"name" 		=> "Creating a New Portfolio Post",
						"desc" 		=> "",
						"id" 		=> "cpp",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Creating a New Portfolio Post</h3>".do_shortcode('[youtube id="owiB3HCI9XE" width="550"]'),
						"icon" 		=> true,
						"type" 		=> "info"
				);			
				
$of_options[] = array( 	"name" 		=> "Custom CSS",
						"type" 		=> "heading"
				);	
				
$of_options[] = array( 	"name" 		=> "Custom css text",
						"desc" 		=> "",
						"id" 		=> "ccss_text",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Custom CSS</h3>Add here your custom css rules to change the design of the theme.",
						"icon" 		=> true,
						"type" 		=> "info"
				);				
				
$of_options[] = array( 	"id" 		=> "creativo_custom_css",
						"std" 		=> "",
						"type" 		=> "textarea"
				);																																								
				
// Backup Options
$of_options[] = array( 	"name" 		=> "Backup Options",
						"type" 		=> "heading",
						"icon"		=> ADMIN_IMAGES . "icon-slider.png"
				);
				
$of_options[] = array( 	"name" 		=> "Backup and Restore Options",
						"id" 		=> "of_backup",
						"std" 		=> "",
						"type" 		=> "backup",
						"desc" 		=> 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
				);
				
$of_options[] = array( 	"name" 		=> "Transfer Theme Options Data",
						"id" 		=> "of_transfer",
						"std" 		=> "",
						"type" 		=> "transfer",
						"desc" 		=> 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".',
				);
				
	}//End function: of_options()
}//End chack if function exists: of_options()
?>
