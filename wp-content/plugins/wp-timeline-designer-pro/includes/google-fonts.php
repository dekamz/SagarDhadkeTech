<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.solwininfotech.com/
 * @since      1.0.0
 *
 * @package    Wp_Timeline_Designer_PRO_Main
 * @subpackage Wp_Timeline_Designer_PRO_Main/includes
 */

/* Google Font Array */
$google_fonts_arr = array(
	'ABeeZee'                        => array(
		'variants' => array( 'regular', 'italic' ),
		'subsets'  => array( 'latin' ),
	),
	'Abel'                           => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Abhaya Libre'                   => array(
		'variants' => array( 'regular', '500', '600', '700', '800' ),
		'subsets'  => array( 'sinhala', 'latin-ext', 'latin' ),
	),
	'Abril Fatface'                  => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Aclonica'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Acme'                           => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Actor'                          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Adamina'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Advent Pro'                     => array(
		'variants' => array( '100', '200', '300', 'regular', '500', '600', '700' ),
		'subsets'  => array( 'greek', 'latin-ext', 'latin' ),
	),
	'Aguafina Script'                => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Akronim'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Aladin'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Aldrich'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Alef'                           => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'latin', 'hebrew' ),
	),
	'Alegreya'                       => array(
		'variants' => array( 'regular', 'italic', '500', '500italic', '700', '700italic', '800', '800italic', '900', '900italic' ),
		'subsets'  => array( 'greek', 'latin-ext', 'cyrillic-ext', 'latin', 'vietnamese', 'greek-ext', 'cyrillic' ),
	),
	'Alegreya SC'                    => array(
		'variants' => array( 'regular', 'italic', '500', '500italic', '700', '700italic', '800', '800italic', '900', '900italic' ),
		'subsets'  => array( 'greek', 'latin-ext', 'cyrillic-ext', 'latin', 'vietnamese', 'greek-ext', 'cyrillic' ),
	),
	'Alegreya Sans'                  => array(
		'variants' => array( '100', '100italic', '300', '300italic', 'regular', 'italic', '500', '500italic', '700', '700italic', '800', '800italic', '900', '900italic' ),
		'subsets'  => array( 'greek', 'latin-ext', 'cyrillic-ext', 'latin', 'vietnamese', 'greek-ext', 'cyrillic' ),
	),
	'Alegreya Sans SC'               => array(
		'variants' => array( '100', '100italic', '300', '300italic', 'regular', 'italic', '500', '500italic', '700', '700italic', '800', '800italic', '900', '900italic' ),
		'subsets'  => array( 'greek', 'latin-ext', 'cyrillic-ext', 'latin', 'vietnamese', 'greek-ext', 'cyrillic' ),
	),
	'Alex Brush'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Alfa Slab One'                  => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Alice'                          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'cyrillic-ext', 'latin', 'cyrillic' ),
	),
	'Alike'                          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Alike Angular'                  => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Allan'                          => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Allerta'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Allerta Stencil'                => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Allura'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Almendra'                       => array(
		'variants' => array( 'regular', 'italic', '700', '700italic' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Almendra Display'               => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Almendra SC'                    => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Amarante'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Amaranth'                       => array(
		'variants' => array( 'regular', 'italic', '700', '700italic' ),
		'subsets'  => array( 'latin' ),
	),
	'Amatic SC'                      => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'latin-ext', 'latin', 'hebrew', 'vietnamese', 'cyrillic' ),
	),
	'Amethysta'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Amiko'                          => array(
		'variants' => array( 'regular', '600', '700' ),
		'subsets'  => array( 'devanagari', 'latin-ext', 'latin' ),
	),
	'Amiri'                          => array(
		'variants' => array( 'regular', 'italic', '700', '700italic' ),
		'subsets'  => array( 'arabic', 'latin-ext', 'latin' ),
	),
	'Amita'                          => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'devanagari', 'latin-ext', 'latin' ),
	),
	'Anaheim'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Andada'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Andika'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'cyrillic-ext', 'latin', 'vietnamese', 'cyrillic' ),
	),
	'Angkor'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'khmer' ),
	),
	'Annie Use Your Telescope'       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Anonymous Pro'                  => array(
		'variants' => array( 'regular', 'italic', '700', '700italic' ),
		'subsets'  => array( 'greek', 'latin-ext', 'latin', 'cyrillic' ),
	),
	'Antic'                          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Antic Didone'                   => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Antic Slab'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Anton'                          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Arapey'                         => array(
		'variants' => array( 'regular', 'italic' ),
		'subsets'  => array( 'latin' ),
	),
	'Arbutus'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Arbutus Slab'                   => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Architects Daughter'            => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Archivo'                        => array(
		'variants' => array( 'regular', 'italic', '500', '500italic', '600', '600italic', '700', '700italic' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Archivo Black'                  => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Archivo Narrow'                 => array(
		'variants' => array( 'regular', 'italic', '500', '500italic', '600', '600italic', '700', '700italic' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Aref Ruqaa'                     => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'arabic', 'latin' ),
	),
	'Arima Madurai'                  => array(
		'variants' => array( '100', '200', '300', 'regular', '500', '700', '800', '900' ),
		'subsets'  => array( 'latin-ext', 'tamil', 'latin', 'vietnamese' ),
	),
	'Arimo'                          => array(
		'variants' => array( 'regular', 'italic', '700', '700italic' ),
		'subsets'  => array( 'greek', 'latin-ext', 'cyrillic-ext', 'latin', 'hebrew', 'vietnamese', 'greek-ext', 'cyrillic' ),
	),
	'Arizonia'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Armata'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Arsenal'                        => array(
		'variants' => array( 'regular', 'italic', '700', '700italic' ),
		'subsets'  => array( 'latin-ext', 'cyrillic-ext', 'latin', 'vietnamese', 'cyrillic' ),
	),
	'Artifika'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Arvo'                           => array(
		'variants' => array( 'regular', 'italic', '700', '700italic' ),
		'subsets'  => array( 'latin' ),
	),
	'Arya'                           => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'devanagari', 'latin-ext', 'latin' ),
	),
	'Asap'                           => array(
		'variants' => array( 'regular', 'italic', '500', '500italic', '600', '600italic', '700', '700italic' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Asap Condensed'                 => array(
		'variants' => array( 'regular', 'italic', '500', '500italic', '600', '600italic', '700', '700italic' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Asar'                           => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'devanagari', 'latin-ext', 'latin' ),
	),
	'Asset'                          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Assistant'                      => array(
		'variants' => array( '200', '300', 'regular', '600', '700', '800' ),
		'subsets'  => array( 'latin', 'hebrew' ),
	),
	'Astloch'                        => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'latin' ),
	),
	'Asul'                           => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'latin' ),
	),
	'Athiti'                         => array(
		'variants' => array( '200', '300', 'regular', '500', '600', '700' ),
		'subsets'  => array( 'latin-ext', 'thai', 'latin', 'vietnamese' ),
	),
	'Atma'                           => array(
		'variants' => array( '300', 'regular', '500', '600', '700' ),
		'subsets'  => array( 'latin-ext', 'latin', 'bengali' ),
	),
	'Atomic Age'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Aubrey'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Audiowide'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Autour One'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Average'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Average Sans'                   => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Averia Gruesa Libre'            => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Averia Libre'                   => array(
		'variants' => array( '300', '300italic', 'regular', 'italic', '700', '700italic' ),
		'subsets'  => array( 'latin' ),
	),
	'Averia Sans Libre'              => array(
		'variants' => array( '300', '300italic', 'regular', 'italic', '700', '700italic' ),
		'subsets'  => array( 'latin' ),
	),
	'Averia Serif Libre'             => array(
		'variants' => array( '300', '300italic', 'regular', 'italic', '700', '700italic' ),
		'subsets'  => array( 'latin' ),
	),
	'Bad Script'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin', 'cyrillic' ),
	),
	'Bahiana'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Baloo'                          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'devanagari', 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Baloo Bhai'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese', 'gujarati' ),
	),
	'Baloo Bhaijaan'                 => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'arabic', 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Baloo Bhaina'                   => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'oriya', 'latin', 'vietnamese' ),
	),
	'Baloo Chettan'                  => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'malayalam', 'latin', 'vietnamese' ),
	),
	'Baloo Da'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin', 'bengali', 'vietnamese' ),
	),
	'Baloo Paaji'                    => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin', 'gurmukhi', 'vietnamese' ),
	),
	'Baloo Tamma'                    => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'kannada', 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Baloo Tammudu'                  => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin', 'telugu', 'vietnamese' ),
	),
	'Baloo Thambi'                   => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'tamil', 'latin', 'vietnamese' ),
	),
	'Balthazar'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Bangers'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Barlow'                         => array(
		'variants' => array( '100', '100italic', '200', '200italic', '300', '300italic', 'regular', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Barlow Condensed'               => array(
		'variants' => array( '100', '100italic', '200', '200italic', '300', '300italic', 'regular', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Barlow Semi Condensed'          => array(
		'variants' => array( '100', '100italic', '200', '200italic', '300', '300italic', 'regular', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Barrio'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Basic'                          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Battambang'                     => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'khmer' ),
	),
	'Baumans'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Bayon'                          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'khmer' ),
	),
	'Bebas Neue, cursive'            => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Belgrano'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Bellefair'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin', 'hebrew' ),
	),
	'Belleza'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'BenchNine'                      => array(
		'variants' => array( '300', 'regular', '700' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Bentham'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Berkshire Swash'                => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Bevan'                          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Bigelow Rules'                  => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Bigshot One'                    => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Bilbo'                          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Bilbo Swash Caps'               => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'BioRhyme'                       => array(
		'variants' => array( '200', '300', 'regular', '700', '800' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'BioRhyme Expanded'              => array(
		'variants' => array( '200', '300', 'regular', '700', '800' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Biryani'                        => array(
		'variants' => array( '200', '300', 'regular', '600', '700', '800', '900' ),
		'subsets'  => array( 'devanagari', 'latin-ext', 'latin' ),
	),
	'Bitter'                         => array(
		'variants' => array( 'regular', 'italic', '700' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Black Ops One'                  => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Bokor'                          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'khmer' ),
	),
	'Bonbon'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Boogaloo'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Bowlby One'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Bowlby One SC'                  => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Brawler'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Bree Serif'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Bubblegum Sans'                 => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Bubbler One'                    => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Buda'                           => array(
		'variants' => array( '300' ),
		'subsets'  => array( 'latin' ),
	),
	'Buenard'                        => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Bungee'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Bungee Hairline'                => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Bungee Inline'                  => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Bungee Outline'                 => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Bungee Shade'                   => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Butcherman'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Butterfly Kids'                 => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Cabin'                          => array(
		'variants' => array( 'regular', 'italic', '500', '500italic', '600', '600italic', '700', '700italic' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Cabin Condensed'                => array(
		'variants' => array( 'regular', '500', '600', '700' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Cabin Sketch'                   => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'latin' ),
	),
	'Caesar Dressing'                => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Cagliostro'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Cairo'                          => array(
		'variants' => array( '200', '300', 'regular', '600', '700', '900' ),
		'subsets'  => array( 'arabic', 'latin-ext', 'latin' ),
	),
	'Calligraffitti'                 => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Cambay'                         => array(
		'variants' => array( 'regular', 'italic', '700', '700italic' ),
		'subsets'  => array( 'devanagari', 'latin-ext', 'latin' ),
	),
	'Cambo'                          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Candal'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Cantarell'                      => array(
		'variants' => array( 'regular', 'italic', '700', '700italic' ),
		'subsets'  => array( 'latin' ),
	),
	'Cantata One'                    => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Cantora One'                    => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Capriola'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Cardo'                          => array(
		'variants' => array( 'regular', 'italic', '700' ),
		'subsets'  => array( 'greek', 'latin-ext', 'latin', 'greek-ext' ),
	),
	'Carme'                          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Carrois Gothic'                 => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Carrois Gothic SC'              => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Carter One'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Catamaran'                      => array(
		'variants' => array( '100', '200', '300', 'regular', '500', '600', '700', '800', '900' ),
		'subsets'  => array( 'latin-ext', 'tamil', 'latin' ),
	),
	'Caudex'                         => array(
		'variants' => array( 'regular', 'italic', '700', '700italic' ),
		'subsets'  => array( 'greek', 'latin-ext', 'latin', 'greek-ext' ),
	),
	'Caveat'                         => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'latin-ext', 'latin', 'cyrillic' ),
	),
	'Caveat Brush'                   => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Cedarville Cursive'             => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Ceviche One'                    => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Changa'                         => array(
		'variants' => array( '200', '300', 'regular', '500', '600', '700', '800' ),
		'subsets'  => array( 'arabic', 'latin-ext', 'latin' ),
	),
	'Changa One'                     => array(
		'variants' => array( 'regular', 'italic' ),
		'subsets'  => array( 'latin' ),
	),
	'Chango'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Chathura'                       => array(
		'variants' => array( '100', '300', 'regular', '700', '800' ),
		'subsets'  => array( 'latin', 'telugu' ),
	),
	'Chau Philomene One'             => array(
		'variants' => array( 'regular', 'italic' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Chela One'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Chelsea Market'                 => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Chenla'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'khmer' ),
	),
	'Cherry Cream Soda'              => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Cherry Swash'                   => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Chewy'                          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Chicle'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Chivo'                          => array(
		'variants' => array( '300', '300italic', 'regular', 'italic', '700', '700italic', '900', '900italic' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Chonburi'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'thai', 'latin', 'vietnamese' ),
	),
	'Cinzel'                         => array(
		'variants' => array( 'regular', '700', '900' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Cinzel Decorative'              => array(
		'variants' => array( 'regular', '700', '900' ),
		'subsets'  => array( 'latin' ),
	),
	'Clicker Script'                 => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Coda'                           => array(
		'variants' => array( 'regular', '800' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Coda Caption'                   => array(
		'variants' => array( '800' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Codystar'                       => array(
		'variants' => array( '300', 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Coiny'                          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'tamil', 'latin', 'vietnamese' ),
	),
	'Combo'                          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Comfortaa'                      => array(
		'variants' => array( '300', 'regular', '700' ),
		'subsets'  => array( 'greek', 'latin-ext', 'cyrillic-ext', 'latin', 'vietnamese', 'cyrillic' ),
	),
	'Coming Soon'                    => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Concert One'                    => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Condiment'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Content'                        => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'khmer' ),
	),
	'Contrail One'                   => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Convergence'                    => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Cookie'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Copse'                          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Corben'                         => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Cormorant'                      => array(
		'variants' => array( '300', '300italic', 'regular', 'italic', '500', '500italic', '600', '600italic', '700', '700italic' ),
		'subsets'  => array( 'latin-ext', 'cyrillic-ext', 'latin', 'vietnamese', 'cyrillic' ),
	),
	'Cormorant Garamond'             => array(
		'variants' => array( '300', '300italic', 'regular', 'italic', '500', '500italic', '600', '600italic', '700', '700italic' ),
		'subsets'  => array( 'latin-ext', 'cyrillic-ext', 'latin', 'vietnamese', 'cyrillic' ),
	),
	'Cormorant Infant'               => array(
		'variants' => array( '300', '300italic', 'regular', 'italic', '500', '500italic', '600', '600italic', '700', '700italic' ),
		'subsets'  => array( 'latin-ext', 'cyrillic-ext', 'latin', 'vietnamese', 'cyrillic' ),
	),
	'Cormorant SC'                   => array(
		'variants' => array( '300', 'regular', '500', '600', '700' ),
		'subsets'  => array( 'latin-ext', 'cyrillic-ext', 'latin', 'vietnamese', 'cyrillic' ),
	),
	'Cormorant Unicase'              => array(
		'variants' => array( '300', 'regular', '500', '600', '700' ),
		'subsets'  => array( 'latin-ext', 'cyrillic-ext', 'latin', 'vietnamese', 'cyrillic' ),
	),
	'Cormorant Upright'              => array(
		'variants' => array( '300', 'regular', '500', '600', '700' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Courgette'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Cousine'                        => array(
		'variants' => array( 'regular', 'italic', '700', '700italic' ),
		'subsets'  => array( 'greek', 'latin-ext', 'cyrillic-ext', 'latin', 'hebrew', 'vietnamese', 'greek-ext', 'cyrillic' ),
	),
	'Coustard'                       => array(
		'variants' => array( 'regular', '900' ),
		'subsets'  => array( 'latin' ),
	),
	'Covered By Your Grace'          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Crafty Girls'                   => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Creepster'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Crete Round'                    => array(
		'variants' => array( 'regular', 'italic' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Crimson Text'                   => array(
		'variants' => array( 'regular', 'italic', '600', '600italic', '700', '700italic' ),
		'subsets'  => array( 'latin' ),
	),
	'Croissant One'                  => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Crushed'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Cuprum'                         => array(
		'variants' => array( 'regular', 'italic', '700', '700italic' ),
		'subsets'  => array( 'latin-ext', 'cyrillic-ext', 'latin', 'vietnamese', 'cyrillic' ),
	),
	'Cutive'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Cutive Mono'                    => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Damion'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Dancing Script'                 => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Dangrek'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'khmer' ),
	),
	'David Libre'                    => array(
		'variants' => array( 'regular', '500', '700' ),
		'subsets'  => array( 'latin-ext', 'latin', 'hebrew', 'vietnamese' ),
	),
	'Dawning of a New Day'           => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Days One'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Dekko'                          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'devanagari', 'latin-ext', 'latin' ),
	),
	'Delius'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Delius Swash Caps'              => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Delius Unicase'                 => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'latin' ),
	),
	'Della Respira'                  => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Denk One'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Devonshire'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Dhurjati'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin', 'telugu' ),
	),
	'Didact Gothic'                  => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'greek', 'latin-ext', 'cyrillic-ext', 'latin', 'greek-ext', 'cyrillic' ),
	),
	'Diplomata'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Diplomata SC'                   => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Domine'                         => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Donegal One'                    => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Doppio One'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Dorsa'                          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Dosis'                          => array(
		'variants' => array( '200', '300', 'regular', '500', '600', '700', '800' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Dr Sugiyama'                    => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Duru Sans'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Dynalight'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'EB Garamond'                    => array(
		'variants' => array( 'regular', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic' ),
		'subsets'  => array( 'greek', 'latin-ext', 'cyrillic-ext', 'latin', 'vietnamese', 'greek-ext', 'cyrillic' ),
	),
	'Eagle Lake'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Eater'                          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Economica'                      => array(
		'variants' => array( 'regular', 'italic', '700', '700italic' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Eczar'                          => array(
		'variants' => array( 'regular', '500', '600', '700', '800' ),
		'subsets'  => array( 'devanagari', 'latin-ext', 'latin' ),
	),
	'El Messiri'                     => array(
		'variants' => array( 'regular', '500', '600', '700' ),
		'subsets'  => array( 'arabic', 'latin', 'cyrillic' ),
	),
	'Electrolize'                    => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Elsie'                          => array(
		'variants' => array( 'regular', '900' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Elsie Swash Caps'               => array(
		'variants' => array( 'regular', '900' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Emblema One'                    => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Emilys Candy'                   => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Encode Sans'                    => array(
		'variants' => array( '100', '200', '300', 'regular', '500', '600', '700', '800', '900' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Encode Sans Condensed'          => array(
		'variants' => array( '100', '200', '300', 'regular', '500', '600', '700', '800', '900' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Encode Sans Expanded'           => array(
		'variants' => array( '100', '200', '300', 'regular', '500', '600', '700', '800', '900' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Encode Sans Semi Condensed'     => array(
		'variants' => array( '100', '200', '300', 'regular', '500', '600', '700', '800', '900' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Encode Sans Semi Expanded'      => array(
		'variants' => array( '100', '200', '300', 'regular', '500', '600', '700', '800', '900' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Engagement'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Englebert'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Enriqueta'                      => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Erica One'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Esteban'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Euphoria Script'                => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Ewert'                          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Exo'                            => array(
		'variants' => array( '100', '100italic', '200', '200italic', '300', '300italic', 'regular', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Exo 2'                          => array(
		'variants' => array( '100', '100italic', '200', '200italic', '300', '300italic', 'regular', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic' ),
		'subsets'  => array( 'latin-ext', 'latin', 'cyrillic' ),
	),
	'Expletus Sans'                  => array(
		'variants' => array( 'regular', 'italic', '500', '500italic', '600', '600italic', '700', '700italic' ),
		'subsets'  => array( 'latin' ),
	),
	'Fanwood Text'                   => array(
		'variants' => array( 'regular', 'italic' ),
		'subsets'  => array( 'latin' ),
	),
	'Farsan'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese', 'gujarati' ),
	),
	'Fascinate'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Fascinate Inline'               => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Faster One'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Fasthand'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'khmer' ),
	),
	'Fauna One'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Faustina'                       => array(
		'variants' => array( 'regular', 'italic', '500', '500italic', '600', '600italic', '700', '700italic' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Federant'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Federo'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Felipa'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Fenix'                          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Finger Paint'                   => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Fira Mono'                      => array(
		'variants' => array( 'regular', '500', '700' ),
		'subsets'  => array( 'greek', 'latin-ext', 'cyrillic-ext', 'latin', 'greek-ext', 'cyrillic' ),
	),
	'Fira Sans'                      => array(
		'variants' => array( '100', '100italic', '200', '200italic', '300', '300italic', 'regular', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic' ),
		'subsets'  => array( 'greek', 'latin-ext', 'cyrillic-ext', 'latin', 'vietnamese', 'greek-ext', 'cyrillic' ),
	),
	'Fira Sans Condensed'            => array(
		'variants' => array( '100', '100italic', '200', '200italic', '300', '300italic', 'regular', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic' ),
		'subsets'  => array( 'greek', 'latin-ext', 'cyrillic-ext', 'latin', 'vietnamese', 'greek-ext', 'cyrillic' ),
	),
	'Fira Sans Extra Condensed'      => array(
		'variants' => array( '100', '100italic', '200', '200italic', '300', '300italic', 'regular', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic' ),
		'subsets'  => array( 'greek', 'latin-ext', 'cyrillic-ext', 'latin', 'vietnamese', 'greek-ext', 'cyrillic' ),
	),
	'Fjalla One'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Fjord One'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Flamenco'                       => array(
		'variants' => array( '300', 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Flavors'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Fondamento'                     => array(
		'variants' => array( 'regular', 'italic' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Fontdiner Swanky'               => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Forum'                          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'cyrillic-ext', 'latin', 'cyrillic' ),
	),
	'Francois One'                   => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Frank Ruhl Libre'               => array(
		'variants' => array( '300', 'regular', '500', '700', '900' ),
		'subsets'  => array( 'latin-ext', 'latin', 'hebrew' ),
	),
	'Freckle Face'                   => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Fredericka the Great'           => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Fredoka One'                    => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Freehand'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'khmer' ),
	),
	'Fresca'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Frijole'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Fruktur'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Fugaz One'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'GFS Didot'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'greek' ),
	),
	'GFS Neohellenic'                => array(
		'variants' => array( 'regular', 'italic', '700', '700italic' ),
		'subsets'  => array( 'greek' ),
	),
	'Gabriela'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'cyrillic-ext', 'latin', 'cyrillic' ),
	),
	'Gafata'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Galada'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin', 'bengali' ),
	),
	'Galdeano'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Galindo'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Gentium Basic'                  => array(
		'variants' => array( 'regular', 'italic', '700', '700italic' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Gentium Book Basic'             => array(
		'variants' => array( 'regular', 'italic', '700', '700italic' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Geo'                            => array(
		'variants' => array( 'regular', 'italic' ),
		'subsets'  => array( 'latin' ),
	),
	'Geostar'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Geostar Fill'                   => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Germania One'                   => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Gidugu'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin', 'telugu' ),
	),
	'Gilda Display'                  => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Give You Glory'                 => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Glass Antiqua'                  => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Glegoo'                         => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'devanagari', 'latin-ext', 'latin' ),
	),
	'Gloria Hallelujah'              => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Goblin One'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Gochi Hand'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Gorditas'                       => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'latin' ),
	),
	'Goudy Bookletter 1911'          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Graduate'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Grand Hotel'                    => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Gravitas One'                   => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Great Vibes'                    => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Griffy'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Gruppo'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Gudea'                          => array(
		'variants' => array( 'regular', 'italic', '700' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Gurajada'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin', 'telugu' ),
	),
	'Habibi'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Halant'                         => array(
		'variants' => array( '300', 'regular', '500', '600', '700' ),
		'subsets'  => array( 'devanagari', 'latin-ext', 'latin' ),
	),
	'Hammersmith One'                => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Hanalei'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Hanalei Fill'                   => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Handlee'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Hanuman'                        => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'khmer' ),
	),
	'Happy Monkey'                   => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Harmattan'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'arabic', 'latin' ),
	),
	'Headland One'                   => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Heebo'                          => array(
		'variants' => array( '100', '300', 'regular', '500', '700', '800', '900' ),
		'subsets'  => array( 'latin', 'hebrew' ),
	),
	'Henny Penny'                    => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Herr Von Muellerhoff'           => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Hind'                           => array(
		'variants' => array( '300', 'regular', '500', '600', '700' ),
		'subsets'  => array( 'devanagari', 'latin-ext', 'latin' ),
	),
	'Hind Guntur'                    => array(
		'variants' => array( '300', 'regular', '500', '600', '700' ),
		'subsets'  => array( 'latin-ext', 'latin', 'telugu' ),
	),
	'Hind Madurai'                   => array(
		'variants' => array( '300', 'regular', '500', '600', '700' ),
		'subsets'  => array( 'latin-ext', 'tamil', 'latin' ),
	),
	'Hind Siliguri'                  => array(
		'variants' => array( '300', 'regular', '500', '600', '700' ),
		'subsets'  => array( 'latin-ext', 'latin', 'bengali' ),
	),
	'Hind Vadodara'                  => array(
		'variants' => array( '300', 'regular', '500', '600', '700' ),
		'subsets'  => array( 'latin-ext', 'latin', 'gujarati' ),
	),
	'Holtwood One SC'                => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Homemade Apple'                 => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Homenaje'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'IM Fell DW Pica'                => array(
		'variants' => array( 'regular', 'italic' ),
		'subsets'  => array( 'latin' ),
	),
	'IM Fell DW Pica SC'             => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'IM Fell Double Pica'            => array(
		'variants' => array( 'regular', 'italic' ),
		'subsets'  => array( 'latin' ),
	),
	'IM Fell Double Pica SC'         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'IM Fell English'                => array(
		'variants' => array( 'regular', 'italic' ),
		'subsets'  => array( 'latin' ),
	),
	'IM Fell English SC'             => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'IM Fell French Canon'           => array(
		'variants' => array( 'regular', 'italic' ),
		'subsets'  => array( 'latin' ),
	),
	'IM Fell French Canon SC'        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'IM Fell Great Primer'           => array(
		'variants' => array( 'regular', 'italic' ),
		'subsets'  => array( 'latin' ),
	),
	'IM Fell Great Primer SC'        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Iceberg'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Iceland'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Imprima'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Inconsolata'                    => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Inder'                          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Indie Flower'                   => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Inika'                          => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Inknut Antiqua'                 => array(
		'variants' => array( '300', 'regular', '500', '600', '700', '800', '900' ),
		'subsets'  => array( 'devanagari', 'latin-ext', 'latin' ),
	),
	'Irish Grover'                   => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Istok Web'                      => array(
		'variants' => array( 'regular', 'italic', '700', '700italic' ),
		'subsets'  => array( 'latin-ext', 'cyrillic-ext', 'latin', 'cyrillic' ),
	),
	'Italiana'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Italianno'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Itim'                           => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'thai', 'latin', 'vietnamese' ),
	),
	'Jacques Francois'               => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Jacques Francois Shadow'        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Jaldi'                          => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'devanagari', 'latin-ext', 'latin' ),
	),
	'Jim Nightshade'                 => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Jockey One'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Jolly Lodger'                   => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Jomhuria'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'arabic', 'latin-ext', 'latin' ),
	),
	'Josefin Sans'                   => array(
		'variants' => array( '100', '100italic', '300', '300italic', 'regular', 'italic', '600', '600italic', '700', '700italic' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Josefin Slab'                   => array(
		'variants' => array( '100', '100italic', '300', '300italic', 'regular', 'italic', '600', '600italic', '700', '700italic' ),
		'subsets'  => array( 'latin' ),
	),
	'Joti One'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Judson'                         => array(
		'variants' => array( 'regular', 'italic', '700' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Julee'                          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Julius Sans One'                => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Junge'                          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Jura'                           => array(
		'variants' => array( '300', 'regular', '500', '600', '700' ),
		'subsets'  => array( 'greek', 'latin-ext', 'cyrillic-ext', 'latin', 'vietnamese', 'greek-ext', 'cyrillic' ),
	),
	'Just Another Hand'              => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Just Me Again Down Here'        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Kadwa'                          => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'devanagari', 'latin' ),
	),
	'Kalam'                          => array(
		'variants' => array( '300', 'regular', '700' ),
		'subsets'  => array( 'devanagari', 'latin-ext', 'latin' ),
	),
	'Kameron'                        => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'latin' ),
	),
	'Kanit'                          => array(
		'variants' => array( '100', '100italic', '200', '200italic', '300', '300italic', 'regular', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic' ),
		'subsets'  => array( 'latin-ext', 'thai', 'latin', 'vietnamese' ),
	),
	'Kantumruy'                      => array(
		'variants' => array( '300', 'regular', '700' ),
		'subsets'  => array( 'khmer' ),
	),
	'Karla'                          => array(
		'variants' => array( 'regular', 'italic', '700', '700italic' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Karma'                          => array(
		'variants' => array( '300', 'regular', '500', '600', '700' ),
		'subsets'  => array( 'devanagari', 'latin-ext', 'latin' ),
	),
	'Katibeh'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'arabic', 'latin-ext', 'latin' ),
	),
	'Kaushan Script'                 => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Kavivanar'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'tamil', 'latin' ),
	),
	'Kavoon'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Kdam Thmor'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'khmer' ),
	),
	'Keania One'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Kelly Slab'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin', 'cyrillic' ),
	),
	'Kenia'                          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Khand'                          => array(
		'variants' => array( '300', 'regular', '500', '600', '700' ),
		'subsets'  => array( 'devanagari', 'latin-ext', 'latin' ),
	),
	'Khmer'                          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'khmer' ),
	),
	'Khula'                          => array(
		'variants' => array( '300', 'regular', '600', '700', '800' ),
		'subsets'  => array( 'devanagari', 'latin-ext', 'latin' ),
	),
	'Kite One'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Knewave'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Kotta One'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Koulen'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'khmer' ),
	),
	'Kranky'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Kreon'                          => array(
		'variants' => array( '300', 'regular', '700' ),
		'subsets'  => array( 'latin' ),
	),
	'Kristi'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Krona One'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Kumar One'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin', 'gujarati' ),
	),
	'Kumar One Outline'              => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin', 'gujarati' ),
	),
	'Kurale'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'devanagari', 'latin-ext', 'cyrillic-ext', 'latin', 'cyrillic' ),
	),
	'La Belle Aurore'                => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Laila'                          => array(
		'variants' => array( '300', 'regular', '500', '600', '700' ),
		'subsets'  => array( 'devanagari', 'latin-ext', 'latin' ),
	),
	'Lakki Reddy'                    => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin', 'telugu' ),
	),
	'Lalezar'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'arabic', 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Lancelot'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Lateef'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'arabic', 'latin' ),
	),
	'Lato'                           => array(
		'variants' => array( '100', '100italic', '300', '300italic', 'regular', 'italic', '700', '700italic', '900', '900italic' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Lato, sans-serif'               => array(
		'variants' => array( '100', '100italic', '300', '300italic', 'regular', 'italic', '700', '700italic', '900', '900italic' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'League Script'                  => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Leckerli One'                   => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Ledger'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin', 'cyrillic' ),
	),
	'Lekton'                         => array(
		'variants' => array( 'regular', 'italic', '700' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Lemon'                          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Lemonada'                       => array(
		'variants' => array( '300', 'regular', '600', '700' ),
		'subsets'  => array( 'arabic', 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Libre Barcode 128'              => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Libre Barcode 128 Text'         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Libre Barcode 39'               => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Libre Barcode 39 Extended'      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Libre Barcode 39 Extended Text' => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Libre Barcode 39 Text'          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Libre Baskerville'              => array(
		'variants' => array( 'regular', 'italic', '700' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Libre Franklin'                 => array(
		'variants' => array( '100', '100italic', '200', '200italic', '300', '300italic', 'regular', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Life Savers'                    => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Lilita One'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Lily Script One'                => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Limelight'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Linden Hill'                    => array(
		'variants' => array( 'regular', 'italic' ),
		'subsets'  => array( 'latin' ),
	),
	'Lobster'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'cyrillic-ext', 'latin', 'vietnamese', 'cyrillic' ),
	),
	'Lobster Two'                    => array(
		'variants' => array( 'regular', 'italic', '700', '700italic' ),
		'subsets'  => array( 'latin' ),
	),
	'Londrina Outline'               => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Londrina Shadow'                => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Londrina Sketch'                => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Londrina Solid'                 => array(
		'variants' => array( '100', '300', 'regular', '900' ),
		'subsets'  => array( 'latin' ),
	),
	'Lora'                           => array(
		'variants' => array( 'regular', 'italic', '700', '700italic' ),
		'subsets'  => array( 'latin-ext', 'cyrillic-ext', 'latin', 'vietnamese', 'cyrillic' ),
	),
	'Love Ya Like A Sister'          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Loved by the King'              => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Lovers Quarrel'                 => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Luckiest Guy'                   => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Lusitana'                       => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'latin' ),
	),
	'Lustria'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Macondo'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Macondo Swash Caps'             => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Mada'                           => array(
		'variants' => array( '200', '300', 'regular', '500', '600', '700', '900' ),
		'subsets'  => array( 'arabic', 'latin' ),
	),
	'Magra'                          => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Maiden Orange'                  => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Maitree'                        => array(
		'variants' => array( '200', '300', 'regular', '500', '600', '700' ),
		'subsets'  => array( 'latin-ext', 'thai', 'latin', 'vietnamese' ),
	),
	'Mako'                           => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Mallanna'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin', 'telugu' ),
	),
	'Mandali'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin', 'telugu' ),
	),
	'Manuale'                        => array(
		'variants' => array( 'regular', 'italic', '500', '500italic', '600', '600italic', '700', '700italic' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Marcellus'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Marcellus SC'                   => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Marck Script'                   => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin', 'cyrillic' ),
	),
	'Margarine'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Marko One'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Marmelad'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin', 'cyrillic' ),
	),
	'Martel'                         => array(
		'variants' => array( '200', '300', 'regular', '600', '700', '800', '900' ),
		'subsets'  => array( 'devanagari', 'latin-ext', 'latin' ),
	),
	'Martel Sans'                    => array(
		'variants' => array( '200', '300', 'regular', '600', '700', '800', '900' ),
		'subsets'  => array( 'devanagari', 'latin-ext', 'latin' ),
	),
	'Marvel'                         => array(
		'variants' => array( 'regular', 'italic', '700', '700italic' ),
		'subsets'  => array( 'latin' ),
	),
	'Mate'                           => array(
		'variants' => array( 'regular', 'italic' ),
		'subsets'  => array( 'latin' ),
	),
	'Mate SC'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Maven Pro'                      => array(
		'variants' => array( 'regular', '500', '700', '900' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'McLaren'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Meddon'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'MedievalSharp'                  => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Medula One'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Meera Inimai'                   => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'tamil', 'latin' ),
	),
	'Megrim'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Meie Script'                    => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Merienda'                       => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Merienda One'                   => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Merriweather'                   => array(
		'variants' => array( '300', '300italic', 'regular', 'italic', '700', '700italic', '900', '900italic' ),
		'subsets'  => array( 'latin-ext', 'cyrillic-ext', 'latin', 'vietnamese', 'cyrillic' ),
	),
	'Merriweather Sans'              => array(
		'variants' => array( '300', '300italic', 'regular', 'italic', '700', '700italic', '800', '800italic' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Metal'                          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'khmer' ),
	),
	'Metal Mania'                    => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Metamorphous'                   => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Metrophobic'                    => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Michroma'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Milonga'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Miltonian'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Miltonian Tattoo'               => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Mina'                           => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'latin-ext', 'latin', 'bengali' ),
	),
	'Miniver'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Miriam Libre'                   => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'latin-ext', 'latin', 'hebrew' ),
	),
	'Mirza'                          => array(
		'variants' => array( 'regular', '500', '600', '700' ),
		'subsets'  => array( 'arabic', 'latin-ext', 'latin' ),
	),
	'Miss Fajardose'                 => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Mitr'                           => array(
		'variants' => array( '200', '300', 'regular', '500', '600', '700' ),
		'subsets'  => array( 'latin-ext', 'thai', 'latin', 'vietnamese' ),
	),
	'Modak'                          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'devanagari', 'latin-ext', 'latin' ),
	),
	'Modern Antiqua'                 => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Mogra'                          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin', 'gujarati' ),
	),
	'Molengo'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Molle'                          => array(
		'variants' => array( 'italic' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Monda'                          => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Monofett'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Monoton'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Monsieur La Doulaise'           => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Montaga'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Montez'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Montserrat'                     => array(
		'variants' => array( '100', '100italic', '200', '200italic', '300', '300italic', 'regular', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic' ),
		'subsets'  => array( 'latin-ext', 'cyrillic-ext', 'latin', 'vietnamese', 'cyrillic' ),
	),
	'Montserrat, sans-serif'         => array(
		'variants' => array( '100', '100italic', '200', '200italic', '300', '300italic', 'regular', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic' ),
		'subsets'  => array( 'latin-ext', 'cyrillic-ext', 'latin', 'vietnamese', 'cyrillic' ),
	),
	'Montserrat Alternates'          => array(
		'variants' => array( '100', '100italic', '200', '200italic', '300', '300italic', 'regular', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic' ),
		'subsets'  => array( 'latin-ext', 'cyrillic-ext', 'latin', 'vietnamese', 'cyrillic' ),
	),
	'Montserrat Subrayada'           => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'latin' ),
	),
	'Moul'                           => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'khmer' ),
	),
	'Moulpali'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'khmer' ),
	),
	'Mountains of Christmas'         => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'latin' ),
	),
	'Mouse Memoirs'                  => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Mr Bedfort'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Mr Dafoe'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Mr De Haviland'                 => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Mrs Saint Delafield'            => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Mrs Sheppards'                  => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Mukta'                          => array(
		'variants' => array( '200', '300', 'regular', '500', '600', '700', '800' ),
		'subsets'  => array( 'devanagari', 'latin-ext', 'latin' ),
	),
	'Mukta Mahee'                    => array(
		'variants' => array( '200', '300', 'regular', '500', '600', '700', '800' ),
		'subsets'  => array( 'latin-ext', 'latin', 'gurmukhi' ),
	),
	'Mukta Malar'                    => array(
		'variants' => array( '200', '300', 'regular', '500', '600', '700', '800' ),
		'subsets'  => array( 'latin-ext', 'tamil', 'latin' ),
	),
	'Mukta Vaani'                    => array(
		'variants' => array( '200', '300', 'regular', '500', '600', '700', '800' ),
		'subsets'  => array( 'latin-ext', 'latin', 'gujarati' ),
	),
	'Muli'                           => array(
		'variants' => array( '200', '200italic', '300', '300italic', 'regular', 'italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Mystery Quest'                  => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'NTR'                            => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin', 'telugu' ),
	),
	'Nanum Brush Script'             => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'korean', 'latin' ),
	),
	'Nanum Gothic'                   => array(
		'variants' => array( 'regular', '700', '800' ),
		'subsets'  => array( 'korean', 'latin' ),
	),
	'Nanum Gothic Coding'            => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'korean', 'latin' ),
	),
	'Nanum Myeongjo'                 => array(
		'variants' => array( 'regular', '700', '800' ),
		'subsets'  => array( 'korean', 'latin' ),
	),
	'Nanum Pen Script'               => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'korean', 'latin' ),
	),
	'Neucha'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin', 'cyrillic' ),
	),
	'Neuton'                         => array(
		'variants' => array( '200', '300', 'regular', 'italic', '700', '800' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'New Rocker'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'News Cycle'                     => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Niconne'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Nixie One'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Nobile'                         => array(
		'variants' => array( 'regular', 'italic', '500', '500italic', '700', '700italic' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Nokora'                         => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'khmer' ),
	),
	'Norican'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Nosifer'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Nothing You Could Do'           => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Noticia Text'                   => array(
		'variants' => array( 'regular', 'italic', '700', '700italic' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Noto Sans'                      => array(
		'variants' => array( 'regular', 'italic', '700', '700italic' ),
		'subsets'  => array( 'greek', 'devanagari', 'latin-ext', 'cyrillic-ext', 'latin', 'vietnamese', 'greek-ext', 'cyrillic' ),
	),
	'Noto Serif'                     => array(
		'variants' => array( 'regular', 'italic', '700', '700italic' ),
		'subsets'  => array( 'greek', 'latin-ext', 'cyrillic-ext', 'latin', 'vietnamese', 'greek-ext', 'cyrillic' ),
	),
	'Nova Cut'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Nova Flat'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Nova Mono'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'greek', 'latin' ),
	),
	'Nova Oval'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Nova Round'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Nova Script'                    => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Nova Slim'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Nova Square'                    => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Numans'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Nunito'                         => array(
		'variants' => array( '200', '200italic', '300', '300italic', 'regular', 'italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Nunito Sans'                    => array(
		'variants' => array( '200', '200italic', '300', '300italic', 'regular', 'italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Odor Mean Chey'                 => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'khmer' ),
	),
	'Offside'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Old Standard TT'                => array(
		'variants' => array( 'regular', 'italic', '700' ),
		'subsets'  => array( 'latin-ext', 'cyrillic-ext', 'latin', 'vietnamese', 'cyrillic' ),
	),
	'Oldenburg'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Oleo Script'                    => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Oleo Script Swash Caps'         => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Open Sans'                      => array(
		'variants' => array( '300', '300italic', 'regular', 'italic', '600', '600italic', '700', '700italic', '800', '800italic' ),
		'subsets'  => array( 'greek', 'latin-ext', 'cyrillic-ext', 'latin', 'vietnamese', 'greek-ext', 'cyrillic' ),
	),
	'Open Sans Condensed'            => array(
		'variants' => array( '300', '300italic', '700' ),
		'subsets'  => array( 'greek', 'latin-ext', 'cyrillic-ext', 'latin', 'vietnamese', 'greek-ext', 'cyrillic' ),
	),
	'Oranienbaum'                    => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'cyrillic-ext', 'latin', 'cyrillic' ),
	),
	'Orbitron'                       => array(
		'variants' => array( 'regular', '500', '700', '900' ),
		'subsets'  => array( 'latin' ),
	),
	'Oregano'                        => array(
		'variants' => array( 'regular', 'italic' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Orienta'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Original Surfer'                => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Oswald'                         => array(
		'variants' => array( '200', '300', 'regular', '500', '600', '700' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese', 'cyrillic' ),
	),
	'Over the Rainbow'               => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Overlock'                       => array(
		'variants' => array( 'regular', 'italic', '700', '700italic', '900', '900italic' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Overlock SC'                    => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Overpass'                       => array(
		'variants' => array( '100', '100italic', '200', '200italic', '300', '300italic', 'regular', 'italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Overpass Mono'                  => array(
		'variants' => array( '300', 'regular', '600', '700' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Ovo'                            => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Oxygen'                         => array(
		'variants' => array( '300', 'regular', '700' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Oxygen Mono'                    => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'PT Mono'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'cyrillic-ext', 'latin', 'cyrillic' ),
	),
	'PT Sans'                        => array(
		'variants' => array( 'regular', 'italic', '700', '700italic' ),
		'subsets'  => array( 'latin-ext', 'cyrillic-ext', 'latin', 'cyrillic' ),
	),
	'PT Sans Caption'                => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'latin-ext', 'cyrillic-ext', 'latin', 'cyrillic' ),
	),
	'PT Sans Narrow'                 => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'latin-ext', 'cyrillic-ext', 'latin', 'cyrillic' ),
	),
	'PT Serif'                       => array(
		'variants' => array( 'regular', 'italic', '700', '700italic' ),
		'subsets'  => array( 'latin-ext', 'cyrillic-ext', 'latin', 'cyrillic' ),
	),
	'PT Serif Caption'               => array(
		'variants' => array( 'regular', 'italic' ),
		'subsets'  => array( 'latin-ext', 'cyrillic-ext', 'latin', 'cyrillic' ),
	),
	'Pacifico'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese', 'cyrillic' ),
	),
	'Padauk'                         => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'myanmar', 'latin' ),
	),
	'Palanquin'                      => array(
		'variants' => array( '100', '200', '300', 'regular', '500', '600', '700' ),
		'subsets'  => array( 'devanagari', 'latin-ext', 'latin' ),
	),
	'Palanquin Dark'                 => array(
		'variants' => array( 'regular', '500', '600', '700' ),
		'subsets'  => array( 'devanagari', 'latin-ext', 'latin' ),
	),
	'Pangolin'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'cyrillic-ext', 'latin', 'vietnamese', 'cyrillic' ),
	),
	'Paprika'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Parisienne'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Passero One'                    => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Passion One'                    => array(
		'variants' => array( 'regular', '700', '900' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Pathway Gothic One'             => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Patrick Hand'                   => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Patrick Hand SC'                => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Pattaya'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'thai', 'latin', 'vietnamese', 'cyrillic' ),
	),
	'Patua One'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Pavanam'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'tamil', 'latin' ),
	),
	'Paytone One'                    => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Peddana'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin', 'telugu' ),
	),
	'Peralta'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Permanent Marker'               => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Petit Formal Script'            => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Petrona'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Philosopher'                    => array(
		'variants' => array( 'regular', 'italic', '700', '700italic' ),
		'subsets'  => array( 'cyrillic-ext', 'latin', 'vietnamese', 'cyrillic' ),
	),
	'Piedra'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Pinyon Script'                  => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Pirata One'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Plaster'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Play'                           => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'greek', 'latin-ext', 'cyrillic-ext', 'latin', 'vietnamese', 'cyrillic' ),
	),
	'Playball'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Playfair Display'               => array(
		'variants' => array( 'regular', 'italic', '700', '700italic', '900', '900italic' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese', 'cyrillic' ),
	),
	'Playfair Display SC'            => array(
		'variants' => array( 'regular', 'italic', '700', '700italic', '900', '900italic' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese', 'cyrillic' ),
	),
	'Podkova'                        => array(
		'variants' => array( 'regular', '500', '600', '700', '800' ),
		'subsets'  => array( 'latin-ext', 'cyrillic-ext', 'latin', 'vietnamese', 'cyrillic' ),
	),
	'Poiret One'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin', 'cyrillic' ),
	),
	'Poller One'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Poly'                           => array(
		'variants' => array( 'regular', 'italic' ),
		'subsets'  => array( 'latin' ),
	),
	'Pompiere'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Pontano Sans'                   => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Poppins'                        => array(
		'variants' => array( '100', '100italic', '200', '200italic', '300', '300italic', 'regular', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic' ),
		'subsets'  => array( 'devanagari', 'latin-ext', 'latin' ),
	),
	'Port Lligat Sans'               => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Port Lligat Slab'               => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Pragati Narrow'                 => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'devanagari', 'latin-ext', 'latin' ),
	),
	'Prata'                          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'cyrillic-ext', 'latin', 'vietnamese', 'cyrillic' ),
	),
	'Preahvihear'                    => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'khmer' ),
	),
	'Press Start 2P'                 => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'greek', 'latin-ext', 'cyrillic-ext', 'latin', 'cyrillic' ),
	),
	'Pridi'                          => array(
		'variants' => array( '200', '300', 'regular', '500', '600', '700' ),
		'subsets'  => array( 'latin-ext', 'thai', 'latin', 'vietnamese' ),
	),
	'Princess Sofia'                 => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Prociono'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Prompt'                         => array(
		'variants' => array( '100', '100italic', '200', '200italic', '300', '300italic', 'regular', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic' ),
		'subsets'  => array( 'latin-ext', 'thai', 'latin', 'vietnamese' ),
	),
	'Prosto One'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin', 'cyrillic' ),
	),
	'Proza Libre'                    => array(
		'variants' => array( 'regular', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Puritan'                        => array(
		'variants' => array( 'regular', 'italic', '700', '700italic' ),
		'subsets'  => array( 'latin' ),
	),
	'Purple Purse'                   => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Quando'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Quantico'                       => array(
		'variants' => array( 'regular', 'italic', '700', '700italic' ),
		'subsets'  => array( 'latin' ),
	),
	'Quattrocento'                   => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Quattrocento Sans'              => array(
		'variants' => array( 'regular', 'italic', '700', '700italic' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Questrial'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Quicksand'                      => array(
		'variants' => array( '300', 'regular', '500', '700' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Quintessential'                 => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Qwigley'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Racing Sans One'                => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Radley'                         => array(
		'variants' => array( 'regular', 'italic' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Rajdhani'                       => array(
		'variants' => array( '300', 'regular', '500', '600', '700' ),
		'subsets'  => array( 'devanagari', 'latin-ext', 'latin' ),
	),
	'Rakkas'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'arabic', 'latin-ext', 'latin' ),
	),
	'Raleway'                        => array(
		'variants' => array( '100', '100italic', '200', '200italic', '300', '300italic', 'regular', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Raleway, sans-serif'            => array(
		'variants' => array( '100', '100italic', '200', '200italic', '300', '300italic', 'regular', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Raleway Dots'                   => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Ramabhadra'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin', 'telugu' ),
	),
	'Ramaraja'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin', 'telugu' ),
	),
	'Rambla'                         => array(
		'variants' => array( 'regular', 'italic', '700', '700italic' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Rammetto One'                   => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Ranchers'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Rancho'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Ranga'                          => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'devanagari', 'latin-ext', 'latin' ),
	),
	'Rasa'                           => array(
		'variants' => array( '300', 'regular', '500', '600', '700' ),
		'subsets'  => array( 'latin-ext', 'latin', 'gujarati' ),
	),
	'Rationale'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Ravi Prakash'                   => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin', 'telugu' ),
	),
	'Redressed'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Reem Kufi'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'arabic', 'latin' ),
	),
	'Reenie Beanie'                  => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Revalia'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Rhodium Libre'                  => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'devanagari', 'latin-ext', 'latin' ),
	),
	'Ribeye'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Ribeye Marrow'                  => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Righteous'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Risque'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Roboto'                         => array(
		'variants' => array( '100', '100italic', '300', '300italic', 'regular', 'italic', '500', '500italic', '700', '700italic', '900', '900italic' ),
		'subsets'  => array( 'greek', 'latin-ext', 'cyrillic-ext', 'latin', 'vietnamese', 'greek-ext', 'cyrillic' ),
	),
	'Roboto, sans-serif'             => array(
		'variants' => array( '100', '100italic', '300', '300italic', 'regular', 'italic', '500', '500italic', '700', '700italic', '900', '900italic' ),
		'subsets'  => array( 'greek', 'latin-ext', 'cyrillic-ext', 'latin', 'vietnamese', 'greek-ext', 'cyrillic' ),
	),
	'Roboto Condensed'               => array(
		'variants' => array( '300', '300italic', 'regular', 'italic', '700', '700italic' ),
		'subsets'  => array( 'greek', 'latin-ext', 'cyrillic-ext', 'latin', 'vietnamese', 'greek-ext', 'cyrillic' ),
	),
	'Roboto Condensed, sans-serif'   => array(
		'variants' => array( '300', '300italic', 'regular', 'italic', '700', '700italic' ),
		'subsets'  => array( 'greek', 'latin-ext', 'cyrillic-ext', 'latin', 'vietnamese', 'greek-ext', 'cyrillic' ),
	),
	'Roboto Mono'                    => array(
		'variants' => array( '100', '100italic', '300', '300italic', 'regular', 'italic', '500', '500italic', '700', '700italic' ),
		'subsets'  => array( 'greek', 'latin-ext', 'cyrillic-ext', 'latin', 'vietnamese', 'greek-ext', 'cyrillic' ),
	),
	'Roboto Slab'                    => array(
		'variants' => array( '100', '300', 'regular', '700' ),
		'subsets'  => array( 'greek', 'latin-ext', 'cyrillic-ext', 'latin', 'vietnamese', 'greek-ext', 'cyrillic' ),
	),
	'Rochester'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Rock Salt'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Rokkitt'                        => array(
		'variants' => array( '100', '200', '300', 'regular', '500', '600', '700', '800', '900' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Romanesco'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Ropa Sans'                      => array(
		'variants' => array( 'regular', 'italic' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Rosario'                        => array(
		'variants' => array( 'regular', 'italic', '700', '700italic' ),
		'subsets'  => array( 'latin' ),
	),
	'Rosarivo'                       => array(
		'variants' => array( 'regular', 'italic' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Rouge Script'                   => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Rozha One'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'devanagari', 'latin-ext', 'latin' ),
	),
	'Rubik'                          => array(
		'variants' => array( '300', '300italic', 'regular', 'italic', '500', '500italic', '700', '700italic', '900', '900italic' ),
		'subsets'  => array( 'latin-ext', 'latin', 'hebrew', 'cyrillic' ),
	),
	'Rubik Mono One'                 => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin', 'cyrillic' ),
	),
	'Ruda'                           => array(
		'variants' => array( 'regular', '700', '900' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Rufina'                         => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Ruge Boogie'                    => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Ruluko'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Rum Raisin'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Ruslan Display'                 => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin', 'cyrillic' ),
	),
	'Russo One'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin', 'cyrillic' ),
	),
	'Ruthie'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Rye'                            => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Sacramento'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Sahitya'                        => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'devanagari', 'latin' ),
	),
	'Sail'                           => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Saira'                          => array(
		'variants' => array( '100', '200', '300', 'regular', '500', '600', '700', '800', '900' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Saira Condensed'                => array(
		'variants' => array( '100', '200', '300', 'regular', '500', '600', '700', '800', '900' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Saira Extra Condensed'          => array(
		'variants' => array( '100', '200', '300', 'regular', '500', '600', '700', '800', '900' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Saira Semi Condensed'           => array(
		'variants' => array( '100', '200', '300', 'regular', '500', '600', '700', '800', '900' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Salsa'                          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Sanchez'                        => array(
		'variants' => array( 'regular', 'italic' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Sancreek'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Sansita'                        => array(
		'variants' => array( 'regular', 'italic', '700', '700italic', '800', '800italic', '900', '900italic' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Sarala'                         => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'devanagari', 'latin-ext', 'latin' ),
	),
	'Sarina'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Sarpanch'                       => array(
		'variants' => array( 'regular', '500', '600', '700', '800', '900' ),
		'subsets'  => array( 'devanagari', 'latin-ext', 'latin' ),
	),
	'Satisfy'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Scada'                          => array(
		'variants' => array( 'regular', 'italic', '700', '700italic' ),
		'subsets'  => array( 'latin-ext', 'cyrillic-ext', 'latin', 'cyrillic' ),
	),
	'Scheherazade'                   => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'arabic', 'latin' ),
	),
	'Schoolbell'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Scope One'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Seaweed Script'                 => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Secular One'                    => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin', 'hebrew' ),
	),
	'Sedgwick Ave'                   => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Sedgwick Ave Display'           => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Sevillana'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Seymour One'                    => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin', 'cyrillic' ),
	),
	'Shadows Into Light'             => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Shadows Into Light Two'         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Shanti'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Share'                          => array(
		'variants' => array( 'regular', 'italic', '700', '700italic' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Share Tech'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Share Tech Mono'                => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Shojumaru'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Short Stack'                    => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Shrikhand'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin', 'gujarati' ),
	),
	'Siemreap'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'khmer' ),
	),
	'Sigmar One'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Signika'                        => array(
		'variants' => array( '300', 'regular', '600', '700' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Signika Negative'               => array(
		'variants' => array( '300', 'regular', '600', '700' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Simonetta'                      => array(
		'variants' => array( 'regular', 'italic', '900', '900italic' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Sintony'                        => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Sirin Stencil'                  => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Six Caps'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Skranji'                        => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Slabo 13px'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Slabo 27px'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Slackey'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Smokum'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Smythe'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Sniglet'                        => array(
		'variants' => array( 'regular', '800' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Snippet'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Snowburst One'                  => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Sofadi One'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Sofia'                          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Sonsie One'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Sorts Mill Goudy'               => array(
		'variants' => array( 'regular', 'italic' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Source Code Pro'                => array(
		'variants' => array( '200', '300', 'regular', '500', '600', '700', '900' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Source Sans Pro'                => array(
		'variants' => array( '200', '200italic', '300', '300italic', 'regular', 'italic', '600', '600italic', '700', '700italic', '900', '900italic' ),
		'subsets'  => array( 'greek', 'latin-ext', 'cyrillic-ext', 'latin', 'vietnamese', 'greek-ext', 'cyrillic' ),
	),
	'Source Serif Pro'               => array(
		'variants' => array( 'regular', '600', '700' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Space Mono'                     => array(
		'variants' => array( 'regular', 'italic', '700', '700italic' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Special Elite'                  => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Spectral'                       => array(
		'variants' => array( '200', '200italic', '300', '300italic', 'regular', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese', 'cyrillic' ),
	),
	'Spectral SC'                    => array(
		'variants' => array( '200', '200italic', '300', '300italic', 'regular', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese', 'cyrillic' ),
	),
	'Spicy Rice'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Spinnaker'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Spirax'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Squada One'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Sree Krushnadevaraya'           => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin', 'telugu' ),
	),
	'Sriracha'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'thai', 'latin', 'vietnamese' ),
	),
	'Stalemate'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Stalinist One'                  => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin', 'cyrillic' ),
	),
	'Stardos Stencil'                => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'latin' ),
	),
	'Stint Ultra Condensed'          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Stint Ultra Expanded'           => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Stoke'                          => array(
		'variants' => array( '300', 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Strait'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Sue Ellen Francisco'            => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Suez One'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin', 'hebrew' ),
	),
	'Sumana'                         => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'devanagari', 'latin-ext', 'latin' ),
	),
	'Sunshiney'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Supermercado One'               => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Sura'                           => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'devanagari', 'latin-ext', 'latin' ),
	),
	'Suranna'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin', 'telugu' ),
	),
	'Suravaram'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin', 'telugu' ),
	),
	'Suwannaphum'                    => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'khmer' ),
	),
	'Swanky and Moo Moo'             => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Syncopate'                      => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'latin' ),
	),
	'Tangerine'                      => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'latin' ),
	),
	'Taprom'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'khmer' ),
	),
	'Tauri'                          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Taviraj'                        => array(
		'variants' => array( '100', '100italic', '200', '200italic', '300', '300italic', 'regular', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic' ),
		'subsets'  => array( 'latin-ext', 'thai', 'latin', 'vietnamese' ),
	),
	'Teko'                           => array(
		'variants' => array( '300', 'regular', '500', '600', '700' ),
		'subsets'  => array( 'devanagari', 'latin-ext', 'latin' ),
	),
	'Telex'                          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Tenali Ramakrishna'             => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin', 'telugu' ),
	),
	'Tenor Sans'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin', 'cyrillic' ),
	),
	'Text Me One'                    => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'The Girl Next Door'             => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Tienne'                         => array(
		'variants' => array( 'regular', '700', '900' ),
		'subsets'  => array( 'latin' ),
	),
	'Tillana'                        => array(
		'variants' => array( 'regular', '500', '600', '700', '800' ),
		'subsets'  => array( 'devanagari', 'latin-ext', 'latin' ),
	),
	'Timmana'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin', 'telugu' ),
	),
	'Tinos'                          => array(
		'variants' => array( 'regular', 'italic', '700', '700italic' ),
		'subsets'  => array( 'greek', 'latin-ext', 'cyrillic-ext', 'latin', 'hebrew', 'vietnamese', 'greek-ext', 'cyrillic' ),
	),
	'Titan One'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Titillium Web'                  => array(
		'variants' => array( '200', '200italic', '300', '300italic', 'regular', 'italic', '600', '600italic', '700', '700italic', '900' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Trade Winds'                    => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Trirong'                        => array(
		'variants' => array( '100', '100italic', '200', '200italic', '300', '300italic', 'regular', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic' ),
		'subsets'  => array( 'latin-ext', 'thai', 'latin', 'vietnamese' ),
	),
	'Trocchi'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Trochut'                        => array(
		'variants' => array( 'regular', 'italic', '700' ),
		'subsets'  => array( 'latin' ),
	),
	'Trykker'                        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Tulpen One'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Ubuntu'                         => array(
		'variants' => array( '300', '300italic', 'regular', 'italic', '500', '500italic', '700', '700italic' ),
		'subsets'  => array( 'greek', 'latin-ext', 'cyrillic-ext', 'latin', 'greek-ext', 'cyrillic' ),
	),
	'Ubuntu Condensed'               => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'greek', 'latin-ext', 'cyrillic-ext', 'latin', 'greek-ext', 'cyrillic' ),
	),
	'Ubuntu Mono'                    => array(
		'variants' => array( 'regular', 'italic', '700', '700italic' ),
		'subsets'  => array( 'greek', 'latin-ext', 'cyrillic-ext', 'latin', 'greek-ext', 'cyrillic' ),
	),
	'Ultra'                          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Uncial Antiqua'                 => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Underdog'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin', 'cyrillic' ),
	),
	'Unica One'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'UnifrakturCook'                 => array(
		'variants' => array( '700' ),
		'subsets'  => array( 'latin' ),
	),
	'UnifrakturMaguntia'             => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Unkempt'                        => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'latin' ),
	),
	'Unlock'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Unna'                           => array(
		'variants' => array( 'regular', 'italic', '700', '700italic' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'VT323'                          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese' ),
	),
	'Vampiro One'                    => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Varela'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Varela Round'                   => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin', 'hebrew', 'vietnamese' ),
	),
	'Vast Shadow'                    => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Vesper Libre'                   => array(
		'variants' => array( 'regular', '500', '700', '900' ),
		'subsets'  => array( 'devanagari', 'latin-ext', 'latin' ),
	),
	'Vibur'                          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Vidaloka'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Viga'                           => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Voces'                          => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Volkhov'                        => array(
		'variants' => array( 'regular', 'italic', '700', '700italic' ),
		'subsets'  => array( 'latin' ),
	),
	'Vollkorn'                       => array(
		'variants' => array( 'regular', 'italic', '600', '600italic', '700', '700italic', '900', '900italic' ),
		'subsets'  => array( 'greek', 'latin-ext', 'cyrillic-ext', 'latin', 'vietnamese', 'cyrillic' ),
	),
	'Vollkorn SC'                    => array(
		'variants' => array( 'regular', '600', '700', '900' ),
		'subsets'  => array( 'latin-ext', 'cyrillic-ext', 'latin', 'vietnamese', 'cyrillic' ),
	),
	'Voltaire'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Waiting for the Sunrise'        => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Wallpoet'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Walter Turncoat'                => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Warnes'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Wellfleet'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Wendy One'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Wire One'                       => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Work Sans'                      => array(
		'variants' => array( '100', '200', '300', 'regular', '500', '600', '700', '800', '900' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Yanone Kaffeesatz'              => array(
		'variants' => array( '200', '300', 'regular', '700' ),
		'subsets'  => array( 'latin-ext', 'latin', 'vietnamese', 'cyrillic' ),
	),
	'Yantramanav'                    => array(
		'variants' => array( '100', '300', 'regular', '500', '700', '900' ),
		'subsets'  => array( 'devanagari', 'latin-ext', 'latin' ),
	),
	'Yatra One'                      => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'devanagari', 'latin-ext', 'latin' ),
	),
	'Yellowtail'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Yeseva One'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin-ext', 'cyrillic-ext', 'latin', 'vietnamese', 'cyrillic' ),
	),
	'Yesteryear'                     => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Yrsa'                           => array(
		'variants' => array( '300', 'regular', '500', '600', '700' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Zeyada'                         => array(
		'variants' => array( 'regular' ),
		'subsets'  => array( 'latin' ),
	),
	'Zilla Slab'                     => array(
		'variants' => array( '300', '300italic', 'regular', 'italic', '500', '500italic', '600', '600italic', '700', '700italic' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
	'Zilla Slab Highlight'           => array(
		'variants' => array( 'regular', '700' ),
		'subsets'  => array( 'latin-ext', 'latin' ),
	),
);
