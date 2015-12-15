<!DOCTYPE html>
<html lang='en'>
  <head>
    <?php
      $title = 'Recover Password';
      view('partials/_assets', compact('title'))
    ?>
  </head>
  <body>
    <div class="container">
      <div class="row">

        <div class="col-sm-5">
          <h1 class="text-center page-header">Recover password</h1>
          <form action="<?php echo url('recover'); ?>" method="POST">
            <input type="hidden" name="<?php echo App\Classes\Utils\Globals::TOKEN_NAME; ?>" value="<?php echo App\Classes\Utils\Token::generate(); ?>">
            <div class="form-group">
              <label for="username" class="control-label">Username:</label>
              <input type="text" name="username" id="username" class="form-control" placeholder="Enter your Username" required>
            </div>
            <div class="form-group">
              <label for="email" class="control-label">Email:</label>
              <input type="email" name="email" id="email" class="form-control" placeholder="Enter your E-mail" required>
            </div>
            <div class="form-group text-right">
              <button type="submit" class="btn btn-md btn-primary">Recover</button>
            </div>
            <?php
              view('partials/_errors');
              view('partials/_messages');
            ?>
            <div class="form-group">
              <p>Don't have any account? <a href="<?php echo url('register'); ?>">Sign Up</a></p>
              <p>Already have an account? <a href="<?php echo url('login'); ?>">Login</a></p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
