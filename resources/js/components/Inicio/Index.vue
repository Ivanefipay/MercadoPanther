<template >
	<div class="p-3 mb-2 bg-body-secondary" v-if="this.allProductsForCategory">
		<section class="container">
			<div class="card border-0" v-for="(category, index) in categories" :key="index">
				<div class="card-body  bg-body-secondary">
					<h3 class="card-title">{{ category.name }}<a @click="AllProductsForCategory(category.id)" class="fs-6 mx-2">Ver todos</a></h3><!-- href="/ProductsForCategory"  -->
					<section class="d-flex justify-content-center flex-wrap  ">
						<div class="card border-0 whImage mx-2 my-3"
							v-for="(product, index) in productForCategory[category.id]" :key="index">
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
			</div>
		</section>
		<section v-if="load_modal">
			<modal-product :product_data="product"/>
		</section>
	</div>
	<div class="p-3 mb-2 bg-body-secondary" v-else>
		<section class="container">
				<div class="card-body  bg-body-secondary">
					<a @click="Back()" class="fs-6 mx-2">- Regresar</a>
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

import ModalProduct from './ModalProduct.vue'
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
			allProductsForCategory: true,
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
			/* await this.getProducts() */
			await this.getCategories()
		},
		async getProducts() {
			try {
				const { data: { product } } = await axios.get('Products/GetAllProducts')
				this.products = product;
			} catch (error) {
				console.log(error);
			}
		},

		async getCategories() {
			try {
				const { data: { categories } } = await axios.get('Categories/GetAllCategories')
				this.categories = categories;
				for (var i = 0; i < categories.length; i++) {
					this.getAllProductsForCategory(categories[i].id)
				}
			} catch (error) {
				console.log(error);
			}
		},

		async getAllProductsForCategory(category_id) {
			try {
				const { data: { product } } = await axios.get(`Products/GetAllProductsForCategory/${category_id}`)
				this.products = product;
				this.productForCategory[category_id] = this.products
			} catch (error) {
				console.log(error);
			}
		},
		async AllProductsForCategory(category_id){
			this.allProductsForCategory = false
			try {
				const { data: { product } } = await axios.get(`Products/GetProductsForCategory/${category_id}`)
				this.products = product;
				this.productForCategory[category_id] = this.products
			} catch (error) {
				console.log(error);
			}
		},
		Back(){
			this.allProductsForCategory = true
			this.getCategories()
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
			/* this.$refs.table.datatable.destroy() */
			/* this.$refs.table.index() */
		},
		editProduct(product){
			this.product = product
			this.openModal()
		}
	},
};
</script>
