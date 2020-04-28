require('./bootstrap');

import $ from 'jquery';
window.$ = window.jQuery = $;

require('jquery-ui/ui/widgets/tooltip');
require('jquery-ui/ui/widgets/sortable');
require('jquery-ui/ui/widgets/selectmenu');

import AOS from 'aos';
import 'aos/dist/aos.css'; // You can also use <link> for styles
// ..
AOS.init();

