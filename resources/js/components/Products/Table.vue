<template>
	<table class="table">
		<thead>
			<tr>
				<th scope="col">IMAGEN</th>
				<th scope="col"># PRODUCTO</th>
				<th scope="col">NOMBRE</th>
				<th scope="col">CATEGORIA</th>
				<th scope="col">VALOR</th>
				<th scope="col">STOCK</th>
				<th scope="col">ACCIONES</th>
			</tr>
		</thead>
		<tbody>
			<tr v-for="(product, index) in products" :key="index">
				<th v-if="product.image"><img v-bind:src="`/storage/images/${product.image}`" class="img-fluid img-thumbnail"></th>
				<th v-else>Sin imagen</th>
				<th>{{ product.id }}</th>
				<td>{{ product.name }}</td>
				<td>{{ product.category.name }}</td>
				<td>{{ product.value }}</td>
				<td>{{ product.stock }}</td>
				<td>
					<button class="btn btn-warning me-2" @click="getProduct(product)">Editar</button>
					<button class="btn btn-danger" @click="deleteProduct(product)">Eliminar</button>
				</td>
			</tr>
		</tbody>
	</table>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';

export default {
	props: ['products_data'],

	data() {
		return {
			products: []
		};
	},

	created() {
		this.index()
	},

	methods: {
		index() {
			this.products = [...this.products_data]
		},
		async getProduct(product) {
			try {
				/* const {data} = await axios.get(`Products/GetAProduct/${product_id}`) */
				this.$parent.editProduct(product)
			} catch (error) {
				console.log(error);
			}
		},
		async deleteProduct(product) {
			try {
				const result = await Swal.fire({
					icon: 'info',
					title: 'Quieres eliminar el producto?',
					showCancelButton: true,
					confirmButtonText: 'Eliminar',
				})
				if (!result.isConfirmed) return

				await axios.delete(`Products/DeleteAProduct/${product.id}`)
				this.$parent.getProducts()
				Swal.fire({
					icon: 'success',
					title: 'Felicidades!',
					text: 'Producto eliminado',
					showConfirmButton: false,
					timer: 1500
				})
			} catch (error) {
				console.log(error);
			}
		}
	}

};
</script>
