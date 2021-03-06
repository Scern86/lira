<?php
defined('_DEXEC') or DIE;
if(!empty($data)) extract($data);
$hostname = \Scern\Lira\Core\Config::getInstance()->hostname;
$alias = $main->alias;
if(!empty($alias)) $url = $alias;
else $url = '?com=object&task=show&id='.$main->id;
$user = \Scern\Lira\Core\User::getInstance();
foreach($main->access as $item){
	$access[] = $item['id'];
}
?>
<div class="clearfix">
<?php if(in_array($user->getUser()->id,$access) OR in_array('efec8802f9a4fe29f344',$access) OR ($user->isLoggedIn() AND in_array('5e1cc7832dcbd43148d5',$access))){?>
	<?php if($main->params['mode']=='small'){?>
		<p><a href="<?=$hostname;?>/<?=$url;?>"><?=$main->title;?></a></p>
	<?php }else{ ?>
		<?php if($main->params['mode']=='medium'){?>
			<?php if($main->params['show_title']==1){?>
			<h1 class="text-center"><a href="<?=$hostname;?>/<?=$url;?>"><?=$main->title;?></a></h1>
			<?php } ?>		
			<div class="content">
				<?=$main->content;?>
				<?=$main->longtext;?>
				<div class="clearfix">
				<?php if($main->attachment) foreach($main->attachment as $item){ ?>		
					<?php $attachment = new \Scern\Lira\Classes\Object($item['id']); ?>
						<?php $params = json_decode($item['params'],1);?>
						<?=$attachment->render($params['type'],$params);?>
				<?php } ?>
				</div>			
			</div><a class="readmore display-block btn btn-danger float-right m-1" href="#">Развернуть</a><br/>	
			<style>
			.content{
				height:150px;
				transition:all 1s;
				-moz-transition:all 1s;
				-webkit-transition:all 1s;
				-o-transition:all 1s;
				margin: 2px;
				overflow:hidden;
			}
			</style>
		<?php }else{?>
			<?php if($main->params['show_title']==1){?>
			<h1 class="text-center"><?=$main->title;?></h1>
			<?php } ?>		
			<?=$main->content;?>
			<?=$main->longtext;?>		
			<div class="clearfix">
				<?php if($main->attachment) foreach($main->attachment as $item){ ?>		
					<?php $attachment = new \Scern\Lira\Classes\Object($item['id']); ?>				
						<?php $params = json_decode($item['params'],1);?>
						<?=$attachment->render($params['type'],$params);?>
				<?php } ?>
			</div>
		<?php } ?>
	<?php } ?>
<?php } ?>
</div>	