<template>
	<div class="modal fade" id="product_modal" tabindex="-1" aria-hidden="false">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title fs-5" id="exampleModalLabel">Información del producto
					</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body ">
					<form @submit.prevent="storeProduct(product.id)" enctype="multipart/form-data">
						<div class="container ">
							<div class="row align-items-start">
								<div class="col">
									<div v-if="product.image"><img v-bind:src="`/storage/images/${product.image}`"
											class="img-fluid img-thumbnail whImage"></div>
									<div v-else><img v-bind:src="`/storage/images/xDdqbLXus4bbzhje8WPK.jpg`"
											class="img-fluid img-thumbnail whImage"></div>
								</div>
								<div class="col">
									<label for="category" class="form-label my-3">Categoria: {{ product.category.name }}
									</label>
									<label for="valor" class="form-label">Valor: $ {{ product.value }}</label>
									<label for="stock" class="form-label">Stock: {{ product.stock }} unidades</label>
								</div>
							</div>
						</div>
						<div class="mb-3">

						</div>
						<div class="mb-3">
							<label for="title" class="form-label">{{ product.name }}</label>
						</div>
						<div class="mb-3">
							<label for="descripcion" class="form-label">Descripción: </label>
							<label for="descripcion" class="form-label">{{ product.description }}</label>
						</div>
						<hr>
						<section class="d-flex justify-content-center mt-3">
							<button type="button" class="btn btn-secondary me-1" data-bs-dismiss="modal">Cerrar</button>
							<button type="submit" class="btn btn-primary me-1">Agregar a carrito</button>
						</section>
					</form>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import axios from 'axios'
import Swal from 'sweetalert2'

export default {
	props: ['product_data'],

	data() {
		return {
			categories: [],
			product: {},
			Sale: {},
			file: null,
			id: null
		}
	},

	created() {
		this.index()
	},

	methods: {
		index() {
			this.getCategories()
			this.setProduct()
		},
		setProduct() {
			if (!this.product_data) return
			this.product = { ...this.product_data }
		},
		async getCategories() {
			const { data } = await axios.get('Categories/GetAllCategories')
			this.categories = data.categories
		},
		async storeProduct(product_id) {
			try {
					this.id = await axios.get('Users/GetUsersAuth')
					this.addCar(this.id.data, product_id);

				} catch (error) {
					Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: 'Debe iniciar sesion'
				})
				}
		},
		async addCar(id,product_id){
			try {
				const form_data = new FormData()
				form_data.append('user_id', id)
				form_data.append('product_id', product_id)
				form_data.append('date', '2023-07-07 15:55:52')
				await axios.post(`Sales/CreateSale`, form_data)
				Swal.fire({
					icon: 'success',
					title: 'Felicidades!',
					text: 'Producto agregado',
					showConfirmButton: true,
					confirmButtonText: 'Aceptar',
				})
				this.$parent.closeModal()
			} catch (error) {
				console.log(error);
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: 'Algo salio mal!'
				})
			}
		}
	},
}
</script>

