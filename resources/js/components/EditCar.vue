<template>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>

            <li class="breadcrumb-item active" aria-current="page">Edit {{ product.name }}</li>
        </ol>
    </nav>
    <div>
        <h3 class="text-center">Edit Car</h3>
        <div class="d-flex justify-content-center">
            <div class="col-6 card shadow-sm p-4">
                <form @submit.prevent="updateProduct">
                    <div class="form-group mb-2">

                        <input type="text" class="form-control p-2" placeholder="Car name" v-model="product.name">
                        <div class="pt-2 pb-2">
                            <input class="form-check-input " type="checkbox" v-model="product.is_registered"
                                id="flexSwitchCheckDefault">
                            <label class="form-check-label " style="margin-left: 0.5rem;" for="flexSwitchCheckDefault">: Is
                                registered</label>
                        </div>

                        <input v-if="product.is_registered" type="text" class="form-control p-2"
                            placeholder="Registration number" v-model="product.registration_number" required>

                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</template>
 
<script>
export default {
    data() {
        return {
            product: {}
        }
    },
    created() {
        this.axios
            .get(`/api/cars/${this.$route.params.id}`)
            .then((res) => {

                this.product = res.data;
                this.product.is_registered = this.product.is_registered == 1;
            });
    },
    methods: {
        updateProduct() {
            this.axios
                .patch(`/api/cars/${this.$route.params.id}`, this.product)
                .then((res) => {
                    this.$router.push({ name: 'home' });
                });
        }
    }
}
</script>