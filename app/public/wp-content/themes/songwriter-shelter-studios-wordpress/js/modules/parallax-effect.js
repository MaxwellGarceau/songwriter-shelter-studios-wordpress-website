import $ from 'jquery';

// Enable parallax scrolling
const ParallaxEffect = () => {

    if (document.getElementById('home')) {
        const myWorkWP = new Waypoint({
            element: document.getElementById('services'),
            handler: function(direction) {
                if (direction === "down") {
                    $('#home').removeClass('home-content my-work-content about-content').addClass('my-work-content');
                } else $('#home').removeClass('home-content my-work-content about-content').addClass('home-content');
            }
        });

        const aboutWP = new Waypoint({
            element: document.getElementById('testimonials'),
            handler: function(direction) {
                if (direction === "down") {
                    $('#home').removeClass('home-content my-work-content about-content').addClass('about-content');
                } else $('#home').removeClass('home-content my-work-content about-content').addClass('my-work-content');
            }
        });

        // Implement better parallax later

        // // Parallax Image Slight Movement
        //     $('body').on('scroll', function() {
        //         console.log('test');
        //     });
    }
}

export default ParallaxEffect;