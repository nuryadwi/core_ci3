<style>
	#loader{display: block;opacity: 0.5;}
	.spin {position: absolute;left: 50%;top: 50%;z-index: 1;color: #7b7979;}
	.text {color: #7b7979;font-size: 20px;position: absolute;left: 49%;bottom: 30%;}
	.required::after{color: red;font-size: bolder;content: ' *';}
	.btn-xs {padding: .15rem .2rem;font-size: .775rem;line-height: .5;border-radius: .2rem;margin:2px;}
	.form-table{width: 100%;font-size: 0.875rem;border-radius: 0.2rem;border: 1px solid #ced4da;padding: 0.3rem 0.1rem;}
	table.table th{padding: 0.5rem;}
	table.table td{padding: 0.25rem;}
</style>
<div id="response_message" style="display:none;"></div>
<div class="" id="loader" style="height: 300px; display:none;">
   <div class="spin">
      <span class="fa fa-spinner fa-spin fa-4x"></span>
   </div>
   <span class="text">Loading...</span>
</div>
<div class="" id="form_area" style="display:none;"></div>
<div class="" id="table_area">
   <div class="row col-md-12">
      <h4><b><?php echo $table['title']?></b></h4>
   </div>
</div>
<div class="mr-1 mb-2">
   <?php
   if( action('add') ) {
      if(isset($btn_control ) ) {
         echo $btn_control;
      } else {
         echo generate_menu( [
            'add' => [
               'size' => 'lg',
               'link' => $url_add,
            ],
         ]);
      }
   }
   ?>
</div>

<div class="table-responsive">
   <table id="grid" class="display table table-styling table-responsive table-hover table-striped" style="width:100%">

   </table>
   <div class="" id="dialog" style="width:60%;height:480px;max-width:90%;display:none;">

   </div>
</div>


<script src="<?php echo base_url() . JS;?>plugins/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() . JS;?>plugins/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url() . JS;?>func/content-datatables.js"></script>
<script type="text/javascript">
   $(document).ready(function() {
      t = $('#grid').DataTable({
         "processing": true,
         "serverSide": true,
         "ajax": {
            "url": "<?php echo $table['url'];?>",
            "type": "POST",
            "pages": 10
         },
         "lengthMenu":[ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
         "columns":<?php echo $table['columns'];?>,
         "order": <?php echo ((array_key_exists('order', $table) ) ? $table['order'] : "[[1, 'asc']]" );?>,
      });
      $('#grid').search(<?php echo $table['columns'];?>);
   });
</script>
