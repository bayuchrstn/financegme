<ul class="icons-list">
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="icon-menu7"></i></a>
		<ul class="dropdown-menu dropdown-menu-right">
			<?php
				if(!empty($action_button)):
					foreach($action_button as $row):
			?>
			<li><?php echo $row; ?></li>
			<?php
					endforeach;
				endif;
			?>
		</ul>
	</li>
</ul>
