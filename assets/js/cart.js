$(document).ready(function(){
    
    //Get Cart array
    
    var id, quantity, price, cart, item;
    var index = -1;
    var total_cart = 0;
    
    cart = localStorage.getItem('cart') ? JSON.parse(localStorage.getItem('cart')) : [];

    cart.forEach( function(item, index) {
        total_cart += parseInt(item.quantity, 0);
    });
    
    $(".add-to-cart").click(function(){
        product =$(this).data("product");
        id = $(this).data("id");
        quantity = parseInt($(this).data("quantity"), 0);
        price = $(this).data("price");
    
        index = findProductInCart(cart, product);
        if(index !== -1){
            cart[index].quantity += quantity;
        }else{
            cart.push({product:product, quantity:quantity})
        }
        total_cart += 1;
        $('#total-cart').text(total_cart);

    
        if (typeof(Storage) !== "undefined") {
            localStorage.setItem("cart", JSON.stringify(cart));
        } else {
            alert('Sorry! No Web Storage support...');
        }
        
        //Disable Add to Cart Button when clicked once
        
        $(this).addClass('disabled');
    });
    $('#total-cart').text(total_cart);
    
    
});

function findProductInCart (cart, product) {
    let index = -1;
    if(cart.length > 0){
        for (var i = 0; i < cart.length; i++) {
            if(cart[i].product.id === product.id){
                index = i;
                break;
            }
        }
    }
    return index;
}