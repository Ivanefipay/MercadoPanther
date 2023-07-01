
import './bootstrap';
import { createApp } from 'vue';

// componets --------------------------------------------------------
import ExampleComponent from './components/ExampleComponent.vue';
import ProductsList from './components/Products/Index.vue';




const app = createApp({
	components: {
		ExampleComponent,
		ProductsList
	}
});




app.mount('#app');

