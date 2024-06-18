import { createApp } from 'vue';
import App from './components/App.vue';
import router from './router/index.js';

// Import Bootstrap CSS
import 'bootstrap/dist/css/bootstrap.css';
// Import Bootstrap JS
import 'bootstrap/dist/js/bootstrap.bundle.min.js';

const app = createApp(App);
app.use(router);
app.mount('#app');
