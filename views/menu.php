<!-- MENU-->
<?php
     require_once('controllers/Menus.php');
     $menus = new Menus();
?>
<section id="menu" data-stellar-background-ratio="0.5">
     <div class="container">
          <div class="row">

               <div class="col-md-12 col-sm-12">
                    <div class="section-title wow fadeInUp" data-wow-delay="0.1s">
                         <h2>Our Menus</h2>
                         <h4>Tea Time &amp; Dining</h4>
                    </div>
               </div>

               <?php foreach($menus->menus as $menu): ?>
                    <div class="col-md-4 col-sm-6">
                         <!-- MENU THUMB -->
                         <div class="menu-thumb">
                              <a href="images/menu-image1.jpg" class="image-popup" title="American Breakfast">
                                   <img src="<?= $menu->src; ?>" class="img-responsive" alt="<?= $menu->alt; ?>">

                                   <div class="menu-info">
                                        <div class="menu-item">
                                             <h3><?= $menu->name; ?></h3>
                                             <p><?= $menu->getIngredients(); ?></p>
                                        </div>
                                        <div class="menu-price">
                                             <span><?= $menu->getPrice(); ?></span>
                                        </div>
                                   </div>
                              </a>
                         </div>
                    </div>
               <?php endforeach; ?>

          </div>
     </div>
</section>