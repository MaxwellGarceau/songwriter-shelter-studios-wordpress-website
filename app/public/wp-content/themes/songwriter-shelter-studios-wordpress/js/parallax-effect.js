jQuery(document).ready(function ($) {
// Enable parallax scrolling
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

    // // Parallax Image Slight Movement
    //     $('body').on('scroll', function() {
    //         console.log('test');
    //     });
    }
});

// Misc

// Music Player

// jQuery(document).ready(function ($) {
//     if($.fn.mediaelementplayer) {
//         $("audio").mediaelementplayer({
//             success: function (mediaElement, domObject) {
//                 mediaElement.addEventListener('play', function() {
//                        mediaElement.setVolume(1);
//                        console.log('event is firing');
//                 });
//             }
//         });
//     }
// });

// $('audio').addEventListener('play', function() {
//     console.log('event is firing');
// });