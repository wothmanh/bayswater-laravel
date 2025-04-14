                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title"> Edit discount : <?php echo $course->name; ?></h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <?php echo validation_errors(); ?>
                                <?php echo form_open_multipart(); ?> 
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> Registration fee waived after week number : </label>
                                            <?php echo form_input(array('name' => 'registration_fee_off', 'value'=> set_value('registration_fee_off', $course->registration_fee_off), 'class' => 'form-control' )); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> Accommodation fee waived after week number : </label>
                                            <?php echo form_input(array('name' => 'accommodation_fee_off', 'value'=> set_value('accommodation_fee_off', $course->accommodation_fee_off), 'class' => 'form-control' )); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> Arrival Transfer fee waived after week number : </label>
                                            <?php echo form_input(array('name' => 'arrival_off', 'value'=> set_value('arrival_off', $course->arrival_off), 'class' => 'form-control' )); ?>
                                        </div>
                                        
                                        
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                <?php echo form_close(); ?>
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section><!-- /.content -->

<script type="text/javascript">
    function getserieval(sel) {
        var choose_city = $('#choose_city');
      //  var serie_input_old = $('.serie_name_id_old');
       if (sel.value == "") {
            var dflt_city = '<label for="exampleInputEmail1">City</label><select name="city_id" class="form-control"><option value="">Choose City</option></select>';
            choose_city.html(dflt_city);

        } else {
            $.ajax({
                url: base_url+"course/get_citiesof",
                async: false,
                type: "POST",
                data: "country_id=" + sel.value,
                dataType: "html",
                success:function(rep)
                {      
                    choose_city.html(rep);           
                }
            });
        }
    }


</script>