<?php

/**
 * Transaction filter form base class.
 *
 * @package    payment
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseTransactionFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'reference'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'taxes'        => new sfWidgetFormFilterInput(),
      'currency'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'status'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'is_processed' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'order_id'     => new sfWidgetFormPropelChoice(array('model' => 'Order', 'add_empty' => true)),
      'created_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'reference'    => new sfValidatorPass(array('required' => false)),
      'taxes'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'currency'     => new sfValidatorPass(array('required' => false)),
      'status'       => new sfValidatorPass(array('required' => false)),
      'is_processed' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'order_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Order', 'column' => 'id')),
      'created_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('transaction_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Transaction';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'reference'    => 'Text',
      'taxes'        => 'Number',
      'currency'     => 'Text',
      'status'       => 'Text',
      'is_processed' => 'Boolean',
      'order_id'     => 'ForeignKey',
      'created_at'   => 'Date',
      'updated_at'   => 'Date',
    );
  }
}
