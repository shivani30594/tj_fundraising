

<!DOCTYPE html>
<html lang="en">
    <head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1">

	<title>TJ's-Pizza Fundraising Company</title>

    <link href="<?php echo ASSETS?>global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo ASSETS?>global/plugins/bootstrap/css/font-awesome.min.css" rel="stylesheet"><!--bootstrap css-->
    <link href="<?php echo ASSETS?>global/plugins/bootstrap/css/fonts.css" rel="stylesheet"><!--bootstrap css-->
    <link href="<?php echo ASSETS?>global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet"/>
    <link href="<?php echo ASSETS?>global/css/style.css" rel="stylesheet"><!--bootstrap css-->
    <link rel="stylesheet" href="<?php echo ASSETS?>global/css/intlTelInput.css"><!--Input tel css-->
    <link href="<?php echo ASSETS?>global/css/responsive.css" rel="stylesheet"><!--bootstrap css-->
    <link href="<?php echo ASSETS?>global/css/sweetalert2.min.css" rel="stylesheet"><!--bootstrap css-->
    <link href="<?php echo ASSETS?>global/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet"><!--bootstrap css-->

</head><body>
	<div class="Tj-page-wrapper">
        <header>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="logo-wrap">
                            <a href="#"><img src="<?php echo ASSETS?>global/img/logo.png" alt="Logo"></a>
                        </div>
                        <div class="social-mobile"><a href="#"><img src="<?php echo ASSETS?>global/img/share.svg" alt="Logo"></a></div>
                        <div class="social-wrap">
                            <ul class="social-nav">
                                <li><a href="#"><img src="<?php echo ASSETS?>global/img/facebook.svg" alt="Facebook"></a></li>
                                <li><a href="#"><img src="<?php echo ASSETS?>global/img/twitter.svg" alt="Twitter"></a></li>
                            </ul>
                        </div>
                        <div class="mobile-menu"><a href="#"><img src="<?php echo ASSETS?>global/img/menu.svg" alt="Menu"></a></div>
                        <div class="menu-wrap">
                            <ul class="navigation">
                                <li class="single-logout"><a href="http://clientapp.narola.online/SD/TJ_Fundraising/u_logout">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>        
        <div class="heading"><img src="<?php echo ASSETS?>global/img/heading-1.png" alt="Start a Fundraiser TODAY!"></div>
        <div class="childern-bg"></div>
        <div class="registration-wrap">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="register-content">
                            <form id="create_campaign_form" action="http://clientapp.narola.online/SD/TJ_Fundraising/user/campaign/create_campaign" method="POST" enctype="multipart/form-data">
                                <div class="col-md-4 col-sm-4">
                                    <div class="tg-input-grp">
                                        <label for="tg-org-name">Organization/Intividual</label>
                                        <input type="text" name="group_name" class="tg-input">
                                    </div>
                                    <div class="tg-input-grp">
                                        <label for="tg-email">Email</label>
                                        <input type="email" name="email" class="tg-input">
                                    </div>
                                    <div class="tg-input-grp">
                                        <label for="tg-add">Address</label>
                                        <input type="text" name="address" id="address" class="tg-input">
                                    </div>
                                    <div class="tg-input-grp">
                                        <label for="tg-cntp">Contact person</label>
                                        <input type="text" name="contact_person" id="contact_person" class="tg-input">
                                    </div>
                                    <div class="tg-input-grp">
                                        <label for="tg-cnt">Contact Phone</label>
                                        <input type="tel" name="contact_phone" id="contact_phone" class="tg-input" style="width: 430px;">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 middle-section">
                                    <div class="tg-input-grp">
                                        <label class="chk-lb">
                                            <input type="checkbox" name="disclaimers" id="disclaimers">
                                            <div class="chk_check"></div>
                                        </label>
                                            <div class="dis-text"><a  data-toggle="modal" data-target="#exampleModal">
                                            Disclaimers</a></div>
                                            <div class="dis-content">All users of this site agree that access to and use of this site are subject to the following terms and conditions and other applicable law. If you do not agree to these terms and conditions, please do not use this site.</div>
                                    
                                    </div>
                                    <div class="tg-input-grp">
                                        <!-- <a href="#" class="tg-btn-submit">Submit</a> -->
                                        <button class="btn tg-btn-submit"> Submit </button>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="tg-input-grp tg-input-date">
                                        <label for="tg-date">Project Start</label>
                                        <input type="text" name="project_start" id="project_start" class="tg-input">
                                    </div>
                                    <div class="tg-input-grp tg-input-date">
                                        <label for="tg-date">Project Finish</label>
                                        <input type="text" name="project_end" id="project_end" class="tg-input">
                                    </div>
                                    <div class="tg-input-grp">
                                        <label for="tg-file">Tax Exempt?</label>
                                        <input type="text" name="tax_document_name" class="tg-input" id="tax_document_name" placeholder="If yes, then upload document">
                                        <input type="file" name="tax_document" id="tax_document">
                                    </div>
                                    <div class="tg-input-grp">
                                        <label for="tg-date">Delivery Method</label>
                                        <div class="dropdown">
                                            <input type="text" id="delivery_method" class="del-method tg-input" name="delivery_method">
                                            <div class="dropdown-content">
                                                <ul>
                                                    <li><a href="javascript:void(0);">Pick Up</a></li>
                                                    <li><a href="javascript:void(0);">Ship</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tg-input-grp">
                                        <label class="chk-lb add-lb">
                                            <input type="checkbox" name="same_address" id="same_address">Same as ‘Address’
                                            <div class="chk_check"></div>
                                        </label>
                                        <label class="main-lb">Delivery Location</label>
                                        <input type="text" class="tg-input" name='delivery_location' id='delivery_location'>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
	        </div>
        </div>	
    </div>
</body>
    
<script src="<?php echo ASSETS?>global/plugins/jquery.min.js"></script><!--jquery js-->
<script src="<?php echo ASSETS?>global/plugins/bootstrap/js/bootstrap.min.js"></script><!--bootstrap js-->
<script src="<?php echo ASSETS?>global/plugins/bootstrap-select/js/bootstrap-select.min.js"></script>
<script src="<?php echo ASSETS?>global/scripts/intlTelInput.min.js"></script><!--bootstrap validation js-->
<script src="<?php echo ASSETS?>global/scripts/custom.js"></script><!--jquery js-->
<script src="<?php echo ASSETS?>global/scripts/jquery.validate.js"></script><!--jquery js-->
<script src="<?php echo ASSETS?>global/plugins/jquery-ui/jquery-ui.min.js"></script><!--jquery js-->

<script src="<?php echo ASSETS?>global/scripts/sweetalert2.min.js"></script><!--jquery js-->
<script type="text/javascript">
    jQuery(document).ready(function()
    {
        var dateToday = new Date();
        var dates = $("#project_start,#project_end").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            minDate: dateToday,
            onSelect: function(selectedDate) {
                var option = this.id == "project_start" ? "minDate" : "maxDate",
                    instance = $(this).data("datepicker"),
                    date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
                dates.not(this).datepicker("option", option, date);
            }
        });

        $("#contact_phone").intlTelInput({
          hiddenInput: "full_number",
          utilsScript: "<?php echo BASE_URL?>"+"/assets/global/scripts/utils.js"
        });
        
        $('#create_campaign_form').validate({
            rules: {
                group_name : { 
                    required :true,
                },
                address : { 
                    required :true,
                },
                project_start : { 
                    required :true,
                },
                project_end : { 
                    required :true,
                },
                delivery_method : { 
                    required :true,
                },
                delivery_location : { 
                    required :true,
                },
                delivery_location : { 
                    required :true,
                },
                contact_phone : { 
                    required :true,
                },
                contact_person : { 
                    required :true,
                },
                disclaimers : {
                    required :true,
                },
                email : {
                    required :true,
                }
            },
            messages: {
                group_name : {
                    required : 'Enter a group name ',
                },
                address : {
                    required : 'Enter an address ',
                },
                project_start : {
                    required : 'Select project start-date ',
                },
                project_end : {
                    required : 'Select project end-date',
                },
                delivery_method : {
                    required : 'Select delivery method',
                },
                delivery_location : {
                    required : 'Enter delivery location',
                },
                contact_phone : {
                    required : 'Enter valid contact number',
                },
                contact_person : {
                    required : 'Enter a contact name',
                },
                disclaimers : {
                    required : 'Please read the disclaimers carefully',
                },
                email : {
                    required : 'Enter an Email',
                }
            }
        });
         $(document).on('click', '#same_address', function() {
             if (this.checked)
             {
                 var address = $("#address").val();
                 $("#delivery_location").val(address);
                 $("#delivery_location-error").hide();
             }
             else{
                $("#delivery_location").val('');
             }
         });
         $(document).on('change', '#tax_document', function() {
                var val = this.value;
                var fileName = val.substr(val.lastIndexOf("\\")+1, val.length);
                document.getElementById("tax_document_name").value = fileName;
         });
         $(document).on('change', '#delivery_location', function() {
             if (this.value != '')
             {
                 $("#delivery_location-error").hide();
             }
        });
    });
</script>
  
    <div id="selectGroup" data-backdrop="static" data-keyboard="false" class="modal fade cust-modal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="http://clientapp.narola.online/SD/TJ_Fundraising/user/dashboard/set_status" method="POST">
                    <div class="modal-body">
                            <div class="dropdown">
                                <select placeholder="Search..." id="active_group" class="search-inputs selectpicker" data-show-subtext="true" data-live-search="true">
                                    <option>Please Select...</option>
                                 </select>
                            </div>
                        <!-- <div class="button-wrap">
                            <button type="button" class="btn btn-primary close-btn" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn  save-btn">Save changes</button>
                        </div> -->
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="modal fade" id="exampleModal" role="dialog">
            <div class="modal-dialog  modal-lg">
            <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Our Privacy Policy</h4>
                    </div>
                    <div class="modal-body">
                        <p>All users of this site agree that access to and use of this site are subject to the following terms and conditions and other applicable law. If you do not agree to these terms and conditions, please do not use this site.TJ’s Pizza is pleased to provide information about its online privacy policy. TJ’s Pizza uses its best efforts to protect the privacy of visitors to this web site.</p>
                        <p>Information Collected TJ’S PIZZA collects general non-personal statistical information from users visiting our web site. The types of information include data about the number of visitors to the site, the type of browser and operating system being used by the visitor, and the pages visited. It provides statistics that are analyzed to improve our web site.</p>
                        <p>TJ’S PIZZA only collects personal information, such as, first and last names, addresses and email addresses, when you voluntarily submit this information to us. This type of information may be collected from you in order to get your feedback on our web site and our products or to respond to your questions or comments.</p>
                        <h4><b>Sharing of Personal Information</b></h4>
                        <p>TJ’S PIZZA does not sell or share personal information with third parties outside of the Little Caesars system.
                        TJ’S PIZZA reserves the right to use or disclose any information as needed to satisfy any law, regulation or legal request, to protect the integrity of the site, to fulfill your requests, or to cooperate in any law enforcement investigation or an investigation on a matter of public safety.</p>
                        <h4><b>Use of Cookies</b></h4>
                        <p>“Cookies” are pieces of information that a web site transfers to a users' personal computer hard drive for record keeping purposes. Cookies allow a web site to recall information that makes the use of the site more convenient. TJ’S PIZZA uses cookies so that we remember information when you revisit a web site. Our cookies cannot retrieve any personal information or data from your hard drives or pass any computer viruses to your computer.</p>
                        <h4><b>Copyright</b></h4>
                        <p>The entire content included in this site, including but not limited to text, graphics or code is copyrighted as a collective work under the United States and other copyright laws, and is the property of TJ’S PIZZA . The collective work includes works that are licensed to TJ’S PIZZA . Permission is granted to electronically copy and print hard copy portions of this site for the sole purpose of gathering information about TJ’S PIZZA and its products, placing an order with TJ’S PIZZA or purchasing TJ’S PIZZA products. You may display and, subject to any expressly stated restrictions or limitations relating to specific material, download or print portions of the material from the different areas of the site solely for your own non-commercial use, or to place an order with TJ’S PIZZA or to purchase TJ’S PIZZA products. Any other use, including but not limited to the reproduction, distribution, display or transmission of the content of this site is strictly prohibited, unless authorized by TJ’S PIZZA . You further agree not to change or delete any proprietary notices from materials downloaded from the site.</p>
                        <h4><b>Trademarks</b></h4>
                        <p>All trademarks, service marks and trade names of TJ’S PIZZA used in the site are trademarks or registered trademarks of TJ’S PIZZA .</p>
                        <h4><b>Warranty Disclaimer</b></h4>
                        <p>This site and the materials and products on this site are provided "as is" and without warranties of any kind, whether express or implied. To the fullest extent permissible pursuant to applicable law, TJ’S PIZZA disclaims all warranties, express or implied, including, but not limited to, implied warranties of merchantability and fitness for a particular purpose and non-infringement. TJ’S PIZZA does not represent or warrant that the functions contained in the site will be uninterrupted or error-free, that the defects will be corrected, or that this site or the server that makes the site available are free of viruses or other harmful components. TJ’S PIZZA does not make any warrantees or representations regarding the use of the materials in this site in terms of their correctness, accuracy, adequacy, usefulness, timeliness, reliability or otherwise. Some states do not permit limitations or exclusions on warranties, so the above limitations may not apply to you.</p>
                        <h4><b>Limitation of Liability</b></h4>
                        <p>TJ’S PIZZA shall not be liable for any special or consequential damages that result from the use of, or the inability to use, the materials on this site or the performance of the products, even if TJ’S PIZZA has been advised of the possibility of such damages. Applicable law may not allow the limitation of exclusion of liability or incidental or consequential damages, so the above limitation or exclusion may not apply to you.</p>
                        <h4><b>Typographical Errors</b></h4>
                        <p>In the event that a TJ’S PIZZA product is mistakenly listed at an incorrect price, TJ’S PIZZA reserves the right to refuse or cancel any orders placed for product listed at the incorrect price. TJ’S PIZZA reserves the right to refuse or cancel any such orders whether or not the order has been confirmed and your credit card charged. If your credit card has already been charged for the purchase and your order is cancelled, TJ’S PIZZA shall issue a credit to your credit card account in the amount of the incorrect price.</p>
                        <h4><b>Termination</b></h4>
                        <p>These terms and conditions are applicable to you upon your accessing the site and/or completing the registration or shopping process. These terms and conditions, or any part of them, may be terminated by TJ’S PIZZA without notice at any time, for any reason. The provisions relating to Copyrights, Trademark, Disclaimer, Limitation of Liability, Indemnification and Miscellaneous, shall survive any termination.</p>
                        <h4><b>Notice</b></h4>
                        <p>TJ’S PIZZA may deliver notice to you by means of e-mail, a general notice on the site, or by other reliable method to the address you have provided to TJ’S PIZZA .</p>
                        <h4><b>Miscellaneous</b></h4>
                        <p>Your use of this site shall be governed in all respects by the laws of the state of Missouri, U.S.A., without regard to choice of law provisions, and not by the 1980 U.N. Convention on contracts for the international sale of goods. You agree that jurisdiction over and venue in any legal proceeding directly or indirectly arising out of or relating to this site (including but not limited to the purchase of TJ’S PIZZA products) shall be in the state or federal courts located in St. Louis, MO. Any cause of action or claim you may have with respect to the site (including but not limited to the purchase of TJ’S PIZZA products) must be commenced within one (1) year after the claim or cause of action arises. TJ’S PIZZA 's failure to insist upon or enforce strict performance of any provision of these terms and conditions shall not be construed as a waiver of any provision or right. Neither the course of conduct between the parties nor trade practice shall act to modify any of these terms and conditions. TJ’S PIZZA may assign its rights and duties under this Agreement to any party at any time without notice to you.</p>
                        <h4><b>Use of Site</b></h4>
                        <p>Harassment in any manner or form on the site, including via e-mail, chat, or by use of obscene or abusive language, is strictly forbidden. Impersonation of others, including a TJ’S PIZZA or other licensed employee, host, or representative, as well as other members or visitors on the site is prohibited. You may not upload to, distribute, or otherwise publish through the site any content which is libelous, defamatory, obscene, threatening, invasive of privacy or publicity rights, abusive, illegal, or otherwise objectionable which may constitute or encourage a criminal offense, violate the rights of any party or which may otherwise give rise to liability or violate any law. You may not upload commercial content on the site or use the site to solicit others to join or become members of any other commercial online service or other organization.</p>
                        <h4><b>Participation Disclaimer</b></h4>
                        <p>TJ’S PIZZA does not and cannot review all communications and materials posted to or created by users accessing the site, and is not in any manner responsible for the content of these communications and materials. You acknowledge that by providing you with the ability to view and distribute user-generated content on the site, TJ’S PIZZA is merely acting as a passive conduit for such distribution and is not undertaking any obligation or liability relating to any contents or activities on the site. However, TJ’S PIZZA reserves the right to block or remove communications or materials that it determines to be (a) abusive, defamatory, or obscene, (b) fraudulent, deceptive, or misleading, (c) in violation of a copyright, trademark or; other intellectual property right of another or (d) offensive or otherwise unacceptable to TJ’S PIZZA in its sole discretion.</p>
                        <h4><b>Indemnification</b></h4>
                        <p>You agree to indemnify, defend, and hold harmless TJ’S PIZZA , its officers, directors, employees, agents, licensors and suppliers from and against all losses, expenses, damages and costs, including reasonable attorneys' fees, resulting from any violation of these terms and conditions or any activity related to your account (including negligent or wrongful conduct) by you or any other person accessing the site using your Internet account.</p>
                        <h4><b>Third-Party Links</b></h4>
                        <p>In an attempt to provide increased value to our visitors, TJ’S PIZZA may link to sites operated by third parties. However, even if the third party is affiliated with TJ’S PIZZA , TJ’S PIZZA has no control over these linked sites, all of which have separate privacy and data collection practices, independent of TJ’S PIZZA . These linked sites are only for your convenience and therefore you access them at your own risk. Nonetheless, TJ’S PIZZA seeks to protect the integrity of its web site and the links placed upon it and therefore requests any feedback on not only its own site, but for sites it links to as well (including if a specific link does not work).</p>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- set agreem,ent -->
    <div id="exampleModall" class="modal fade cust-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                   
                <form id="set_agreement" action="<?php echo BASE_URL?>u_setagreement" method="POST">
                <input type="hidden" name="group_id" id="group_id" value="<?php echo isset($group_id)  ? $group_id : ''?>">
                    <div class="modal-body">
                    <small class="text-justify">Owner splits Funds raised with Fundraising organization with two options as described.
                    Option 1: Owner 70% / Fundraiser organization 30% 
                    Options 2: Owner 60% / Fundraiser organization 40% 
                    payments are given to the organization after the fundraising campaign has been completed or expired.</small>
                        <div class="radio-wrap">
                            <div class="radio-bg-white">
                                <div class="radio">
                                    <label><input type="radio" required name="agreement" checked value="0">70/30 (TJ_Fundraising Owner/Fundraiser Organization)<span class="chk-radio"></span></label>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" required name="agreement" value="1">60/40 (TJ_Fundraising Owner/Fundraiser Organization)<span class="chk-radio"></span></label>
                                </div>
                            </div>
                        </div>
                        <div class="button-wrap">
                            <button type="submit" class="btn  save-btn">Set Option</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</html>

<script>
    jQuery(document).ready(function(){
        $('#exampleModall').modal({
			    backdrop: 'static'
            });
        $('#exampleModall').modal('show');
    });
</script>