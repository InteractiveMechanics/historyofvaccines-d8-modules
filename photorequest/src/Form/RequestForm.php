<?php

namespace Drupal\photorequest\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\ChangedCommand;
use Drupal\Core\Ajax\CssCommand;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Ajax\InvokeCommand;

class RequestForm extends FormBase {

        public function getFormId() {
                return 'request_form';

        }

        public function buildForm(array $form, FormStateInterface $form_state) {

		$form['#prefix'] = '<div id="request-form-wrapper-id">';

                $form['name'] = array(
                      '#type' => 'textfield',
                      '#title' => t('Name:'),
                      '#required' => TRUE,
                );

                $form['organization'] = array(
                      '#type' => 'textfield',
                      '#title' => t('Organization:'),
                      '#required' => TRUE,
                );

                $form['email'] = array(
                      '#type' => 'email',
                      '#title' => t('Email Address:'),
                      '#required' => TRUE,
                );

                $form['why'] = array(
                      '#type' => 'textfield',
                      '#title' => t('Why you want the photo:'),
                      '#required' => TRUE,
                );

                $form['how'] = array(
                      '#type' => 'textfield',
                      '#title' => t('How will you use the photo:'),
                      '#required' => TRUE,
                );

                $form['actions']['#type'] = 'actions';

                $form['actions']['submit'] = array(
                      '#type' => 'submit',
                      '#value' => $this->t('Submit'),
                      '#button_type' => 'primary',
		      '#attributes' => [
				'class' => [
				    'btn',
				    'btn-md',
				    'btn-primary',
				    'use-ajax-submit'
				]
		    ],
		    '#ajax' => [
			'wrapper' => 'my-form-wrapper-id',
			'callback' => 'Drupal\photorequest\Form\RequestForm::handleSubmit'
		    ],
		
                );
		$form['actions']['download'] = array(
                      '#type' => 'submit',
                      '#value' => $this->t('Download'),
                      '#button_type' => 'primary',
                      '#attributes' => [
                                'class' => [
                                    'btn',
                                    'btn-md',
                                    'btn-primary',
                                    'use-ajax-submit'
                                ],
				'style' => ['display:none']	
                    ],
                    '#ajax' => [
                        'wrapper' => 'my-form-wrapper-id',
                        'callback' => 'Drupal\photorequest\Form\RequestForm::handleDownload'
                    ],

                );


		$form['#suffix'] = '</div>';

                return $form;
        }

	public function handleSubmit(array &$form, FormStateInterface $form_state) {

		//save to db or email or something?
		//$name = $form_state->getValue('name');

		$ajax_response = new AjaxResponse();
		$ajax_response->addCommand(new InvokeCommand('#request-form-wrapper-id form input', 
			'css', array('display', "none")));
		$ajax_response->addCommand(new InvokeCommand('#request-form-wrapper-id form label', 
			'css', array('display', "none")));
		$ajax_response->addCommand(new InvokeCommand('#request-form-wrapper-id form input#edit-download', 
			'css', array('display', "block")));
    
	        // Return the AjaxResponse Object.
	        return $ajax_response;
	}

	public function handleDownload(array &$form, FormStateInterface $form_state) {
		$ajax_response = new AjaxResponse();

		//serve up image
	        return $ajax_response;
	}


        public function validateForm(array &$form, FormStateInterface $form_state) {

        }

	public function ajaxRebuildForm(array &$form, FormStateInterface $form_state) {
	    return $form;
	}

        public function submitForm(array &$form, FormStateInterface $form_state) {
        /*
            foreach ($form_state->getValues() as $key => $value) {
              drupal_set_message($key . ': ' . $value);
            }
        */
        }

}
