<template>
	<table class="table" id="userTable" @click="getEvent">
		<thead>
			<tr>
				<!-- <th scope="col">IMAGEN</th>
				<th scope="col"># PRODUCTO</th> -->
				<th scope="col">NOMBRE</th>
				<th scope="col">AELLIDO</th>
				<th scope="col">N° IDENTIFICACION</th>
				<th scope="col">CORREO ELECTRONICO</th>
				<th scope="col">ROL</th>
				<th scope="col">ACCIONES</th>
			</tr>
		</thead>
		<tbody>
			<!-- <tr v-for="(product, index) in products" :key="index">
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
			</tr> -->
		</tbody>
	</table>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';

export default {

	data() {
		return {
			//products: [],
			datatable: {}
		};
	},

	/* created() {
		this.index()
	}, */

	mounted(){
		this.index()
		/* $('#productTable').DataTable() */
		/* setTimeout(() => {
		}, 500) */
	},

	methods: {
		async index() {
			this.mountDataTable()
			//await this.getProducts()
		},
		async getProducts() {
			try {
				const { data: { product } } = await axios.get('Products/GetAllProducts')
				this.products = product;
			} catch (error) {
				console.log(error);
			}
			this.mountDataTable()
		},
		mountDataTable(){
			/* setTimeout(() => { */
			this.datatable = $('#userTable').DataTable({
				processing: true,
				serverSide: true,
				ajax:{
					url:'/Users/GetAllUsersForDataTable'
				},
				columns:[
					{data: 'name', name: 'name'},
					{data: 'last_name', name: 'last_name'},
					{data: 'number_id', name: 'number_id'},
					{data: 'email', name: 'email'},
					{data: 'roles[0].name', name: 'roles', searchable: false},
					{data: 'action', name: 'action'},
				]
			})
		   /*  }, 200) */
		},
		getEvent(event){
			const button = event.target
			if(button.getAttribute('role') == 'edit'){
				 this.rol(button.getAttribute('data-id'))
				/* alert('edit') */
			}
		},
		async getProduct(product_id) {
			try {
				const {data} = await axios.get(`Products/GetAProduct/${product_id}`)
				this.$parent.editProduct(data.product)
			} catch (error) {
				console.log(error);
			}
		},
		async rol(product_id) {
			try {
				const result = await Swal.fire({
					icon: 'info',
					title: 'Quieres cambiar el rol?',
					showCancelButton: true,
					confirmButtonText: 'Cambiar',
				})
				if (!result.isConfirmed) return
				this.datatable.destroy()
				/* this.load = false; */
				await axios.post(`Users/ChangeRol/${product_id}`)
				this.index()
				/* this.$parent.getProducts() */
				Swal.fire({
					icon: 'success',
					title: 'Felicidades!',
					text: 'Rol cambiado',
					showConfirmButton: true,
					confirmButtonText: 'Aceptar',
					/* timer: 1500 */
				})
			} catch (error) {
				console.log(error);
			}
		}
	}

};
</script>
