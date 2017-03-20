<?php
if(!defined('_PS_VERSION_'))
	exit;
	
class OrderEmail extends Module {
	
	public function __construct()
   {
		$this->name = 'orderemail';
		$this->tab = 'front_office_features';
		$this->version = '1.0.0';
		$this->author = 'Arnaldo Perez Castano';
		$this->need_instance = 0;
		$this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_); 
		$this->bootstrap = true;
	 
		parent::__construct();
	 
		$this->displayName = $this->l('Order Email');
		$this->description = $this->l('Send email notifications after order confirmation');
	 
		$this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
	}
	
	public function install()
	{
		if (!parent::install())
			return false;
		return true;
	}
   
    public function uninstall()
	{
		if (!parent::uninstall())
			return false;
		return true;
	}
	
	public function hookdisplayOrderConfirmation($params)
	{
		$email = Configuration::get('emails');
		
		return Mail::Send(
			$this->context->language->id,
			'order_conf',
			Mail::l('New HCCT Order'),
			array(
				'{firstname}' => $customer->firstname,
				'{lastname}' => $customer->lastname,
				'{email}' => $customer->email,
				'{passwd}' => Tools::getValue('passwd')),
			$customer->email,
			$customer->firstname.' '.$customer->lastname
		);
	}
	
	public function getContent()
	{
		if (Tools::isSubmit('submit'))
		{
			Configuration::updateValue('emails', Tools::getValue('csv'));
		}
		$this->displayForm();
		return $this->_html;
	}
	
	private function displayForm()
    {
		$this->_html .= '
		<form action="'.$_SERVER['REQUEST_URI'].'" method="post">
		<label>'.$this->l('Email addresses to send notification email').'</label>
		<div class="margin-form">
			<input type="text" name="csv" />
		</div> <br>
		<input type="submit" name="submit" value="'.$this->l('Save').'" class="button" />
		</form>';
    }
}
	

