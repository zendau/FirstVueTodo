<template>
    <form @submit.prevent="addItem">
        <b-form-input class="add_input" v-model="text" placeholder="Введите заметку"></b-form-input>
        <b-button type="submit" variant="success">Добавить</b-button>
    </form>
</template>

<script>
export default {
    data(){
        return {
            text: "",
        }
    },
    methods: {
        addItem(){
            console.log(this.text);
            this.$emit("add-todo", this.text)
        }
    }
}
</script>

<style lang="scss" scoped>
    form {
        display: flex;
        justify-content: center;
    }
    .add_input {
        max-width: 250px;
        margin-right: 25px;
    }
</style>