<?php

namespace Drupal\custom_submission_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;
use Drupal\media\Entity\Media;

/**
 * Submission form for uploading media and a message.
 */
class SubmissionForm extends FormBase {

  public function getFormId() {
    return 'custom_submission_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['full_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Full Name'),
      '#required' => TRUE,
      '#placeholder' => $this->t('Enter your full name'),
    ];

    $form['media_image'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Upload Images'),
      '#upload_location' => 'public://media',
      '#required' => TRUE,
      '#multiple' => TRUE,
    ];

    $form['media_video'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Upload Videos'),
      '#upload_location' => 'public://media',
      '#multiple' => TRUE,
    ];

    $form['message'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Message'),
      '#required' => FALSE,
      '#placeholder' => $this->t('Enter your message'),
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
    // Validate image files.
    $image_files = $form_state->getValue('media_image');
    if (!empty($image_files) && is_array($image_files)) {
      foreach ($image_files as $fid) {
        $file = File::load($fid);
        if ($file) {
          $ext = pathinfo($file->getFilename(), PATHINFO_EXTENSION);
          $allowed = ['png', 'jpg', 'jpeg', 'gif', 'heic'];
          if (!in_array(strtolower($ext), $allowed)) {
            $form_state->setErrorByName('media_image', $this->t('The file extension %ext is not allowed.', ['%ext' => $ext]));
          }
          if ($file->getSize() > 20 * 1024 * 1024) {
            $form_state->setErrorByName('media_image', $this->t('The file %name exceeds the maximum size of 20 MB.', ['%name' => $file->getFilename()]));
          }
        }
      }
    }

    // Validate video files.
    $video_files = $form_state->getValue('media_video');
    if (!empty($video_files) && is_array($video_files)) {
      foreach ($video_files as $fid) {
        $file = File::load($fid);
        if ($file) {
          $ext = pathinfo($file->getFilename(), PATHINFO_EXTENSION);
          $allowed = ['mp4', 'mov'];
          if (!in_array(strtolower($ext), $allowed)) {
            $form_state->setErrorByName('media_video', $this->t('The file extension %ext is not allowed.', ['%ext' => $ext]));
          }
          if ($file->getSize() > 20 * 1024 * 1024) {
            $form_state->setErrorByName('media_video', $this->t('The file %name exceeds the maximum size of 20 MB.', ['%name' => $file->getFilename()]));
          }
        }
      }
    }
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $name = $form_state->getValue('full_name');
    $message = $form_state->getValue('message');
    $image_files = $form_state->getValue('media_image');
    $video_files = $form_state->getValue('media_video');
    $uid = \Drupal::currentUser()->id();

    if (!empty($image_files) && is_array($image_files)) {
      foreach ($image_files as $fid) {
        $file = File::load($fid);
        if ($file) {
          $file->setPermanent();
          $file->save();

          $media = Media::create([
            'bundle' => 'image',
            'name' => $file->getFilename(),
            'uid' => $uid,
            'status' => 0,
            'field_media_image' => [
              'target_id' => $file->id(),
            ],
          ]);
          $media->save();
        }
      }
    }

    if (!empty($video_files) && is_array($video_files)) {
      foreach ($video_files as $fid) {
        $file = File::load($fid);
        if ($file) {
          $file->setPermanent();
          $file->save();

          $media = Media::create([
            'bundle' => 'video',
            'name' => $file->getFilename(),
            'uid' => $uid,
            'status' => 0,
            'field_media_video' => [
              'target_id' => $file->id(),
            ],
          ]);
          $media->save();
        }
      }
    }

    $this->messenger()->addMessage($this->t('Your submission has been received. It will be reviewed before publishing.'));
  }

}
