// import $ from 'jquery';
// Live Search

jQuery(document).ready(function ($){

class Search {
	constructor() {
		this.addSearchHTML();
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
				this.typingTimer = setTimeout(this.getResults.bind(this), 750);							
			} else {
				this.resultsDiv.html('');
				this.isSpinnerVisible = false;
			}

			this.previousValue = this.searchField.val();
		}
	}

	getResults() {
		$.getJSON(songwriterData.root_url + '/wp-json/songwriter/v1/search?term=' + this.searchField.val(), (results) => {
			this.resultsDiv.html(`
				<div class="container">
					<div class="row">
						<div class="col-sm-3 text-container">
							<h2 class="search-overlay__section-title">Pages</h2>
							<div class="text-container__reset">
								${results.pageSection.length !== 0 ? '<ul class="link-list min-list">' : '<span>Sorry, no results</span>'}
								${results.pageSection.map((item) => `<li><a href="${item.permalink}">${item.title}</a>${item.postType == 'post' ?  ` - ${item.postDate}` : ''}</li><br>`).join('')}
								${results.pageSection.length == 0 ? '</ul>' : ''}		
							</div>					
						</div>
						<div class="col-sm-3 text-container">
							<h2 class="search-overlay__section-title">Songwriter Salon</h2>
							<div class="text-container__reset">
								${results.songwriterSalon.length !== 0 ? '<ul class="link-list min-list">' : `<span>Sorry, no results. <br> <a href="${songwriterData.root_url}/songwriter-shelter-studios-blog-pages/songwriter-salon-music-philosophy-in-the-21st-century/">See all Songwriter Salon posts here.</a></span>`}
								${results.songwriterSalon.map((item) => `<li><a href="${item.permalink}">${item.title}</a> - ${item.postDate}</li><br>`).join('')}
								${results.songwriterSalon.length == 0 ? '</ul>' : ''}
							</div>											
						</div>
						<div class="col-sm-3 text-container">
							<h2 class="search-overlay__section-title">Advice for Songwriters</h2>
							<div class="text-container__reset">
								${results.songwriterAdvice.length !== 0 ? '<ul class="link-list min-list">' : `<span>Sorry, no results. <br> <a href="${songwriterData.root_url}/songwriter-shelter-studios-blog-pages/songwriter-advice-from-a-nashville-music-producer/">See all Advice for Songwriters posts here.</a></span>`}
								${results.songwriterAdvice.map((item) => `<li><a href="${item.permalink}">${item.title}</a> - ${item.postDate}</li><br>`).join('')}
								${results.songwriterAdvice.length == 0 ? '</ul>' : ''}		
							</div>	
						</div>
						<div class="col-sm-3 text-container">
							<h2 class="search-overlay__section-title">Music Production and Composition Tutorials</h2>
							<div class="text-container__reset">
								${results.productionTutorials.length !== 0 ? '<ul class="link-list min-list">' : `<span>Sorry, no results. <br> <a href="${songwriterData.root_url}/songwriter-shelter-studios-blog-pages/modern-music-production-and-composition-a-deep-dive-into-the-why-and-the-how/">See all Music Production and Composition Tutorial posts here.</a></span>`}
								${results.productionTutorials.map((item) => `<li><a href="${item.permalink}">${item.title}</a> - ${item.postDate}</li><br>`).join('')}
								${results.productionTutorials.length == 0 ? '</ul>' : ''}	
							</div>		
						</div>						
					</div>
				</div>
				`);
		});
		this.isSpinnerVisible = false;
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
		this.searchField.val('');
		this.resultsDiv.html('');
		setTimeout(() => this.searchField.focus(), 301);
		this.isOverlayOpen = true;
		return false;
	}

	closeOverlay() {
		this.searchOverlay.removeClass('search-overlay--active');
		$('body').removeClass('body-no-scroll');
		this.isOverlayOpen = false;
	}

	addSearchHTML() {
		$('body').append(`
		    <div class="search-overlay">
		        <div class="search-overlay__top">
		            <div class="">
		                <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
		                <input type="text" class="search-term" placeholder="What are you looking for?" id="search-term">
		                <i class="fa fa-close search-overlay__close" aria-hidden="true"></i>                
		            </div>
		        </div>
		        <div>
		            <div id="search-overlay__results"></div>
		        </div>
		    </div>
		`);
	}
}

const search = new Search();
});