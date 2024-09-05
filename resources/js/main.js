// src/main.js
import { createApp } from 'vue';
import App from './App.vue';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import router from './router.js';
import { createI18n } from 'vue-i18n';

import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { faCoffee, faPen, faTrashAlt,faPlus,faCirclePlus, faEarthAsia, faRightFromBracket, faArrowLeft, faCircleCheck,faTimesCircle,faDownload,faTrash,faEye} from '@fortawesome/free-solid-svg-icons';
import './assets/main.css';
import './assets/extended.css';

import store from './store/index.js';

import en from './locales/en.json';
import ru from './locales/ru.json';

const messages = {
    en,
    ru,
};
const savedLanguage = localStorage.getItem('preferred_language') || 'en';
const i18n = createI18n({
    locale: savedLanguage,
    fallbackLocale: 'en',
    messages,
});

library.add(faCoffee, faPen, faTrashAlt,faPlus,faCirclePlus, faEarthAsia, faRightFromBracket,faArrowLeft,faCircleCheck,faTimesCircle,faDownload,faTrash,faEye);

const app = createApp(App);

app.component('font-awesome-icon', FontAwesomeIcon);

app.use(i18n);
app.use(store);
app.use(router);

app.mount('#app');
