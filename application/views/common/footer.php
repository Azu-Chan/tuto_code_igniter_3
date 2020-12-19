<div class="container">
      <hr>
      <footer>
        <p>&copy; Petit Blog 2016</p>
      </footer>
      </div>
      <script src="<?= base_url("js/jquery-2.1.4.min.js") ?>"></script>
      <script src="<?= base_url("js/bootstrap.min.js") ?>"></script>
      <?php
        if (isset($script)) {
            echo $script;
        }
      ?>
  </body>
</html>
