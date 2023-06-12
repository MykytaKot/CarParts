<template>
    <div class="container">

        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">

            <router-link to="/"
                class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">CARS AND
                PARTS</router-link>


            <ul class="nav nav-pills">
                <li class="nav-item"><router-link to="/" class="nav-item nav-link">Home</router-link></li>
                <li class="nav-item"> <router-link to="/allParts" class="nav-link">Parts list</router-link></li>
                <li class="nav-item"><router-link to="/createCar" class="nav-link">Create Car</router-link></li>
                <li class="nav-item"> <router-link to="/createPart" class="nav-link">Create Part</router-link></li>


            </ul>
        </header>


        <router-view> </router-view>


    </div>
</template>
 
<script>
export default {}
</script>