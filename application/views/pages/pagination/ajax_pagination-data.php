


<?php if(!empty($sample)): foreach($sample as $sample): ?>
    <div class="list-item"><a href="javascript:void(0);"><h2><?php echo $sample['competition_name']; ?></h2></a></div>
<?php endforeach; else: ?>
<p>Post(s) not available.</p>
<?php endif; ?>
<?php echo $this->load->library('ajax_pagination');
$this->ajax_pagination->create_links(); ?>