<div id="mainResources">
    <h1><?php echo __('Resources of','resources').':'.Html::nbsp(2).Site::name();?></h1>
    <?php echo Html::br(); ?>
    <?php if (Notification::get('success')) Alert::success(Notification::get('success')); ?>

    <?php echo ( Html::anchor(__('Add new item', 'resources'), 'index.php?id=resources&action=add_item', array('title' => __('Add new item', 'resources'), 'class' => 'btn btn-small')). Html::nbsp(3));?>

    <?php echo Html::br(2); ?>

    <table class="table table-bordered">
    <thead>
        <tr>
            <th><?php echo __('Photo','resources'); ?></th>
            <th><?php echo __('Title','resources'); ?></th>
            <th class="hidden-phone"><?php echo __('Desc.','resources'); ?></th>
            <th class="hidden-phone"><?php echo __('Tags','resources'); ?></th>
            <th><?php echo __('Version','resources'); ?></th>
        </tr>
    </thead>
        <tbody>
        <?php if (count($reCd) > 0) foreach ($reCd as $row) { ?>
                <tr>
                    <td  class="image">
                        <a class="image" href="#" rel="<?php echo $row['img']; ?>" title="<?php echo Html::toText($row['title']); ?>">
                            <img width="90" src="<?php echo $row['img']; ?>" alt="<?php echo Html::toText($row['title']); ?>"/>
                        </a>
                    </td>
                    <td><?php echo Html::toText($row['title']); ?></td>
                    <td class="hidden-phone"><?php echo Html::toText($row['content']); ?></td>
                    <td class="hidden-phone"><?php echo Html::toText($row['tags']); ?></td>
                    <td><?php echo Html::toText($row['version']); ?></td>

                <td>
                <div class="pull-right">
                    <div class="btn-group">
                    <?php echo Html::anchor(__('Edit', 'resources'), 'index.php?id=resources&action=editItem&uid='.$row['uid'], array('class' => 'btn')); ?>

                    <?php echo Html::anchor(__('Delete', 'resources'), 'index.php?id=resources&delItem='.$row['id'], array('class' => 'btn', 'onClick'=>'return confirmDelete(\''.__('Are you sure', 'resources').'\')')); ?>

                    </div>
                </div>
            </td>
         </tr>

        <?php } ?>
        </tbody>
    </table>
</div>


<div id="resurcesPreview" class="lightbox hide fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class='lightbox-header'>
        <button type="button" class="close" data-dismiss="lightbox" aria-hidden="true">&times;</button>
    </div>
    <div class='lightbox-content'>
        <img />
    </div>
</div>
