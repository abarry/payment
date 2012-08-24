<?php

/**
 * Template filter form base class.
 *
 * @package    payment
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseTemplateFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'content'                     => new sfWidgetFormFilterInput(),
      'subject'                     => new sfWidgetFormFilterInput(),
      'seller_psp_configuration_id' => new sfWidgetFormPropelChoice(array('model' => 'SellerPspConfiguration', 'add_empty' => true)),
      'created_at'                  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'                  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'name'                        => new sfValidatorPass(array('required' => false)),
      'content'                     => new sfValidatorPass(array('required' => false)),
      'subject'                     => new sfValidatorPass(array('required' => false)),
      'seller_psp_configuration_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'SellerPspConfiguration', 'column' => 'id')),
      'created_at'                  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'                  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('template_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Template';
  }

  public function getFields()
  {
    return array(
      'id'                          => 'Number',
      'name'                        => 'Text',
      'content'                     => 'Text',
      'subject'                     => 'Text',
      'seller_psp_configuration_id' => 'ForeignKey',
      'created_at'                  => 'Date',
      'updated_at'                  => 'Date',
    );
  }
}
