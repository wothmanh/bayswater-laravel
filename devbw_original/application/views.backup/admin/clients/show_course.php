<section class="content-header">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header boheader55">
                    <h3 class="box-title"> <?php echo $client_course_info->first_name.' '.$client_course_info->last_name."'s"; ?> course</h3>
                  
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding" id="printable">
                    
            
                    <div class="PDF">
                       <object data="<?php echo base_url('uploads/pdf/'.$client_course_info->pdf_course) ?>" type="application/pdf" width="100%" height="1200" > </object>
                    </div>


        
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>


    </div>
</section><!-- /.content -->
