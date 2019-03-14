<!DOCTYPE html>
<html lang="ru">
<head>
  <title>sakh.com example</title>
  
  <!-- meta tags -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- css style sheets -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
  <link rel="stylesheet" type="text/css" href="/css/index.css">

  <!-- js files -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>
<body>
      <header>
      <div class="header__inner">

        <div class="header__logo">
          <a href="/"><img src="/img/logo.svg"></a>
        </div>
        <nav>
          <a href="/wallet">
            <?php
              if ($_SESSION['login']) {
                echo '<span class="balance">'.$data['balance'].' $</span><img class="user__photo" src="/img/nophoto.png">';
              }

              else {
                echo 'Уже есть аккаунт? <a href="/login">Войти</a>';
              }
            ?>
        </a>
      </nav>
      </div>
    </header>
  <div class="app">


    <?php print_r($content); ?>

    <footer>
      <div class="footer__main"></div>
      <div class="footer__subpanel">
        &copy; 2019 Sakhcom exapmle
      </div>
    </footer>
  </div>
</body>
</html>

<script type="text/javascript">
  function showModal() {
    $('.modal__layout').show();
  }
  function hideModal() {
    $('.modal__layout').hide();
  }
</script>