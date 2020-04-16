require('./bootstrap');
require('./Client.js');
if (document.getElementById('vue_app')){
    const Vue = require('vue');
    new Vue({
        el: '#vue_app',
        components: {
            'widget-component': require('./components/WidgetComponent.vue').default
        }
    });
}
