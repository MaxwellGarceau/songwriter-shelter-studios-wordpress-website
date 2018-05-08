jQuery(document).ready(function ($) {
	
	// class CreateForumPost {
	// 	constructor() {
	// 		this.events();
	// 	}

	// 	events() {
			
	// 	}
	// }

	class UserPosts {
		constructor() {
			this.events();
		}
		events() {
			$('#user-posts-button').on('click', this.toggleUserPosts);			
			$('#user-forum-posts').on('click', '.delete-forum-post', this.deleteUserPost);
			$('#user-forum-posts').on('click', '.update-forum-post', this.updateUserPost.bind(this));
			$('#user-forum-posts').on('click', '.edit-forum-post', this.editUserPost.bind(this));
			$('.create-forum-post').on('click', this.createForumPost.bind(this));
		}
		toggleUserPosts() {
			// $('#user-posts-area').toggleClass('user-posts--hidden');
			if ($('#user-posts-button').html() == 'Show My Posts') {
				$('#user-posts-area').slideDown(1000);
				$('#user-posts-button').html('Hide My Posts');
			} else {
				$('#user-posts-area').slideUp();
				$('#user-posts-button').html('Show My Posts');
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
			const thisPost = $(e.target).parents('li');
			$.ajax({
				beforeSend: (xhr) => {
					xhr.setRequestHeader('X-WP-Nonce', songwriterData.nonce);
				},
				url: songwriterData.root_url + '/wp-json/wp/v2/music-phil-forum/' + thisPost.data('id'),
				type: 'DELETE',
				success: (response) => {
					thisPost.slideUp();
					console.log('congrats');
					console.log(response);
					if (response.userPostCount < 5) {
						$('.forum-post-limit-message').fadeOut();
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
				url: songwriterData.root_url + '/wp-json/wp/v2/music-phil-forum/' + thisPost.data('id'),
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
			const ourNewPost = {
				'title': $('.new-forum-post-title').val(),
				'content': $('.new-forum-post-body-field').val(),
				'status': 'publish'
			};

			$.ajax({
				beforeSend: (xhr) => {
					xhr.setRequestHeader('X-WP-Nonce', songwriterData.nonce);
				},
				url: songwriterData.root_url + '/wp-json/wp/v2/music-phil-forum/',
				type: 'POST',
				data: ourNewPost,
				success: (response) => {
					$('.new-forum-post-title, .new-forum-post-body-field').val('');
					$(`
					    <li data-id="${response.id}">
					      <input readonly class="user-posts__title" value="${response.title.raw}">
					      <br>
					      <textarea readonly class="user-posts__content">${response.content.raw}</textarea>
					      <br>
					      <span class="edit-forum-post"><i class="fa fa-pencil" aria-hidden="true"> Edit</i></span>
					      <span class="delete-forum-post"><i class="fa fa-trash-o" aria-hidden="true"> Delete</i></span>
					      <span class="update-forum-post"><i class="fa fa-arrow-right" aria-hidden="true"> Save</i></span>
					    </li>
					    <hr>						
						`).prependTo('#user-forum-posts').hide().slideDown();
					console.log('congrats');
					console.log(response);
				},
				error: (response) => {
					// PHP adding white space, fix later
					if (response.responseText == "									Slow down, you're posting too quickly.") {
						$('.forum-post-limit-message').fadeIn();
					}
					console.log('sorry');
					console.log(response);
				}
			});
		}								
	}

// const createForumPost = new CreateForumPost();
const userPosts = new UserPosts();
});