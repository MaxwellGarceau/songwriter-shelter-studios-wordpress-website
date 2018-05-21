import $ from 'jquery';

	class ForumPosts {
		constructor() {
			this.events();
		}
		events() {
			// $('#user-posts-button').on('click', this.toggleUserPosts);
			$('.user-posts-button__show').on('click', this.toggleUserPosts);
			$('.user-posts-button__create').on('click', this.toggleCreatePosts);			
			$('.user-forum-posts').on('click', '.delete-forum-post', this.deleteUserPost);
			$('.user-forum-posts').on('click', '.update-forum-post', this.updateUserPost.bind(this));
			$('.user-forum-posts').on('click', '.edit-forum-post', this.editUserPost.bind(this));
			$('.create-forum-post').on('click', this.createForumPost.bind(this));
		}
		toggleUserPosts(e) {
			const thisSection = $(e.target).parents('.forum-master-container__subsection');
			if (thisSection.find('.user-posts-button__show').html() == 'Show My Posts') {
				thisSection.find('.user-posts-area__show').slideDown(1000);
				thisSection.find('.user-posts-button__show').html('Hide My Posts');
			} else {
				thisSection.find('.user-posts-area__show').slideUp();
				thisSection.find('.user-posts-button__show').html('Show My Posts');
			}		
		}
		toggleCreatePosts(e) {
			const thisSection = $(e.target).parents('.forum-master-container__subsection');
			if (thisSection.find('.user-posts-button__create').html() == 'Create A Post') {
				thisSection.find('.user-posts-area__create').slideDown(1000);
				thisSection.find('.user-posts-button__create').html('Cancel');
			} else {
				thisSection.find('.user-posts-area__create').slideUp();
				thisSection.find('.user-posts-button__create').html('Create A Post');
			}
		}		
		editUserPost(e) {
			const thisPost = $(e.target).parents('li');
			if (thisPost.data('state') == 'editable') {
				this.makeUserPostReadOnly(thisPost);
			} else {
				this.makeUserPostEditable(thisPost);
			}
		}
		makeUserPostEditable(thisPost) {
			thisPost.find('.edit-forum-post').html('<i class="fa fa-times" aria-hidden="true"> Cancel</i>');
			thisPost.find('.user-posts__title, .user-posts__content').removeAttr('readonly').addClass('forum-post-active-field');
			thisPost.find('.update-forum-post').addClass('update-forum-post--visible');
			thisPost.data('state', 'editable');
		}
		makeUserPostReadOnly(thisPost) {
			thisPost.find('.edit-forum-post').html('<i class="fa fa-pencil" aria-hidden="true"> Edit</i>');
			thisPost.find('.user-posts__title, .user-posts__content').attr('readonly', 'readonly').removeClass('forum-post-active-field');
			thisPost.find('.update-forum-post').removeClass('update-forum-post--visible');		
			thisPost.data('state', 'cancel');
		}
		deleteUserPost(e) {
			const thisSection = $(e.target).parents('.forum-master-container__subsection');
			const thisPost = $(e.target).parents('li');

			$.ajax({
				beforeSend: (xhr) => {
					xhr.setRequestHeader('X-WP-Nonce', songwriterData.nonce);
				},
				
				url: songwriterData.root_url + '/wp-json/wp/v2/' + thisPost.data('post-type') + '/' + thisPost.data('id'),
				type: 'DELETE',
				success: (response) => {
					thisPost.slideUp();
					console.log('congrats');
					console.log(response);
					if (response.userPostCount < 5) {
						thisSection.find('.forum-post-limit-message').fadeOut();
					}
					if (response.userPostCount == 0) {
						$('.forum-button__no-posts').html(`You don't have any posts at the moment. Click the "Create A Post" button to make some!`);
					}
				},
				error: (response) => {
					console.log('sorry');
					console.log(response);						
				}
			});
		}
		updateUserPost(e) {
			const thisPost = $(e.target).parents('li');

			const ourUpdatedPost = {
				'title': thisPost.find('.user-posts__title').val(),
				'content': thisPost.find('.user-posts__content').val()
			};

			$.ajax({
				beforeSend: (xhr) => {
					xhr.setRequestHeader('X-WP-Nonce', songwriterData.nonce);
				},
				
				url: songwriterData.root_url + '/wp-json/wp/v2/' + thisPost.data('post-type') + '/' + thisPost.data('id'),
				type: 'POST',
				data: ourUpdatedPost,
				success: (response) => {
					this.makeUserPostReadOnly(thisPost);
					console.log('congrats');
					console.log(response);
				},
				error: (response) => {
					console.log('sorry');
					console.log(response);						
				}
			});
		}
		createForumPost(e) {
			const thisSection = $(e.target).parents('.forum-master-container__subsection');
			// const thisPost = $(e.target).parents('div');
			const ourNewPost = {
				'title': thisSection.find('.new-forum-post-title').val(),
				'content': thisSection.find('.new-forum-post-body-field').val(),
				'status': 'publish'
			};

			$.ajax({
				beforeSend: (xhr) => {
					xhr.setRequestHeader('X-WP-Nonce', songwriterData.nonce);
				},
				
				url: songwriterData.root_url + '/wp-json/wp/v2/' + thisSection.find('.user-posts-area__create').data('post-type') + '/',
				type: 'POST',
				data: ourNewPost,
				success: (response) => {
					console.log(response);
					thisSection.find('.new-forum-post-title, .new-forum-post-body-field').val('');
					$('.forum-button__no-posts').html('');
					$(`
					    <li data-id="${response.id}" data-post-type="${response.type}">
					      <input readonly class="user-posts__title" value="${response.title.raw}">
					      <br>
					      <textarea readonly class="user-posts__content">${response.content.raw}</textarea>
					      <br>
					      <span class="edit-forum-post"><i class="fa fa-pencil" aria-hidden="true"> Edit</i></span>
					      <span class="delete-forum-post"><i class="fa fa-trash-o" aria-hidden="true"> Delete</i></span>
					      <span class="update-forum-post"><i class="fa fa-arrow-right" aria-hidden="true"> Save</i></span>
					    <hr>						      
					    </li>
						`).prependTo(thisSection.find('.user-forum-posts')).hide().slideDown();
					// Update forum list in real time (could also do for delete if I have time)
					
					// $(`
				 //        $musicPhilForum = new WP_Query([
				 //        'posts_per_page' => -1,
				 //        'post_type' => ${thisPost.data('post-type')}
				 //      ]);

				 //    <?php
				 //      forumMainContent([
				 //        'query' => $musicPhilForum
				 //      ]);           
				 //      ?>														
					// 	`).prependTo('.page--posts').hide().slideDown();					
					console.log('congrats');
					console.log(response);
				},
				error: (response) => {
					// PHP adding white space, fix later
					if (response.responseText == "Slow down, you're posting too quickly.") {
						thisSection.find('.forum-post-limit-message').fadeIn();
					}
					console.log('sorry');
					console.log(response);
				}
			});
		}								
	}

export default ForumPosts;