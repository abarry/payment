<?php

/**
 * CreditCard form base class.
 *
 * @method CreditCard getObject() Returns the current form's model object
 *
 * @package    payment
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseCreditCardForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'alias'       => new sfWidgetFormInputText(),
      'brand'       => new sfWidgetFormInputText(),
      'number'      => new sfWidgetFormInputText(),
      'expires_at'  => new sfWidgetFormInputText(),
      'owner'       => new sfWidgetFormInputText(),
      'is_selected' => new sfWidgetFormInputCheckbox(),
      'user_id'     => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'alias'       => new sfValidatorString(array('max_length' => 255)),
      'brand'       => new sfValidatorString(array('max_length' => 20)),
      'number'      => new sfValidatorString(array('max_length' => 255)),
      'expires_at'  => new sfValidatorString(array('max_length' => 4)),
      'owner'       => new sfValidatorString(array('max_length' => 255)),
      'is_selected' => new sfValidatorBoolean(array('required' => false)),
      'user_id'     => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id')),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'CreditCard', 'column' => array('alias', 'number')))
    );

    $this->widgetSchema->setNameFormat('credit_card[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CreditCard';
  }


}
