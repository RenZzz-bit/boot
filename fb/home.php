<?php
include 'db_connect.php';
include('../login/admin/db.php');
// Get the total number of articles
$sqlCount = "SELECT COUNT(*) AS total FROM news";
$resultCount = $conn->query($sqlCount);
$rowCount = $resultCount->fetch_assoc();
$totalArticles = $rowCount['total'];

// Fetch articles for the current page
$sql = "SELECT * FROM news ";
$result = $conn->query($sql);
?>

<style>
	.left-panel{
		width: calc(20%);
		height: calc(100% - 3rem);
		overflow: auto;
		position: fixed;
	}
	.center-panel{
		left: calc(22%);
		width: calc(50%);
		height: calc(100% - 3rem);
		overflow: auto;
		position: fixed;
		border-top: none; 
		border-bottom: none; 
		border-left: 1px solid #ccc; 
		border-right: 1px solid #ccc
	}
	.right-panel {
        right: calc(1%);
        width: calc(20%);
        height: calc(100% - 3rem);
        overflow: auto;
        position: fixed;
        background-color: #f8f9fa;
        padding: 10px;
        border-radius: 8px;
    }
	.side-nav:hover,.post-link:hover{
		background: #00000026
	}
	 /* Style for the left panel */
	 .left-panel {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
    }

    /* Profile section styling */
    .left-panel a {
        display: flex;
        align-items: center;
        padding: 10px 15px;
        text-decoration: none;
        color: #343a40;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .left-panel a:hover {
        background-color: #e9ecef;
    }

    .left-panel .rounded-circle {
        border: 2px solid #ccc;
        overflow: hidden;
    }

    /* Government Links Section */
    .gov-links {
        padding-top: 15px;
    }

    .gov-links h6 {
        font-weight: bold;
        margin-bottom: 10px;
        font-size: 16px;
        color: #343a40;
    }

    .gov-links ul {
        padding-left: 0;
    }

    .gov-links ul li {
        margin-bottom: 8px;
    }

    /* Government Link Styling */
    .gov-link {
        text-decoration: none;
        color: #007bff;
        font-size: 14px;
        transition: color 0.3s ease;
    }

    .gov-link:hover {
        color: #0056b3;
        text-decoration: underline;
    }

    /* Style for the horizontal line */
    .left-panel hr {
        border-top: 1px solid #ccc;
    }
	
</style>
<div class="d-flex w-100 h-100">
<div class="left-panel mt-1">
    <!-- Profile Section -->
    <a href="index.php?page=profile" class="d-flex py-2 px-1 text-dark side-nav rounded">
        <?php if(isset($_SESSION['login_profile_pic']) && !empty($_SESSION['login_profile_pic'])): ?>
            <div class="rounded-circle mr-1" style="width: 30px;height: 30px;top:-5px;left: -40px">
                <img src="assets/uploads/<?php echo $_SESSION['login_profile_pic'] ?>" class="image-fluid image-thumbnail rounded-circle" alt="" style="max-width: calc(100%);height: calc(100%);">
            </div>
        <?php else: ?>
            <span class="fa fa-user mr-2" style="width: 30px;height: 30px;top:-5px;left: -40px"></span>
        <?php endif; ?>
        <span class="ml-3"><b><?php echo ucwords($_SESSION['login_firstname'].' '.$_SESSION['login_lastname']) ?></b></span>
    </a>
    <hr>

		<!-- Government Links Section -->
		<div class="gov-links mt-3">
			<h5 class="text-dark text-center">Government Links</h5	>
			<ul class="list-unstyled">
				<li><a href="https://owwa.gov.ph/" class="text-dark" target="_blank">OWWA.gov.ph</a></li>
				<li><a href="https://dmw.gov.ph/archives/default.html" class="POEA.gov.ph" target="_blank">GovTrack</a></li>
				<li><a href="https://www.foi.gov.ph/" class="text-dark" target="_blank">DOLE</a></li>
				
				<!-- Add more links as needed -->
			</ul>
		</div>
	</div>


	<div class="d-flex w-100 h-100">
    <!-- Right Panel -->
    <div class="right-panel mt-1">
        <!-- News Articles Section -->
        <div class="news-articles mt-5 bg-white p-3 rounded">
            <h5 class="text-dark text-center">Latest News</h5>
            <div class="row g-3">
			<?php
			if (isset($result) && $result->num_rows > 0) {
				// Limit the number of articles (e.g., limit to 5 articles)
				$limit = 4;  // You can change this number as needed
				$sql = "SELECT * FROM news ORDER BY created_at DESC LIMIT $limit"; // Modify the query to include LIMIT

				$result = $conn->query($sql);  // Execute the query

				if ($result->num_rows > 0) {
					// Loop through articles
					while ($row = $result->fetch_assoc()) {
						$title = htmlspecialchars($row['title']);
						$image = $row['image'] ? '../login/admin/assets/' . htmlspecialchars($row['image']) : '../login/admin/assets/default.jpg';
						$articleLink = "../login/admin/article.php?id=" . $row['id'];

						echo '<div class="col-12">';
						echo '    <div class="news-item d-flex align-items-center border rounded p-2">';
						echo '        <img src="' . $image . '" alt="" class="img-fluid rounded" style="width: 80px; height: 80px; object-fit: cover;">';
						echo '        <div class="ms-3">';
						echo '            <a href="' . $articleLink . '" class="text-decoration-none text-dark" target="_blank">';
						echo '                <h6 class="mb-1"  style="padding-left: 5px;">' . $title . '</h6>';
						echo '            </a>';
						echo '            <small class="text-muted" style="padding-left: 5px;">' . date('F j, Y', strtotime($row['created_at'])) . '</small>';
						echo '        </div>';
						echo '    </div>';
						echo '</div>';
					}
				}
			} else {
				echo '<p class="text-center text-muted"><br>No articles available.</p>';
			}

?>

            </div>
        </div>
    </div>
</div>


	<div class="center-panel py-3 px-2">
		<div class="container-fluid">
			<!-- <div class="col-md-12">
				<div class="card card-widget">
					<div class="card-body">
						<div class="container-fluid">
							<div class="d-flex w-100">
								<div class="rounded-circle mr-1" style="width: 30px;height: 30px;top:-5px;left: -40px">
					                  <img src="assets/uploads/<?php echo $_SESSION['login_profile_pic'] ?>" class="image-fluid image-thumbnail rounded-circle" alt="" style="max-width: calc(100%);height: calc(100%);">
				                </div>
				                <button class="btn btn-default ml-4 text-left" id="write_post" type="button" style="width:calc(80%);border-radius: 50px !important;"><span>What's on your mind, <?php echo ucwords($_SESSION['login_firstname']) ?>?</span></button>
							</div>
							<hr>
							<div class="d-flex w-100 justify-content-center">
								<a href="javascript:void(0)" id="upload_post" class="text-dark post-link px-3 py-1" style="border-radius: 50px !important;"><span class="fa fa-photo-video text-success"></span> Photo/Video</a>
							</div>
						</div>
					</div>
				</div>
			</div> -->
			<?php 

			$posts = $conn->query("SELECT p.*,concat(u.firstname,' ',u.lastname) as name,u.profile_pic from posts p inner join users u on u.id = p.user_id  where p.type = 0 order by unix_timestamp(p.date_created) desc");
			while($row=$posts->fetch_assoc()):
			$row['content'] = str_replace("\n","<br/>",$row['content']);
			$is_liked =  $conn->query("SELECT * FROM likes where user_id = {$_SESSION['login_id']} and post_id = {$row['id']} ")->num_rows ? "text-primary" : "";
			$liked =  $conn->query("SELECT * FROM likes where post_id = {$row['id']} ")->num_rows;
			$commented =  $conn->query("SELECT * FROM comments where post_id = {$row['id']} ")->num_rows;

			?>
			<div class="col-md-12">
				
			<div class="card card-widget post-card" data-id="<?php echo $row['id'] ?>">
              <div class="card-header">
                <div class="user-block">
                  <img class="img-circle" src="assets/uploads/<?php echo $row['profile_pic'] ?>" alt="User Image">
                  <span class="username"><a href="#"><?php echo $row['name'] ?></a></span>
                  <span class="description">Posted - <?php echo date("M d,Y h:i a",strtotime($row['date_created'])) ?></span>
                </div>
                <!-- /.user-block -->
                <div class="card-tools">
                	<?php if($_SESSION['login_id'] == $row['user_id']): ?>
                	<div class="dropdown">
	                  <button type="button" class="btn btn-tool" data-toggle="dropdown" title="Manage">
	                    <i class="fa fa-ellipsis-v"></i>
	                  </button>
	                  <div class="dropdown-menu">
              			<a class="dropdown-item edit_post" data-id="<?php echo $row['id'] ?>" href="javascript:void(0)">Edit</a>
              			<a class="dropdown-item delete_post" data-id="<?php echo $row['id'] ?>" href="javascript:void(0)">Delete</a>
	                  </div>
	                  </div>
	              <?php endif; ?>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- post text -->
                <p class="content-field"><?php echo $row['content'] ?></p>

              	<a href="javascript:void(0)" class="d-none show-content" >Show More</a>
              	<?php if(is_dir('assets/uploads/'.$row['id'])): ?>
              	<div class="gallery mb-2" >
              		<?php
              		$gal = scandir('assets/uploads/'.$row['id']);
					unset($gal[0]);
					unset($gal[1]);
					$count =count($gal);
					$i = 0;
					foreach($gal as $k => $v):
						$mime = mime_content_type('assets/uploads/'.$row['id'].'/'.$v);
						$i++;
						if($i > 4)
						break;
						$style = '';
						if($count == 1){
							$style = "grid-column-start: 1;grid-column-end: 3;grid-row-start: 1;grid-row-end: 3;";
						}elseif($count == 2){
							// if($i==1)
							$style = "grid-column-start: {$i};grid-column-end: ".($i + 1).";grid-row-start: 1;grid-row-end: 3;";
						}elseif ($count == 3) {
							if($i == 1)
							$style = "grid-column-start: {$i};grid-column-end: ".($i + 1).";grid-row-start: 1;grid-row-end: 3;";
						}
              		 ?>
              		 <figure class="gallery__item position-relative" style="<?php echo $style ?>">
					   <?php if($i == 4 && $count > 4): ?>
						<div class="position-absolute d-flex justify-content-center align-items-center h-100 w-100" style="top:0;left:0;z-index:1" >
							<a href="javascript:void(0)" class="text-white view_more" data-id="<?php echo $row['id'] ?>"><h4 class="text-white text-center"><?php echo '+ '.($count-4) ?> More</h4></a>
						</div>
					    <?php endif; ?>
              		 	<?php if(strstr($mime,'image')): ?>
              		 		<a href="assets/uploads/<?php echo $row['id'].'/'.$v ?>" class="lightbox-items" data-toggle="lightbox<?php echo $row['id'] ?>" data-slide="<?php echo $k ?>" data-title="" data-gallery="gallery"  data-id="<?php echo $row['id'] ?>">
					    <img src="assets/uploads/<?php echo $row['id'].'/'.$v ?>" class="gallery__img" alt="Image 1">
					    </a>
					    <?php else: ?>
							<?php if($count > 1): ?>
								<a href="assets/uploads/<?php echo $row['id'].'/'.$v ?>" class="lightbox-items" data-toggle="lightbox<?php echo $row['id'] ?>" data-slide="<?php echo $k ?>" data-title="" data-gallery="gallery">
					    	<?php endif; ?>
					    	<video <?php echo $count == 1 ? "controls" : '' ?> class="gallery__img">
					    		 <source src="assets/uploads/<?php echo $row['id'].'/'.$v ?>" type="<?php echo $mime ?>">
					    	</video>
							<?php if($count > 1): ?>
							</a>
							<a href="javascript:void(0)" class="text-white view_more" data-id="<?php echo $row['id'] ?>" >
							<div class="position-absolute d-flex justify-content-center align-items-center h-100 w-100" style="top:0;left:0;z-index:1" >
							<h3 class="text-white text-center rounded-circle "><i class="fa fa-play-circle "></i></h3>
							</div>
							</a>
					    	<?php endif; ?>

					    <?php endif; ?>
						
					  </figure>
              		<?php endforeach; ?>
              	</div>
              <?php endif; ?>

                <!-- Social sharing buttons -->
                <button type="button" class="btn btn-default btn-sm like <?php echo $is_liked ?> rounded-pill" 
       			 data-id="<?php echo $row['id'] ?>">
    			<i class="far fa-thumbs-up"></i> Like
				</button>
                <span class="float-right text-muted counts"><span class="like-count"><?php echo number_format($liked) ?></span> <?php echo $liked > 1 ? "likes" : "like" ?> - <span class="comment-count"><?php echo number_format($commented) ?></span> comments</span>
              </div>
              <!-- /.card-body -->
              <div class="card-footer card-comments">
				<?php 
					$comments = $conn->query("SELECT c.*,concat(u.firstname,' ',u.lastname) as name,u.profile_pic FROM comments c inner join users u on u.id = c.user_id where c.post_id = {$row['id']} order by unix_timestamp(c.date_created) asc ");
					while($crow = $comments->fetch_assoc()):
				?>
				<div class="card-comment">
					<!-- User image -->
					<img class="img-circle img-sm" src="assets/uploads/<?php echo $crow['profile_pic'] ?>" alt="User Image">

					<div class="comment-text">
					<span class="username">
						<span class="uname"><?php echo $crow['name'] ?></span>
						<span class="text-muted float-right timestamp"><?php echo date("M d,Y h:i A",strtotime($crow['date_created'])) ?></span>
					</span><!-- /.username -->
					<span class="comment">
					<?php echo str_replace("\n","<br/>",$crow['comment']) ?>
					</span>
					</div>
					<!-- /.comment-text -->
				</div>
				<?php endwhile; ?>
              </div>
              <!-- /.card-footer -->
              <div class="card-footer">
                <form action="#" method="post">
                  <i class="img-fluid img-circle img-sm fa fa-comment"></i>
                  <!-- .img-push is used to add margin to elements next to floating images -->
                  <div class="img-push">
                    <textarea cols="30" rows="1" class="form-control comment-textfield" style="resize:none" placeholder="Press enter to post comment" data-id="<?php echo $row['id'] ?>"></textarea>
                  </div>
                </form>
              </div>
              <!-- /.card-footer -->
            </div>
			</div>
		<?php endwhile; ?>
			
		</div>
	</div>
</div>
<style>
	.gallery__img {
	    width: 100%;
	    height: 100%;
	    object-fit: cover;
	}
	.gallery {
	    display: grid;
	    grid-template-columns: repeat(2, 50%);
	    grid-template-rows: repeat(2, 30vh);
	    grid-gap: 3px;
	    grid-row-gap: 3px;
	}
	.gallery__item{
		margin: 0
	}
</style>
<div class="d-none " id="comment-clone">
<div class="card-comment">
	<!-- User image -->
	<img class="img-circle img-sm" src="" alt="User Image">

	<div class="comment-text">
	<span class="username">
		<span class="uname">Maria Gonzales</span>
		<span class="text-muted float-right timestamp">8:03 PM Today</span>
	</span><!-- /.username -->
	<span class="comment">
	It is a long established fact that a reader will be distracted
	by the readable content of a page when looking at its layout.
	</span>
	</div>
	<!-- /.comment-text -->
</div>
</div>
<script>
	$('.comment-textfield').on('keypress', function (e) {
		if(e.which == 13 && e.shiftKey == false){
			if($('#preload2').length <= 0){
				start_load();
			}else{
				return false;
			}
			var post_id = $(this).attr('data-id')
			var comment = $(this).val()
			$(this).val('')
			$.ajax({
				url:'ajax.php?action=save_comment',
				method:'POST',
				data:{post_id:post_id,comment:comment},
				success:function(resp){
					if(resp){
						resp = JSON.parse(resp)
						if(resp.status == 1){
							var cfield = $('#comment-clone .card-comment').clone()
							cfield.find('.img-circle').attr('src','assets/uploads/'+resp.data.profile_pic)
							cfield.find('.uname').text(resp.data.name)
							cfield.find('.comment').html(resp.data.comment)
							cfield.find('.timestamp').text(resp.data.timestamp)
						$('.post-card[data-id="'+post_id+'"]').find('.card-comments').append(cfield)
						var cc = $('.post-card[data-id="'+post_id+'"]').find('.comment-count').text();
							cc = cc.replace(/,/g,'');
							cc = parseInt(cc) + 1
						$('.post-card[data-id="'+post_id+'"]').find('.comment-count').text(cc)
						}else{
							alert_toast("An error occured","danger")
						}
						end_load()
					}
				}
			})
			return false;
		}
    })
	$('.comment-textfield').on('change keyup keydown paste cut', function (e) {
		if(this.scrollHeight <= 117)
        $(this).height(0).height(this.scrollHeight);
    })
	$('#write_post').click(function(){
		uni_modal("<center><b>Create Post</b></center></center>","create_post.php")
	})
	$('.edit_post').click(function(){
		uni_modal("<center><b>Edit Post</b></center></center>","create_post.php?id="+$(this).attr('data-id'))
	})
	$('.delete_post').click(function(){
	_conf("Are you sure to delete this post?","delete_post",[$(this).attr('data-id')])
	})
	function delete_post($id){
			start_load()
			$.ajax({
				url:'ajax.php?action=delete_post',
				method:'POST',
				data:{id:$id},
				success:function(resp){
					if(resp==1){
						alert_toast("Data successfully deleted",'success')
						setTimeout(function(){
							location.reload()
						},1500)

					}
				}
			})
		}
	$('#upload_post').click(function(){
		uni_modal("<center><b>Create Post</b></center></center>","create_post.php?upload=1")
	})
	$('.content-field').each(function(){
		var dom = $(this)[0]
		var divHeight = dom.offsetHeight
		if(divHeight > 117){
			$(this).addClass('truncate-5')
			$(this).parent().children('.show-content').removeClass('d-none')
		}
	})
	$('.show-content').click(function(){
		var txt = $(this).text()
		if(txt == "Show More"){
			$(this).parent().children('.content-field').removeClass('truncate-5')
			$(this).text("Show Less")
		}else{
			$(this).parent().children('.content-field').addClass('truncate-5')
			$(this).text("Show More")
		}
	})
	$('.lightbox-items').click(function(e){
		e.preventDefault()
		uni_modal("","view_attach.php?id="+$(this).attr('data-id'),"large")
	})
	$('.view_more').click(function(e){
		e.preventDefault()
		uni_modal("","view_attach.php?id="+$(this).attr('data-id'),"large")
	})
	$('.like').click(function(){
		var _this = $(this)
		$.ajax({
			url:'ajax.php?action=like',
			method:'POST',
			data:{post_id:$(this).attr('data-id')},
			success:function(resp){
				if(resp == 1){
					_this.addClass('text-primary')
					var lc = _this.siblings('.counts').find('.like-count').text();
							lc = lc.replace(/,/g,'');
							lc = parseInt(lc) + 1
					_this.siblings('.counts').find('.like-count').text(lc)
				}else if(resp==0){
					_this.removeClass('text-primary')
					var lc = _this.siblings('.counts').find('.like-count').text();
							lc = lc.replace(/,/g,'');
							lc = parseInt(lc) - 1
					_this.siblings('.counts').find('.like-count').text(lc)
				}
			}
		})
	})

</script>