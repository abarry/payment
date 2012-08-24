<?php

/**
 * Seller form base class.
 *
 * @method Seller getObject() Returns the current form's model object
 *
 * @package    payment
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseSellerForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'name'         => new sfWidgetFormInputText(),
      'description'  => new sfWidgetFormTextarea(),
      'ident'        => new sfWidgetFormInputText(),
      'sha_key'      => new sfWidgetFormInputText(),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
      'slugged_name' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'name'         => new sfValidatorString(array('max_length' => 100)),
      'description'  => new sfValidatorString(array('required' => false)),
      'ident'        => new sfValidatorString(array('max_length' => 50)),
      'sha_key'      => new sfValidatorString(array('max_length' => 50)),
      'created_at'   => new sfValidatorDateTime(array('required' => false)),
      'updated_at'   => new sfValidatorDateTime(array('required' => false)),
      'slugged_name' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Seller', 'column' => array('slugged_name')))
    );

    $this->widgetSchema->setNameFormat('seller[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Seller';
  }


}
