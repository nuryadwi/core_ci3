<?php
   echo '
   <div class="modal-header">
      <h4 id="modelHeader" class="modal-title">' . $form_title. '</h4>' .
      ( ( ! isset( $form_close ) || $form_close ) ?
      '<button type="button" class="btn-close btn-danger" data-dismiss="modal" title="Close"><i class="fa fa-times"></i></button>': '' ) . '
   </div>
   <div id="modalBody" class="modal-body">
   ';
   if ( isset( $form_is_multi ) ) {
      echo '
      <form id="form-data" action="' .$form_action. '" enctype="multipart/form-data" accept-charset="utf-8" method="post">';
   } else {
      echo '
      <form id="form-data" action="' .$form_action. '" accept-charset="utf-8" method="post">';
   }

   echo ( ( isset( $form_data ) ) ? $form_data : '' );
   echo ( ( isset( $form_content) ) ? $this->load->view( $form_content ) : '' );
   echo '
   </div>
   <div class="modal-footer">
   ';
   if ( ( isset( $form_button ) ) ) {
      echo $form_button;
   } else {
      echo '
      <div class="m-auto text-center">
         <button id="btn_save" type="button" class="btn btn-success mr-1"><i class="mdi mdi-content-save"></i>&nbsp;Save</button>
      ';
   }
   echo '

   </form>
   </div>';
?>
