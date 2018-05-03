// import $ from 'jquery';
// Live Search

jQuery(document).ready(function ($){

class Search {
	constructor() {
		this.resultsDiv = $('#search-overlay__results');
		this.openButton = $('.js-search-trigger');
		this.closeButton = $('.search-overlay__close');
		this.searchOverlay = $('.search-overlay');
		this.searchField = $('#search-term');
		this.isOverlayOpen = false;
		this.isSpinnerVisible = false;
		this.previousValue;
		this.typingTimer;
		this.events();
	}

	events() {
		this.openButton.on('click', this.openOverlay.bind(this));
		this.closeButton.on('click', this.closeOverlay.bind(this));
		$(document).on('keydown', this.keyPressDispatcher.bind(this));
		this.searchField.on('keyup', this.typingLogic.bind(this));
	}

	typingLogic() {
		if (this.searchField.val() != this.previousValue) {
			clearTimeout(this.typingTimer);
			if (this.searchField.val()) {
				if (!this.isSpinnerVisible) {
					this.resultsDiv.html('<div class="spinner-loader"></div>');
					this.isSpinnerVisible = true;
				}	
				this.typingTimer = setTimeout(this.getResults.bind(this), 2000);							
			} else {
				this.resultsDiv.html('');
				this.isSpinnerVisible = false;
			}


			this.previousValue = this.searchField.val();
		}
	}

	getResults() {
		// Using songwriter data which is tied to main-songwriter-js instead of search-js to make it easier when I switch to gulp workflow
		$.getJSON(songwriterData.root_url + '/wp-json/wp/v2/posts?search=' + this.searchField.val(), (posts) => {
			this.resultsDiv.html(`
				<h2 class="search-overlay__section-title">General Information</h2>
				${posts.length !== 0 ? '<ul class="link-list min-list">' : '<span>Sorry, no results</span>'}
					${posts.map((post) => `<li><a href="${post.link}">${post.title.rendered}</a></li>`).join('')}
				${posts.length == 0 ? '</ul>' : ''}
				`);
			this.isSpinnerVisible = false;			
		});
	}

	keyPressDispatcher(e) {
		switch(e.keyCode) {
			case 83:
			!this.isOverlayOpen && !$('input, textarea').is(':focus') ? this.openOverlay() : null;
			break;
			case 27:
			this.isOverlayOpen  ? this.closeOverlay() : null;
			break;
		}
	}

	openOverlay() {
		this.searchOverlay.addClass('search-overlay--active');
		$('body').addClass('body-no-scroll');
		this.isOverlayOpen = true;
	}

	closeOverlay() {
		this.searchOverlay.removeClass('search-overlay--active');
		$('body').removeClass('body-no-scroll');
		this.isOverlayOpen = false;
	}
}

const search = new Search();
});