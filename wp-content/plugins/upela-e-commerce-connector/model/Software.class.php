<?php
class Software
{
	protected $software = 'unknown';
	protected $version;
	protected $supportComments;
	
	public function __construct()
    {
        global $wpdb;
		$theme = $wpdb->get_row("SELECT * FROM $wpdb->options WHERE option_name = 'current_theme'", ARRAY_A);
		
		// Ligne à retirer à l'avenir 
		$this->software = $theme['option_value'];

        // Définir les variables avec les résultats de la base
		if ( 'shopperpress' == $theme['option_value'] ) {
			$this->software = $theme['option_value'];
			$this->setVersion();
			$this->supportComments = false;
		} else if ( is_plugin_active_custom( "woocommerce/woocommerce.php" ) ) {
			$this->software = "Woocommerce";
			$this->setVersion();
			$this->supportComments = true;
		} else if ( is_plugin_active_custom( "shopp/Shopp.php" ) ) {
			$this->software = "Shopp";
			$this->setVersion();
			$this->supportComments = false;
		} else if ( is_plugin_active_custom( "wp-e-commerce/wp-shopping-cart.php" ) ) {
			$this->software = "WP eCommerce";
			$this->setVersion();
			$this->supportComments = false;
		} else if ( is_plugin_active_custom( "cart66-lite/cart66.php" ) ) {
			$this->software = "Cart66 Lite";
			$this->setVersion();
			$this->supportComments = false;
		} else if ( is_plugin_active_custom( "cart66.php" ) ) {
			$this->software = "Cart66 Pro";
			$this->setVersion();
			$this->supportComments = false;
		}else if ( is_plugin_active_custom( "jigoshop/jigoshop.php" ) ) {
			$this->software = "Jigoshop";
			$this->setVersion();
			$this->supportComments = true;
		}
    }
	
	public function getSoftware() {
		return $this->software;
	}
	
	public function getVersion() {
		return $this->version;
	}
	
	public function getSupportComments() {
		$converted_res = ($this->supportComments) ? 'true' : 'false';
		return $converted_res;
	}
	
	protected function setVersion() {
		if ( 'shopperpress' == $this->software ) {
			$fichier = fopen( THEMES_PATH . "/shopperpress/functions.php","r");
			// On récupère la version
			while( ! feof( $fichier ) ) {
			 // On récupère une ligne
			  $ligne = fgets( $fichier );
				if ( strpos( $ligne , '"PREMIUMPRESS_VERSION"' ) != false ) {
					$i = strpos( $ligne, '"PREMIUMPRESS_VERSION"' ) + strlen('"PREMIUMPRESS_VERSION"') + 2;
					$j = $i;
					while ( $i<=strlen( $ligne ) && substr( $ligne, $i, 1) != '"') {
						$i++;
					}
					$this->version = substr( $ligne, $j, $i - $j);
				}			
			 }
			 // On ferme le fichier
			 fclose($fichier);
		} else if ( 'Shopp' == $this->getSoftware() ) {
			$this->version = getVersion( "/shopp/Shopp.php" );
		} else if ( 'Woocommerce' == $this->getSoftware() ) {
		    //custom-developer logic
            $this->version = WC()->version;
		    /*
			$fichier = fopen( PLUGINS_PATH . "/woocommerce/woocommerce.php","r");

			// On récupère la version
			while( ! feof( $fichier ) ) {
			 // On récupère une ligne
			  $ligne = fgets( $fichier );
				if ( strpos( $ligne , 'public $version =' ) != false ) {
					$i = strpos( $ligne, 'public $version =' ) + strlen('public $version =') + 2;
					$j = $i;
					while ( $i<=strlen( $ligne ) && substr( $ligne, $i, 1) != "'" ) {
						$i++;
					}
					$this->version = substr( $ligne, $j, $i - $j);
				}			
			 }
			 // On ferme le fichier
			 fclose($fichier);*/
		} else if ( 'WP eCommerce' == $this->getSoftware() ) {
			$fichier = fopen( PLUGINS_PATH . "/wp-e-commerce/wp-shopping-cart.php","r");
			// On récupère la version
			while( ! feof( $fichier ) ) {
			 // On récupère une ligne
			  $ligne = fgets( $fichier );
				if ( strpos( $ligne , 'Version:' ) != false ) {
					$i = strpos( $ligne, 'Version:' ) + strlen('Version:') + 1;
					$j = $i;
					while ( $i<=strlen( $ligne ) && substr( $ligne, $i, 2) != "\n" ) {
						$i++;
					}
					$this->version = substr( $ligne, $j, $i - $j);
				}			
			 }
			 // On ferme le fichier
			 fclose($fichier);
		} else if ( 'Cart66 Lite' == $this->getSoftware() ) {
			$this->version = getVersion( "/cart66-lite/cart66.php" );
		} else if ( 'Cart66 Pro' == $this->getSoftware() ) {
				$this->version = getVersion( "cart66.php" );
		}else if ( 'Jigoshop' == $this->getSoftware() ) {
			$this->version = getVersion( "/jigoshop/jigoshop.php" );
		}
		$this->filtre();
	}
	
	protected function filtre() {
		$this->software = filtreString( $this->software );
		$this->version = filtreString( $this->version );	
	}
	
	public function isCompatible() {
		$toReturn = false;
		$split = explode( '.' , $this->getVersion() );
		if ( 'shopperpress' == $this->getSoftware() ) {
			if ( $split[0] > 7 || ( $split[0] == 7 & $split[1] >= 1 ) ) {
				$toReturn = true;
			} 
		} else if ( 'Shopp' == $this->getSoftware() ) {
			if ( $split[0] > 1 || ( $split[0] == 1 & $split[1] > 2 ) || ( $split[0] == 1 & $split[1] == 2 & $split[2] >= 2 ) ) {
				$toReturn = true;
			}
		} else if ( 'Woocommerce' == $this->getSoftware() ) {
			if ( $split[0] >= 2 ) {
				$toReturn = true;
			}
		} else if ( 'WP eCommerce' == $this->getSoftware() ) {
			if ( $split[0] >= 3 ) {
				$toReturn = true;
			}
		} else if ( 'Cart66 Lite' == $this->getSoftware() ) {
			if ( $split[0] > 1 || ( $split[0] == 1 & $split[1] >= 5 ) ) {
				$toReturn = true;
			}
		} else if ( 'Cart66 Pro' == $this->getSoftware() ) {
			if ( $split[0] > 1 || ( $split[0] == 1 & $split[1] >= 5 ) ) {
				$toReturn = true;
			}
		} else if ( 'Jigoshop' == $this->getSoftware() ) {
			if ( $split[0] >= 1 ) {
				$toReturn = true;
			}
		} 
		return $toReturn;
	}
	
	public function getCompatibleMessage() {
		return sprintf(__("You are currently running %s with the version %s.", 'upela'), $this->software, $this->version) ."\n" 
				. __("This one is fully compatible with the Upela plugin.", 'upela');
	}
	
	public function getNotCompatibleMessage() {
		$toReturn = __("We didn't find any E-commerce plugin activated on your website, please activate it.", 'upela');	
		
		return $toReturn;
	}
	
}