<template>
    <b-card class="w-50 mx-auto">
        <b-form @submit="onSubmit">
            <b-form-group
                id="input-group-1"
                label="Username:"
                label-for="input-1"
            >
                <b-form-input
                    id="input-1"
                    v-model="form.name"
                    type="text"
                    placeholder="Enter username"
                    required
                ></b-form-input>

            </b-form-group>

            <b-form-group
                id="input-group-2"
                label="Password:"
                label-for="input-2"
            >
                <b-form-input
                    id="input-2"
                    v-model="form.password"
                    type="password"
                    placeholder="Enter password"
                    required
                ></b-form-input>

            </b-form-group>


            <b-button type="submit" variant="primary">Login</b-button>
        </b-form>
    </b-card>
</template>

<script>
export default {
    data() {
      return {
        form: {
          name: '',
          password: '',
        },
      }
    },
    methods: {
        onSubmit(event) {
            event.preventDefault()
            
            axios.post('/admin/login', this.form).then(response => {
                localStorage.setItem("token", response.data.token)
            })

            this.$router.push('/admin/home')
        },
    }
}
</script>