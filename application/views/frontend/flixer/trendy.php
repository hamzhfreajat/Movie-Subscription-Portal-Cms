
<div class="row" style="margin:20px 60px;">
	<?php $trendy_movies = $this->crud_model->get_trendy_movies(20); ?>
	<h4><?php echo get_phrase('trendy_movies');?> (<?php echo $trendy_movies->num_rows(); ?>)</h4>
	<div class="content">
		<div class="grid">
			<?php
			
			foreach($trendy_movies->result_array() as $trendy_movie):
				$title	=	$trendy_movie['title'];
				$link	=	base_url().'index.php?browse/playmovie/'.$trendy_movie['movie_id'];
				$thumb	=	$this->crud_model->get_thumb_url('movie' , $trendy_movie['movie_id']);
				?>
				<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/frontend/flixer'?>/hovercss/demo.css" />
				<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/frontend/flixer'?>/hovercss/set1.css" />
				<style>
					.movie_thumb{}
					.btn_opaque{font-size:20px; border: 1px solid #939393;text-decoration: none;margin: 10px;background-color: rgba(0, 0, 0, 0.74); color: #fff;}
					.btn_opaque:hover{border: 1px solid #939393;text-decoration: none;background-color: rgba(57, 57, 57, 0.74);color:#fff;}

					.progress-bar{
							
					    background-color: #000 !important;
					    text-align: left;
					    padding: 5px;
					    color: #c3c3c3;
					    font-size: 12px;
					    width: 100%;
					}
				</style>
				<figure class="effect-sadie col-lg-2 col-md-4 col-sm-6 pb-0">
					<img src="<?php echo $thumb;?>" alt="img02"/>
					<figcaption>
						<p>
							<img src="<?php echo base_url();?>/assets/frontend/<?php echo $selected_theme;?>/images/play.png" style="width:60px;"/>
							<br>
							<span style="font-size: 20px;">
							<?php echo $title;?>
							</span>
						</p>
						<a href="<?php echo $link;?>">View more</a>
					</figcaption>


					<!-- progress section, showed if only progress found -->
					<?php
					if(isset($check_movie)):
						$progress = $this->db->get_where('progress', array('user_id' => $this->session->userdata('user_id') , 'movie_id' => $trendy_movie['movie_id'], 'active_user' => $this->session->userdata('active_user')));
						if($progress->num_rows() > 0){
							$progress_value = $progress->row();
							$progress_value = intval($progress_value->progress_value);
							$duration = 100/$trendy_movie['duration'];
							$already_seeing_time = $duration * $progress_value;
						?>

							<!--Convert secoend -> H, M, S  -->
							<?php
								$seconds = $progress_value % 60;
								$minutes = (($progress_value - $seconds)/60)%60;
								$hours	 = intval(($progress_value / 60) / 60);
							?>

						
							<div style=" width: <?php echo $already_seeing_time; ?>%; border:2px solid #e50615;"></div>
							<div class="progress-bar">
								<i class="fa fa-clock-o" aria-hidden="false"></i>
								<?php
									if($hours > 0){
										echo $hours.' Hour, ';
									}
									if($minutes > 0){
										echo $minutes.' Minutes, ';
									}
									if($hours <= 0 && $seconds > 0){
										echo $seconds.' Seconds';
									}
								?>
							</div>
						<?php } ?>
					<?php endif; ?>
					
				</figure>
			<?php endforeach; ?>
		</div>
	</div>
</div>