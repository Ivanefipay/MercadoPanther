<template>
	<div class="modal fade" id="product_modal" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title fs-5" id="exampleModalLabel">{{ `${is_create ? 'Crear' : 'Actualizar'} producto`
					}}
					</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form @submit.prevent="storeProduct" enctype="multipart/form-data">
						<div class="mb-3">
							<label for="images" class="form-label">Imagen</label>
							<input type="file" class="form-control" id="file" accept="image/#" @change="loadImage">
						</div>
						<div class="mb-3">
							<label for="title" class="form-label">Nombre</label>
							<input type="text" class="form-control" id="title" v-model="product.name">
						</div>
						<div class="mb-3">
							<label for="valor" class="form-label">Valor</label>
							<input type="number" class="form-control" id="Valor" v-model="product.value">
						</div>
						<div class="mb-3">
							<label for="stock" class="form-label">Stock</label>
							<input type="number" class="form-control" id="Stock" v-model="product.stock">
						</div>
						<div class="mb-3">
							<label for="descripcion" class="form-label">Descripción</label>
							<textarea class="form-control" id="descripcion" rows="3"
								v-model="product.description"></textarea>
						</div>
						<div class="mb-3">
							<label for="category" class="form-label">Categoria</label>
							<v-select id="category" :options="this.categories" v-model="product.category_id"
								:reduce="category => category.id" label="name" :clearable="false">
							</v-select>
						</div>
						<hr>
						<section class="d-flex justify-content-center mt-3">
							<button type="button" class="btn btn-secondary me-1" data-bs-dismiss="modal">Cerrar</button>
							<button type="submit" class="btn btn-primary me-1">{{ `${is_create ? 'Crear' : 'Actualizar'}`}}</button>
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
		setProduct(){
			if (!this.product_data)return
			this.product = {...this.product_data}
			this.is_create = false
		},
		loadImage(event){
			this.file = event.target.files[0]
		},
		loadFormData(){
			const form_data = new FormData()
			if(this.file) form_data.append('image', this.file, this.file.name)
			form_data.append('name',this.product.name)
			form_data.append('value',this.product.value)
			form_data.append('stock',this.product.stock)
			form_data.append('description',this.product.description)
			form_data.append('category_id',this.product.category_id)
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
					text: 'producto almacenado',
					showConfirmButton: false,
					timer: 1500
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

