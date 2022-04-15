<?php
/*
		 *  Fonction deconnexion, detruit les variables de sessions utilisé par la classe
		 */
		public static function deconnexion($varSession){			
			unset($_SESSION[$varSession]);
			if(isset($_SESSION[$varSession]))
				return false;
			else
				return true;
		}
  ?>      