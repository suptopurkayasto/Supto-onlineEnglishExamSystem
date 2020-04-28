import AOS from 'aos';
import 'aos/dist/aos.css';
AOS.init();

require('./01809e8659');
require('./word-count');

require('jquery-ui/ui/widgets/tooltip');
require('jquery-ui/ui/widgets/sortable');
require('jquery-ui/ui/widgets/selectmenu');
$(document).tooltip({
    track: true,
    classes: {
        "ui-tooltip": "text-primary shadow border-0 rounded"
    }
});

require('./jquery.multipage');
$('#myform').multipage({
    generateNavigation: false,
});



