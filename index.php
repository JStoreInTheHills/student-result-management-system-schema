<?php

?>

<!DOCTYPE html>
<html lang="en">

  <?php include "./resources/views/css_files.html";  ?>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

  <?php include "./resources/views/sidebar.html";  ?>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">
       <?php include "./resources/views/topbar.php";  ?>

          <?php #include "./resources/views/index_.html";  ?>

        <?php #include './layouts/utils/edit_school_modal.html'; ?>

      </div>
      <!-- End of Main Content -->

     <?php include "./resources/views/footer.html";  ?>

    </div>
    <!-- End of Content Wrapper -->
    <?php #include 'layouts/utils/logout_modal.html'?>
  </div>
  <!-- End of Page Wrapper -->

  <script src="/dist/js/main.min.js"></script>
  <!-- <script src="/dist/js/utils/school.js"></script>
  <script src="/dist/js/utils/utils.js"></script>
  <script src="/dist/js/dashboard/dashboard.js"></script> -->
</body>

</html>