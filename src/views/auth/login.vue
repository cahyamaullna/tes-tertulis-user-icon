<template>
    <div>
        <form class="tes login" @submit.prevent="store()">
            <h1>Login to your Account</h1>
            <label for="">Email</label>
            <input type="email" v-model="transaction.email" required>
            <div v-if="validation.email">
                {{ validation.email[0] }}
            </div>
            <label for="">Password</label>
            <input type="password" v-model="transaction.password" required>
            <div v-if="validation.password">
                {{ validation.password[0] }}
            </div>
            <button>Login</button>
        </form>
        <h5>Dont have an account?<router-link :to="{ name: 'auth.register'}" class="router">&nbsp Register</router-link></h5>
        <h5>Forgotten your password? <a class="router">&nbsp Recover password</a></h5>
    </div>
</template>

<script>
import { reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'

export default {
    setup(){
        const transaction = reactive({
        email: '',
        password: '',
    });

    const validation = ref([]);
    const router = useRouter();

    function store() {
        axios.post(
            'http://127.0.0.1:8000/api/transaction',
            transaction
        )
        .then(() => {
            router.push({
                name: 'transaction.index'
            });
        }).catch((err) => {
            validation.value = err.response.data
        });
    }

    return {
        transaction,
        validation,
        router,
        store
    }
    }
}
</script>
