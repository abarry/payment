<?php

/**
 * SellerPspConfiguration filter form base class.
 *
 * @package    payment
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseSellerPspConfigurationFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'seller_id'         => new sfWidgetFormPropelChoice(array('model' => 'Seller', 'add_empty' => true)),
      'psp_name'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'service_type'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'psp_configuration' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'seller_id'         => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Seller', 'column' => 'id')),
      'psp_name'          => new sfValidatorPass(array('required' => false)),
      'service_type'      => new sfValidatorPass(array('required' => false)),
      'psp_configuration' => new sfValidatorPass(array('required' => false)),
      'created_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('seller_psp_configuration_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SellerPspConfiguration';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'seller_id'         => 'ForeignKey',
      'psp_name'          => 'Text',
      'service_type'      => 'Text',
      'psp_configuration' => 'Text',
      'created_at'        => 'Date',
      'updated_at'        => 'Date',
    );
  }
}
