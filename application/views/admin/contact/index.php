<div class="page-content">
    <h3 class="page-title"> Contact 
        <small>Inquiries</small>
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="<?php echo BASE_URL?>a_dashboard">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <span>Contact</span>
            </li>
        <ul>
    </div>
    <?php if($this->session->flashdata('success')):?>
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert"></button>
            <strong>Success!</strong> <?php echo $this->session->flashdata('success') ?>
        </div>
    <?php endif;?>
    <?php if($this->session->flashdata('danger')):?>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert"></button>
            <strong>Error!</strong> <?php echo $this->session->flashdata('danger') ?>
        </div>
    <?php endif;?>
    <?php if($this->session->flashdata('warning')):?>
        <div class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert"></button>
            <strong>Warning!</strong> <?php echo $this->session->flashdata('warning') ?>
        </div>
    <?php endif;?>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light ">
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" style="border-bottom: 0px !important; width: 1319px;" id="contact_datatable">
                    </table> 
                </div>
            </div>
        </div>
    </div>

    <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Response of Query: <span id="subject"></span></h4>
      </div>
      <form role="form" method="POST" id="add_category_from" action="<?php echo BASE_URL?>a_respond">
        <div class="modal-body">
            <div class="form-body">
                <input type="hidden" name="contact_id" id="contact_id">
                    <div class="form-group">
                        <label class="control-label">Response</label>
                        <textarea rows="10" class="form-control" id="response" name="response" placeholder="Enter response" value=""></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" >Submit</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
  </div>
