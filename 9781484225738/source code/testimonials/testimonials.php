<?php
if(!defined('_PS_VERSION_'))
	exit;
	
class Testimonials extends Module {
	
	public function __construct()
   {
		$this->name = 'testimonials';
		$this->tab = 'front_office_features';
		$this->version = '1.0.0';
		$this->author = 'Arnaldo Perez Castano';
		$this->need_instance = 0;
		$this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_); 
		$this->bootstrap = true;
	 
		parent::__construct();
	 
		$this->displayName = $this->l('Testimonials');
		$this->description = $this->l('Display testimonials on homepage');
	 
		$this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
	}
	
	public function install()
	{
		if (!parent::install() ||
			!$this->registerHook('testimonials'))
			return false;
		return true;
	}
   
    public function uninstall()
	{
		if (!parent::uninstall())
			return false;
		return true;
	}
	
	protected function addHook() 
	{
		// Checking the module does not exist
		$exists = Db::getInstance()->getRow('
				SELECT name
				FROM '._DB_PREFIX_.'hook
				WHERE name = "testimonials"
				');
		// If it does not exist
		if (!$exists) {
			$query = "INSERT INTO "._DB_PREFIX_."hook (`name`, `title`, `description`) VALUES ('testimonials', 'Testimonials', 'Hooks in the homepage');";
			if(Db::getInstance()->Execute($query))
				return true;
			else
				return false;
		}
		else return true;
	}

	
	public function hookTestimonials($params)
	{
		global $smarty;
		Tools::addCSS($this->_path.'testimonials.css', 'all');
		
		$smarty->assign(
				array(
					'testimonial_1' => Configuration::get('testimonial_1'),
					'testimonial_2' => Configuration::get('testimonial_2'),
					'testimonial_3' => Configuration::get('testimonial_3'),
					'name_1' => Configuration::get('name_1'),
					'name_2' => Configuration::get('name_2'),
					'name_3' => Configuration::get('name_3'),
					'image_1' => Configuration::get('image_1'),
					'image_2' => Configuration::get('image_2'),
					'image_3' => Configuration::get('image_3'),
				)
			);
		
		return $this->display(__FILE__, 'testimonials.tpl');
	}
	
	private function imageCheck($image) 
	{
		//Controllo se c'è una immagine da salvare
        if ($image['name'] != "" )
        {
            // Allowed image formats
            $allowed = array('image/gif', 'image/jpeg', 'image/jpg', 'image/png');

            //Controllo che l'immagine sia in un formato accettato
            if (in_array($image['type'], $allowed))
            {
                $path = '../upload/';

                //Controllo se esiste già un file con questo nome

                //Carico il file
                if( ! move_uploaded_file($image['tmp_name'], $path.$image['name']) )
                {
                        $output .= $this->displayError( $path.$image['name'] );
                        return $output.$this->displayForm();
                }
            }
            else
            {
                $output .= $this->displayError( $this->l('Invalid image format.') );
                return $output.$this->displayForm();
            }
        }   
	}
	
	public function getContent()
	{
		if (Tools::isSubmit('submit'))
		{
			Configuration::updateValue('testimonial_1', Tools::getValue('testimonial_1'));
			Configuration::updateValue('testimonial_2', Tools::getValue('testimonial_2'));
			Configuration::updateValue('testimonial_3', Tools::getValue('testimonial_3'));
			Configuration::updateValue('name_1', Tools::getValue('name_1'));
			Configuration::updateValue('name_2', Tools::getValue('name_2'));
			Configuration::updateValue('name_3', Tools::getValue('name_3'));
		
			$image_1 = $_FILES['image_1'];
			$image_2 = $_FILES['image_2'];
			$image_3 = $_FILES['image_3'];
			
            $this->imageCheck($image_1);
			$this->imageCheck($image_2);
			$this->imageCheck($image_3);
		
			
			Configuration::updateValue('image_1', $_FILES['image_1']['name']);
			Configuration::updateValue('image_2', $_FILES['image_2']['name']);
			Configuration::updateValue('image_3', $_FILES['image_3']['name']);
		}
		$this->displayForm();
		return $this->_html;
	}
	
	private function displayForm()
    {
		$this->_html .= '
		<form action="'.$_SERVER['REQUEST_URI'].'" method="post" enctype="multipart/form-data">
		<label>'.$this->l('Testimonial #1').'</label>
		<div class="margin-form">
			<textarea name="testimonial_1"> </textarea>
		</div> <br>
		<label>'.$this->l('Name #1').'</label>
		<div class="margin-form">
			<input type="text" name="name_1" />
			<input type="file" name="image_1" />
		</div>
		<br>
		<div class="margin-form">
			<textarea name="testimonial_2"> </textarea>
		</div> <br>
		<label>'.$this->l('Name #2').'</label>
		<div class="margin-form">
			<input type="text" name="name_2" />
			<input type="file" name="image_2" />
		</div>
		<br>
		<div class="margin-form">
			<textarea name="testimonial_3"> </textarea>
		</div> <br>
		<label>'.$this->l('Name #3').'</label>
		<div class="margin-form">
			<input type="text" name="name_3" />
			<input type="file" name="image_3" />
		</div>
		<br>
		<input type="submit" name="submit" value="'.$this->l('Save').'" class="button" />
		</form>';
    }
}
	

