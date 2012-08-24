<?php

/**
 * Template form base class.
 *
 * @method Template getObject() Returns the current form's model object
 *
 * @package    payment
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseTemplateForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                          => new sfWidgetFormInputHidden(),
      'name'                        => new sfWidgetFormInputText(),
      'content'                     => new sfWidgetFormTextarea(),
      'subject'                     => new sfWidgetFormTextarea(),
      'seller_psp_configuration_id' => new sfWidgetFormPropelChoice(array('model' => 'SellerPspConfiguration', 'add_empty' => false)),
      'created_at'                  => new sfWidgetFormDateTime(),
      'updated_at'                  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                          => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'name'                        => new sfValidatorString(array('max_length' => 45)),
      'content'                     => new sfValidatorString(array('required' => false)),
      'subject'                     => new sfValidatorString(array('required' => false)),
      'seller_psp_configuration_id' => new sfValidatorPropelChoice(array('model' => 'SellerPspConfiguration', 'column' => 'id')),
      'created_at'                  => new sfValidatorDateTime(array('required' => false)),
      'updated_at'                  => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('template[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Template';
  }


}
