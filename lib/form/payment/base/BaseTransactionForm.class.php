<?php

/**
 * Transaction form base class.
 *
 * @method Transaction getObject() Returns the current form's model object
 *
 * @package    payment
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseTransactionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'reference'    => new sfWidgetFormInputText(),
      'taxes'        => new sfWidgetFormInputText(),
      'currency'     => new sfWidgetFormInputText(),
      'status'       => new sfWidgetFormInputText(),
      'is_processed' => new sfWidgetFormInputCheckbox(),
      'order_id'     => new sfWidgetFormPropelChoice(array('model' => 'Order', 'add_empty' => false)),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'reference'    => new sfValidatorString(array('max_length' => 45)),
      'taxes'        => new sfValidatorNumber(array('required' => false)),
      'currency'     => new sfValidatorString(array('max_length' => 45)),
      'status'       => new sfValidatorString(array('max_length' => 45)),
      'is_processed' => new sfValidatorBoolean(),
      'order_id'     => new sfValidatorPropelChoice(array('model' => 'Order', 'column' => 'id')),
      'created_at'   => new sfValidatorDateTime(array('required' => false)),
      'updated_at'   => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Transaction', 'column' => array('reference')))
    );

    $this->widgetSchema->setNameFormat('transaction[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Transaction';
  }


}
