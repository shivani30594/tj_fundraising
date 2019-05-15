<!-- <script>
 $(document).ready(function (){
     
     // onload set the total amount;
   // calculateTotalAmount();
    // displayListing();

    $(document).on('click', "#add_to_cart", function(){
        var product_id = $(this).attr("data-productid");
        var product_name = $(this).attr("data-productname");
        var price = parseFloat($("#price_"+product_id).html());
        var quantity = parseInt($("#quantity_"+product_id).val());
        var total_amount = parseFloat( price * quantity);
        var product = {};
        product.id = parseInt(product_id);
        product.price = price;
        product.total_amount = total_amount;
        product.quantity = quantity;
        product.name = product_name;
        addToCart(product);
        calculateTotalAmount();
    });

     $(document).on('click', "#delete", function(){
        var product_id = parseInt($(this).attr("data-productid"));
        if (localStorage && localStorage.getItem('cart')) {
            var cart = localStorage.getItem('cart');
            if (cart.products != '')
            {
                var cart = JSON.parse(localStorage.getItem('cart'));  
            }
            var temp ;
            result = cart.products.some(function(o){  temp = o ;return o["id"] === product_id})
            if (result == true)
            {
                    var index = cart.products.findIndex(function(prod) {
                    return prod.id == product_id
                    });
                    cart.products.splice(index,1);  
                    $("#div_"+product_id).remove();
            }
            localStorage.setItem('cart', JSON.stringify(cart));
            calculateTotalAmount();
            displayListing();
        } 
    });


    function addToCart(product) {
        if (localStorage && localStorage.getItem('cart')) {
            var cart = localStorage.getItem('cart');
            if (cart.products != '')
            {
                var cart = JSON.parse(localStorage.getItem('cart'));  
            }
            var temp ;
            result = cart.products.some(function(o){  temp = o ;return o["id"] === product.id})
            if (result == true)
            {
                    var index = cart.products.findIndex(function(prod) {
                    return prod.id == product.id
                    });
                    cart.products.splice(index,1);  
            }
            cart.products.push(product)
            localStorage.setItem('cart', JSON.stringify(cart));
        } 
        calculateTotalAmount();
        displayListing();
    }

    function calculateTotalAmount()
    {
        if (localStorage && localStorage.getItem('cart')) {
            var cart = localStorage.getItem('cart');
            if (cart.products != '')
            {
                var cart = JSON.parse(localStorage.getItem('cart'));  
            }
            var total = 0;
            var total_quan = 0;
            for(i=0;i<(cart.products).length;i++)
            {
                total_quan = total_quan + cart.products[i].quantity;
                total = total + cart.products[i].total_amount;
            }
           
           $("#total_amount").html( Math.round(total * 100) / 100);
           $("#total_quantity").html(total_quan);
        }
    }


    function displayListing(){
          if (localStorage && localStorage.getItem('cart')) {
            var cart = localStorage.getItem('cart');
            if (cart.products != '')
            {
                var cart = JSON.parse(localStorage.getItem('cart'));  
                
                var html ='';
                var sum = 0;
                var pay_now_class = '';
                html += '<div id="products_cart_wrapper">';
                html += '<div class="table-responsive">';
                html += '<table>';
                html += '<thead>';
                html += '<tr><th>Name</th><th>Price</th><th>Quantity</th><th>Remove</th></tr>';
                html += '</thead>';
                html += '<tbody>';
                if (cart.products.length > 0)
                {
                    pay_now_class = '';
                    for(i=0;i<cart.products.length;i++)
                    {
                        html += '<tr>';
                        html += '<td>'+cart.products[i].name+'</td>';
                        html += '<td>'+cart.products[i].price+'</td>';
                        html += '<td>'+cart.products[i].quantity+'</td>';
                        html += '<td><button type="button" data-productid="'+cart.products[i].id+'" id="delete" class="delete-btn" name="delete" value="delete"><i class="fa fa-trash" aria-hidden="true"></i></button></td>';
                        html += '</tr>';
                        sum = sum + cart.products[i].total_amount;
                    }
                }
                else{
                    pay_now_class = "disabled";
                    html += '<tr >';
                    html += '<td colspan="4">Your shopping cart is empty.</td>';
                    html += '</tr>';
                }
                html += '</tbody>';
                html += '</table>';
                html += '</div>';
                html += '<div class="bottom-wrapper">';
                html += '<p>Total Amount:<span>'+sum+'</span></p>';
                html += '<div id="checkout_btn_grp"><a href="button" id="paynow_btn" >Pay Now</a>';
                html += '<a href="<?php echo BASE_URL?>display_product" id="product_listing">Back to Product Listing</a></div>';
                html += '</div>';
                html += '</div>';
                $("#items_avialable").html(html);
            }
            else{
                $("#items_avialable").html("No item available");
            }
        }
    }

 });  


</script> -->