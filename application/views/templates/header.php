<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/fontawesome.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <!-- js -->


    <!-- static css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url();  ?>assets/static/css/nav.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url();  ?>assets/static/css/landing.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url();  ?>assets/static/css/footer.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url();  ?>assets/static/css/dark_mode.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url();  ?>assets/static/css/kategori.css">


    <link
      rel="shortcut icon"
      href="<?= base_url(); ?>assets/images/logo/<?= $this->Settings_model->getSetting()['favicon']; ?>"
      type="image/x-icon"
    />
    <title><?= $title ?></title>
  </head>
  <body>

  <?php
  $setting = $this->db->get('settings')->row_array();
  $dateNow = date('Y-m-d H:i');
  $dateDB = $setting['promo_time'];
  $dateDBNew = str_replace("T"," ",$dateDB);
  if($dateNow >= $dateDBNew){
    $this->db->set('promo', 0);
    $this->db->update('settings');
  }
  ?>

  


