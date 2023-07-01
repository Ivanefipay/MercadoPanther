<template>
	<!-- html -->
	<div class="card mx-5 my-5">

		<div class="card-header d-flex justify-content-between">
			<h2>Productos</h2>
			<a class="btn btn-primary"> Crear producto</a>
		</div>

		<div class="card-body" >
            <section class="table-responsive" v-if="load">
				<table-component :products_data="products"/>
			</section>
			<section v-else>
				<div class="d-flex justify-content-center my-3">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
			</section>
		</div>
	</div>
</template>

<script>
import { onMounted } from 'vue';
import TableComponent from './Table.vue'
import axios from 'axios';

export default {
	props:[],
	components: {
		TableComponent
	},

	data() {
		return {
			products: [],
			load: false
		};
	},
	created() {
		this.index();
	},
	update() {

	},
	destroyed(){

	},
	Mounted(){

	},
	methods: {
		async index(){
			this.getProducts()
		},
		async getProducts() {
		try {
			const {data: {product}} = await axios.get('/api/Products/GetAllProducts')
			this.products = product;
			this.load = true
		} catch (error) {
			console.log(error);
		}
		}
	}
};
</script>
