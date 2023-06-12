import AllCars from './components/AllCars.vue';
import CreateCar from './components/CreateCar.vue';
import EditCar from './components/EditCar.vue';
import CreatePart from './components/CreatePart.vue';
import EditPart from './components/EditPart.vue';
import AllPartsForCar from './components/AllPartsForCar.vue';
import AllParts from './components/AllParts.vue';
 
export const routes = [
    {
        name: 'home',
        path: '/',
        component: AllCars
    },
    {
        name: 'createCar',
        path: '/createCar',
        component: CreateCar
    },
    {
        name: 'editCar',
        path: '/editCar/:id',
        component: EditCar
    },
    {
        name: 'AllParts',
        path: '/allParts',
        component: AllParts
    },
    {
        name: 'partsForCar',
        path: '/parts/:id',
        component: AllPartsForCar
    },
    {
        name: 'createPart',
        path: '/createPart',
        component: CreatePart
    },
    {
        name: 'editPart',
        path: '/editPart/:id',
        component: EditPart
    }
];