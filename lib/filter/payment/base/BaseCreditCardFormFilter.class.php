<?php

/**
 * CreditCard filter form base class.
 *
 * @package    payment
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseCreditCardFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'alias'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'brand'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'number'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'expires_at'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'owner'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'is_selected' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'user_id'     => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'alias'       => new sfValidatorPass(array('required' => false)),
      'brand'       => new sfValidatorPass(array('required' => false)),
      'number'      => new sfValidatorPass(array('required' => false)),
      'expires_at'  => new sfValidatorPass(array('required' => false)),
      'owner'       => new sfValidatorPass(array('required' => false)),
      'is_selected' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'user_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('credit_card_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CreditCard';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'alias'       => 'Text',
      'brand'       => 'Text',
      'number'      => 'Text',
      'expires_at'  => 'Text',
      'owner'       => 'Text',
      'is_selected' => 'Boolean',
      'user_id'     => 'ForeignKey',
    );
  }
}
