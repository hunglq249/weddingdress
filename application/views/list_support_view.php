<section id="support">
    <div class="cover">
        <div class="mask">
            <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=775372bf5857090b5e3e458118372cc7&auto=format&fit=crop&w=1350&q=80" alt="image support cover">

            <div class="overlay"></div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <h2 class="title-md">Support Center</h2>

                <p class="paragraph">
                    What type of product do you need help with?
                </p>
            </div>

            <?php foreach ($result as $key => $value): ?>

            <div class="item col-xs-12 col-md-4">
                <div class="inner">
                    <a href="<?php echo base_url('support/detail/') . $value['id'] ?>">
                        <div class="mask">
                            <img src="<?php echo site_url('assets/img/product/') . $value['image'] ?>" alt="image <?php echo $value['title'] ?>">
                        </div>

                        <h3 class="title-sm"><?php echo $value['title'] ?></h3>
                    </a>
                </div>
            </div>

            <?php endforeach; ?>

        </div>
    </div>
</section>