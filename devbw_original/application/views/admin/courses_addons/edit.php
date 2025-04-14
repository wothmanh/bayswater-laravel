<section class="content-header">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><?php echo empty($courses_addons->id) ? 'Add a new courses add-ons' : 'Edit course ' . $courses_addons->name; ?></h3>
                </div>
                
                <?php echo validation_errors(); ?>

                <?php echo form_open_multipart(); ?>
                    <div class="box-body">
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <?php echo form_input(array('name' => 'name', 'value'=> set_value('name', $courses_addons->name), 'class' => 'form-control' )); ?>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Lessons</label>
                            <?php echo form_input(array('name' => 'lessons', 'value'=> set_value('lessons', $courses_addons->lessons), 'class' => 'form-control', 'type' => 'number' )); ?>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Price</label>
                            <?php echo form_input(array('name' => 'price', 'value'=> set_value('price', $courses_addons->price), 'class' => 'form-control', 'type' => 'number', 'step' => '0.01' )); ?>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">School</label>
                            <?php 
                            echo form_dropdown('school_id', $schools_all, set_value('school_id', $courses_addons->school_id), 'class="form-control"'); ?>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Notes</label>
                            <?php echo form_textarea(array('name' => 'notes', 'value' => set_value('notes', $courses_addons->notes), 'class' => 'form-control', 'rows' => '4', 'cols' => '50')); ?>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Status</label>
                            <?php echo form_dropdown('active', $status, set_value('active', $courses_addons->active), 'class="form-control"'); ?>
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
