<template>
	<table class="table">
      <thead>
        <tr>
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
          <th>{{product.id}}</th>
          <td>{{product.name}}</td>
		  <td>{{product.category.name}}</td>
          <td>{{product.value}}</td>
          <td>{{product.stock}}</td>
          <td>
			<button class="btn btn-warning me-2" >Editar</button>
			<button class="btn btn-danger">Eliminar</button>
		  </td>
        </tr>
      </tbody>
    </table>
</template>

<script>
export default {
	props: ['products_data'],

	data() {
		return {
			products: []
		};
	},

	created(){
		this.index()
	},

	methods:{
		index(){
			this.products = [...this.products_data]
		}
	}

};
</script>
