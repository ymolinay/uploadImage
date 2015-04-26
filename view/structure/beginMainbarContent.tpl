<div class="mainbar">
	<!-- -->
	<div class="page-head">
		<!-- Page heading -->
		<h2 class="pull-left"><i class="{$headerIconContent}"></i> {$headerContent}</h2>
		<!-- Breadcrumb -->
		<div class="bread-crumb pull-right">
			<a href="principal.php"><i class="fa fa-home"></i> Principal</a> 
            {if $showSubHeader neq 'no'}
            	<span class="divider">/</span> 
            	{$subHeader.title}
            	<span class="divider">/</span> 
            	<a href="{$subHeader.link}" class="bread-current">{$subHeader.header}</a>
            {/if}
		</div>
		<div class="clearfix"></div>
	</div>