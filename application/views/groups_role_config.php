<?php $this->load->view('layouts/meta') ?>
<?php $this->load->view('layouts/header') ?>
<?php $this->load->view('set_group_access_to_pages')?>

<div class="wrapper" xmlns="http://www.w3.org/1999/html">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="content-header">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Collapsible Accordion</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div id="accordion">
                                <?php
                                $colors = [
                                    0 => 'card card-primary',
                                    1 => 'card card-danger',
                                    2 => 'card card-success',
                                ];
                                $accordionsID = [
                                    0 =>'collapseOne',
                                    1 => 'collapseTwo',
                                    2 => 'collapseThree'
                                ];
                                $links = [
                                    0 => '#collapseOne',
                                    1 => '#collapseTwo',
                                    2 => '#collapseThree'
                                ];
                                $idForm = [
                                    0 => 'form1',
                                    1 => 'form2',
                                    2 => 'form3'
                                ];
                                $buttonID = [
                                    0 => 'button_1',
                                    1 => 'button_2',
                                    2 => 'button_3'
                                ];
                                $pageID = [
                                    0 => 'page_1',
                                    1 => 'page_2',
                                    2 => 'page_3'
                                ];
                                $groupID = [
                                    0 => 'group_1',
                                    1 => 'group_2',
                                    2 => 'group_3'
                                ]
                                ?>
                                <?php foreach ($groups as $key => $group):?>
                                    <div class="<?php echo $color = $colors[$key];?>">
                                        <div class="card-header">
                                            <h4 class="card-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="<?= $link = $links[$key];?>">
                                                        <?php echo htmlspecialchars($group->name,ENT_QUOTES,'UTF-8');?>
                                                </a>
                                            </h4>
                                        </div>
                                            <div id="<?= $accordionID = $accordionsID[$key];?>" class="panel-collapse collapse">
                                            <div class="card-body">
                                                <?php $forms = $idForm[$key]; ?>
                                                <?php echo form_open('groups_role_config/saveOrDeletePermissionForGroup', array('id' => $forms));?>
                                                <?php foreach ($pages as $page) :?>
                                                    <label class="checkbox">
                                                    <input type="checkbox" class="get_value" value="<?= $page->id;?>" id="<?=$pagesID = $pageID[$key];?>" name="pages[]" <?php if (!empty($fetchPermission[$group->id][$page->id])) : ?>checked<?php endif ?>>
                                                        <?php echo $page->permission_description;?>
                                                </label>
                                                <?php $data = [
                                                        'type'  => 'hidden',
                                                        'name'  => 'idGroup',
                                                        'value' => $group->id,
                                                        'id' => $groupsID = $groupID[$key],
                                                        'class' => 'idGroup'
                                                    ];?>
                                                <?= form_input($data); ?>
                                                <?php endforeach;?>
                                                <div>
                                                    <button type="submit" class="btn btn-outline-warning" id="btnSubmit">Save</button>
                                                </div>
                                                <?php echo form_close();?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach;?>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <p><a href="<?= base_url('auth') ?>"><button type="submit" class="btn btn-outline-secondary" id="btnSubmit">Back</button></a></p>
            </div>
        </div>
    </div>
    <?php $this->load->view('layouts/footer') ?>
</div>
<?php $this->load->view('layouts/js') ?>
<script>
    $('form').submit(function(e){
        e.preventDefault();
        let form = $(this);
        let idGroup = form.find(".idGroup").val();
        let pages = [];
        form.find('input[name="pages[]"]:checked').each(function() {
            if ($(this).is(":checked")) {
                pages.push($(this).val());
            }
        });
        $.ajax({
            type : "POST",
            url  : "<?php echo base_url() ?>groups_role_config/saveOrDeletePermissionForGroup",
            dataType : "json",
            cache : false,
            data : {pages: pages, idGroup: idGroup},
            success (){
                if (!pages) {
                    alert('Доступы к страницам удалены!');
                }
                alert('Операция сделана успешно!');
            }
        });
    });
</script>
</body>
</html>