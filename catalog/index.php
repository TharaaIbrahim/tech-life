<?php 
// session_start();
// unset($_SESSION['cart']);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tech-life";
	try{
        $connection=new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch (PDOException $e){
        echo $sql . "<br>" . $e->getMessage();
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>
      Catalog &middot; Unistore &middot; Responsive E-Commerce Template
    </title>

    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="Sunrise Digital" />
    <link rel="shortcut icon" type="image/x-icon" href="../favicon.png" />

    <!-- Bootstrap -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
    <link href="../assets/css/custom.css" rel="stylesheet" />
    <link href="../assets/css/carousel.css" rel="stylesheet" />
    <link href="../assets/ionicons-2.0.1/css/ionicons.css" rel="stylesheet" />
    <link
      rel="stylesheet"
      href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Catamaran:400,100,300"
      rel="stylesheet"
      type="text/css"
    />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
<?php 
// include_once("../cart/cart.php");
 ?>
    <?php 
    include '../navbar.php';
    include '../cart/cart.php';
     ?>
    <hr class="offset-lg" />


    <div class="container">
      <div class="row">
        <!-- Filter -->
        <div class="col-sm-3 filter">
          <div class="item">
            <div class="title">
              <a href="#clear" data-action="open" class="down">
                <i class="ion-android-arrow-dropdown"></i> Open</a
              >
              <h1 class="h4">Type</h1>
            </div>

            <div class="controls">
              <?php
               $category=$connection->prepare("SELECT * FROM categories");
               $category->execute();
               echo "<a style={} href='index.php'>All Product </a>";
               foreach($category as $cat){
              if($cat['name']!=="default"){
               echo "<div class='checkbox-group' data-status='inactive'>";
               echo "<div class='label' data-value='Laptops'><a href='index.php?id=$cat[id]'>
                $cat[name] </a> </div>";
              echo" </div>";
              }
          
              }
              ?>
            </div>
          </div>

          <br />

        </div>
        <!-- /// -->

        <!-- Products -->
        <div class="col-sm-9 products">
         
        <div class="col-sm-12"> 
          <div class="row"><form method="GET" action="<?php $_SERVER['PHP_SELF']?>" style="display:flex;justify-content:center;">
                <input style="width: 50%;margin-right:1rem;" type="text" name="search" value="" placeholder="Search" class="form-control" id="search" />
                <button type="submit" class="btn btn-primary">Search</button>
              </div>
            </form>
            <?php
             if(isset($_GET['id'])){
              $result=$connection->prepare("SELECT * FROM products WHERE category_id=$_GET[id]");
            }elseif(isset($_GET['search'])){
              $result=$connection->prepare("SELECT * FROM products WHERE name LIKE '%$_GET[search]%'");            
            }
            else{
              $result=$connection->prepare("SELECT * FROM products");
          }
          $result->execute();
          $row=$result->fetchAll(PDO::FETCH_ASSOC) ;
          if(count($row)>0){
            foreach($row as $product){ 
              $sql="SELECT * FROM categories WHERE id=$product[category_id]";
              $result=$connection->query($sql);
              $row = $result->fetch(PDO::FETCH_ASSOC) ;
              if($product['stock']>0){
             ?>
            <div class="col-sm-6 col-md-4 product">
                <img style="width:100%;"
                  src=<?php echo $product['image'] ?>
                  alt=<?php echo $product['name'] ?>
              />
              <div class="content" style="width:100%;">
                <h1 class="h4"><?php echo $product['name'] ?></h1>
                <p class="price"><?php 
                if($product['discount'] != 1 ){ echo $product['price']-$product['price']*$product['discount']." "."JD";}
               else echo $product['price']." "."JD" ?></p>
                <p class="price through"><?php 
                if($product['discount'] != 1 ){
                  echo  $product['price']." "."JD";
                } ?> </p>
                <label ><?php echo strtoupper($row['name']) ?></label>
                 
                <a href="../catalog/product.php?details=<?php echo $product['id']?>" class="btn btn-link">
                  Details</a
                >
                <button class="btn btn-primary btn-rounded btn-sm">
                  <i class="ion-bag"></i><a style="color:white;text-decoration:none" href="./addToCart.php?id=<?php echo $product['id'] ?>&&typeCart=addToCart"> Add to cart</a>
                </button>
              </div>
            </div> <?php }}}else {
               echo "<p style='text-align:center;margin:10% 0% 10% 0;font-size:5rem;'>No Results Found</p>";
            }?>
            
          </div>

          <nav>
            <ul class="pagination">
              <li>
                <a href="#" aria-label="Previous">
                  <span aria-hidden="true"
                    ><i class="ion-ios-arrow-left"></i
                  ></span>
                </a>
              </li>
              <li class="active"><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li class="disabled"><a href="#">..</a></li>
              <li><a href="#">10</a></li>
              <li>
                <a href="#" aria-label="Next">
                  <span aria-hidden="true"
                    ><i class="ion-ios-arrow-right"></i
                  ></span>
                </a>
              </li>
            </ul>
          </nav>
        </div>
        <!-- /// -->
      </div>
    </div>
    <br /><br />

    <footer>
      <div class="about">
        <div class="container">
          <div class="row">
            <hr class="offset-md" />

            <div class="col-xs-6 col-sm-3">
              <div class="item">
                <i class="ion-ios-telephone-outline"></i>
                <h1>
                  24/7 free <br />
                  <span>support</span>
                </h1>
              </div>
            </div>
            <div class="col-xs-6 col-sm-3">
              <div class="item">
                <i class="ion-ios-star-outline"></i>
                <h1>
                  Low price <br />
                  <span>guarantee</span>
                </h1>
              </div>
            </div>
            <div class="col-xs-6 col-sm-3">
              <div class="item">
                <i class="ion-ios-gear-outline"></i>
                <h1>
                  Manufacturers <br />
                  <span>warranty</span>
                </h1>
              </div>
            </div>
            <div class="col-xs-6 col-sm-3">
              <div class="item">
                <i class="ion-ios-loop"></i>
                <h1>
                  Full refund <br />
                  <span>guarantee</span>
                </h1>
              </div>
            </div>

            <hr class="offset-md" />
          </div>
        </div>
      </div>

      <div class="subscribe">
        <div class="container align-center">
          <hr class="offset-md" />

          <h1 class="h3 upp">Join our newsletter</h1>
          <p>
            Get more information and receive special discounts for our products.
          </p>
          <hr class="offset-sm" />

          <form action="index.php" method="post">
            <div class="input-group">
              <input
                type="email"
                name="email"
                value=""
                placeholder="E-mail"
                required=""
                class="form-control"
              />
              <span class="input-group-btn">
                <button type="submit" class="btn btn-primary">
                  Subscribe <i class="ion-android-send"></i>
                </button>
              </span>
            </div>
            <!-- /input-group -->
          </form>
          <hr class="offset-lg" />
          <hr class="offset-md" />

          <div class="social">
            <a href="#"><i class="ion-social-facebook"></i></a>
            <a href="#"><i class="ion-social-twitter"></i></a>
            <a href="#"><i class="ion-social-googleplus-outline"></i></a>
            <a href="#"><i class="ion-social-instagram-outline"></i></a>
            <a href="#"><i class="ion-social-linkedin-outline"></i></a>
            <a href="#"><i class="ion-social-youtube-outline"></i></a>
          </div>

          <hr class="offset-md" />
          <hr class="offset-md" />
        </div>
      </div>

      <div class="container">
        <hr class="offset-md" />

        <div class="row menu">
          <div class="col-sm-3 col-md-2">
            <h1 class="h4">
              Information
              <i class="ion-plus-round hidden-sm hidden-md hidden-lg"></i>
            </h1>

            <div class="list-group">
              <a href="#" class="list-group-item">About</a>
              <a href="#" class="list-group-item">Terms</a>
              <a href="#" class="list-group-item">How to order</a>
              <a href="#" class="list-group-item">Delivery</a>
            </div>
          </div>
          <div class="col-sm-3 col-md-2">
            <h1 class="h4">
              Products
              <i class="ion-plus-round hidden-sm hidden-md hidden-lg"></i>
            </h1>

            <div class="list-group">
              <a href="#" class="list-group-item">Laptops</a>
              <a href="#" class="list-group-item">Tablets</a>
              <a href="#" class="list-group-item">Servers</a>
            </div>
          </div>
          <div class="col-sm-3 col-md-2">
            <h1 class="h4">
              Support
              <i class="ion-plus-round hidden-sm hidden-md hidden-lg"></i>
            </h1>

            <div class="list-group">
              <a href="#" class="list-group-item">Returns</a>
              <a href="#" class="list-group-item">FAQ</a>
              <a href="#" class="list-group-item">Contacts</a>
            </div>
          </div>
          <div class="col-sm-3 col-md-2">
            <h1 class="h4">Location</h1>

            <div class="dropdown">
              <button
                class="btn btn-default dropdown-toggle"
                type="button"
                id="dropdownMenu1"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                Language
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                <li>
                  <a href="#English">
                    <img src="../assets/img/flags/gb.png" alt="Eng" />
                    English</a
                  >
                </li>
                <li>
                  <a href="#Spanish">
                    <img src="../assets/img/flags/es.png" alt="Spa" />
                    Spanish</a
                  >
                </li>
                <li>
                  <a href="#Deutch">
                    <img src="../assets/img/flags/de.png" alt="De" /> Deutch</a
                  >
                </li>
                <li>
                  <a href="#French">
                    <img src="../assets/img/flags/fr.png" alt="Fr" /> French</a
                  >
                </li>
              </ul>
            </div>
            <hr class="offset-xs" />

            <div class="dropdown">
              <button
                class="btn btn-default dropdown-toggle"
                type="button"
                id="dropdownMenu2"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                Currency
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                <li>
                  <a href="#Euro"><i class="ion-social-euro"></i> Euro</a>
                </li>
                <li>
                  <a href="#Dollar"><i class="ion-social-usd"></i> Dollar</a>
                </li>
                <li>
                  <a href="#Yen"><i class="ion-social-yen"></i> Yen</a>
                </li>
                <li>
                  <a href="#Bitcoin"
                    ><i class="ion-social-bitcoin"></i> Bitcoin</a
                  >
                </li>
              </ul>
            </div>
          </div>
          <div
            class="col-sm-3 col-md-3 col-md-offset-1 align-right hidden-sm hidden-xs"
          >
            <h1 class="h4">Unistore, Inc.</h1>

            <address>
              1305 Market Street, Suite 800<br />
              San Francisco, CA 94102<br />
              <abbr title="Phone">P:</abbr> (123) 456-7890
            </address>

            <address>
              <strong>Support</strong><br />
              <a href="mailto:#">sup@example.com</a>
            </address>
          </div>
        </div>
      </div>

      <hr />

      <div class="container">
        <div class="row">
          <div class="col-sm-8 col-md-9 payments">
            <p>Pay your order in the most convenient way</p>

            <div class="payment-icons">
              <img src="../assets/img/payments/paypal.svg" alt="paypal" />
              <img src="../assets/img/payments/visa.svg" alt="visa" />
              <img src="../assets/img/payments/master-card.svg" alt="mc" />
              <img src="../assets/img/payments/discover.svg" alt="discover" />
              <img src="../assets/img/payments/american-express.svg" alt="ae" />
            </div>
            <br />
          </div>
          <div class="col-sm-4 col-md-3 align-right align-center-xs">
            <hr class="offset-sm hidden-sm" />
            <hr class="offset-sm" />
            <p>
              Unistore Pro © 2016 <br />
              Designed By
              <a href="http://sunrise.ru.com/" target="_blank"
                >Sunrise Digital</a
              >
            </p>
            <hr class="offset-lg visible-xs" />
          </div>
        </div>
      </div>
    </footer>

    <!-- Modal -->
    <div class="modal fade" id="Modal-SignIn" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true"><i class="ion-android-close"></i></span>
            </button>
          </div>
          <div class="modal-body">
            <div class="container-fluid">
              <div class="row">
                <div class="col-sm-6">
                  <h4 class="modal-title">Join Free</h4>
                  <br />

                  <form class="join" action="index.php" method="post">
                    <input
                      type="email"
                      name="email"
                      value=""
                      placeholder="E-mail"
                      required=""
                      class="form-control"
                    />
                    <br />
                    <input
                      type="password"
                      name="password"
                      value=""
                      placeholder="Password"
                      required=""
                      class="form-control"
                    />
                    <br />

                    <button type="submit" class="btn btn-primary btn-sm">
                      Join
                    </button>
                    <a href="#">Terms ></a>

                    <br /><br />
                    <p>
                      By creating an account you will be able to shop faster, be
                      up to date on an order's status, and keep track of the
                      orders you have previously made.
                    </p>
                  </form>
                </div>
                <div class="col-sm-6">
                  <h4 class="modal-title">Sign In</h4>
                  <br />

                  <form class="signin" action="index.php" method="post">
                    <input
                      type="email"
                      name="email"
                      value=""
                      placeholder="E-mail"
                      required=""
                      class="form-control"
                    />
                    <br />
                    <input
                      type="password"
                      name="password"
                      value=""
                      placeholder="Password"
                      required=""
                      class="form-control"
                    />
                    <br />

                    <button type="submit" class="btn btn-primary btn-sm">
                      Sign In
                    </button>
                    <a href="#forgin-password" data-action="Forgot-Password"
                      >Password recovery ></a
                    >
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer"></div>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="Modal-ForgotPassword"
      tabindex="-1"
      role="dialog"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true"><i class="ion-android-close"></i></span>
            </button>
          </div>
          <div class="modal-body">
            <div class="container-fluid">
              <div class="row">
                <div class="col-sm-6">
                  <h4 class="modal-title">Forgot Your Password?</h4>
                  <br />

                  <form class="join" action="index.php" method="post">
                    <input
                      type="email"
                      name="email"
                      value=""
                      placeholder="E-mail"
                      required=""
                      class="form-control"
                    />
                    <br />

                    <button type="submit" class="btn btn-primary btn-sm">
                      Continue
                    </button>
                    <a href="#Sign-In" data-action="Sign-In">Back ></a>
                  </form>
                </div>
                <div class="col-sm-6">
                  <br /><br />
                  <p>
                    Enter the e-mail address associated with your account. Click
                    submit to have your password e-mailed to you.
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer"></div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="Modal-Gallery" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true"><i class="ion-android-close"></i></span>
            </button>
            <h4 class="modal-title">Title</h4>
          </div>
          <div class="modal-body"></div>
          <div class="modal-footer"></div>
        </div>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../assets/js/jquery-latest.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/core.js"></script>
    <script src="../assets/js/catalog.js"></script>

    <script
      type="text/javascript"
      src="../assets/js/jquery-ui-1.11.4.js"
    ></script>
    <script
      type="text/javascript"
      src="../assets/js/jquery.ui.touch-punch.js"
    ></script>
  </body>
</html>
