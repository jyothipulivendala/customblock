<?php

namespace Drupal\customblock\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Datetime\DrupalDateTime;


/**
 * Provides a 'Custom' block.
 *
 * @Block(
 *  id = "id_block_custom_new",
 *  admin_label = @Translation("block custom form"),
 * )
 */



class CustomBlockNew extends BlockBase implements BlockPluginInterface {

	/**
   * {@inheritdoc}
   */

  public function defaultConfiguration() {
    return array(
      'text' => $this->t('%time', array('%time' => date('c'))),
    );
  }



public function blockForm($form, FormStateInterface $form_state){
	$form= parent::blockForm($form,$form_state);

	$config= $this->getConfiguration();

	$form['block_name'] = array (
          '#type' => 'textfield',
		  '#title' => $this->t('username'),
		  '#description' => $this->t('enter your username'),
		  '#default_value' => isset($config['name']) ? $config['name'] : '',
		  );
	$form['block_email'] = array (
		'#type' => 'email',
		  '#title' => $this->t('email address'),
		  '#description' => $this->t('enter your emailaddress'),
		  '#default_value' => isset($config['mail']) ? $config['mail'] : '',

		);
  $form['date'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('Time'),
      '#description' => $this->t('This text will appear in the block.'),
      '#default_value' => isset($config['text']) ? $config['text'] : '',
    );

    
   
	return $form;
}
/**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {

    $this->setConfigurationValue('name', $form_state->getValue('block_name'));
    $this->setConfigurationValue('mail', $form_state->getValue('block_email'));
    $this->setConfigurationValue('text', $form_state->getValue('date'));
    
    }

   public function build() {
    $config = $this->getConfiguration();
    
     $time = $config['text'];

    if (!empty($config['name'])) {
      $name = $config['name'];
    }
    else {
      $name = $this->t('to no one');
    }
    
    if (!empty($config['mail'])) { 
      $email = $config['mail'];
    }
    else {
      $email = $this->t('email address');
    }

    return array (
      '#markup' => $this->t('Hi my name is @name,my email address is @mail, the login time and date is @time', array ( 
                   '@name' => $name, '@mail' => $email, '@time' => $time,
            )
          ),
      );
    

    } 

}