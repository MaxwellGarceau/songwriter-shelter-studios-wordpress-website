jQuery(document).ready(function ($){
// Client side code for sending upvote information to server and displaying visual upvote count
class Upvote {
	constructor() {
		this.events();
	}

	events() {
		$('.upvote-box').on('click', this.ourClickDispatcher.bind(this));
	}

// Conditional logic to determine if upvote box should create or delete a upvote based on user/past user input
	ourClickDispatcher(e) {
		const currentUpvoteBox = $(e.target).closest('.upvote-box');
		if (currentUpvoteBox.attr('data-exists') == 'yes') {
			this.deleteUpvote(currentUpvoteBox);
		} else {
			this.createUpvote(currentUpvoteBox);
		}
	}

// Sends data to wordpress backend
	createUpvote(currentUpvoteBox) {
		$.ajax({
			beforeSend: (xhr) => {
				xhr.setRequestHeader('X-WP-NONCE', songwriterData.nonce);
			},
			url: songwriterData.root_url + '/wp-json/songwriter/v1/manageUpvote',
			type: 'POST',
			data: {'userId': currentUpvoteBox.data('user')},
			success: (response) => {
				// Visually updates Upvote box and count
				currentUpvoteBox.attr('data-exists', 'yes');
				let upvoteCount = parseInt(currentUpvoteBox.find('.upvote-count').html(), 10);
				upvoteCount++;
				currentUpvoteBox.find('.upvote-count').html(upvoteCount);
				// Sends back post ID
				currentUpvoteBox.attr('data-upvote', response);
				console.log(response);
			},
			error: (response) => {
				console.log(response);
			}
		});
	}

	deleteUpvote(currentUpvoteBox) {
		$.ajax({
			beforeSend: (xhr) => {
				xhr.setRequestHeader('X-WP-NONCE', songwriterData.nonce);
			},
			url: songwriterData.root_url + '/wp-json/songwriter/v1/manageUpvote',
			type: 'DELETE',
			data: {'upvote': currentUpvoteBox.attr('data-upvote')},
			success: (response) => {
				// Visually updates upvote box and count
				currentUpvoteBox.attr('data-exists', 'no');
				let upvoteCount = parseInt(currentUpvoteBox.find('.upvote-count').html(), 10);
				upvoteCount--;
				currentUpvoteBox.find('.upvote-count').html(upvoteCount);
				currentUpvoteBox.attr('data-upvote', '');				
				console.log(response);
			},
			error: (response) => {
				console.log(response);
			}
		});
	}
}

// Run code
const upvote = new Upvote();
});