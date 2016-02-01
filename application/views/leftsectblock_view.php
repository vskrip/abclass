<div id="left_block">
	<?php if(isset($links)): ?>
		<!-- Links block -->
		<h4 class="contr_title">ссылки</h4>
		<?php foreach($links as $lnk): ?>
				<?php if($lnk['sectype']=='1'): ?>
					<a href = "<?=base_url()."sections/$lnk[section_id]";?>"><strong><?=$lnk['title'];?></strong></a><br>
					<h4 class="contr_title">главы</h4>
				<?php elseif($lnk['sectype']=='2'): ?>
					<a href = "<?=base_url()."sections/$lnk[section_id]";?>"><?=$lnk['title'];?></a><br>
				<?php else: ?>
					<a href = "<?=base_url()."sections/$lnk[section_id]";?>">
					Глава: <?=$lnk['title'];?></a><br>
				<?php endif; ?>
		<?php endforeach; ?>
	<?php endif; ?>
	<!-- Type hotels block -->
	<?php if(isset($type_hotels)): ?>
		<h4 class="contr_title">типы отелей</h4>
		<a href = "<?=base_url()."sections/hotels/";?>" style="padding-left: 2px;">-- все отели --</a>
		<?php foreach($type_hotels as $thots): ?>
			<dif id="hotel_type">
				<ul>
					<li><a href = "<?=base_url()."sections/hotels/hotel_type_id/$thots[id]";?>"><?=$thots['title'];?></a></li>
				</ul>
			</dif>
		<?php endforeach; ?>
	<?php endif; ?>
	<!-- Countries block -->
	<?php if(isset($continents)): ?>
		<h4 class="contr_title">страны</h4>
	      <div id="country">
	        <ul id="accordion">
		<?php foreach ($continents as $contis): ?>
	        	<?php if($contis['id']==1): ?>
	        	<li class="active">
	        	<?php else: ?>
	        	<li>
	        	<?php endif; ?>
	        		<span><?=$contis['title']?></span>
	        		<?php if(is_array($contis['countries'])): ?>
 		        		<ul>
	        			<?php foreach ($contis['countries'] as $countrs): ?>
	        				<?php if($cur_sec == 'hotels'): ?>
	        		     		<li><a href = "<?=base_url()."sections/hotels/country/$countrs[id]";?>"><?=$countrs['title'];?></a></li>        				
	        				<?php elseif($cur_sec = 'rests'): ?>
		        		     	<li><a href = "<?=base_url()."sections/rests/country/$countrs[id]";?>"><?=$countrs['title'];?></a></li>
	        				<?php endif; ?>
		        		<?php endforeach; ?>
		        		</ul>
	        		<?php endif; ?>
        		</li>
		<?php endforeach; ?>
        	</ul>
		</div>
		<?php endif; ?>	
</div>