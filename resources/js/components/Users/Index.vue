<template>
	<!-- html -->
	<div class="p-3 mb-2 bg-body-secondary">
		<div class="card mx-5 my-5 ">

			<div class="card-header d-flex justify-content-between ">
				<h2>Usuarios</h2>
			</div>

			<div class="card-body">
				<table-component ref="table" /><!-- :products_data="products" -->
				<!-- <section class="table-responsive" v-if="load">
			</section>
			<section v-else>
				<div class="d-flex justify-content-center my-3">
					<div class="spinner-border" role="status">
						<span class="visually-hidden">Loading...</span>
					</div>
				</div>
			</section> -->
			</div>

		</div>
	</div>
</template>

<script>

import TableComponent from './Table.vue'
import axios from 'axios';

export default {
	props: [],
	components: {
		TableComponent,
	},

	data() {
		return {
			/* products: [], */
			/* load: false, */
			load_modal: false,
			modal: null,
			product: null
		};
	},
	update() {

	},
	destroyed() {

	},
	Mounted() {

	},
	methods: {


	}
};
</script>
