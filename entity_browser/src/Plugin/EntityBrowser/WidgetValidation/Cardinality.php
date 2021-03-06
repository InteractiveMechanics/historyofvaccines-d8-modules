<?php

namespace Drupal\entity_browser\Plugin\EntityBrowser\WidgetValidation;

use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\entity_browser\WidgetValidationBase;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;

/**
 * Validates that the widget returns the appropriate number of elements.
 *
 * @EntityBrowserWidgetValidation(
 *   id = "cardinality",
 *   label = @Translation("Cardinality validator")
 * )
 */
class Cardinality extends WidgetValidationBase {

  /**
   * {@inheritdoc}
   */
  public function validate(array $entities, $options = []) {
    $violations = new ConstraintViolationList();

    // As this validation happens at a level above the individual entities,
    // we implement logic without using Constraint Plugins.
    $count = count($entities);
    $max = $options['cardinality'];
    if ($max !== FieldStorageDefinitionInterface::CARDINALITY_UNLIMITED && $count > $max) {
      $message = 'You can not select more than %max entities.';
      $parameters = ['%max' => $max];
      $violation = new ConstraintViolation($this->t($message, $parameters), $message, $parameters, $count, '', $count);
      $violations->add($violation);
    }

    return $violations;
  }

}
