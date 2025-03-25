<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <?php include 'navbar.php'; ?>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2>Contact Us</h2>
        <form id="contactForm">
          <div class="form-group">
            <label for="firstname">Nama Depan:</label>
            <input type="text" class="form-control" id="firstname" name="firstname" required>
          </div>
          <div class="form-group">
            <label for="lastname">Nama Belakang:</label>
            <input type="text" class="form-control" id="lastname" name="lastname" required>
          </div>
          <div class="form-group">
            <label for="message">Kritik dan Saran:</label>
            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Kirim</button>
        </form>
      </div>
    </div>
  </div>
  <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="successModalLabel">Sukses</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Data telah disimpan!
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
  <script>
    $(document).ready(function() {
      $('#contactForm').on('submit', function(event) {
        event.preventDefault();

        $.ajax({
          url: 'save_message.php',
          method: 'post',
          data: $(this).serialize(),
          success: function(response) {
            $('#successModal').modal('show');
            $('#contactForm')[0].reset();
          }
        });
      });
    });
  </script>
  <?php include 'footer.php'; ?>
  <script src="https://cdn.botpress.cloud/webchat/v2/inject.js"></script>
  <script src="https://mediafiles.botpress.cloud/bac8c003-5434-411c-b4dd-68a4a959f0fd/webchat/v2/config.js"></script>
</body>
</html>
