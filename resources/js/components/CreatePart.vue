<template>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>

            <li class="breadcrumb-item active" aria-current="page">Create part</li>
        </ol>
    </nav>
    <div>
        <h3 class="text-center">Create Part</h3>
        <div class="d-flex justify-content-center">
            <div class="col-6 card shadow-sm p-4">
                <form @submit.prevent="addProduct">
                    <div class="form-group mb-2">
                        <input type="text" class="form-control p-2 mb-2" placeholder="Part name" v-model="product.name">


                        <input type="text" class="form-control p-2 mb-2" placeholder="Serial number"
                            v-model="product.serialnumber" required>
                        <label for="car" class="form-label">Car for part :</label>
                        <select class="form-select p-2" id='car' v-model="product.car_id" required>

                            <option v-for="option in products" :value="option.id"> {{ option.name }}</option>



                        </select>

                    </div>

                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
</template>
 
<script>
export default {
    data() {
        return {
            product: {},
            products: []
        }
    },
    created() {
        this.axios
            .get('/api/cars/')
            .then(response => {

                this.products = response.data;
            });
    },
    methods: {
        addProduct() {
            this.product.action = 'save';
            this.axios
                .post('/api/parts', this.product)
                .then(response => (
                    this.$router.push(`/parts/${this.product.car_id}`)
                ))
                .catch(err => console.log(err))
                .finally(() => this.loading = false)
        }
    }
}
</script>