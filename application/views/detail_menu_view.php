<section id="menu-detail">
    <div class="cover">
        <div id="leftImage">
            <div class="mask">
                <img src="https://images.unsplash.com/photo-1485704686097-ed47f7263ca4?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=b3a0347e68dba64f130c186dc3f396ea&auto=format&fit=crop&w=1369&q=80" alt="">

                <div class="overlay"></div>
            </div>
        </div>

        <div id="mainImage">
            <div class="mask">
                <img src="https://images.unsplash.com/photo-1485704686097-ed47f7263ca4?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=b3a0347e68dba64f130c186dc3f396ea&auto=format&fit=crop&w=1369&q=80" alt="">

                <div class="cover-title">
                    <h1 class="title-lg">Steak</h1>
                </div>
            </div>
        </div>

        <div id="side-title">
            <h1 class="title-xlg">Steak</h1>
        </div>
    </div>

	<div class="container-fluid" id="description">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2">
					<p class="paragraph">
						Donec id dolor non dui viverra varius molestie convallis lectus. Sed sed rhoncus massa. Pellentesque ipsum erat, rhoncus congue fermentum sit amet, pharetra eu odio. Fusce maximus eu tortor sit amet efficitur. Nam turpis arcu, auctor et commodo sed, facilisis non est. Nulla eget accumsan magna. Integer tincidunt urna nulla, sed tempus est porttitor vitae. Sed et elit a elit accumsan porttitor. In ex urna, volutpat ac rutrum ac, porttitor in tellus. Pellentesque iaculis turpis id arcu suscipit fermentum. Ut et imperdiet augue, ut convallis purus.
					</p>

					<p class="paragraph">
						Sed facilisis, urna ac tristique gravida, tellus lorem tempus dolor, vel hendrerit nisl ante non metus. Nunc vehicula commodo est nec sagittis. Cras urna nibh, pellentesque quis dui quis, porttitor scelerisque velit. In hac habitasse platea dictumst. Vivamus semper nec sem ac vehicula. Suspendisse efficitur facilisis aliquet. Quisque ullamcorper magna ex, eu porta leo efficitur vitae.
					</p>
				</div>
			</div>
		</div>
	</div>

	<div class="container" id="menu-list">
		<h2 class="title-md">Steak Menu</h2>
		<div class="row">
            <?php
            $value = array(
                ['steak' , 'Grilling smokey sausages and brats on a grill' , '999.999.999 vnd' , 'Sed facilisis, urna ac tristique gravida, tellus lorem tempus dolor, vel hendrerit nisl ante non metus. Nunc vehicula commodo est nec sagittis. Cras urna nibh, pellentesque quis dui quis, porttitor scelerisque velit. In hac habitasse platea dictumst. Vivamus semper nec sem ac vehicula. Suspendisse efficitur facilisis aliquet. Quisque ullamcorper magna ex, eu porta leo efficitur vitae.', 'https://images.unsplash.com/photo-1488992783499-418eb1f62d08?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=94653fa675a682fedd91970fae3fa1e1&auto=format&fit=crop&w=2306&q=80'],
                ['steak' , 'Grilling smokey sausages and brats on a grill' , '999.999.999 vnd' , 'Sed facilisis, urna ac tristique gravida, tellus lorem tempus dolor, vel hendrerit nisl ante non metus. Nunc vehicula commodo est nec sagittis. Cras urna nibh, pellentesque quis dui quis, porttitor scelerisque velit. In hac habitasse platea dictumst. Vivamus semper nec sem ac vehicula. Suspendisse efficitur facilisis aliquet. Quisque ullamcorper magna ex, eu porta leo efficitur vitae.', 'https://images.unsplash.com/photo-1457393568996-e452740c8346?ixlib=rb-0.3.5&s=02443601b62a847b2fc970cf15900c0c&auto=format&fit=crop&w=1950&q=80'],
                ['steak' , 'Grilling smokey sausages and brats on a grill' , '999.999.999 vnd' , 'Sed facilisis, urna ac tristique gravida, tellus lorem tempus dolor, vel hendrerit nisl ante non metus. Nunc vehicula commodo est nec sagittis. Cras urna nibh, pellentesque quis dui quis, porttitor scelerisque velit. In hac habitasse platea dictumst. Vivamus semper nec sem ac vehicula. Suspendisse efficitur facilisis aliquet. Quisque ullamcorper magna ex, eu porta leo efficitur vitae.', 'https://images.unsplash.com/photo-1457393568996-e452740c8346?ixlib=rb-0.3.5&s=02443601b62a847b2fc970cf15900c0c&auto=format&fit=crop&w=1950&q=80']
            );
            ?>

            <?php for ($i = 0; $i < count($value); $i ++){ ?>
				<div class="item col-xs-12 col-lg-6">
					<div class="inner">
						<h3 class="subtitle-md"><?php echo $value[$i][0] ?></h3>

						<h2 class="title-md text-wrapper"><?php echo $value[$i][1] ?></h2>

						<h2 class="title-md"><?php echo $value[$i][2] ?></h2>

						<p class="paragraph text-wrapper"><?php echo $value[$i][3] ?></p>

						<div class="mask">
							<img src="<?php echo $value[$i][4] ?>" alt="post image">
						</div>
					</div>
				</div>
            <?php } ?>
		</div>
	</div>
</section>