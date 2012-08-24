<?php

/**
 * TransactionExtraProperty filter form base class.
 *
 * @package    payment
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseTransactionExtraPropertyFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'property_name'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'property_value' => new sfWidgetFormFilterInput(),
      'transaction_id' => new sfWidgetFormPropelChoice(array('model' => 'Transaction', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'property_name'  => new sfValidatorPass(array('required' => false)),
      'property_value' => new sfValidatorPass(array('required' => false)),
      'transaction_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Transaction', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('transaction_extra_property_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TransactionExtraProperty';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'property_name'  => 'Text',
      'property_value' => 'Text',
      'transaction_id' => 'ForeignKey',
    );
  }
}
