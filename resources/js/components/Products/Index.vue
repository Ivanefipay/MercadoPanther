<template>
	<!-- html -->
	<div class="p-3 mb-2 bg-body-secondary">
		<div class="card mx-5 my-5 ">

			<div class="card-header d-flex justify-content-between ">
				<h2>Productos</h2>
				<button @click="openModal" class="btn btn-primary"> Crear producto</button>
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

			<section v-if="load_modal">
				<modal :product_data="product" />
			</section>
		</div>
	</div>
</template>

<script>

import TableComponent from './Table.vue'
import Modal from './Modal.vue'
import axios from 'axios';

export default {
	props: [],
	components: {
		TableComponent,
		Modal
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

		openModal() {
			this.load_modal = true;
			setTimeout(() => {
				this.modal = new bootstrap.Modal(document.getElementById('product_modal'), {
					keyboard: false
				})
				this.modal.show()

				const modal = document.getElementById('product_modal')
				modal.addEventListener('hidden.bs.modal', () => {
					this.load_modal = false
					this.product = null
				})
			}, 200)
		},
		closeModal() {
			this.modal.hide()
			this.$refs.table.datatable.destroy()
			this.$refs.table.index()
		},
		editProduct(product) {
			this.product = product
			this.openModal()
		}
	}
};
</script>
