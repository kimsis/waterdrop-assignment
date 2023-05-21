import './assets/main.css'

import { createApp } from 'vue'

// @ts-ignore
import App from './App.vue'
import router from './router'
import store from "@/stores";
// @ts-ignore
import {createVuetify} from 'vuetify';
import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives';

const vuetify = createVuetify({
    components,
    directives,
})

const app = createApp(App)

app.use(store)
app.use(router)
app.use(vuetify)

app.mount('#app')
