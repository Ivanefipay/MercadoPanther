<template >
	<section>
		<div class="p-3 mb-2 bg-body-secondary d-flex justify-content-center flex-wrap ">
			<div class="card" style="width: 40rem;">
				<div class="card-header">
					Productos
				</div>
				<ul class="list-group list-group-flush" v-for="(product, index) in products" :key="index">
					<li class="list-group-item">
						<div class="row align-items-start">
							<div class="col">
								<div v-if="product.product.image"><img
										v-bind:src="`/storage/images/${product.product.image}`"
										class="img-fluid img-thumbnail whImage"></div>
								<div v-else><img v-bind:src="`/storage/images/xDdqbLXus4bbzhje8WPK.jpg`"
										class="img-fluid img-thumbnail whImage"></div>
							</div>
							<div class="col mx-1">
								<label for="category" class="form-label my-3">{{ product.product.name }}
								</label><br>
								<label for="valor" class="form-label">Valor: $ {{ product.product.value }}</label><br>
								<a class="btn btn-warning" @click=eliminate(product.id)>Eliminar</a>
							</div>
						</div>
					</li>
				</ul>
			</div>
			<div class="card mx-2" style="width: 18rem; ">
				<div class="card-header">
					Valor Compra
				</div>
				<ul class="list-group list-group-flush">
					<li class="list-group-item">Total a pagar: </li><br>
					<li class="list-group-item">Valor: $ {{ this.value }}<br><br>
						<a class="btn btn-primary my-2 mx-4 d-flex justify-content-center">Pagar</a>
					</li><br>

				</ul>
			</div>
		</div>
	</section>
</template>

<script>

/* import axios from 'axios';
import Swal from 'sweetalert2'; */
export default {
	name: 'MercadoPantherIndex',

	components: {

	},
	data() {
		return {
			products: [],
			product: null,
			value: 0
		};
	},
	created() {
		this.index()
	},
	mounted() {
	},

	methods: {
		async index() {
			await this.getProductsForUser()
		},
		async getProductsForUser() {
			try {
				this.value = 0
				const { data: { sale } } = await axios.get('Sales/GetAllSaleForSale')
				this.products = sale;
				for (var i = 0; i < this.products.length; i++) {
					this.value = this.products[i].product.value + this.value
				}
			} catch (error) {
				console.log(error);
			}
		},

		async eliminate(product_id){
			try {
				const result = await Swal.fire({
					icon: 'info',
					title: 'Quieres eliminar el producto?',
					showCancelButton: true,
					confirmButtonText: 'Eliminar',
				})
				if (!result.isConfirmed) return
				/* this.load = false; */
				await axios.delete(`Sales/DeleteAProductSale/${product_id}`)
				this.index()
				/* this.$parent.getProducts() */
				Swal.fire({
					icon: 'success',
					title: 'Felicidades!',
					text: 'Producto eliminado',
					showConfirmButton: true,
					confirmButtonText: 'Aceptar',
					/* timer: 1500 */
				})
			} catch (error) {
				console.log(error);
			}

		},


		async getProduct(product_id) {
			try {
				const { data } = await axios.get(`Products/GetAProduct/${product_id}`)
				this.editProduct(data.product)
			} catch (error) {
				console.log(error);
			}
		},

		editProduct(product) {
			this.product = product
			this.openModal()
		}
	},
};
</script>
