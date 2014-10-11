<div class="row blog-content">
      <div class="col-sm-9">
        
        <div class="panel panel-default panel-blog">
          <div class="panel-body">
            <h3 class="blogsingle-title"><?php the_title(); ?></h3>
            
            <ul class="blog-meta">
              <li>By: <a href="">TmPxls</a></li>
              <li>Jan 02, 2014</li>
              <li><a href="">2 Comments</a></li>
            </ul>
            
            <br />
             <div class="blog-img">
            <?php
			// Must be inside a loop.
			
			if ( has_post_thumbnail() ) {
				the_post_thumbnail();
			}
			else {
				//echo '<img src="' . get_bloginfo( 'stylesheet_directory' ) . '/images/thumbnail-default.jpg" />';
			}
			?>
          </div>
            <div class="mb20"></div>
            
            <?php the_content('Read the rest of this entry &raquo;'); ?>
                      
          </div><!-- panel-body -->
        </div><!-- panel -->
        
        <div class="authorpanel">
          <div class="media">
            <a class="pull-left" href="#">
              <img class="media-object thumbnail" src="images/photos/userprofile.png" alt="" />
            </a>
            <div class="media-body event-body">
              <h4 class="subtitle">About The Author</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
          </div><!-- media -->
        </div><!-- authorpanel -->
        
        <div class="mb30"></div>
        <h5 class="subtitle">5 Comments</h5>
        <div class="mb30"></div>
        
        <ul class="media-list comment-list">
          
          <li class="media">
            <a class="pull-left" href="#">
              <img class="media-object thumbnail" src="images/photos/user1.png" alt="" />
            </a>
            <div class="media-body">
              <a href="" class="btn btn-primary btn-xs pull-right reply">Reply</a>
              <h4>Nusja Nawancali</h4>
              <small class="text-muted">January 10, 2014 at 7:30am</small>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
              
              <div class="media">
                <a class="pull-left" href="#">
                  <img class="media-object thumbnail" src="images/photos/userprofile.png" alt="" />
                </a>
                <div class="media-body">
                  <a href="" class="btn btn-primary btn-xs pull-right reply">Reply</a>
                  <h4>Eileen Sideways</h4>
                  <small class="text-muted">January 10, 2014 at 7:30am</small>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                
                  <div class="media">
                    <a class="pull-left" href="#">
                      <img class="media-object thumbnail" src="images/photos/user3.png" alt="" />
                    </a>
                    <div class="media-body">
                      <a href="" class="btn btn-primary btn-xs pull-right reply">Reply</a>
                      <h4>Zaham Sindilmaca</h4>
                      <small class="text-muted">January 10, 2014 at 7:30am</small>
                      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                  </div><!-- media -->
                
                </div><!-- media-body -->
              </div><!-- media -->
              
              <div class="media">
                <a class="pull-left" href="#">
                  <img class="media-object thumbnail" src="images/photos/user2.png" alt="" />
                </a>
                <div class="media-body">
                  <a href="" class="btn btn-primary btn-xs pull-right reply">Reply</a>
                  <h4>Ray Sin</h4>
                  <small class="text-muted">January 10, 2014 at 7:30am</small>
                  <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>
              </div><!-- media -->
              
            </div><!-- media-body -->
            
          </li><!-- media -->
          
          <li class="media">
            <a class="pull-left" href="#">
              <img class="media-object thumbnail" src="images/photos/user1.png" alt="" />
            </a>
            <div class="media-body">
              <a href="" class="btn btn-primary btn-xs pull-right reply">Reply</a>
              <h4>Nusja Nawancali</h4>
              <small class="text-muted">January 10, 2014 at 7:30am</small>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
          </li><!-- media -->
          
          <li class="media">
            <a class="pull-left" href="#">
              <img class="media-object thumbnail" src="images/photos/user4.png" alt="" />
            </a>
            <div class="media-body">
              <a href="" class="btn btn-primary btn-xs pull-right reply">Reply</a>
              <h4>Weno Carasbong</h4>
              <small class="text-muted">January 10, 2014 at 7:30am</small>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            
              <div class="media">
                <a class="pull-left" href="#">
                  <img class="media-object thumbnail" src="images/photos/user3.png" alt="" />
                </a>
                <div class="media-body">
                  <a href="" class="btn btn-primary btn-xs pull-right reply">Reply</a>
                  <h4>Zaham Sindilmaca</h4>
                  <small class="text-muted">January 10, 2014 at 7:30am</small>
                  <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>
              </div><!-- media -->
                  
            </div>
          </li><!-- media -->
          
        </ul><!-- comment-list -->
        
        <div class="mb30"></div>
        <h5 class="subtitle mb5">Leave A Comment</h5>
        <p class="text-muted">Your email address will not be published.</p>
        <div class="mb20"></div>
        
        <form>
              <div class="row row-pad-5">
                <div class="col-lg-4">
                  <input type="text" class="form-control" placeholder="Name" name="name">
                </div>
                <div class="col-lg-4">
                  <input type="email" class="form-control" placeholder="Email" name="email">
                </div>
                <div class="col-lg-4">
                  <input type="url" class="form-control" placeholder="Website" name="website">
                </div>
              </div><!-- row -->
              <textarea placeholder="Message" rows="5" class="form-control"></textarea>
              <div class="mb10"></div>
              <button class="btn btn-primary">Add Comment</button>
            </form>
      
      </div><!-- col-sm-8 -->
      
      <div class="col-sm-3">
        <div class="blog-sidebar">
          
          <h5 class="subtitle">Text Widget</h5>
          <p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam</p>
          
          <div class="mb30"></div>
          
          <h5 class="subtitle">Categories</h5>
          <ul class="sidebar-list">
			<li>Posted in <?php the_category(', ') ?></li>
			<li><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?></li>
			<?php the_tags('<li>Tags: ', ', ', '</li>'); ?>
          </ul>
          
          <div class="mb30"></div>
          
          <h5 class="subtitle">Archives</h5>
          <ul class="sidebar-list">
            <li><a href=""><i class="fa fa-angle-right"></i> January 2014</a></li>
            <li><a href=""><i class="fa fa-angle-right"></i> December 2013</a></li>
            <li><a href=""><i class="fa fa-angle-right"></i> November 2013</a></li>
            <li><a href=""><i class="fa fa-angle-right"></i> October 2013</a></li>
            <li><a href=""><i class="fa fa-angle-right"></i> September 2013</a></li>
          </ul>
          
        </div><!-- blog-sidebar -->
      </div><!-- col-sm-4 -->
      
 </div><!-- row -->