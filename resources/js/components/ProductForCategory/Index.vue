<template >
	<div class="p-3 mb-2 bg-body-secondary">
		<section class="container">
				<div class="card-body  bg-body-secondary">
					<section class="d-flex justify-content-center flex-wrap  ">
						<div class="card border-0 whImage mx-2 my-3"
							v-for="(product, index) in products" :key="index">
							<div class="card-body">
								<th v-if="product.image"><img v-bind:src="`/storage/images/${product.image}`"
										class="img-fluid img-thumbnail whImage"></th>
								<th v-else><img v-bind:src="`/storage/images/xDdqbLXus4bbzhje8WPK.jpg`"
										class="img-fluid img-thumbnail whImage"></th>
								<h5 class="card-title">{{ product.name }}</h5>
								<p class="card-text">Valor: $ {{ product.value }}</p>
								<p class="card-text">Stock: {{ product.stock }}</p>
								<a class="btn btn-primary" @click="getProduct(product.id)">Ver mas</a>
							</div>
						</div>
					</section>
				</div>
		</section>
		<section v-if="load_modal">
			<modal-product :product_data="product"/>
		</section>
	</div>
</template>

<script>

import ModalProduct from './ModalProducts.vue'
export default {
	name: 'MercadoPantherIndex',

	components: {
		ModalProduct
	},
	data() {
		return {
			products: [],
			categories: [],
			productForCategory: [],
			load_modal: false,
			modal: null,
			product: null
		};
	},
	created() {
		this.index()
	},
	mounted() {
	},

	methods: {
		async index() {
			await this.getProducts()
			/* await this.getCategories() */
			/* await this.getProductsForcategory() */
		},
		async getProducts() {
			try {
				const { data: { product } } = await axios.get('Products/GetAllProducts')
				this.products = product;
			} catch (error) {
				console.log(error);
			}
		},


		openModal() {
			this.load_modal = true;
			setTimeout(() => {
				this.modal = new bootstrap.Modal(document.getElementById('product_modal'), {
					keyboard: false
				})
				this.modal.show()

				const modal = document.getElementById('product_modal')
				modal.addEventListener('hidden.bs.modal', ()=> {
					this.load_modal = false
					this.product = null
				})
			}, 200)
		},
		async getProduct(product_id) {
			try {
				const {data} = await axios.get(`Products/GetAProduct/${product_id}`)
				this.editProduct(data.product)
			} catch (error) {
				console.log(error);
			}
		},
		closeModal() {
			this.modal.hide()
			this.$refs.table.datatable.destroy()
			this.$refs.table.index()
		},
		editProduct(product){
			this.product = product
			this.openModal()
		}
	},
};
</script>
