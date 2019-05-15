<style>.acc-wrapper{ height : auto !important;
}</style>
<div class="checkout-exp">
<h3>You are able to pay with your personal credit card as a guest through Paypal.</h3>
</div>
<section class="acc-wrapper" style="background-color: unset; padding : unset;">
    <div class="acc-container">
   
    <img src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/cc-badges-ppmcvdam.png" alt="Credit Card Badges">
    <h1>Billing Information</h1>
        <form id="customer_form" class="login-form" action="<?php echo BASE_URL?>cust_save" method="get">
            <div class="form-gr">
                <label class="main-lb">First Name :</label>
                <input type="hidden" name="user_id" id="user_id" value="<?php echo isset($user_id) ? $user_id : ''?>">
                <input type="text" id="cust_first_name" placeholder="Enter First Name" name="cust_first_name" >
            </div>
            <div class="form-gr">
                <label class="main-lb">Last Name :</label>
                <input type="text" id="cust_last_name" placeholder="Enter Last Name" name="cust_last_name" >
            </div>
            <div class="form-gr">
                <label class="main-lb">Email :</label>
                <input type="email" id="cust_email" placeholder="Enter Email" name="cust_email" >
            </div>
            <div class="form-gr ">
                <label class="main-lb">Shipping :</label>
                <select name="shipping" id="shipping" class="form-control" style="border: 1px solid #99201f;height: 50px;border-radius:0">
                    <option value="">---Choose Shipping Method---</option>
                    <option value="pickup">Pickup - $0.00</option>
                    <option value="delivered_sales">Delivered by Salesperson - $0.00</option>
                    <option value="delivered_fedex">Delivered By Fedex - Varies</option>
                </select>
            </div>
            <!-- <div class="form-gr" style="display:none" id="address-div">
                <label class="main-lb">Address :</label>
                <input type="text" id="cust_address" placeholder="Enter Address" name="cust_address" >
            </div> -->

            <div id="address-div" style="display:none">
                <div class="form-gr">
                    <label class="main-lb">Street :</label>
                    <input type="text" id="cust_street" placeholder="Enter State" name="cust_street" >
                </div>
                <div class="form-gr">
                    <label class="main-lb">City :</label>
                    <input type="text" id="cust_city" placeholder="Enter City" name="cust_city" >
                </div>
                <div class="form-gr">
                    <label class="main-lb">State :</label>
                    <input type="text" id="cust_state" placeholder="Enter State" name="cust_state" >
                </div>
                <div class="form-gr">
                    <label class="main-lb">Zip :</label>
                    <input type="text" id="cust_zip" placeholder="Enter Zip" name="cust_zip" >
                </div>
            </div>

            <div class="form-gr">
                <label class="main-lb">Phone Number :</label>
                <input type="tel" id="cust_phone" placeholder="Enter Phone" name="cust_phone" >
            </div>
            <div class="form-gr" id="delivery-date" style="display:none">
                <label class="main-lb">Delivery Date :</label>
                <input type="text" name="delivery_date" id="delivery_date" class="tg-input">
            </div>
            <div class="tg-input-grp">
                <label class="chk-lb add-lb">
                    <input type="checkbox" style="border: 1px solid #b31818;" name="agreement" id="agreement">I authorize TJ's Pizza to charge me for the order total. I further affirm that the name and personal information provided on this form are true and correct. I further declare that I have read, understand and accept TJ's Pizza's business terms as published on their website. By pressing the Submit Order button below, I agree to pay TJ's Pizza.
                    <div class="chk_check"></div>
                </label>    
            </div>         
            
            <button type="submit" class="submit-btn">Proceed To Purchase</button>
        </form>
    </div>
</section>