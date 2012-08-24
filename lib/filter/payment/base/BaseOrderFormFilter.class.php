<?php

/**
 * Order filter form base class.
 *
 * @package    payment
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseOrderFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'reference'                   => new sfWidgetFormFilterInput(),
      'amount'                      => new sfWidgetFormFilterInput(),
      'hash'                        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'user_id'                     => new sfWidgetFormFilterInput(),
      'seller_psp_configuration_id' => new sfWidgetFormPropelChoice(array('model' => 'SellerPspConfiguration', 'add_empty' => true)),
      'created_at'                  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'                  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'reference'                   => new sfValidatorPass(array('required' => false)),
      'amount'                      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'hash'                        => new sfValidatorPass(array('required' => false)),
      'user_id'                     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'seller_psp_configuration_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'SellerPspConfiguration', 'column' => 'id')),
      'created_at'                  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'                  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('order_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Order';
  }

  public function getFields()
  {
    return array(
      'id'                          => 'Number',
      'reference'                   => 'Text',
      'amount'                      => 'Number',
      'hash'                        => 'Text',
      'user_id'                     => 'Number',
      'seller_psp_configuration_id' => 'ForeignKey',
      'created_at'                  => 'Date',
      'updated_at'                  => 'Date',
    );
  }
}
