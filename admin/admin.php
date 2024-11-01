
<?php
if (!defined('ABSPATH')) {
    die('No direct access allowed');
}

function simplecontent_admin_pages()
{
//getting all settings
    $simple_content_protector = get_option('simple_content_protector');
//sanitize all post values
    if (isset($_POST['scp_nonce_submit'])) {
        $scp_nonce_submit = sanitize_text_field($_POST['scp_nonce_submit']);
        if ($scp_nonce_submit != '') {
            $simple_content_protector = sanitize_text_field($_POST['simple_content_protector']);
            $saved                     = sanitize_text_field($_POST['saved']);
            if (isset($simple_content_protector)) {
                update_option('simple_content_protector', $simple_content_protector);
            }
            if ($saved == true) {
                echo ' <div class="updated"><p><strong>Settings Saved.</strong></p></div>';
            }
        }
    }

    ?>

 <div class="wrap">
    <div class="postbox4" style="padding: 10px 10px;">
        <h3>General Settings</h3>
        <div class="scp_block" style="margin: 20px 20px;">
            <label>Simple Content Protector Free is to Automatically Protect the Website Content<br/><br/>
                 Basically this Plugin Disable the Control Keys like <br/><br/></label>

                <ul class="scp_protect_list">
                    <li>CTRL+A</li>
                    <li> CTRL+C</li>
                    <li>CTRL+V</li>
                    <li> CTRL+X</li>
                    <li>CTRL+S</li>
                    <li>CTRL+U</li>
                    <li>MOUSE RIGHT CLICK</li>
                </ul>


              <form method="post" id="form_submit" action="">
                <select style="width:250px" name="simple_content_protector">
                    <option value='scp_enable' <?php if ($simple_content_protector == 'scp_enable') {echo "selected='selected'";}?>>Enable
                    <option value='scp_disable' <?php if ($simple_content_protector == 'scp_disable') {echo "selected='selected'";}?>>Disable</option>
                    </option>
                </select>

                <input type="hidden" name="saved"  value="saved"/>
                <input type="submit" name="scp_nonce_submit" class="button-primary" value="Save Changes" />
                <?php if (function_exists('wp_nonce_field')) {
        wp_nonce_field('scp_nonce_submit', ' scp_nonce_submit');
    }
    ?>
             </form>

        </div>
    </div>
</div>
    <?php

}
?>

