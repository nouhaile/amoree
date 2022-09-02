<?php 
$setto_hs_breadcrumb	= get_theme_mod('hs_breadcrumb','1');
if($setto_hs_breadcrumb == '1') {	
?>
	<div class="breadcrumb-area">
	   <div class="container">
		  <div class="row">
			 <div class="col">
				<!-- breadcrumb-list start -->
				<ul class="breadcrumb-list">
					<?php setto_breadcrumbs();?>
				</ul>
				<!-- breadcrumb-list end -->
			 </div>
		  </div>
	   </div>
	</div>
<?php } ?>	