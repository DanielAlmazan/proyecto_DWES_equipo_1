<?php
  require_once("header.php");
  
  //TODO: Load events
?>

<!-- Principal Content Start -->
   <div id="index">

    <!-- Header -->
      <div class="row">
         <div class="col-xs-12 intro">
            <div class="carousel-inner">
               <div class="item active">
                <img class="img-responsive" src="images/index/woman.jpg" alt="header picture">
               </div>
            </div>
         </div>
      </div>

      <section id="index-body">
      
      <!-- Navigation Table Content -->
        <div class="tab-content">

        <!-- First Category pictures -->
           <div id="category1" class="tab-pane active" >
              <div class="row popup-gallery">
                <!--<div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="sol">
                      <img class="img-responsive" src="images/index/portfolio/1.jpg" alt="First category picture">
                      <div class="behind">
                          <div class="head text-center">
                            <ul class="list-inline">
                              <li>
                                <a class="gallery" href="images/index/gallery/1.jpg" data-toggle="tooltip" data-original-title="Quick View">
                                  <i class="fa fa-eye"></i>
                                </a>
                              </li>
                              <li>
                                <a href="#" data-toggle="tooltip" data-original-title="Click if you like it">
                                  <i class="fa fa-heart"></i>
                                </a>
                              </li>
                              <li>
                                <a href="#" data-toggle="tooltip" data-original-title="Download">
                                  <i class="fa fa-download"></i>
                                </a>
                              </li>
                              <li>
                                <a href="#" data-toggle="tooltip" data-original-title="More information">
                                  <i class="fa fa-info"></i>
                                </a>
                              </li>
                            </ul>
                          </div>
                          <div class="row box-content">
                            <ul class="list-inline text-center">
                              <li><i class="fa fa-eye"></i> 1000</li>
                              <li><i class="fa fa-heart"></i> 500</li>
                              <li><i class="fa fa-download"></i> 100</li>
                            </ul>
                          </div>
                      </div>
                    </div>
                </div>-->
                
              </div>
              <!--<nav class="text-center">
                <ul class="pagination">
                  <li class="active"><a href="#">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#" aria-label="suivant">
                    <span aria-hidden="true">&raquo;</span>
                  </a></li>
                </ul>
              </nav>-->
           </div>
        </div>
        <!-- End of First category pictures -->
        
    <!-- End of Navigation Table Content -->
      </section><!-- End of Index-body box -->

    <!-- Newsletter form -->
      <div class="index-form text-center">
        <h3>SUSCRIBE TO OUR NEWSLETTER </h3>
        <h5>Suscribe to receive our News and Gifts</h5>
        <form class="form-horizontal">
          <div class="form-group">
            <div class="col-xs-12 col-sm-6 col-sm-push-3 col-md-4 col-md-push-4">
            <input class="form-control" type="text" placeholder="Type here your email address">
            <a href="" class="btn btn-lg sr-button">SUBSCRIBE</a>
            </div>
          </div>
        </form>
      </div>
    <!-- End of Newsletter form -->  
   </div><!-- End of index box -->

<?php
  require_once('footer.php');
?>
