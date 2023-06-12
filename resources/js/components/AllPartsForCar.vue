<template>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>

            <li class="breadcrumb-item active" aria-current="page"> {{ car.name }}</li>
        </ol>
    </nav>
    <div class="album py-3 ">
        <div class="container">
            <h1 class="mb-3">Parts for {{ car.name }}</h1>
            <div class="shadow-sm p-2 my-3"><span v-if="filter.abc == true" class="badge badge-primary bg-primary"
                    @click="UpdateList({ abc: false })"><i class="bi bi-sort-alpha-down"></i></span><span
                    v-if="filter.abc == false" class="badge badge-primary bg-primary" @click="UpdateList({ abc: true })"><i
                        class="bi bi-sort-alpha-down-alt"></i></span> </div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <div class="col-3" v-for="product in parts" :key="product.id">
                    <div class="card shadow-sm ">
                        <div class="card-body">
                            <h3 class="card-text ">{{ product.name }}</h3>


                            <p class="card-text">Serial number : {{ product.serialnumber }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">

                                    <router-link :to="{ name: 'editPart', params: { id: product.id } }"
                                        class="btn btn-sm btn-outline-primary">Edit</router-link>
                                    <button class="btn btn-sm btn-outline-danger"
                                        @click="deleteProduct(product.id)">Delete</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="d-flex justify-content-center mt-3" v-if="parts.length == 0">
                <h3>No parts avaliable</h3>
            </div>
        </div>
    </div>
</template>
 
<script>
export default {
    data() {
        return {
            car: {},
            parts: [],
            filter: {}
        }
    },
    created() {
        this.filter.abc = true;
        this.axios
            .get(`/api/cars/${this.$route.params.id}`)
            .then(response => {
                this.car = response.data;
                this.axios



                    .post('/api/parts', { action: 'getforcar', id: this.$route.params.id })
                    .then(response => (
                        this.parts = response.data
                    ))
            });


    },
    methods: {
        deleteProduct(id) {
            this.axios
                .delete(`/api/parts/${id}`)
                .then(response => {
                    let i = this.parts.map(data => data.id).indexOf(id);
                    this.parts.splice(i, 1)
                });
        },
        UpdateList(filter = {}) {

            if (filter.hasOwnProperty('abc')) {
                this.filter.abc = !this.filter.abc;
            }

            this.filter.action = 'filter';
            this.filter.id = this.$route.params.id;
            this.axios
                .post('/api/parts', this.filter)
                .then(response => {
                    this.parts = response.data;
                });
        }
    }
}
</script>