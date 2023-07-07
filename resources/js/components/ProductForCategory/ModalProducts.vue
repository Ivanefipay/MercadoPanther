
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
					<form @submit.prevent="storeProduct" enctype="multipart/form-data">
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
			is_create: true,
			categories: [],
			product: {},
			file: null
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
			this.is_create = false
		},
		loadImage(event) {
			this.file = event.target.files[0]
		},
		loadFormData() {
			const form_data = new FormData()
			if (this.file) form_data.append('image', this.file, this.file.name)
			form_data.append('name', this.product.name)
			form_data.append('value', this.product.value)
			form_data.append('stock', this.product.stock)
			form_data.append('description', this.product.description)
			form_data.append('category_id', this.product.category_id)
			return form_data
		},
		async getCategories() {
			const { data } = await axios.get('Categories/GetAllCategories')
			this.categories = data.categories
		},
		async storeProduct() {
			try {
				const product = this.loadFormData()
				if (this.is_create) {
					await axios.post('Products/CreateProduct', product)
				} else {
					await axios.post(`Products/UpdateProduct/${this.product.id}`, product)
				}
				Swal.fire({
					icon: 'success',
					title: 'Felicidades!',
					text: 'Producto creado',
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

