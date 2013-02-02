		</hgroup>

	</header> <!-- #master-header -->

<div id="main" class="row clearfix">
    
<?php /* above needed only in this view due to nav bar not being shown on the login screen */ ?>

<div class="">

    <?php echo $this->session->userdata('session_id'); ?>
    
    <?php echo validation_errors(); ?>

    <?php
    $attributes = array('class' => 'loginform big_search');
    echo form_open('ajw/index', $attributes); 
    ?>
        <label class="assistive-text" for="s">username</label>
        <input type="username" name="username" value="<?php echo set_value('login'); ?>" placeholder="username" required>

        <label class="assistive-text" for="s">password</label>
        <input type="password" name="password" value="<?php echo set_value('password'); ?>" placeholder="password" required>
        <input type="submit" value="login">
    </form> 
    
</div>