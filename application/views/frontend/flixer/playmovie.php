<style>
	@media screen and (max-width: 765px) {
	  .mobile_vedio_player{
	  	width: 100%;
	    height: 220px;
	  }
	  .mobile_vedio_player_html{
	  	width: 100%;
	  }
	}
	@media screen and (min-width: 766px) {
	  .mobile_vedio_player{
	    width: 100%;
	    height: 585px;
	  }
	  .mobile_vedio_player_html{
	    width: 100%;
	  }
	}

</style>
<?php include 'header_browse.php';?>
<?php $user_id = $this->session->userdata('user_id'); ?>
<?php $active_user = $this->session->userdata('active_user'); ?>
<?php
	$movie_details	=	$this->db->get_where('movie' , array('movie_id' => $movie_id))->result_array();
	foreach ($movie_details as $row):
	?>


<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/frontend/' . $selected_theme;?>/hovercss/demo.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/frontend/' . $selected_theme;?>/hovercss/set1.css" />
<style>
	.movie_thumb{}
	.btn_opaque{font-size:20px; border: 1px solid #939393;text-decoration: none;margin: 10px;background-color: rgba(0, 0, 0, 0.74); color: #fff;}
	.btn_opaque:hover{border: 1px solid #939393;text-decoration: none;background-color: rgba(57, 57, 57, 0.74);color:#fff;}
	.video_cover {
	position: relative;padding-bottom: 30px;
	}
	.video_cover:after {
	content : "";
	display: block;
	position: absolute;
	top: 0;
	left: 0;
	background-image: url(<?php echo $this->crud_model->get_poster_url('movie' , $row['movie_id']);?>);
	width: 100%;
	height: 100%;
	opacity : 0.2;
	z-index: -1;
	background-size:cover;
	}
	.select_black{background-color: #000;height: 45px;padding: 12px;font-weight: bold;color: #fff;}
	.profile_manage{font-size: 25px;border: 1px solid #ccc;padding: 5px 30px;text-decoration: none;}
	.profile_manage:hover{font-size: 25px;border: 1px solid #fff;padding: 5px 30px;text-decoration: none;color:#fff;}
</style>
<!-- VIDEO PLAYER -->

<div class="video_cover">
	<div class="container" style="padding-top:100px; text-align: center;">
		<div class="row">

			<!--Main movie-->
			<?php include 'main_movie.php'; ?>


			<!--Trailer-->
			<?php include 'trailer.php'; ?>
		</div>
	</div>
</div>
<!-- VIDEO DETAILS HERE -->
<div class="container" style="margin-top: 30px;">
	<div class="row">
		<div class="col-lg-8">
			<div class="row">
				<div class="col-lg-3">
					<img src="<?php echo $this->crud_model->get_thumb_url('movie' , $row['movie_id']);?>" style="height: 60px; margin:20px;" />
				</div>
				<div class="col-lg-9">
					<!-- VIDEO TITLE -->
					<h3>
						<?php echo $row['title'];?>
					</h3>
					<!-- RATING CALCULATION -->
					<div>
						<?php $average_rating = $this->crud_model->get_ratings('movie', $row['movie_id'],'average'); ?>
						<?php for($i = 1; $i <= 5; $i++): ?>
							<i class="fa fa-star" aria-hidden="true" style="<?php if($average_rating >= $i): ?>color: #e2cc0c;<?php else: echo "color: #999999;"; endif; ?>"></i>
						<?php endfor; ?>
					</div>
				</div>
			</div>
		</div>
		<script>
			// submit the add/delete request for mylist
			// type = movie/series, task = add/delete, id = movie_id/series_id
			function process_list(type, task, id)
			{
				$.ajax({
					url: "<?php echo base_url();?>index.php?browse/process_list/" + type + "/" + task + "/" + id,
					success: function(result){
			        //alert(result);
			        if (task == 'add')
			        {
			        	$("#mylist_button_holder").html( $("#mylist_delete_button").html() );
			        }
			        else if (task == 'delete')
			        {
			        	$("#mylist_button_holder").html( $("#mylist_add_button").html() );
			        }
			    }});
			}

			// Show the add/delete wishlist button on page load
			   $( document ).ready(function() {

			   	// Checking if this movie_id exist in the active user's wishlist
			    mylist_exist_status = "<?php echo $this->crud_model->get_mylist_exist_status('movie' , $row['movie_id']);?>";

			    if (mylist_exist_status == 'true')
			    {
			    	$("#mylist_button_holder").html( $("#mylist_delete_button").html() );
			    }
			    else if (mylist_exist_status == 'false')
			    {
			    	$("#mylist_button_holder").html( $("#mylist_add_button").html() );
			    }
			});
		</script>
		<div class="col-lg-4">
			<!-- ADD OR DELETE FROM PLAYLIST -->
			<span id="mylist_button_holder">
			</span>
			<span id="mylist_add_button" style="display:none;">
			<a href="#" class="btn btn-danger btn-md" style="font-size: 16px; margin-top: 20px;"
				onclick="process_list('movie' , 'add', <?php echo $row['movie_id'];?>)">
			<i class="fa fa-plus"></i> <?php echo get_phrase('Add_to_My_list');?>
			</a>
			</span>
			<button class="btn btn-danger btn-md" id = 'watch_button' style="font-size: 16px; margin-top: 20px;" onclick="divToggle()">
				<i class="fa fa-eye"></i> <?php echo get_phrase('watch_trailer');?>
			</button>
			<span id="mylist_delete_button" style="display:none;">
			<a href="#" class="btn btn-default btn-md" style="font-size: 16px; margin-top: 20px;"
				onclick="process_list('movie' , 'delete', <?php echo $row['movie_id'];?>)">
			<i class="fa fa-check"></i> <?php echo get_phrase('Added_to_My_list');?>
			</a>
			</span>
			<!-- MOVIE GENRE -->
			<div style="margin-top: 10px;">
				<strong><?php echo get_phrase('Genre');?></strong> :
				<a href="<?php echo base_url();?>index.php?browse/movie/<?php echo $row['genre_id'];?>">
				<?php echo $this->db->get_where('genre',array('genre_id'=>$row['genre_id']))->row()->name;?>
				</a>
			</div>
			<!-- MOVIE YEAR -->
			<div>
				<strong><?php echo get_phrase('Year');?></strong> : <?php echo $row['year'];?>
			</div>
		</div>
	</div>
	<div class="row" style="margin-top:20px;">
		<div class="col-lg-12">
			<div class="bs-component">
				<ul class="nav nav-tabs">
					<li class="active" style="width:25%;">
						<a href="#about" data-toggle="tab">
							<?php echo get_phrase('About');?>
						</a>
					</li>

					<li style="width:25%;">
						<a href="#rating" data-toggle="tab">
							<?php echo get_phrase('comments');?>
							<?php $comments = $this->crud_model->get_ratings('movie', $row['movie_id'],'all'); ?>
							(<?php echo $comments->num_rows(); ?>)
						</a>
					</li>
					
					<li style="width:25%;">
						<a href="#cast" data-toggle="tab">
							<?php echo get_phrase('Cast');?>
						</a>
					</li>
					<li style="width:25%;">
						<a href="#more" data-toggle="tab">
							<?php echo get_phrase('More');?>
						</a>
					</li>
				</ul>
				<div id="myTabContent" class="tab-content">

					<!-- TAB FOR TITLE -->
					<div class="tab-pane active in" id="about">
						<p>
							<?php echo $row['description_long'];?>
						</p>
					</div>

					<div class="tab-pane " id="rating">
						<a href="javascript:;" class="btn btn-danger" onclick="$('#toggleAddComment').toggle();"><?php echo get_phrase('add_comment'); ?></a>
						<form id="toggleAddComment" action="<?php echo base_url('index.php?browse/user_rating/movie/'.$row['movie_id']); ?>" style="max-width: 500px; display: none;" method="post">
								<div class="form-group">
									<label><?php get_phrase('rating'); ?></label>
									<select name="rate" class="form-control">
										<option value="1">1 <?php echo get_phrase('star'); ?></option>
										<option value="2">2 <?php echo get_phrase('star'); ?></option>
										<option value="3">3 <?php echo get_phrase('star'); ?></option>
										<option value="4">4 <?php echo get_phrase('star'); ?></option>
										<option value="5">5 <?php echo get_phrase('star'); ?></option>
									</select>
								</div>

								<div class="form-group">
									<label><?php get_phrase('comment'); ?></label>
									<textarea name="comment" rows="4" class="form-control"></textarea>
								</div>

								<div class="form-group">
									<button type="submit" class="btn btn-danger"><?php echo get_phrase('submit'); ?></button>
								</div>
							</form>

						<?php foreach($comments->result_array() as $comment): ?>
							<p>
								<div style="display: flex; float: left; color: #fff; font-weight: bold; width: 100%;">
									<div style="margin-top: 10px; display: block;">
										<?php echo $this->db->get_where('user', array('user_id'=>$comment['user_id']))->row()->name;?>
										<div>
											<?php for($i = 1; $i <= 5; $i++): ?>
												<i class="fa fa-star" aria-hidden="true" style="<?php if($comment['rate'] >= $i): ?>color: #e2cc0c;<?php else: echo "color: #999999;"; endif; ?>"></i>
											<?php endfor; ?>
										</div>
										<div style="padding: 10px 0px 10px 0px; font-size: 14px; font-weight: 500;">
											<?php echo $comment['comment']; ?>
										</div>

										<?php if($this->session->userdata('login_type') == 1 || $this->session->userdata('user_id') == $comment['user_id']): ?>
											<?php if($this->session->userdata('user_id') == $comment['user_id']): ?>
												<a href="javascript:;" onclick="$('#<?php echo $comment['rating_id']; ?>').toggle();"><?php echo get_phrase('edit'); ?></a>
											<?php endif; ?>
											<a href="<?php echo base_url('index.php?browse/remove_rating/'.$comment['movie_or_series_id']); ?>" onclick="return confirm('Want to delete?')"><?php echo get_phrase('remove'); ?></a>
										<?php endif; ?>
									</div>
								</div>
							</p>
							<form id="<?php echo $comment['rating_id']; ?>" action="<?php echo base_url('index.php?browse/user_rating/movie/'.$row['movie_id']); ?>" style="max-width: 500px; display: none;" method="post">
								<div class="form-group">
									<label><?php get_phrase('rating'); ?></label>
									<select name="rate" class="form-control">
										<option value="1" <?php if($comment['rate'] == 1) echo 'selected'; ?>>1 <?php echo get_phrase('star'); ?></option>
										<option value="2" <?php if($comment['rate'] == 2) echo 'selected'; ?>>2 <?php echo get_phrase('star'); ?></option>
										<option value="3" <?php if($comment['rate'] == 3) echo 'selected'; ?>>3 <?php echo get_phrase('star'); ?></option>
										<option value="4" <?php if($comment['rate'] == 4) echo 'selected'; ?>>4 <?php echo get_phrase('star'); ?></option>
										<option value="5" <?php if($comment['rate'] == 5) echo 'selected'; ?>>5 <?php echo get_phrase('star'); ?></option>
									</select>
								</div>

								<div class="form-group">
									<label><?php get_phrase('comment'); ?></label>
									<textarea name="comment" rows="4" class="form-control"><?php echo $comment['comment']; ?></textarea>
								</div>

								<div class="form-group">
									<button type="submit" class="btn btn-danger"><?php echo get_phrase('submit'); ?></button>
								</div>
							</form>
						<?php endforeach; ?>
					</div>

					<!-- TAB FOR ACTORS -->
					<div class="tab-pane " id="cast">
						<p>
							<?php
								$actors	=	json_decode($row['actors']);
								for($i = 0; $i< sizeof($actors) ; $i++)
								{
									?>
						<div style="float: left; text-align:center; color: #fff; font-weight: bold;">
							<img src="<?php echo $this->crud_model->get_actor_image_url($actors[$i]);?>"
								style="height: 160px; margin:5px;" />
							<br>
							<a href="<?php echo base_url('index.php?browse/filter/movie/all/'.$actors[$i].'/all/all'); ?>" style="color: white;"><?php echo $this->db->get_where('actor', array('actor_id'=>$actors[$i]))->row()->name;?></a>
						</div>
						<?php
							}
							?>
						</p>
					</div>
					<!-- TAB FOR SAME CATEGORY MOVIES -->
					<div class="tab-pane  " id="more">
						<p>
						<div class="content">
							<div class="grid">
								<?php
									$movies = $this->crud_model->get_movies($row['genre_id'] , 10, 0);
									foreach ($movies as $row)
									{
										$title	=	$row['title'];
										$link	=	base_url().'index.php?browse/playmovie/'.$row['movie_id'];
										$thumb	=	$this->crud_model->get_thumb_url('movie' , $row['movie_id']);
										include 'thumb.php';
									}
									?>
							</div>
						</div>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr style="border-top:1px solid #333;">
	<?php include 'footer.php';?>
</div>
<?php endforeach;?>

<script type="text/javascript">
	function divToggle() {
		if ($('#trailer_div').hasClass('hidden')) {
			$('#trailer_div').removeClass('hidden');
			$('#movie_div').addClass('hidden');
			$('#watch_button').html('<?php echo '<i class="fa fa-eye"></i> '.get_phrase('watch_movie') ?>');
			player.pause();
		}else {
			$('#movie_div').removeClass('hidden');
			$('#trailer_div').addClass('hidden');
			$('#watch_button').html('<?php echo '<i class="fa fa-eye"></i> '.get_phrase('watch_trailer') ?>');
			trailer_url.pause();
		}
		$("html, body").animate({scrollTop: 0}, 500);
	}
</script>

<script language="javascript" type="text/javascript" src="jquery-1.8.2.js"></script>
<script language="javascript" type="text/javascript">

// $(function(){
//     $('#watch_button').click(function(){
//         $('iframe').attr('src', $('iframe').attr('src'));
//     });
// });
</script>
