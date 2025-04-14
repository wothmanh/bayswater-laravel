                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                
                                <div class="box-header">
                                    <h3 class="box-title"><?php echo empty($schools->id) ? 'Add a new school' : 'Edit school ' . $schools->name; ?></h3>
                                </div>
                                
                                <?php echo validation_errors(); ?>
                                <?php echo form_open_multipart(); ?>

                                    <div class="box-body">
                                        
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">School Name</label>
                                            <?php echo form_input(array('name' => 'name', 'value'=> set_value('name', $schools->name), 'class' => 'form-control' )); ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Country</label>
                                            <?php 
                                            echo form_dropdown('country_id', $country_all, set_value('country_id', $schools->country_id), 'class="form-control" onchange="getserieval(this);"'); ?>
                                        </div>

                                        <div class="form-group" id="choose_city">
                                            <label for="exampleInputEmail1">City</label>
                                            <?php 
                                            echo form_dropdown('city_id', $cities_all, set_value('city_id', $schools->city_id), 'class="form-control"'); ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">School Address</label>
                                            <?php echo form_input(array('name' => 'address', 'value'=> set_value('address', $schools->address), 'class' => 'form-control' )); ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Currency</label>
                                            <?php 
                                            echo form_dropdown('currency_id', $currency_all, set_value('currency_id', $schools->currency_id), 'class="form-control"'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">School insurance</label>
                                            <?php echo form_input(array('name' => 'insurance', 'value'=> set_value('insurance', $schools->insurance), 'class' => 'form-control' )); ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Registration fee</label>
                                            <?php echo form_input(array('name' => 'registration_fee', 'value'=> set_value('registration_fee', $schools->registration_fee), 'class' => 'form-control' )); ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Bank charges</label>
                                            <?php echo form_input(array('name' => 'bank_charges', 'value'=> set_value('bank_charges', $schools->bank_charges), 'class' => 'form-control' )); ?>
                                        </div>

                                        <div class="form-group" id='custodianshipInputId' style="display:<?php if($country_all[$schools->country_id] == 'Canada') echo 'block'; else echo 'none'; ?>">
                                            <label for="exampleInputEmail1">Custodianship fee </label>
                                            <?php echo form_input(array('name' => 'custodianship_fee', 'value'=> set_value('custodianship_fee', $schools->custodianship_fee), 'class' => 'form-control')); ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Summer supp</label>
                                            <?php echo form_input(array('name' => 'summer_fees', 'value'=> set_value('summer_fees', $schools->summer_fees), 'class' => 'form-control' )); ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Summer supp off after (in weeks)</label>
                                            <?php echo form_input(array('name' => 'summer_supp_week_off', 'value'=> set_value('summer_supp_week_off', $schools->summer_supp_week_off), 'class' => 'form-control' )); ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Summer supp. note</label>
                                            <?php echo form_input(array('name' => 'smr_s_note', 'value'=> set_value('smr_s_note', $schools->smr_s_note), 'class' => 'form-control' )); ?>
                                        </div>

                                        <div class="form-group" >
                                            <label for="exampleInputEmail1">Summer supp. date start</label>
                                            <div class="input-group">
                                                <?php echo form_input(array('name' => 'smr_s_dt_start', 'value'=> set_value('smr_s_dt_start', $schools->smr_s_dt_start), 'class' => 'form-control','id' => 'datepicker-autoclose2', 'data-date-format' => 'yyyy-mm-dd' )); ?>
                                                <span class="input-group-addon lftbr1"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>

                                        <div class="form-group" >
                                            <label for="exampleInputEmail1">Summer supp. date ends</label>
                                            <div class="input-group">
                                                <?php echo form_input(array('name' => 'smr_s_dt_ends', 'value'=> set_value('smr_s_dt_ends', $schools->smr_s_dt_ends), 'class' => 'form-control','id' => 'datepicker-autoclose', 'data-date-format' => 'yyyy-mm-dd' )); ?>
                                                <span class="input-group-addon lftbr1"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Accommodation fee</label>
                                            <?php echo form_input(array('name' => 'accommodation_fee', 'value'=> set_value('accommodation_fee', $schools->accommodation_fee), 'class' => 'form-control' )); ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Guardianship fee</label>
                                            <?php echo form_input(array('name' => 'guardianship_fee', 'value'=> set_value('guardianship_fee', $schools->guardianship_fee), 'class' => 'form-control' )); ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Christmas fee</label>
                                            <?php echo form_input(array('name' => 'christmas_fee', 'value'=> set_value('christmas_fee', $schools->christmas_fee), 'class' => 'form-control' )); ?>
                                        </div>

                                        <div class="form-group" >
                                            <label for="exampleInputEmail1">Christmas date start</label>
                                            <div class="input-group">
                                                <?php echo form_input(array('name' => 'christmas_start', 'value'=> set_value('christmas_start', $schools->christmas_start), 'class' => 'form-control','id' => 'nrmdatepicker', 'data-date-format' => 'yyyy-mm-dd' )); ?>
                                                <span class="input-group-addon lftbr1"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>

                                        <div class="form-group" >
                                            <label for="exampleInputEmail1">Christmas date ends</label>
                                            <div class="input-group">
                                                <?php echo form_input(array('name' => 'christmas_end', 'value'=> set_value('christmas_end', $schools->christmas_end), 'class' => 'form-control','id' => 'nrmdatepicker2', 'data-date-format' => 'yyyy-mm-dd' )); ?>
                                                <span class="input-group-addon lftbr1"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Books fee</label>
                                            <?php echo form_input(array('name' => 'books_fee', 'value'=> set_value('books_fee', $schools->books_fee), 'class' => 'form-control' )); ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Books fee per weeks (recurrence)</label><div style="font-size: 11px;font-weight: bold;color: red;margin-bottom: 10px;">If books fee are paid  only once leave 0, otherwise enter the weeks number</div>
                                            <?php echo form_input(array('name' => 'books_weeks', 'value'=> set_value('books_weeks', $schools->books_weeks), 'class' => 'form-control' )); ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Aramix fee</label>
                                            <?php echo form_input(array('name' => 'aramix_fee', 'value'=> set_value('aramix_fee', $schools->aramix_fee), 'class' => 'form-control' )); ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Statu</label>
                                            <?php echo form_dropdown('active', $status, set_value('active', $schools->active), 'class="form-control"'); ?>
                                        </div>

                                        <!-- UPD2 -->

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">All courses include</label>
                                            <?php echo form_textarea(array('name' => 'qf_all_courses_include', 'value' => set_value('qf_all_courses_include', $schools->qf_all_courses_include), 'class' => 'form-control', 'rows' => '4', 'cols' => '50')); ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Professional courses</label>
                                            <?php echo form_textarea(array('name' => 'qf_professional_courses', 'value' => set_value('qf_professional_courses', $schools->qf_professional_courses), 'class' => 'form-control', 'rows' => '4', 'cols' => '50')); ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">English courses</label>
                                            <?php echo form_textarea(array('name' => 'qf_english_courses', 'value' => set_value('qf_english_courses', $schools->qf_english_courses), 'class' => 'form-control', 'rows' => '4', 'cols' => '50')); ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">English lessons</label>
                                            <?php echo form_textarea(array('name' => 'qf_english_lessons', 'value' => set_value('qf_english_lessons', $schools->qf_english_lessons), 'class' => 'form-control', 'rows' => '4', 'cols' => '50')); ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Closure dates</label>
                                            <?php echo form_textarea(array('name' => 'qf_closure_dates', 'value' => set_value('qf_closure_dates', $schools->qf_closure_dates), 'class' => 'form-control', 'rows' => '4', 'cols' => '50')); ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Classrooms</label>
                                            <?php echo form_textarea(array('name' => 'qf_classrooms', 'value' => set_value('qf_classrooms', $schools->qf_classrooms), 'class' => 'form-control', 'rows' => '4', 'cols' => '50')); ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Capacity</label>
                                            <?php echo form_textarea(array('name' => 'qf_capacity', 'value' => set_value('qf_capacity', $schools->qf_capacity), 'class' => 'form-control', 'rows' => '4', 'cols' => '50')); ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Classrooms</label>
                                            <?php echo form_textarea(array('name' => 'qf_max_class_size', 'value' => set_value('qf_max_class_size', $schools->qf_max_class_size), 'class' => 'form-control', 'rows' => '4', 'cols' => '50')); ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Test centre</label>
                                            <?php echo form_textarea(array('name' => 'qf_test_centre', 'value' => set_value('qf_test_centre', $schools->qf_test_centre), 'class' => 'form-control', 'rows' => '4', 'cols' => '50')); ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Notes</label>
                                            <?php echo form_textarea(array('name' => 'qf_notes', 'value' => set_value('qf_notes', $schools->qf_notes), 'class' => 'form-control', 'rows' => '4', 'cols' => '50')); ?>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">File link</label>
                                            <?php echo form_input(array('name' => 'qf_file_link', 'value'=> set_value('name', $schools->qf_file_link), 'class' => 'form-control' )); ?>
                                        </div>

                                    </div>

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>

                                <?php echo form_close(); ?>

                            </div>
                        </div>
                    </div>
                </section><!-- /.content -->

<script type="text/javascript">
    function getserieval(sel) {

        if(sel.options[sel.selectedIndex].text == 'Canada') 
            document.getElementById("custodianshipInputId").style.display = "block";
        else document.getElementById("custodianshipInputId").style.display = "none";

        var choose_city = $('#choose_city');
      //  var serie_input_old = $('.serie_name_id_old');
       if (sel.value == "") {
            var dflt_city = '<label for="exampleInputEmail1">City</label><select name="city_id" class="form-control"><option value="">Choose City</option></select>';
            choose_city.html(dflt_city);

        } else {
            $.ajax({
                url: base_url+"schools/get_citiesof",
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