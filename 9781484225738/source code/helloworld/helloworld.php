<?php
if(!defined('_PS_VERSION_'))
	exit;
	
class HelloWorld extends Module {
	
	public function __construct()
   {
		$this->name = 'helloworld';
		$this->tab = 'front_office_features';
		$this->version = '1.0.0';
		$this->text = 'Hello World';
		$this->author = 'Arnaldo Perez Castano';
		$this->need_instance = 0;
		$this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_); 
		$this->bootstrap = true;
	 
		parent::__construct();
	 
		$this->displayName = $this->l('Hello World');
		$this->description = $this->l('Display Hello World text');
	 
		$this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
	}
	
	public function install()
	{
		if (!parent::install() ||
			!$this->registerHook('top'))
			return false;
		return true;
	}
   
    public function uninstall()
	{
		if (!parent::uninstall())
			return false;
		return true;
	}
	
	public function hookTop($params)
	{
		global $smarty;
		
		$smarty->assign(
				array(
					'msg' => Configuration::get($this->text.'_message'),
				)
			);
		return $this->display(__FILE__, 'helloworld.tpl');
	}
	
	public function hookHomePage($params)
	{
		global $smarty;
		return $this->display(__FILE__, 'helloworld.tpl');
	}
	
	protected function addHook() {
		// Checking the module does not exist
		$exists = Db::getInstance()->getRow('
				SELECT name
				FROM '._DB_PREFIX_.'hook
				WHERE name = "homepage"
				');
		// If it does not exist
		if (!$exists) {
			$query = "INSERT INTO "._DB_PREFIX_."hook (`name`, `title`, `description`) VALUES ('homepage', 'HomePage', 'Hooks in the homepage');";
			if(Db::getInstance()->Execute($query))
				return true;
			else
				return false;
		}
		else return true;
	}
	
	public function getContent()
	{
		if (Tools::isSubmit('submit'))
		{
			Configuration::updateValue($this->text.'_message', Tools::getValue('our_message'));
		}
		$this->displayForm();
		return $this->_html;
	}
	
	private function displayForm()
    {
		$this->_html .= '
		<form action="'.$_SERVER['REQUEST_URI'].'" method="post">
		<label>'.$this->l('Hello World Message').'</label>
		<div class="margin-form">
			<input type="text" name="our_message" />
		</div> <br>
		<input type="submit" name="submit" value="'.$this->l('Save').'" class="button" />
		</form>';
    }
}
	

