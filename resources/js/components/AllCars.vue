<template>
    <div class="album py-5 ">
        <div class="container">
            <h1 class="mb-3">Cars</h1>

            <div class="shadow-sm p-2 my-3"><span v-if="filter.abc == true" class="badge badge-primary bg-primary"
                    @click="UpdateList({ abc: false })"><i class="bi bi-sort-alpha-down"></i></span><span
                    v-if="filter.abc == false" class="badge badge-primary bg-primary" @click="UpdateList({ abc: true })"><i
                        class="bi bi-sort-alpha-down-alt"></i></span> <input type="checkbox" class="form-check-input m-2"
                    v-model="is_reg" @click="UpdateList({ is_reg: true })"><label for="">only Registered</label> </div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <div class="col-3" v-for="product in products" :key="product.id">
                    <div class="card shadow-sm ">
                        <div class="card-body">
                            <router-link :to="{ name: 'partsForCar', params: { id: product.id } }"
                                class="text-decoration-none text-secondary">
                                <h3 class="card-text ">{{ product.name }}</h3>
                            </router-link>
                            <div v-if="product.is_registered == 0" style="margin-bottom: 2.4rem;">
                                <span class="badge badge-danger  bg-danger">Not Registered</span>
                            </div>
                            <div v-if="product.is_registered == 1">
                                <span class="badge badge-success bg-success">Registered</span>

                            </div>

                            <p v-if="product.is_registered == 1" class="card-text">Reg number : {{
                                product.registration_number }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">

                                    <router-link :to="{ name: 'editCar', params: { id: product.id } }"
                                        class="btn btn-sm btn-outline-primary">Edit</router-link>
                                    <button class="btn btn-sm btn-outline-danger"
                                        @click="deleteProduct(product.id)">Delete</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="d-flex justify-content-center mt-3" v-if="products.length == 0">
                <h3>No cars avaliable</h3>
            </div>
        </div>
    </div>
</template>
 
<script>
export default {
    data() {
        return {
            products: [],
            filter: {},
        }
    },
    created() {
        this.filter.is_reg = false;
        this.filter.abc = true;
        this.axios
            .get('/api/cars/')
            .then(response => {
                this.products = response.data;
            });


    },
    methods: {
        deleteProduct(id) {
            this.axios
                .delete(`/api/cars/${id}`)
                .then(response => {
                    let i = this.products.map(data => data.id).indexOf(id);
                    this.products.splice(i, 1)
                });
        },

        UpdateList(filter = {}) {
            if (filter.hasOwnProperty('is_reg')) {
                this.filter.is_reg = !this.filter.is_reg;
            }
            if (filter.hasOwnProperty('abc')) {
                this.filter.abc = !this.filter.abc;
            }

            this.filter.action = 'filter';
            this.axios
                .post('/api/cars', this.filter)
                .then(response => {
                    this.products = response.data;
                });
        }

    }
}
</script>