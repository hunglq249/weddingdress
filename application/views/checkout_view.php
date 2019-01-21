

<section id="checkout">
    <div class="cover">
        <div class="mask">
            <img src="https://images.unsplash.com/photo-1532778489370-ffc5d2095091?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=9e4c2b340c5da49e59ba804663dae6ff&auto=format&fit=crop&w=1351&q=80" alt="image about cover">
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="left col-xs-12 col-lg-8">
                <div id="checklist">

                </div>

                <div id="extra">
                    <div class="item item-discount">
                        <h3 class="title-sm">
                            Free expedited shipping
                        </h3>
                    </div>

                    <!-- <div class="item item-protect">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="title-sm">
                                Protection Plan
                            </h3>

                            <select class="form-control" id="exampleFormControlSelect1">
                                <option>1 year</option>
                                <option>2 years</option>
                                <option>3 years</option>
                                <option>4 years</option>
                                <option>5 years</option>
                            </select>

                            <h3 class="title-sm">
                                $20
                            </h3>

                            <button class="btn btn-light" role="button">
                                Add Plan
                            </button>
                        </div>
                    </div> -->
                </div>
            </div>

            <div class="right col-xs-12 col-lg-4">
                <div id="bill">
                    <table class="table">
                        <tr>
                            <td>Cart Subtotal</td>
                            <td>$ Price</td>
                        </tr>
                        <tr>
                            <td>Shipping</td>
                            <td>$ Price</td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td>$ Price</td>
                        </tr>
                    </table>

                    <button class="btn btn-primary" role="button">
                        Checkout
                    </button>

                    <a class="btn btn-light" href="<?php echo base_url('products/') ?>">
                        Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    var cart = localStorage.getItem('cart') ? JSON.parse(localStorage.getItem('cart')) : [];
    var elmCartItem = '';
    
    cart.forEach( function(item, index) {
        // var color = '';
        // item.product.color.forEach(function(value, index){
        //     color += '<p class="paragraph"><div style="width: 30px; height: 15px ;background-color: '+value[]+'"></div></p>';
        // })
        elmCartItem += `
            <div class="item">
                <div class="d-flex justify-content-between">
                    <div class="item-left d-flex">
                        <div class="item-image">
                            <div class="mask">
                                <img src="<?php echo site_url('assets/img/product/') ?>${item.product.image}" alt="image ">
                            </div>
                        </div>

                        <div class="item-info">
                            <h3 class="title-sm">${item.product.title}</h3>
                                <p class="paragraph"><div style="width: 30px; height: 15px ;background-color: ${item.product.color[0]}"></div></p>
                            <div class="item-buttons">
                                <form class="d-flex">
                                    <input type="number" class="form-control" min="0" value=${item.quantity}>

                                    <a class="btn btn-light" href="<?php echo base_url('products/detail/') ?>" role="button">
                                        Edit
                                    </a>

                                    <button class="btn btn-light" role="button">
                                        Remove
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="item-right">
                        <h3 class="title-sm">$ ${item.product.price}</h3>
                    </div>
                </div>
            </div>
        `;
    });
    $('#checklist').html(elmCartItem);
</script>

