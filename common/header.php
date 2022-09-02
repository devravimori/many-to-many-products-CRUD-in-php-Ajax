<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <title><?php echo isset($title)?$title:'' ?></title>
  <meta name="description" content="<?php echo isset($description)?$description:'' ?>" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.css" />
  <style>
    div[class="form-group"] {
      margin-top: -.8rem;
    }

    .submit_btn {
      margin-top: -.5rem;
    }

    label {
      padding-bottom: .6rem;
    }

    .styled-border {
      width: 20%;
      border-style: double;
      border-width: medium;
      border-color: #0d6efd;
      opacity: 0.7;
    }
  </style>
</head>
<?php $curPage = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"],"/") + 1); ?>
<body>
  <!-- nav -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container ">
      <div class="row mx-auto fw-semibold">
        <div class="col col-12 col-md-12">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a class="nav-link <?php echo $curPage=='index.php'?'active':'' ?>" href="./">Product</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php echo $curPage=='category.php'?'active':'' ?>" href="category.php">Category</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </nav>