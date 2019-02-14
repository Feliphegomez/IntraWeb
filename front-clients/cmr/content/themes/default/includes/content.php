<?php
	global $session;
	global $site;
?>
	<!-- 
    <div class="blast-box">
        <div class="blast-frame">
            <p>color schemes</p>
            <div class="blast-colors d-flex justify-content-center">
                <div class="blast-color">#25e0ff</div>
                <div class="blast-color">#feb800</div>
                <div class="blast-color">#f25050</div>
                <div class="blast-color">#18e7d3</div>
            </div>
            <p class="blast-custom-colors">Choose Custom color</p>
            <input type="color" name="blastCustomColor" value="#cf2626">

        </div>
        <div class="blast-icon"><i class="fa fa-cog" aria-hidden="true"></i></div>
    </div> -->
	<?php $session->getBodyTheme(); ?>
	<?php require('cmr/content/themes/'.theme_active.'/includes/footer.php'); ?>
	<?php $session->getModalsTheme(); ?>
	<?php $site->getScriptsGlobal(); ?>
	<?php $session->getScriptsTheme(); ?>
	