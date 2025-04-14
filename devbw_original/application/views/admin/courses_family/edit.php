<section class="content-header">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><?php echo empty($courses_family->id) ? 'Add a new course family option' : 'Edit course family option ' ?></h3>
                </div>
                
                <?php echo validation_errors(); ?>

                <?php echo form_open_multipart(); ?>
                    <div class="box-body">

                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <?php echo form_input(array('name' => 'name', 'value'=> set_value('name', $courses_family->name), 'class' => 'form-control' )); ?>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Lessons</label>
                                    <?php echo form_input(array('name' => 'lessons', 'value'=> set_value('lessons', $courses_family->lessons), 'class' => 'form-control', 'type' => 'number' )); ?>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Age from</label>
                                    <?php echo form_input(array('name' => 'age_from', 'value'=> set_value('age_from', $courses_family->age_from), 'class' => 'form-control', 'type' => 'number' )); ?>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Age to</label>
                                    <?php echo form_input(array('name' => 'age_to', 'value'=> set_value('age_to', $courses_family->age_to), 'class' => 'form-control', 'type' => 'number' )); ?>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Price</label>
                                    <?php echo form_input(array('name' => 'price', 'value'=> set_value('price', $courses_family->price), 'class' => 'form-control', 'type' => 'number', 'step' => '0.01' )); ?>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Extra</label>
                                    <?php echo form_input(array('name' => 'extra', 'value'=> set_value('extra', $courses_family->extra), 'class' => 'form-control', 'type' => 'number', 'step' => '0.01' )); ?>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Start date</label>
                                    <?php echo form_input(array('name' => 'date_from', 'value'=> set_value('date_from', $courses_family->date_from), 'class' => 'form-control', 'type' => 'date')); ?>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Start end</label>
                                    <?php echo form_input(array('name' => 'date_to', 'value'=> set_value('date_to', $courses_family->date_to), 'class' => 'form-control', 'type' => 'date')); ?>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">School</label>
                                    <?php 
                                    echo form_dropdown('school_id', $schools_all, set_value('school_id', $courses_family->school_id), 'class="form-control"'); ?>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Notes</label>
                                    <?php echo form_textarea(array('name' => 'notes', 'value' => set_value('notes', $courses_family->notes), 'class' => 'form-control', 'rows' => '4', 'cols' => '50')); ?>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Status</label>
                                    <?php echo form_dropdown('active', $status, set_value('active', $courses_family->active), 'class="form-control"'); ?>
                                </div>
                            </div>
                        </div>
                                
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</section>
