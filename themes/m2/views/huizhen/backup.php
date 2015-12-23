
<?php foreach ($data['hospital'] as $hpage) { ?>
    <div id="<?php echo $hpage['pageId']; ?>" data-role="page" data-title="<?php echo $hpage['name']; ?>"  data-add-back-btn="true" data-back-btn-text="返回">
        <div data-role="content" class="ui-content">
            <h3><span class="h-name"><?php echo $hpage['name']; ?></span></h3>
            <p><span class="h-class"><?php echo $hpage['class']; ?></span></p>
            <p><span class="h-type"><?php echo $hpage['type']; ?></span></p>                        
            <p><?php echo $hpage['desc']; ?></p>
        </div>
    </div>
<?php } ?>

<?php foreach ($data['doctor'] as $dpage) { ?>
    <div id="<?php echo $dpage['pageId']; ?>" data-role="page" data-add-back-btn="true" data-back-btn-text="返回">

        <div data-role="content" class="ui-content">
            <p><img class="d-avatar" src="<?php echo $dpage['avatar']; ?>" /></p>
            <h3 class="d-name"><?php echo $dpage['name']; ?></h3>
            <p class="d-title"><?php echo $dpage['title']; ?></p>
            <p class="d-faculty"><?php echo $dpage['faculty']; ?></p>                        
            <p class="d-hospital"><?php echo $dpage['hospital']; ?></p>
            <p class="d-desc"><?php echo $dpage['desc']; ?></p>
        </div>
    </div>
<?php } ?>



