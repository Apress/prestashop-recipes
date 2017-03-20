<?php
if(!defined('_PS_VERSION_'))
	exit;
	
class Bookings extends Module {
	
	public function __construct()
   {
		$this->name = 'bookings';
		$this->tab = 'front_office_features';
		$this->version = '1.0.0';
		$this->author = 'Arnaldo Perez Castano';
		$this->need_instance = 0;
		$this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_); 
		$this->bootstrap = true;
	 
		parent::__construct();
	 
		$this->displayName = $this->l('Bookings');
		$this->description = $this->l('Add Bookings Tab to product edit page');
	 
		$this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
	}
	
	public function install()
	{
		if (!parent::install() ||
			!$this->registerHook('displayAdminProductsExtra'))
			return false;
		return true;
	}
 
	public function uninstall()
	{
		if (!parent::uninstall())
			return false;
		return true;
	}
	
	public function hookdisplayAdminProductsExtra($params)
	{
		$product = new Product((int)Tools::getValue('id_product'));
		if (Validate::isLoadedObject($product))
		{
		    $this->context->smarty->assign(array(
                     'bookings' => $product->booking_dates
					 ));

			return $this->display(__FILE__, 'bookings.tpl');
		}
	}   
	
}
	

