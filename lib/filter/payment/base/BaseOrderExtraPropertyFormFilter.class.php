<?php

/**
 * OrderExtraProperty filter form base class.
 *
 * @package    payment
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseOrderExtraPropertyFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'property_name'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'property_value' => new sfWidgetFormFilterInput(),
      'order_id'       => new sfWidgetFormPropelChoice(array('model' => 'Order', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'property_name'  => new sfValidatorPass(array('required' => false)),
      'property_value' => new sfValidatorPass(array('required' => false)),
      'order_id'       => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Order', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('order_extra_property_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'OrderExtraProperty';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'property_name'  => 'Text',
      'property_value' => 'Text',
      'order_id'       => 'ForeignKey',
    );
  }
}
