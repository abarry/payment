<?php

/**
 * Order form base class.
 *
 * @method Order getObject() Returns the current form's model object
 *
 * @package    payment
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseOrderForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                          => new sfWidgetFormInputHidden(),
      'reference'                   => new sfWidgetFormInputText(),
      'amount'                      => new sfWidgetFormInputText(),
      'hash'                        => new sfWidgetFormInputText(),
      'user_id'                     => new sfWidgetFormInputText(),
      'seller_psp_configuration_id' => new sfWidgetFormPropelChoice(array('model' => 'SellerPspConfiguration', 'add_empty' => false)),
      'created_at'                  => new sfWidgetFormDateTime(),
      'updated_at'                  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                          => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'reference'                   => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'amount'                      => new sfValidatorNumber(array('required' => false)),
      'hash'                        => new sfValidatorString(array('max_length' => 255)),
      'user_id'                     => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'seller_psp_configuration_id' => new sfValidatorPropelChoice(array('model' => 'SellerPspConfiguration', 'column' => 'id')),
      'created_at'                  => new sfValidatorDateTime(array('required' => false)),
      'updated_at'                  => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Order', 'column' => array('hash')))
    );

    $this->widgetSchema->setNameFormat('order[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Order';
  }


}
