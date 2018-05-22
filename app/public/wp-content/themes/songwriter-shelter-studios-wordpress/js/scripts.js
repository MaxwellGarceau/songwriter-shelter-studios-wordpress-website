// 3rd party packages from NPM
import $ from 'jquery';
import 'jquery.easing';
import 'jquery-ui';

// Imported from vendor folder
import '../vendor/bootstrap/js/bootstrap.bundle.min.js';
import '../vendor/jquery-ui-waypoints/jquery.waypoints.min.js';
import './modules/misc.js';

// Our modules / classes
// import { ContactFormRequiredFields } from './modules/contact-form'; // Might validate contact form differently in future
import ForumPosts from './modules/forum';
import ParallaxEffect from './modules/parallax-effect';
import ScrollingNav from './modules/scrolling-nav';
import Search from './modules/search';
import Upvote from './modules/upvote';

// Instantiate a new object using our modules/classes
// const contactFormRequiredFields = new ContactFormRequiredFields(); // Might validate contact form differently in future
const forumPosts = new ForumPosts(); // Forum
const parallaxEffect = new ParallaxEffect(); // Parallax
const scrollingNav = new ScrollingNav(); // Scrolling Nav
const search = new Search(); // Search
const upvote = new Upvote(); // Upvote