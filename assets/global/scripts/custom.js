jQuery(document).ready(function(){

	$(".mobile-menu").click(function(){
		$(".menu-wrap").slideToggle(500);
	});

	$(".social-mobile").click(function(){
		$(".social-wrap").slideToggle(500)
	})

	function childrenBgPosition(){
		var headerHeight = $("header").height();  
		var totalHeight =headerHeight + 20;
		var childrenHeight = $(".childern-bg").height();
		var finalHeight = totalHeight - childrenHeight + 50;
		$(".childern-bg").css({"top":finalHeight})
		//console.log(total)
	}

	childrenBgPosition();

	
		
	var windowHeight = jQuery(document).height();
	jQuery(".acc-wrapper").css({"height":windowHeight})

	$(".dropbtn").click(function(){
		$(".dropdown-content").slideToggle(500)
	})
	$(".del-method").click(function(){
		$(".dropdown-content").slideToggle(300)
	});
	$(".dropdown-content ul li a").click(function(){
		var clickedValue = $(this).text();
		//console.log(clickedValue)
		$(this).closest(".dropdown").find(".del-method ").val(clickedValue)
		$(this).closest(".dropdown").find(".dropbtn").val(clickedValue)
		$(this).closest(".dropdown-content").slideUp(300);
	})

	function dashboardBoxHeightEqual(){
		//alert("hi")
		var allboxes = $(".dashboad-wrap .dash-bx");
		boxHeight = []
		$(allboxes).each(function () {
			var bxHeight = $(this).outerHeight();
			//console.log(bxHeight)
			boxHeight.push(bxHeight);
			
		});
		$(allboxes).css({"height":"0"})
		var maxHeightBx = Math.max.apply(Math,boxHeight); 
		//console.log("hi"+maxHeightBx)
		$(allboxes).css({"height":maxHeightBx})
	}
	function resetHeight(){
		//alert("reset")
		 var allboxes = jQuery(".dashboad-wrap .dash-bx");
		 jQuery(allboxes).css({"height":"100%"})
		
	 }
	function profileBoxHeightEqual(){
		var allboxes = $(".profile-wrap .dashboad-wrap .col-md-4");
		boxHeight = []
		$(allboxes).each(function () {
			var bxHeight = $(this).outerHeight();
			//console.log(bxHeight)
			boxHeight.push(bxHeight);
			
		});
		var maxHeightBx = Math.max.apply(Math,boxHeight); 
		//console.log("hi"+maxHeightBx)
		$(allboxes).css({"height":maxHeightBx})
	}

	dashboardBoxHeightEqual();
	profileBoxHeightEqual();

	jQuery(document).resize(function(){
		resetHeight();
		setTimeout(function(){
			dashboardBoxHeightEqual();
			profileBoxHeightEqual();
		},200)
		
		
		childrenBgPosition();
	});

	jQuery(window).resize(function(){
		resetHeight();
		setTimeout(function(){
			dashboardBoxHeightEqual();
			profileBoxHeightEqual();
		},300)
		childrenBgPosition();
	});

	/*15-10-2018*/
	jQuery(".search-cart-wrap .input-grp span").click(function(){
		jQuery(this).closest(".search-cart-wrap").find(".search-text-box").slideToggle(500)
	});
		


	// login form validation
	$('#login_form').validate({
		rules: {
			email : { 
				required :true,
			},
			password : { 
				required :true,
				
			}
		},
		messages: {
			email : {
			   required : 'Enter an User ID / Email ',
			},
			password : {
			   required : 'Enter a password',
			}
		}
	});
	$('#forgot_form').validate({
		rules: {
			email : { 
				required :true,
			},
		},
		messages: {
			email : {
			   required : 'Enter an email ',
			},
		}
	});
	$('#change_password_form').validate({
		rules: {
			password : { 
				required :true,
			},
			retype_password : { 
				required :true,
				equalTo: "#password"
			},
		},
		messages: {
			password : {
			   required : 'Enter a password ',
			},
			retype_password : { 
				required : 'Retype a password ',
				equalTo : 'Password and retype-password are not matched'
			},
		}
	});
	// registartion validation
	$('#register_form').validate({
		rules: {
			first_name : { 
				required :true,
			},
			last_name : { 
				required :true,
			},
			contact_phone : { 
				required :true,
			},
			email : { 
				required :true,
			},
			username : { 
				required :true,
			},
			password : { 
				required :true,
			}
		},
		messages: {
			first_name : {
			   required : 'Enter First Name ',
			},
			last_name : {
				required : 'Enter Last Name ',
			 },
			contact_phone : {
			   required : 'Enter a phone number',
			},
			email : {
				required : 'Enter a email',
			},
			username : {
				required : 'Enter a username',
			},
			password : {
				required : 'Enter a password',
			},

		}
	});
});
