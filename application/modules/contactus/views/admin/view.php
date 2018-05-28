<div class="section">
    <h4>View Feedback Details </h4>

    <div class="content">
        <?php if ($contact): ?>
            <div class="contact_con">

                <p><label>Name: </label><span><?php echo $contact->getName() ?></span></p>
                <p><label>Email: </label><span><?php echo $contact->getEmail() ?></span></p>
                
                <p><label>Feedback  Message: </label><br/><span id="message"><?php echo nl2br($contact->getMessage()) ?></span></p>
                <p>&nbsp;</p>
                <p><label>Submitted: </label><span><?php echo date_format(($contact->getCreated()), 'Y-m-d'); ?></span></p>

                <br/>
                <p><?php /* ?><label>&nbsp;</label><a href="<?php echo admin_url('feedback')?>" class="button">Back</a><?php */ ?></p>
                <a name="cancel" class="button" style="display:none" href="<?php echo current_url() ?>">Cancel</a>


                <a href="<?php echo admin_url('feedback/delete/' . $contact['id']); ?>" class="button delete" title="Delete Feedback" >Delete</a>
                <a href="javascript:window.history.back();" class="button back">Back</a>
            </div>        
            <?php
        else:
            echo 'Feedback with this ID is not available.';
        endif;
        ?>

    </div>
</div>