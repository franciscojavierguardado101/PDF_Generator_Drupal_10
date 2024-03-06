<?php

namespace Drupal\my_pdf_module\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Render\Markup;

/**
 * Provides a controller for the success page after PDF generation.
 */
class PdfSuccessController extends ControllerBase {

  /**
   * Renders the success page.
   *
   * @return array
   *   A render array for the success page.
   */
  public function successPage() {
    $build = [];
    $build['message'] = [
      '#type' => 'markup',
      '#markup' => $this->t('The PDF file has been generated!'),
    ];

    return $build;
  }
}
