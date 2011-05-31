<?php
	
	/**
	 * @package advanced_upload_field
	 */
	
	/**
	 * An upload field that allows features to be plugged in.
	 */
	class Extension_Advanced_Upload_Field extends Extension {
		protected $addedHeaders = false;
		
		/**
		 * Extension information.
		 */
		public function about() {
			return array(
				'name'			=> 'Field: Advanced Upload',
				'version'		=> '0.1',
				'release-date'	=> '2011-05-31',
				'author'		=> array(
					'name'			=> 'Rowan Lewis',
					'website'		=> 'http://rowanlewis.com/',
					'email'			=> 'me@rowanlewis.com'
				),
				'description'	=> 'An upload field that allows features to be plugged in.'
			);
		}
		
		/**
		 * Cleanup installation.
		 */
		public function uninstall() {
			$this->_Parent->Database->query("DROP TABLE `tbl_fields_advanced_upload`");
		}
		
		/**
		 * Create tables and configuration.
		 */
		public function install() {
			$this->_Parent->Database->query("
				CREATE TABLE IF NOT EXISTS `tbl_fields_advanced_upload` (
					`id` int(11) unsigned NOT NULL auto_increment,
					`field_id` int(11) unsigned NOT NULL,
					`destination` varchar(255) NOT NULL,
					`validator` varchar(50) default NULL,
					`serialise` enum('yes','no') default NULL,
					PRIMARY KEY  (`id`),
					KEY `field_id` (`field_id`)
				)
			");
			
			return true;
		}
		
		public function addHeaders($page) {
			if (!is_null($page) && !$this->addedHeaders) {
				$page->addStylesheetToHead(URL . '/extensions/advanced_upload_field/assets/publish.css', 'screen', 9745190);
				$page->addScriptToHead(URL . '/extensions/advanced_upload_field/assets/publish.js', 9745190);
				
				$this->addedHeaders = true;
			}
		}
	}
	
?>