<?php

/**
 * TransactionExtraProperty form base class.
 *
 * @method TransactionExtraProperty getObject() Returns the current form's model object
 *
 * @package    payment
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseTransactionExtraPropertyForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'property_name'  => new sfWidgetFormInputText(),
      'property_value' => new sfWidgetFormTextarea(),
      'transaction_id' => new sfWidgetFormPropelChoice(array('model' => 'Transaction', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'property_name'  => new sfValidatorString(array('max_length' => 255)),
      'property_value' => new sfValidatorString(array('required' => false)),
      'transaction_id' => new sfValidatorPropelChoice(array('model' => 'Transaction', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('transaction_extra_property[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TransactionExtraProperty';
  }


}
