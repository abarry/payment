<?php

/**
 * SellerPspConfiguration form base class.
 *
 * @method SellerPspConfiguration getObject() Returns the current form's model object
 *
 * @package    payment
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseSellerPspConfigurationForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'seller_id'         => new sfWidgetFormPropelChoice(array('model' => 'Seller', 'add_empty' => false)),
      'psp_name'          => new sfWidgetFormInputText(),
      'service_type'      => new sfWidgetFormInputText(),
      'psp_configuration' => new sfWidgetFormInputText(),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'seller_id'         => new sfValidatorPropelChoice(array('model' => 'Seller', 'column' => 'id')),
      'psp_name'          => new sfValidatorString(array('max_length' => 255)),
      'service_type'      => new sfValidatorString(array('max_length' => 45)),
      'psp_configuration' => new sfValidatorPass(),
      'created_at'        => new sfValidatorDateTime(array('required' => false)),
      'updated_at'        => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('seller_psp_configuration[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SellerPspConfiguration';
  }


}
