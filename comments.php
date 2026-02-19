<div class="container">
  <!-- Comments section -->
  <div class="row">
    <div class="col-md-6 mx-auto">
        <!-- Comment Count -->
        <div class="d-flex justify-content-between my-4">
          <p class="mb-0">
             <span class="text-danger">
                 <?php echo get_comments_number(); ?>
             </span> Comments
          </p>
           <a class="btn btn-outline-danger rounded-0"
              href="#commentForm">
              Write a comment
           </a>
        </div>
    </div>
  </div>
  <!-- ------------ COMMENTS AREA (example) ------------ -->
  <div class="article-comments">
    <div class="row">
      <div class="col-md-6 my-5 mx-auto">
        <!-- All Comments -->
        <?php if ( have_comments() ) : ?>
            <div id="allComments" class="comments">
                <?php
                wp_list_comments( array(
                  'style'      => 'ul',
                  'short_ping' => true,
                  'callback'   => 'custom_bootstrap_comment',
                  'max_depth'  => 3,
                ) );
                ?>
            </div>
        <?php endif; ?>
        </div>
        <div class="row">
          <div class="col-md-6 my-5 mx-auto">
            <!-- Main Comment Form (for new top-level comments) -->
            <div id="commentForm" class="comment-form my-5">
                <?php
                comment_form( array(
                    'class_submit' => 'my-3 btn btn-outline-danger rounded-0',
                    'class_form'   => 'row',
                    'title_reply'  => '',
                    'comment_field' => '
                        <div class="">
                            <textarea id="comment" name="comment"
                            class="form-control border-black rounded-0"
                            style="height:200px"
                            placeholder="Write your comment..." required></textarea>
                        </div>
                    ',
                    'fields' => array(
                        'author' => '
                            <div class="">
                                <input id="author" name="author" type="text"
                                class="my-3 form-control border-0 border-bottom border-black rounded-0"
                                required placeholder="Enter your name.." />
                                <label class="form-label">Name *</label>
                            </div>',
                        'email' => '
                            <div class="">
                                <input id="email" name="email" type="email"
                                class="my-3 form-control border-0 border-bottom border-black rounded-0"
                                required placeholder="Enter your email.."/>
                                <label class="form-label">Email *</label>
                            </div>',
                        'url' => '
                            <div class="">
                                <input id="url" name="url" type="text"
                                class="my-3 form-control border-0 border-bottom border-black rounded-0" placeholder="Enter your website address (optional)" />
                                <label class="form-label">Website</label>
                            </div>',
                    ),
                ) );
                ?>
            </div>
          </div>
        </div

        <!-- Hidden reply form template (cloned when replying) -->
        <div id="replyFormTemplate" class="d-none my-3">
          <form class="reply-form row g-3">
            <input
              type="hidden"
              name="parent_id"
              class="parent-id-input"
              value=""
            />
            <div class="col-12">
              <textarea
                class="form-control border-black rounded-0 reply-text"
                style="height: 150px"
              ></textarea>
            </div>
            <div class="col-md-6">
              <input
                type="text"
                class="form-control border-0 border-bottom border-black rounded-0 reply-name"
              />
              <label class="form-label">Name *</label>
            </div>
            <div class="col-md-6">
              <input
                type="email"
                class="form-control border-0 border-bottom border-black rounded-0 reply-email"
              />
              <label class="form-label">Email *</label>
            </div>
            <div class="col-md-12">
              <input
                type="text"
                class="form-control border-0 border-bottom border-black rounded-0 reply-email"
              />
              <label class="form-label">Website</label>
            </div>
            <div class="col-12">
              <button
                type="submit"
                class="btn btn-outline-danger rounded-0"
              >
                Reply
              </button>
              <button
                type="button"
                class="btn btn-outline-secondary rounded-0 cancel-reply"
              >
                Cancel
              </button>
            </div>
          </form>
        </div>
    </div>
  </div>
  <!-- ------------ OPTIONAL CSS for animation / spacing ------------ -->
  <style>
    /* make the placeholder keep some space when injected */
    .reply-placeholder {
    margin-top: 0.75rem;
    }

    /* Slide animation handled via max-height in JS; small nicety */
    .reply-form {
    overflow: hidden;
    }
  </style>
</div>
