<div id="mainResources">

    <h1><?php echo __('Edit item','resources'); ?></h1>

     <?php echo Html::br(2); ?>

    <ul class="breadcrumb">
      <li><a href="?id=resources"><?php echo __('Resources','resources'); ?></a>
        <span class="divider">/</span></li>
      <li class="active"><?php echo __('Edit item','resources'); ?></li>
    </ul>
    <?php
        echo (
            Form::open(null).
    '<div class="span4">'.
            Form::label('rImg', __('Insert link img', 'resources')).
            Form::input('rImg', $img, array('class'=>'input-block-level')).Html::br(2).

            Form::label('rVer', __('Insert version', 'resources')).
            Form::input('rVer', $version, array('class'=>'input-block-level')).Html::br(2).

            Form::label('rLink', __('Insert link to download', 'resources')).
            Form::input('rLink', $link, array('class'=>'input-block-level')).Html::br(2).

            Form::label('rTag', __('Insert tags', 'resources')).
            Form::input('rTag', $tags, array('class'=>'input-block-level')).Html::br(2).

    '</div><div class="span6">'.
            Form::label('rTitle', __('Insert title', 'resources')).
            Form::input('rTitle', $title, array('class'=>'input-block-level')).Html::br(2).

            Form::label('rContent', __('Insert description', 'resources')).
            Form::textarea('rContent', $content, array('class'=>'input-block-level','rows'=>'5')).Html::br(2).

            Form::hidden('csrf', Security::token()).
            Form::submit('rEdit', __('Save', 'resources'), array('class' => 'btn pull-right')).
    '</div>'.
            Form::close()
        );
    ?>
</div>