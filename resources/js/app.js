
import './bootstrap';
import { createApp } from 'vue';
import vSelect from "vue-select";


// componets --------------------------------------------------------
import ExampleComponent from './components/ExampleComponent.vue';
import ProductsList from './components/Products/Index.vue';
import UsersList from './components/Users/Index.vue';
import InicioList from './components/Inicio/Index.vue';
import SalesList from './components/Sales/Index.vue';



const app = createApp({
	components: {
		ExampleComponent,
		ProductsList,
		UsersList,
		InicioList,
		SalesList
	}
});




app.component("v-select", vSelect);
app.mount('#app');

