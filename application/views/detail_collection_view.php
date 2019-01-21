<!-- Animate CSS -->
<link rel="stylesheet" href="<?php echo site_url('node_modules/animate.css/') ?>animate.min.css">

<section id="detail-collection">
    <div class="cover">
        <div class="image">
            <div class="item">
                <div class="mask">
                    <img src="<?php echo base_url('assets/upload/collection/'.$collection['slug'].'/'.$collection['image_left']);?>" alt="image latest collection">
                </div>
            </div>
            <div class="item">
                <div class="mask">
                    <img src="<?php echo base_url('assets/upload/collection/'.$collection['slug'].'/'.$collection['image_right']);?>" alt="image latest collection">
                </div>
            </div>

            <div class="content">
                <h6 class="subtitle">
                    <?php echo $this->lang->line('new_collection')?>
                </h6>
                <h1>
                    <?php echo $collection['title']; ?>
                </h1>
            </div>
        </div>
    </div>

    <div class="container list-items">
        <div class="row">
            <div class="left col-xs-12 col-md-3">
                <div class="line"></div>
                <p class="paragraph">
                    <?php echo $collection['description']; ?>
                </p>
            </div>

            <div class="right col-xs-12 col-md-8">
                <div class="grid">
                    <div class="grid-sizer"></div>
                    <?php if (count($product) == 0): ?>
                        <?php echo $message;?>
                    <?php endif ?>
                    <?php foreach ($product as $key => $value): ?>
                        <?php $data = json_decode($value['data'],true); ?>
                        <?php $common = json_decode($value['common'],true); ?>
                        <div class="grid-item <?php echo ($key % 2 == 0)? 'grid-item-mt' : '' ?> wow fadeInUp" data-wow-delay="0.<?php echo $key ?>s">
                            <div class="image">
                                <div class="mask">
                                    <a href="<?php echo base_url('san-pham/'.$value['slug']) ?>">
                                        <img src="https://scontent.fsgn2-2.fna.fbcdn.net/v/t1.0-9/37390753_418398698672124_8871318781691953152_n.jpg?_nc_cat=103&_nc_ht=scontent.fsgn2-2.fna&oh=6beea61e6da7aaef01d3d28a1876ebe8&oe=5C7C7AC1" alt="image product">
                                    </a>
                                </div>

                                <div class="name">
                                    <h6>Name of Product Jessica</h6>
                                </div>
                            </div>
                            <div class="content">
                                <h4>
                                    <a href="<?php echo base_url('san-pham/'.$value['slug']) ?>">
                                        <?php echo $value['title'] ?>
                                    </a>
                                </h4>
                                <h6>Code: <?php echo $data['ma_san_pham'] ?></h6>
                                <div class="price">
                                    <?php if ($common['rent'] == 'true'): ?>
                                        <span class="price-rent">
                                            <?php if ($common['showpromotion_rent'] == 'true'): ?>
                                                <?php echo $value['pricepromotion_rent'] ?> vnd <small><?php echo $value['price_rent'] ?> vnd</small>
                                            <?php else:?>
                                                <?php echo $value['price_rent'] ?> vnd 
                                            <?php endif ?>
                                        </span>
                                    <?php endif ?>
                                    <span class="price-buy">
                                    <?php if ($common['sale'] == 'true' && $common['showpromotion'] == 'true'): ?>
                                        <?php echo $value['pricepromotion'] ?> vnd <small><?php echo $value['price'] ?> vnd</small>
                                    <?php else:?>
                                        <?php echo $value['price'] ?> vnd 
                                    <?php endif ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Isotope JS -->
<script src="<?php echo site_url('node_modules/isotope-layout/') ?>dist/isotope.pkgd.min.js"></script>
<!-- imageLoaded JS -->
<script src="<?php echo site_url('node_modules/imagesloaded/') ?>imagesloaded.pkgd.min.js"></script>
<!-- wow JS -->
<script src="<?php echo site_url('node_modules/wow.js/') ?>dist/wow.min.js"></script>

<script>
    $(document).ready(function(){
        // init Isotope
        var $grid = $('.grid').isotope({
            itemSelector: '.grid-item',
            percentPosition: true,
            masonry: {
                // use element for option
                columnWidth: '.grid-sizer'
            }
        });
        // layout Isotope after each image loads
        $grid.imagesLoaded().progress( function() {
            $grid.isotope('layout');
        });

        new WOW().init();
    })
</script>