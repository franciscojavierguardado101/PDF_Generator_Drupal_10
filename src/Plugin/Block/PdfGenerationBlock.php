<?php

namespace Drupal\my_pdf_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\dompdf\Controller\DomPdfController;
use Drupal\Core\Url;

/**
 * Provides a block for generating a PDF of the current page.
 *
 * @Block(
 *   id = "pdf_generation_block",
 *   admin_label = @Translation("PDF Generation Block"),
 * )
 */
class PdfGenerationBlock extends BlockBase implements BlockPluginInterface {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array &$form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);

    // Add a button to trigger PDF generation.
    $form['generate_pdf_button'] = [
      '#type' => 'submit',
      '#value' => $this->t('Generate PDF'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $current_url = $this->getCurrentUrl();

    // Use DomPDF library to generate PDF of the current page.
    $dompdf = new DomPdfController();
    $dompdf->generatePdf($current_url);

    // Optionally, redirect to a success page or display a message.
    $form_state->setRedirect('my_pdf_module.success'); // Replace with your success route if needed.
  }

  /**
   * Gets the current URL based on the context.
   *
   * @return \Drupal\Core\Url
   *   The current URL object.
   */
  protected function getCurrentUrl() {
    $request = $this->getRequest();
    return $request->getCurrentUrl();
  }

  /**
   * {@inheritdoc}
   */
  public function blockBuild() {
    $build = [];

    // Optionally, you could add a link to trigger PDF generation instead of a button.

    return $build;
  }
}
